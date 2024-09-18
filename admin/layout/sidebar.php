<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="admin/../">Perpus Skanova</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <?php 
                    $role = $_SESSION['role'];
                    if ($role == "Petugas") {
                    ?>
                        <li><a class="dropdown-item" href="profile?id=<?= $_SESSION['id_user'] ?>">Profile saya</a></li>
                    <?php
                    }
                    ?>
                <li><a class="dropdown-item" href="../logout">Logout</a></li>
            </ul>
        </li>

    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Menu Utama</div>
                    <a class="nav-link" href="admin/../">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-solid fa-book"></i></div>
                        Data
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <?php 
                    $role = $_SESSION['role'];
                    if ($role == "Admin") {
                    ?>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="databuku">Buku</a>
                            <a class="nav-link" href="kategori">Kategori</a>
                            <a class="nav-link" href="ulasan">Ulasan</a>
                            <a class="nav-link" href="datapetugas">Petugas</a>
                            <a class="nav-link" href="dataanggota">Anggota</a>
                            <a class="nav-link" href="dataguru">Guru</a>
                        </nav>
                    </div>
                    <?php } else { ?>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="databuku">Buku</a>
                            <a class="nav-link" href="kategori">Kategori</a>
                            <a class="nav-link" href="ulasan">Ulasan</a>
                            <a class="nav-link" href="dataanggota">Anggota</a>
                            <a class="nav-link" href="dataguru">Guru</a>
                        </nav>
                    </div>
                    <?php } ?>
                    <!-- <a class="nav-link" href="datapetugas">
                        <div class="sb-nav-link-icon"><i class="fas fa-solid fa-house-user"></i></div>
                        Data Petugas
                    </a> -->
                    <a class="nav-link" href="peminjaman">
                        <div class="sb-nav-link-icon"><i class="fas fa-solid fa-house-user"></i></div>
                        Peminjaman Buku
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#laporan" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-solid fa-book"></i></div>
                        Laporan
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="laporan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="laporan">Laporan Peminjaman</a>
                            <a class="nav-link" href="laporan-buku">Laporan Buku</a>
                        </nav>
                    </div>
                    <?php 
                    $role = $_SESSION['role'];
                    if ($role == "Admin") {
                    ?>
                        <a class="nav-link" href="profile-web">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Profile Web
                        </a>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Masuk sebagai:</div>
                <?= $_SESSION['role']; ?>
            </div>
        </nav>
    </div>