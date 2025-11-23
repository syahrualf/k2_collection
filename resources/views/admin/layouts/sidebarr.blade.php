<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #4F46E5;">
    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-tasks"></i>
        </div>
        <div class="sidebar-brand-text mx-2">K2 Collection</div>
    </a>

    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ $menuDashboard ?? '' }}">
        <a class="nav-link py-2" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>
     <li class="nav-item {{ $menuAdmin ?? ''}} ">
      <a class="nav-link py-2" href="{{ route ('user') }}">
        <i class="fas fa-user"></i>
        <span>Akun Admin</span>
      </a>
    </li>

    <!-- Menu Section -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading small text-gray-400 uppercase">
        Manajemen Toko
    </div>

    <li class="nav-item {{ $menuKategori ?? '' }} ">
        <a class="nav-link py-2" href="{{ route ('kategori') }}">
            <i class="fas fa-tags"></i>
            <span>Kategori</span>
        </a>
    </li>

    <li class="nav-item {{ $menuProduk ?? '' }}">
        <a class="nav-link py-2" href="{{ route ('produk') }}">
            <i class="fas fa-tshirt"></i>
            <span>Produk</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0">

    <div class="text-center d-none d-md-inline mt-3">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>