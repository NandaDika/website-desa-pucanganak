<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\dataStaff;
use App\Models\dataUtama;
use App\Models\UMKM;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        $berita = Artikel::take(4)->get();
        foreach ($berita as $data) {
            $data->encoded_konten = preg_replace('/<[^>]+>/', ' ', $data->konten);
            $data->encoded_konten = preg_replace('/\s+/', ' ', $data->encoded_konten);
            $data->encoded_konten = trim($data->encoded_konten);
        }

        $umkm = UMKM::take(4)->get();
        foreach ($umkm as $data) {
            $data->encoded_konten = preg_replace('/<[^>]+>/', ' ', $data->konten);
            $data->encoded_konten = preg_replace('/\s+/', ' ', $data->encoded_konten);
            $data->encoded_konten = trim($data->encoded_konten);
        }
        $data_utama = dataUtama::first();
        return view('index', ['berita' => $berita, 'umkm' => $umkm, 'dataUtama' => $data_utama]);
    }

    public function showBerita(){
        $news = Artikel::paginate(10); // Menampilkan 10 berita per halaman
        foreach ($news as $data) {
            $data->encoded_konten = preg_replace('/<[^>]+>/', ' ', $data->konten);
            $data->encoded_konten = preg_replace('/\s+/', ' ', $data->encoded_konten);
            $data->encoded_konten = trim($data->encoded_konten);
        }
        return view('berita', ['news' => $news]);
    }

    public function detailBerita($id){
    $news = Artikel::findOrFail($id);
    $news->view =+ 1;
    $news->save();

    // Get the recent posts (latest 5 news articles, excluding the current one)
    $recent_posts = Artikel::where('id', '!=', $id)->orderBy('created_at', 'desc')->take(5)->get();

    // Pass the news article and recent posts to the view
    return view('detailberita', compact('news', 'recent_posts'));
    }

    public function showUmkm(){
        $news = UMKM::paginate(10); // Menampilkan 10 berita per halaman
        foreach ($news as $data) {
            $data->encoded_konten = preg_replace('/<[^>]+>/', ' ', $data->konten);
            $data->encoded_konten = preg_replace('/\s+/', ' ', $data->encoded_konten);
            $data->encoded_konten = trim($data->encoded_konten);
        }
        return view('umkm', ['news' => $news]);
    }

    public function detailUmkm($id){
        $news = UMKM::findOrFail($id);

        // Get the recent posts (latest 5 news articles, excluding the current one)
        $recent_posts = Artikel::where('id', '!=', $id)->orderBy('created_at', 'desc')->take(5)->get();

        // Pass the news article and recent posts to the view
        return view('detailumkm', compact('news', 'recent_posts'));
    }

    public function showStruktur(){
        $dataUtama = dataUtama::first();
        $dataStaff = dataStaff::all();

        return view('about', ['dataUtama' => $dataUtama, 'dataStaff' => $dataStaff]);
    }
}
