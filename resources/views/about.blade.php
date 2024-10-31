<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Desa Pucanganak - Struktur Pemerintahan</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/x-icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
        <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            @include('component.header')
        </div>
        <!-- Navbar End -->
        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Susunan Organisasi</h4>
                    </div>
                    <h1 class="display-3 mb-4">Susunan Struktur Organisasi Tata Kerja Pemerintah Desa Pucanganak</p>
                </div>
                <div class="text-center">
                    <img class="struktur-img" src="/storage/img/struktur/{{$dataUtama->gambar_struktur  ?? ''}}" alt="">
                </div>
            </div>
        </div>
        <!-- Team Start -->

        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Perangkat Desa</h4>
                    </div>
                </div>

                <div class="row g-5 align-items-center">
 @foreach ($dataStaff as $data)
                    <div class="col-lg-3 wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="team-img profil-img rounded h-100">
                            <img src="/storage/img/perangkat/{{$data->thumbnail}}" class="img-fluid rounded w-100" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeInRight" data-wow-delay="0.4s">
                        <div class="section-title text-start mb-5">
                            <h1>Biodata</h1>
                            <p class="mb-2">Jabatan: {{$data->Jabatan}}</p>
                            <p class='mb-2'>Nama: {{$data->nama}}</p>
                            <p class='mb-2'>NIP: {{$data->NIP ?? '-'}}</p>
                            <p class='mb-2'>Nomor Telepon: {{$data->nomor_telepon ?? '-'}}  </p>
                        </div>
                    </div>
@endforeach
                </div>

            </div>
        </div>

        <!-- Team End -->

@include('component.footer')

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
