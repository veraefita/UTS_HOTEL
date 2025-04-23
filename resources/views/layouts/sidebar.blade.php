<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ (isset($activeMenu) && $activeMenu == 'dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Data Kamar -->
            <li class="nav-header">MANAJEMEN KAMAR</li>
            <li class="nav-item">
            <a href="{{ route('kamar.index') }}" 
                class="nav-link {{ (isset($activeMenu) && $activeMenu === 'kamar') ? 'active' : '' }}">
                <i class="nav-icon fas fa-bed"></i>
                <p>Daftar Kamar</p>
            </a>

            <!-- Data Reservasi -->
            <li class="nav-header">MANAJEMEN RESERVASI</li>
            <li class="nav-item">
                <a href="{{ route('reservasi.index') }}" class="nav-link {{ (isset($activeMenu) && $activeMenu == 'reservasi') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-calendar-check"></i>
                    <p>Daftar Reservasi</p>
                </a>
            </li>

            <!-- Tombol Logout -->
            <li class="nav-header">AKUN</li>
            <li class="nav-item">
                <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>