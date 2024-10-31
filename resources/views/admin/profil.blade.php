<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Desa Pucanganak - Profil Desa</title>
    <link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            @include('component.adminsidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('component.admintopbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <!-- Content Row -->
                    <div class="row">
                        <div class="container mt-5">
                            <!-- Card for form styling -->
                            <div class="card shadow mb-4">
                              <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Perbarui Data Desa</h6>
                              </div>
                              <div class="card-body">
                                <!-- Form Start -->
                                <form action="/admin/profil/update" method="POST" enctype="multipart/form-data">
                                    @csrf
                                  <!-- Judul (Title) Input -->
                                  <div class="mb-3">
                                    <label for="koordinat" class="form-label">Koordinat</label>
                                    <input type="text" class="form-control" id="koordinat" name="koordinat" placeholder="Koordinat Desa" value="{{$dataUtama->koordinat ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="kode_desa" class="form-label">Kode Desa</label>
                                    <input type="text" class="form-control" id="kode_desa" name="kode_desa" placeholder="Kode Desa" value="{{$dataUtama->kode_desa ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="tahun_pembentukan" class="form-label">Tahun Pembentukan</label>
                                    <input type="text" class="form-control" id="tahun_pembentukan" name="tahun_pembentukan" placeholder="Tahun Pembentukan" value="{{$dataUtama->tahun_pembentukan ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="dasar_hukum" class="form-label">Dasar Hukum</label>
                                    <input type="text" class="form-control" id="dasar_hukum" name="dasar_hukum" placeholder="Dasar Hukum" value="{{$dataUtama->dasar_hukum ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="tipologi" class="form-label">Tipologi</label>
                                    <input type="text" class="form-control" id="tipologi" name="tipologi" placeholder="Tipologi Desa" value="{{$dataUtama->tipologi ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="klasifikasi" class="form-label">Klasifikasi</label>
                                    <input type="text" class="form-control" id="klasifikasi" name="klasifikasi" placeholder="Klasifikasi Desa" value="{{$dataUtama->klasifikasi ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori Desa" value="{{$dataUtama->kategori ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="luas_wilayah" class="form-label">Luas Wilayah</label>
                                    <input type="text" class="form-control" id="luas_wilayah" name="luas_wilayah" placeholder="Luas Wilayah Desa" value="{{$dataUtama->luas_wilayah ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="batas_utara" class="form-label">Batas Wilayah Utara Desa</label>
                                    <input type="text" class="form-control" id="batas_utara" name="batas_utara" placeholder="Batas Utara" value="{{$dataUtama->batas_utara ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="batas_selatan" class="form-label">Batas Wilayah Selatan Desa</label>
                                    <input type="text" class="form-control" id="batas_selatan" name="batas_selatan" placeholder="Batas Selatan" value="{{$dataUtama->batas_selatan ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="batas_timur" class="form-label">Batas Wilayah Timur Desa</label>
                                    <input type="text" class="form-control" id="batas_timur" name="batas_timur" placeholder="Batas Timur" value="{{$dataUtama->batas_timur ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="batas_barat" class="form-label">Batas Wilayah Barat Desa</label>
                                    <input type="text" class="form-control" id="batas_barat" name="batas_barat" placeholder="Batas Barat" value="{{$dataUtama->batas_barat ?? ''}}">
                                  </div>
                                  <div class="mb-3">
                                    <label for="link_gmaps" class="form-label">Link Google Maps</label>
                                    <input type="text" class="form-control" id="link_gmaps" name="link_gmaps" placeholder="Update Link Google Maps" value="{{$dataUtama->link_gmaps ?? ''}}">
                                  </div>

                                  <!-- Gambar (Image) Upload -->
                                  <div class="mb-3">
                                    <label for="inputGambar" class="form-label">Update Gambar</label>
                                    <input type="file" class="form-control" id="inputGambar" name="gambar_struktur">
                                    <!-- Image Preview Section -->
                                    <div class="mt-3">
                                      <label>Gambar Saat Ini:</label>
                                      <div class="image-preview">
                                        <img src="/storage/img/struktur/{{$dataUtama->gambar_struktur ?? ''}}" alt="Current Image">
                                      </div>
                                    </div>
                                  </div>

                                  <!-- Optional: Additional Fields -->
                                  <!-- You can add more fields based on your needs here -->

                                  <!-- Submit Button -->
                                  <button type="submit" class="btn btn-primary">Update Data</button>
                                </form>
                                <!-- Form End -->
                              </div>
                            </div>
                        </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Desa Pucanganak</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('component.logoutmodel')

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>
