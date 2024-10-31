<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Desa Pucanganak - Home</title>
    <link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/x-icon">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        /* Set the height of the map */
        .map-container {
            height: 400px;
            width: 100%;
            border: 1px solid #ddd;
            /* Optional: Add border */
        }
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->




    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        @include('component.header')


        <!-- Carousel Start -->
        <div class="header-carousel owl-carousel">
            <div class="header-carousel-item">
                <img src="{{ asset('img/background3.jpg') }}" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="carousel-caption-content p-3">
                        <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Pemerintah
                            Kabupaten Trenggalek</h5>
                        <h1 class="display-1 text-capitalize text-white mb-4">Selamat Datang!</h1>
                        <h2 class="mb-5 text-white fs-5">
                            di Website Resmi Desa Pucanganak
                        </h2>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item">
                <img src="{{ asset('img/background2.jpg') }}" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="carousel-caption-content p-3">
                        <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Pemerintah
                            Kabupaten Trenggalek</h5>
                        <h1 class="display-1 text-capitalize text-white mb-4">Desa Pucanganak</h1>
                        <p class="mb-5 fs-5 animated slideInDown">VISI MISI
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->
    </div>
    <!-- Navbar & Hero End -->


    <!-- Services Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">INFORMASI</h4>
                </div>
                <h1 class="display-3 mb-4">Papan Informasi Berita Terbaru</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($berita as $item)
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded">
                        <div class="service-img rounded-top">
                            <img src="/storage/img/thumbnail/{{$item->thumbnail}}" class="thumbnail-img rounded-top" alt="">
                        </div>
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{$item->judul}}</h5>
                                <p class="truncate-text mb-4">{{$item->encoded_konten}}</p>
                                <a href="/berita/{{$item->id}}" class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="/berita">Lebih Banyak</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!-- About Start -->

    <!-- About End -->

    <!-- Feature Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">Daftar UMKM</h4>
                </div>
                <h1 class="display-3 mb-4">Daftar UMKM di Desa Pucanganak</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($umkm as $item)
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded">
                        <div class="service-img rounded-top">
                            <img src="/storage/img/thumbnail/{{$item->thumbnail}}" class="thumbnail-img rounded-top" alt="">
                        </div>
                        <div class="service-content rounded-bottom bg-light p-4">
                            <div class="service-content-inner">
                                <h5 class="mb-4">{{$item->judul}}</h5>
                                <p class="truncate-text mb-4">{{$item->encoded_konten}}</p>
                                <a href="/umkm/{{$item->id}}" class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="/berita">Lebih Banyak</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <div class="container-fluid about bg-light py-5">
        <div class="container py-5">
            <div class="container mt-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">LOKASI</h4>
                    </div>
                    <h1 class="display-3 mb-4">Alamat Kantor Desa Pucanganak</h1>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-sm-12 col-xs-12">
                        <!-- Embed Google Map -->
                        <div class="map-container">
                            <iframe
                                src="{{$dataUtama->link_gmaps  ?? ''}}"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-sm-12 col-xs-12">
                        <div class="mt-6 text-left">
                            <p><strong>Koordinat:</strong> {{$dataUtama->koordinat ?? ''}}</p>
                            <p><strong>Kode Desa:</strong> {{$dataUtama->kode_desa ?? ''}}</p>
                            <p><strong>Tahun Pembentukan:</strong> {{$dataUtama->tahun_pembentukan ?? ''}}</p>
                            <p><strong>Dasar Hukum:</strong> {{$dataUtama->dasar_hukum ?? ''}}</p>
                            <p><strong>Tipologi:</strong> {{$dataUtama->tipologi ?? ''}}</p>
                            <p><strong>Klasifikasi:</strong> {{$dataUtama->klasifikasi ?? ''}}</p>
                            <p><strong>Kategori:</strong> {{$dataUtama->kategori ?? ''}}</p>
                            <p><strong>Luas Wilayah:</strong> {{$dataUtama->luas_wilayah ?? ''}}</p>
                            <p><strong>Batas Sebelah Utara:</strong> {{$dataUtama->batas_utara ?? ''}}</p>
                            <p><strong>Batas Sebelah Selatan:</strong> {{$dataUtama->batas_selatan ?? ''}}</p>
                            <p><strong>Batas Sebelah Timur:</strong> {{$dataUtama->batas_timur ?? ''}}</p>
                            <p><strong>Batas Sebelah Barat:</strong> {{$dataUtama->batas_barat ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    @include('component.footer')

    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>


    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>

</body>

</html>
