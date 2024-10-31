<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Desa Pucanganak - UMKM</title>
        <link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/x-icon">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

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
        <div class="container-fluid position-relative py-5">
            @include('component.header')
            <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">Daftar UMKM</h4>
                </div>
                <h1 class="display-3 mb-4">Daftar UMKM di Desa Pucanganak</h1>
                </div>
                <div class="row">
                    @foreach($news as $item)
                    <div class="col-lg-12 mb-4">
                        <div class="card flex-row p-2 shadow-sm">
                            <img src="/storage/img/thumbnail/{{$item->thumbnail}}" class="card-img-left img-fluid" alt="Thumbnail" style="width: 150px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->judul }}</h5>
                                <div class="mb-2">
                                    <span class="text-muted">By {{ $item->user->name }}</span> |
                                    <span class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                </div>
                                <p class="card-text">{{ Str::limit($item->encoded_konten, 150, '...') }}</p>
                                <a href="/umkm/{{$item->id}}" class="btn btn-primary btn-sm">Read more</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <!-- Navbar End -->

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
