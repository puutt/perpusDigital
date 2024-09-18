<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top rounded shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="perpusDigital/../">Perpustakaan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" data-bs-scroll="true" data-bs-backdrop="false" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><a href="perpusDigital/../" style="color: black; text-decoration: none;"> Perpustakaaan </a></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kategori
            </a>
            <ul class="dropdown-menu">
              <?php
              $no = 1;
              $tampil = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM buku");
              foreach ($tampil as $k) :
                ?>
                <li><a class="dropdown-item" href="kategori?nama_ktg=<?= $k["kategori"]; ?>"><?= $k['kategori'] ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="peminjaman?id=<?= $_SESSION['id_user'] ?>">Peminjaman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="pengembalian?id=<?= $_SESSION['id_user'] ?>">Pengembalian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="koleksi?id=<?= $_SESSION['id_user'] ?>">Koleksi</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['nama_lengkap']; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profile?id=<?= $_SESSION['id_user'] ?>">Profile saya</a></li>
              <li><a class="dropdown-item" href="logout">Logout</a></li>
            </ul>
          </li>
        </ul>

      </div>
    </div>
  </div>
</nav>