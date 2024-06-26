<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
        <img src="{{ asset('images/logo_usmhub_nobg.png') }}" 
            class="me-2" style="height: 30px">
        </div>
        {{-- <div class="sidebar-brand-text mx-2">USM HUB</div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Report
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pengaduan.index') }}">
            <i class='bx bx-notepad'></i>
            <span>Report Pengaduan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('aspirasi.index') }}">
            <i class='bx bx-notepad'></i>
            <span>Report Aspirasi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('feed.index') }}">
            <i class='bx bx-info-circle'></i>
            <span>Sebar Informasi</span>
        </a>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengeolahan Akun:</h6>
                
                <a class="collapse-item" href="{{ route('users.index') }}">Data Mahasiswa</a>
                <a class="collapse-item" href="{{ route('settings.index') }}">Edit Profil</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
