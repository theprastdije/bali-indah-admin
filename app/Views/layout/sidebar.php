<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3"><b>BSI Admin</b></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Heading Menu -->
    <div class="sidebar-heading pb-1">
        Menu
    </div>
    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link py-2" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <?php if (in_groups('Super admin', 'Owner', 'Manajer', 'Kasir')) : ?>
            <a class="nav-link py-2" href="/kas">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>Kas</span>
            </a>
        <?php endif; ?>
        <?php if (in_groups('Super admin', 'Owner', 'Manajer', 'Kasir')) : ?>
            <a class="nav-link py-2" href="/penjualan">
                <i class="fas fa-fw fa-money-bill"></i>
                <span>Penjualan</span>
            </a>
        <?php endif; ?>
        <a class="nav-link py-2" href="/pengeluaran">
            <i class="fas fa-fw fa-funnel-dollar"></i>
            <span>Pengeluaran</span>
        </a>
        <?php if (in_groups('Super admin', 'Owner', 'Manajer', 'Kasir')) : ?>
            <a class="nav-link py-2" href="/payroll">
                <i class="fas fa-fw fa-file-invoice-dollar"></i>
                <span>Payroll</span>
            </a>
        <?php endif; ?>
        <?php if (in_groups('Super admin', 'Owner', 'Manajer', 'Kasir')) : ?>
            <a class="nav-link py-2" href="/aset">
                <i class="fas fa-fw fa-box"></i>
                <span>Manajemen Aset</span>
            </a>
        <?php endif; ?>
        <?php if (in_groups('Super admin', 'Owner', 'Manajer', 'Kasir')) : ?>
            <a class="nav-link py-2" href="/laporan">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        <?php endif; ?>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Heading User -->
    <div class="sidebar-heading pb-1">
        User
    </div>
    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link py-2" href="/user">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil</span>
        </a>
        <!-- <a class="nav-link py-2" href="/user">
            <i class="fas fa-fw fa-key"></i>
            <span>Ubah Password</span>
        </a> -->
    </li>


    <?php if (in_groups('Super admin', 'Owner')) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Heading Admin -->
        <div class="sidebar-heading pb-1">
            Admin
        </div>
        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link py-2" href="/users">
                <i class="fas fa-fw fa-users"></i>
                <span>Kelola User</span>
            </a>
            <a class="nav-link py-2" href="/role">
                <i class="fas fa-fw fa-user-cog"></i>
                <span>Kelola Role</span>
            </a>
            <a class="nav-link py-2" href="/pembayaran">
                <i class="far fa-fw fa-credit-card"></i>
                <span>Kelola Pembayaran</span>
            </a>
            <a class="nav-link py-2" href="/pajak">
                <i class="far fa-fw fa-credit-card"></i>
                <span>Kelola Pajak</span>
            </a>
            <a class="nav-link py-2" href="/akun">
                <i class="fas fa-fw fa-ellipsis-h"></i>
                <span>Kelola Akun</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->