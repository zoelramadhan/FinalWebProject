<ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">


    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" >
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Dropdown Example -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData" aria-expanded="true" aria-controls="collapseData">
            <i class="fas fa-fw fa-folder"></i>
            <span>Menu</span>
        </a>
        <div id="collapseData" class="collapse" aria-labelledby="headingData" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- Daftar Mobil -->
                <a class="collapse-item" href="{{ route('cars.index') }}">Daftar Mobil</a>
                <!-- Daftar Driver -->
                <a class="collapse-item" href="{{ route('drivers.index') }}">Daftar Driver</a>
                <!-- Daftar Pembayaran -->
                <a class="collapse-item" href="{{ route('payments.index') }}">Daftar Pembayaran</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>
