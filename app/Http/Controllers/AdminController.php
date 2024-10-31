<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\dataStaff;
use App\Models\dataUtama;
use App\Models\UMKM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(){
        $total_berita = Artikel::count();
        $total_umkm = UMKM::count();
        $total_perangkat = dataStaff::count();
        $total_admin = User::count();
        $total_kunjungan = Artikel::sum('view');
        return view('admin.dashboard', ['total_berita' => $total_berita, 'total_umkm' => $total_umkm, 'total_perangkat' => $total_perangkat, 'total_admin' => $total_admin, 'total_kunjungan' => $total_kunjungan]);
    }

    public function showProfile(){
        $dataUtama = dataUtama::first();
        return view('admin.profil', ['dataUtama' => $dataUtama]);
    }

    public function showBerita(){
        $beritas = Artikel::with('user')->get();
        return view('admin.listberita', ['beritas' => $beritas]);
    }

    public function showUmkm(){
        $data = UMKM::with('user')->get();
        return view('admin.listumkm', ['data' => $data]);
    }

    public function showUser(){
        $user = User::all();
        return view('admin.listuser', ['user' => $user]);
    }

    public function showUploadBerita(){
        return view('admin.uploadberita');
    }

    public function addUser(){
        return view('admin.adduser');
    }

    public function login(Request $request){
        $validation = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($validation, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request){
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect the user to the homepage
        return redirect('/');
    }

    public function createUser(Request $request){
        $data = User::where('username', $request->username)->first();
        if(!$data){
            $akun = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($akun) {
                return redirect('/admin/user')->with('success', 'Akun berhasil dibuat');
            }else{
                return redirect('/admin/user')->with('error', 'Akun gagal dibuat');
            }
        }else{
            return back()->with('error', 'Username telah terdaftar');
        }

    }

    public function deleteUser($id){
        $user = User::where('id', $id)->first();
        if (!$user) {
            return back()->with('error', 'User tidak tersedia');
        }

        if ($user->username == 'superadmin') {
            return back()->with('error', 'Tidak dapat menghapus akun utama');
        }

        $user->delete();
        return back()->with('success', 'Berhasil menghapus akses user');
    }

    public function editUser($id){
        $user = User::where('id', $id)->first();
        return view('admin.edituser', ['user' => $user]);
    }

    public function updateUser(Request $request, $id){
        $user = User::where('id', $id)->first();

        if(!$user){
            return back()->with('error', 'User tidak tersedia');
        }

        if($user->username == 'superadmin'){
            if($request->password != null){
                $user->password = Hash::make($request->password);
                $user->save();
            }
        }else{
            $user->name = $request->name;
            $user->username = $request->username;
            if($request->password != null){
                $user->password = Hash::make($request->password);
                $user->save();
            }
            $user->save();
        }
        return redirect('/admin/user')->with('success', 'Berhasil memperbarui data');
    }

    public function uploadBerita(Request $request){
        //dd($request);
        $berita = new Artikel();
        $berita->judul = $request->title;
        $berita->user_id = Auth::id();
        $berita->konten = $request->content;

        if ($request->hasFile('thumbnail')) {
            $newThumbnailFile = $request->file('thumbnail');
            $newThumbnailFilename = $newThumbnailFile->hashName();

            // Store the new thumbnail
            Storage::put('/public/img/thumbnail/' . $newThumbnailFilename, file_get_contents($newThumbnailFile->getRealPath()));

            // Delete the old thumbnail if it exists
            if (!empty($website->thumbnail)) {
                Storage::delete('/public/img/thumbnail/' . $berita->thumbnail);
            }

            // Update the website's thumbnail field
            $berita->thumbnail = $newThumbnailFilename;
        }else{
            $berita->thumbnail = 'not_avaliable.png';
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];

            // Store new images
            foreach ($request->file('images') as $image) {
                $imagePath = $image->hashName();
                Storage::put('/public/img/dokumentasi/' . $imagePath, file_get_contents($image->getRealPath()));
                $imagePaths[] = $imagePath;
            }

            // Delete old images if any exist
            if (!empty($berita->images)) {
                foreach (json_decode($berita->images, true) as $filename) {
                    $oldFilePath = '/public/img/dokumentasi/' . $filename;

                    // Check if the file exists before deleting
                    if (Storage::exists($oldFilePath)) {
                        Storage::delete($oldFilePath);
                    }
                }
            }

            // Update the images field with new image paths
            $berita->images = json_encode($imagePaths, JSON_UNESCAPED_SLASHES);
        }

        $berita->save();

        return redirect('/admin/berita')->with('success', 'Berita berhasil dibuat');

    }

    public function deleteBerita($id){
        $berita = Artikel::where('id', $id)->first();

        if (!$berita) {
            return back()->with('error', 'Data berita tidak tersedia');
        }

        $images = json_decode($berita->images, true);

        foreach ($images as $imageTitle) {
            $imagePath = '/public/img/dokumentasi/' . $imageTitle;

            // Check if the file exists in storage
            if (!Storage::exists($imagePath)) {
                return back()->with('error', 'file tidak tersedia di storage');
            }
        }

        foreach ($images as $imageTitle) {
            $imagePath = '/public/img/dokumentasi/' . $imageTitle;

            // Attempt to delete the file
            if (!Storage::delete($imagePath)) {
                return back()->with('error', 'file gagal dihapus');
            }
        }

        $thumbnail = $berita->thumbnail;
        $thumbnailPath = '/public/img/thumbnail/' . $thumbnail;
        if (!Storage::exists($thumbnailPath)) {
            return back()->with('error', 'file tidak tersedia di storage');
        }
        if (!Storage::delete($thumbnailPath)) {
            return back()->with('error', 'file gagal dihapus');
        }

        $berita->delete();
        return back()->with('success', 'Berita berhasil dihapus');
    }

    public function editBerita($id){
        $data = Artikel::where('id', $id)->with('user')->first();
        $data->array_images = json_decode($data->images, true);
        return view('admin.editberita', ['data' => $data]);
    }

    public function updateBerita(Request $request, $id){
        $berita = Artikel::where('id', $id)->with('user')->first();

        if (!$berita) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $berita->judul = $request->title;
        $berita->konten = $request->content;

        if ($request->hasFile('thumbnail')) {
            $newThumbnailFile = $request->file('thumbnail');
            $newThumbnailFilename = $newThumbnailFile->hashName();

            // Store the new thumbnail
            Storage::put('/public/img/thumbnail/' . $newThumbnailFilename, file_get_contents($newThumbnailFile->getRealPath()));

            // Delete the old thumbnail if it exists
            if (!empty($berita->thumbnail) && $berita->thumbnail != 'not_avaliable.png') {
                Storage::delete('/public/img/thumbnail/' . $berita->thumbnail);
            }

            // Update the website's thumbnail field
            $berita->thumbnail = $newThumbnailFilename;
        }

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];

            // Store new images
            foreach ($request->file('images') as $image) {
                $imagePath = $image->hashName();
                Storage::put('public/img/dokumentasi/' . $imagePath, file_get_contents($image->getRealPath()));
                $imagePaths[] = $imagePath;
            }

            // Delete old images if any exist
            if (!empty($berita->images)) {
                foreach (json_decode($berita->images, true) as $filename) {
                    $oldFilePath = 'public/img/dokumentasi/' . $filename;

                    // Check if the file exists before deleting
                    if (Storage::exists($oldFilePath)) {
                        Storage::delete($oldFilePath);
                    }
                }
            }

            // Update the images field with new image paths
            $berita->images = json_encode($imagePaths, JSON_UNESCAPED_SLASHES);
        }

        // Save the website data
        $berita->save();
        return redirect('/admin/berita')->with('success', 'Data berhasil di update');
    }

    public function showPerangkat(){
        $user = dataStaff::all();
        return view('admin.listperangkat', ['user' => $user]);
    }

    public function addPerangkat(){
        return view('admin.addperangkat');
    }

    public function submitPerangkat(Request $request){
        $perangkat = new dataStaff();
        $perangkat->nama = $request->name;
        $perangkat->NIP = $request->NIP;
        $perangkat->Jabatan = $request->jabatan;
        $perangkat->nomor_telepon = $request->no_telp;
        if ($request->hasFile('thumbnail')) {
            $newThumbnailFile = $request->file('thumbnail');
            $newThumbnailFilename = $newThumbnailFile->hashName();

            // Store the new thumbnail
            Storage::put('/public/img/perangkat/' . $newThumbnailFilename, file_get_contents($newThumbnailFile->getRealPath()));

            // Delete the old thumbnail if it exists
            if (!empty($perangkat->thumbnail)) {
                Storage::delete('/public/img/perangkat/' . $perangkat->thumbnail);
            }

            // Update the website's thumbnail field
            $perangkat->thumbnail = $newThumbnailFilename;
        }

        $perangkat->save();

        return redirect('/admin/perangkat')->with('success', 'Berhasil menambahkan data baru');

    }

    public function editPerangkat($id){
        $user = dataStaff::where('id', $id)->first();
        return view('admin.editperangkat', ['user' => $user]);
    }

    public function updatePerangkat(Request $request, $id){
        $perangkat = dataStaff::where('id', $id)->first();

        if (!$perangkat) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $perangkat->nama = $request->name;
        $perangkat->NIP = $request->NIP;
        $perangkat->Jabatan = $request->jabatan;
        $perangkat->nomor_telepon = $request->no_telp;

        if ($request->hasFile('thumbnail')) {
            $newThumbnailFile = $request->file('thumbnail');
            $newThumbnailFilename = $newThumbnailFile->hashName();

            // Store the new thumbnail
            Storage::put('/public/img/perangkat/' . $newThumbnailFilename, file_get_contents($newThumbnailFile->getRealPath()));

            // Delete the old thumbnail if it exists
            if (!empty($perangkat->thumbnail)) {
                Storage::delete('/public/img/perangkat/' . $perangkat->thumbnail);
            }

            // Update the website's thumbnail field
            $perangkat->thumbnail = $newThumbnailFilename;
        }

        $perangkat->save();
        return redirect('/admin/perangkat')->with('success', 'Data berhasil diperbarui');
    }

    public function showUploadUmkm(){
        return view('admin.addUMKM');
    }

    public function uploadUmkm(Request $request){
        $umkm = new UMKM();
        $umkm->judul = $request->title;
        $umkm->user_id = Auth::id();
        $umkm->konten = $request->content;

        if ($request->hasFile('thumbnail')) {
            $newThumbnailFile = $request->file('thumbnail');
            $newThumbnailFilename = $newThumbnailFile->hashName();

            // Store the new thumbnail
            Storage::put('/public/img/thumbnail/' . $newThumbnailFilename, file_get_contents($newThumbnailFile->getRealPath()));

            // Delete the old thumbnail if it exists
            if (!empty($umkm->thumbnail)) {
                Storage::delete('/public/img/thumbnail/' . $umkm->thumbnail);
            }

            // Update the website's thumbnail field
            $umkm->thumbnail = $newThumbnailFilename;
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];

            // Store new images
            foreach ($request->file('images') as $image) {
                $imagePath = $image->hashName();
                Storage::put('/public/img/UMKM/' . $imagePath, file_get_contents($image->getRealPath()));
                $imagePaths[] = $imagePath;
            }

            // Delete old images if any exist
            if (!empty($umkm->images)) {
                foreach (json_decode($umkm->images, true) as $filename) {
                    $oldFilePath = '/public/img/UMKM/' . $filename;

                    // Check if the file exists before deleting
                    if (Storage::exists($oldFilePath)) {
                        Storage::delete($oldFilePath);
                    }
                }
            }

            // Update the images field with new image paths
            $umkm->images = json_encode($imagePaths, JSON_UNESCAPED_SLASHES);
        }

        $umkm->save();

        return redirect('/admin/umkm')->with('success', 'Berita berhasil dibuat');
    }

    public function deleteUmkm($id){
        $umkm = UMKM::where('id', $id)->first();

        if (!$umkm) {
            return back()->with('error', 'Data umkm tidak tersedia');
        }

        $images = json_decode($umkm->images, true);

        foreach ($images as $imageTitle) {
            $imagePath = '/public/img/UMKM/' . $imageTitle;

            // Check if the file exists in storage
            if (!Storage::exists($imagePath)) {
                return back()->with('error', 'file tidak tersedia di storage');
            }
        }

        foreach ($images as $imageTitle) {
            $imagePath = '/public/img/UMKM/' . $imageTitle;

            // Attempt to delete the file
            if (!Storage::delete($imagePath)) {
                return back()->with('error', 'file gagal dihapus');
            }
        }

        $thumbnail = $umkm->thumbnail;
        $thumbnailPath = '/public/img/thumbnail/' . $thumbnail;
        if (!Storage::exists($thumbnailPath)) {
            return back()->with('error', 'file tidak tersedia di storage');
        }
        if (!Storage::delete($thumbnailPath)) {
            return back()->with('error', 'file gagal dihapus');
        }

        $umkm->delete();
        return back()->with('success', 'Data UMKM berhasil dihapus');
    }

    public function editUmkm($id){
        $data = UMKM::where('id', $id)->with('user')->first();
        $data->array_images = json_decode($data->images, true);
        return view('admin.editumkm', ['data' => $data]);
    }

    public function updateUmkm(Request $request, $id){
        $umkm = UMKM::where('id', $id)->with('user')->first();

        if (!$umkm) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $umkm->judul = $request->title;
        $umkm->konten = $request->content;

        if ($request->hasFile('thumbnail')) {
            $newThumbnailFile = $request->file('thumbnail');
            $newThumbnailFilename = $newThumbnailFile->hashName();

            // Store the new thumbnail
            Storage::put('/public/img/thumbnail/' . $newThumbnailFilename, file_get_contents($newThumbnailFile->getRealPath()));

            // Delete the old thumbnail if it exists
            if (!empty($umkm->thumbnail)) {
                Storage::delete('/public/img/thumbnail/' . $umkm->thumbnail);
            }

            // Update the website's thumbnail field
            $umkm->thumbnail = $newThumbnailFilename;
        }

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];

            // Store new images
            foreach ($request->file('images') as $image) {
                $imagePath = $image->hashName();
                Storage::put('public/img/UMKM/' . $imagePath, file_get_contents($image->getRealPath()));
                $imagePaths[] = $imagePath;
            }

            // Delete old images if any exist
            if (!empty($umkm->images)) {
                foreach (json_decode($umkm->images, true) as $filename) {
                    $oldFilePath = 'public/img/UMKM/' . $filename;

                    // Check if the file exists before deleting
                    if (Storage::exists($oldFilePath)) {
                        Storage::delete($oldFilePath);
                    }
                }
            }

            // Update the images field with new image paths
            $umkm->images = json_encode($imagePaths, JSON_UNESCAPED_SLASHES);
        }

        // Save the website data
        $umkm->save();
        return redirect('/admin/umkm')->with('success', 'Data berhasil di update');
    }

    public function updateDataProfil(Request $request){
        $data = [
            'koordinat' => $request->koordinat,
            'kode_desa' => $request->kode_desa,
            'tahun_pembentukan' => $request->tahun_pembentukan,
            'dasar_hukum' => $request->dasar_hukum,
            'tipologi' => $request->tipologi,
            'klasifikasi' => $request->klasifikasi,
            'kategori' => $request->kategori,
            'luas_wilayah' => $request->luas_wilayah,
            'batas_utara' => $request->batas_utara,
            'batas_selatan' => $request->batas_selatan,
            'batas_timur' => $request->batas_timur,
            'batas_barat' => $request->batas_barat,
            'link_gmaps' => $request->link_gmaps
        ];

        // Check if a new thumbnail is being uploaded
        if ($request->hasFile('gambar_struktur')) {
            $newThumbnailFile = $request->file('gambar_struktur');
            $newThumbnailFilename = $newThumbnailFile->hashName();

            // Store the new thumbnail
            Storage::put('/public/img/struktur/' . $newThumbnailFilename, file_get_contents($newThumbnailFile->getRealPath()));

            // If you're updating an existing record, retrieve the old one
            $existingDataUtama = dataUtama::find(1);

            // Delete the old thumbnail if it exists
            if ($existingDataUtama && !empty($existingDataUtama->gambar_struktur)) {
                Storage::delete('/public/img/struktur/' . $existingDataUtama->gambar_struktur);
            }

            // Add the new thumbnail filename to the data array
            $data['gambar_struktur'] = $newThumbnailFilename;
        }

        // Use updateOrCreate to update the record or create a new one
        $dataUtama = dataUtama::updateOrCreate(
            ['id' => 1], // Find the record with id = 1, or create a new one if it doesn't exist
            $data
        );

        return redirect('/admin/profil')->with('message', 'Perubahan data telah disimpan');
    }
}
