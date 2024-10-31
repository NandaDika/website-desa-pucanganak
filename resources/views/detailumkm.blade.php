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
            <div class="container mt-5">
                <div class="row">
                    <!-- Main News Content -->
                    <div class="col-lg-8">
                        <!-- News Image -->
                        <img src="/storage/img/thumbnail/{{$news->thumbnail}}" class="img-fluid mb-4" alt="News Image" style="max-height: 450px; width: 100%; object-fit: cover;">

                        <!-- News Title -->
                        <h1>{{ $news->judul }}</h1>

                        <!-- Publisher, Date, and Tags -->
                        <p class="text-muted">
                            Published by {{ $news->user->name }} on {{ \Carbon\Carbon::parse($news->created_at)->format('d M Y') }}
                        </p>

                        <!-- News Content -->
                        <div class="news-content">
                            {!! $news->konten !!}
                        </div>

                        <h3>Dokumentasi:</h3>

                        @if(!empty($news->images))
            <div id="newsImageCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach(json_decode($news->images) as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('/storage/img/UMKM/' . $image) }}" class="d-block w-100" alt="News Image" style="height: 450px; object-fit: cover;">
                    </div>
                    @endforeach
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#newsImageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsImageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @endif
                    </div>

                    <!-- Sidebar (Recent Posts) -->
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                Recent Posts
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($recent_posts as $recent)
                                <li class="list-group-item">
                                    <a href="/umkm/{{$recent->id}}" class="text-decoration-none">
                                        <h6 class="mb-1">{{ $recent->judul }}</h6>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($recent->created_at)->format('d M Y') }}</small>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
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
