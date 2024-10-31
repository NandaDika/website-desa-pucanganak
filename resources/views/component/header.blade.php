<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
    <a href="/" class="navbar-brand p-0">
        <h1 class="text-primary m-0"><img src="{{asset('img/logo.png')}}" alt="">Desa Pucanganak</h1>
        <!-- <img src="img/logo.png" alt="Logo"> -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="/" class="nav-item nav-link {{Route::is('home')?'active' : ''}}">Home</a>
            <a href="/about" class="nav-item nav-link {{Route::is('about')?'active' : ''}}">Struktur</a>
            <a href="/berita" class="nav-item nav-link {{Route::is('berita')?'active' : ''}}">Berita</a>
            <a href="/umkm" class="nav-item nav-link {{Route::is('umkm')?'active' : ''}}">UMKM</a>
        </div>
        <a href="/auth" class="btn btn-primary rounded-pill text-white py-2 px-4 flex-wrap flex-sm-shrink-0">{{Auth::check() ? 'Dashboard' : 'Portal'}}</a>
    </div>
</nav>
