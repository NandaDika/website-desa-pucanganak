<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img class="icon-image" src="{{asset('img/logo.png')}}" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Admin Desa Pucanganak</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{Route::is('dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Utama
    </div>

    <li class="nav-item {{Route::is('profil.desa') ? 'active' : ''}}">
        <a class="nav-link" href="/admin/profil">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Profil Desa</span>
        </a>
    </li>
    <li class="nav-item {{Route::is('perangkat.desa') ? 'active' : ''}}">
        <a class="nav-link" href="/admin/perangkat">
            <i class="fas fa-fw fa-id-badge"></i>
            <span>Perangkat Desa</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Website
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Route::is('admin.berita') || Route::is('admin.berita.upload') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="/admin/berita" >
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Berita</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{Route::is('admin.umkm') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="/admin/umkm" >
            <i class="fas fa-fw fa-shopping-bag"></i>
            <span>UMKM</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Akses Admin
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Route::is('admin.user') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="/admin/user" >
            <i class="fas fa-fw fa-users"></i>
            <span>List Admin</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
