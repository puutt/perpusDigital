<?php 

include 'koneksi.php';

if (isset($_POST['pinjam'])) {
  $judul = $_POST['judul'];
  $id_buku = $_POST['id_buku'];
  $id_user = $_POST['id_user'];
  $tgl_pinjam = $_POST['tgl_pinjam'];
  $jml_pinjam = $_POST['jml_pinjam'];
  $darijam = $_POST['darijam'];
  $sampaijam = $_POST['sampaijam'];
  $jam = $darijam ."-". $sampaijam;
  $guru = $_POST['guru'];
  $tgl_kembali = strtotime("+7 day", strtotime($tgl_pinjam)); // +7 hari dari tgl peminjaman
  $tgl_kembali = date('Y-m-d', $tgl_kembali); // format tgl peminjaman tahun-bulan-hari

  //cek apakah peminjam telah meminjam buku tsb apa blm
	$pinjam_query = "SELECT * FROM peminjaman WHERE id_buku = '$id_buku'";
	$pinjam_query_run = mysqli_query($koneksi, $pinjam_query);
	if (mysqli_num_rows($pinjam_query_run) > 0){
		echo "<script>
		alert('Anda telah meminjam buku ini');
		document.location.href = '';
		</script>";
		exit();
	}

  //cek apakah peminjam telah meminjam buku sebanyak 3 atau blm
	$pinjam_query = "SELECT * FROM peminjaman WHERE id_user = '$id_user'";
	$pinjam_query_run = mysqli_query($koneksi, $pinjam_query);
	if (mysqli_num_rows($pinjam_query_run) === 3){
		echo "<script>
		alert('Anda telah meminjam buku sebanyak 3');
		document.location.href = '';
		</script>";
		exit();
	}

  //memasukkan data buku ke db
  $query = mysqli_query($koneksi, "INSERT INTO peminjaman (id_user, id_buku, buku, tgl_peminjaman, tgl_kembali, jml_pinjam, jam, guru) VALUES ('$id_user', '$id_buku', '$judul', '$tgl_pinjam', '$tgl_kembali', '$jml_pinjam', '$jam', '$guru')");

if ($query) {
  $sisa = $_POST["jml_buku"] - $_POST["jml_pinjam"];

  // Ubah data jml buku dari setelah sukses meminjam buku
  $queryInsert = mysqli_query($koneksi, "UPDATE buku SET jml_buku = '$sisa' WHERE id_buku = '$_POST[id_buku]'");
  
  if ($queryInsert) {
    echo "<script>
    alert('Kamu berhasil meminjam buku.');
    document.location.href = '';
    </script>";
  } else {
    echo "<script>
    alert('Kamu gagal meminjam buku.');
    document.location.href = '';
    </script>";
  }
} else {
  echo "<script>
  alert('Kamu gagal meminjam buku.');
  document.location.href = '';
  </script>";
  exit();
}
}


?>

<?php include "header-user.php" ?>

<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top rounded shadow" style=" background-color: #30475e;">
  <div class="container-fluid">
    <a class="navbar-brand" href="perpusDigital/../">Perpustakaan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" data-bs-scroll="true" data-bs-backdrop="false" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><a href="index" style="color: black; text-decoration: none;"> Perpustakaan </a></h5>
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
        <form method="get" class="d-flex" role="search">
          <input class="form-control me-2" type="text" name="cari" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
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
<!-- navbar -->

<div class="container" style="padding-top: 90px;">
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-4">
        <!-- jika terlambat mengembalikan buku -->
        <?php 
        $id = $_SESSION['id_user'];
        $query = "SELECT * FROM peminjaman WHERE id_user='$id'";
        $query_run = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($query_run) > 0) {
         foreach ($query_run as $row) {
           ?>

           <?php 
           $tanggalPeminjaman = strtotime($row['tgl_peminjaman']);
           $tanggalJatuhTempo = strtotime($row['tgl_kembali']);
           $tanggalSekarang = strtotime(date('Y-m-d'));
           $selisihHari = floor(($tanggalSekarang - $tanggalJatuhTempo) / (60 * 60 * 24));

           if ($tanggalJatuhTempo < $tanggalSekarang) { 


            echo '<p class="alert alert-danger">Anda terlambat ' . $selisihHari . ' hari mengembalikan buku ' . $row['buku'] . '. Harap segera kembalikan. <a href="peminjaman"> </a></p>';
          } else if ($tanggalJatuhTempo == $tanggalSekarang) {
            echo '<p class="alert alert-warning">Hari ini jatuh tempo untuk buku ' . $row['buku'] . '. Harap segera kembalikan. <a href="peminjaman"> </a></p>';

          } ?>

          <?php
        }
      }
      ?>

      <!-- cari -->
      <?php
      if (isset($_GET['cari'])) {
        $buku = $_GET['cari'];
        echo "<h5> Hasil Pencarian : " . $buku . "</h5>";
      } else {
        echo "<h5> Daftar Buku </h5>";
      }
      ?>
      <div class="row layout-card-custom">

        <?php
        if (isset($_GET['cari'])) {
          $buku = $_GET['cari'];

          // cari
          $books = mysqli_query($koneksi, "SELECT * FROM buku where judul like '%".$buku."%' OR kategori like '%".$buku."%' ");
        } else {

          // membatasi buku
          $perPage = 8;
          $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
          $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

          $books = mysqli_query($koneksi, "SELECT * FROM buku LIMIT $start, $perPage");

          $result = mysqli_query($koneksi, "SELECT * FROM buku");
          $total = mysqli_num_rows($result);

          $pages = ceil($total/$perPage);
        }
        while($b = mysqli_fetch_assoc($books)){
          ?>
          <div class="col-xl-4 col-md-6 card ms-4 mb-4" style="width: 15rem;">
            <img src="img/<?= $b['foto'] ?>" class="card-img-top p-1 rounded" alt="coverBuku" height="250px">
            <div class="card-body">
              <h5 class="card-title"><?= substr($b['judul'], 0, 35) ?></h5>
            </div>
            <ul class="list-group list-group-flush text-center">
              <li class="list-group-item"><?= $b['kategori'] ?> • <?= $b['jumlah_halaman'] ?> halaman</li>
            </ul>
            <div class="card-body">
              <a class="btn btn-success" href="detail-buku?id=<?= $b["id_buku"]; ?>">Detail</a>
              <?php if ($b['jml_buku'] >= 1) { ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamBuku<?= $b['id_buku'] ?>">Pinjam</button>
              <?php } else { ?>
                <p style="color: red;">Buku telah dipinjam, tunggu stok buku tersedia kembali.</p>
              <?php } ?>
            </div>
          </div>

          <div class="modal fade" id="pinjamBuku<?= $b["id_buku"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Pinjam Buku</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                          <h4 class="alert-heading">Catatan</h4>
                          <p>* Waktu peminjaman buku hanya 1 minggu/7 hari <br>
                            * Denda keterlambatan 1000/hari
                          </p>
                        </div>
                        <form method="post">
                          <div class="mb-3">
                            <input type="hidden" value="<?= $b['id_buku']; ?>" name="id_buku">
                            <input type="hidden" value="<?= $_SESSION['id_user']; ?>" name="id_user">
                            <input type="hidden" value="<?= $b['jml_buku']; ?>" name="jml_buku">
                            <label for="inputJudul" class="form-label">Buku yang dipinjam</label>
                            <input type="text" class="form-control" name="judul" id="inputJudul" value="<?= $b['judul']; ?>" readonly>
                          </div>
                          <div class="mb-3">
                            <label for="inputNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="inputNama" value="<?= $_SESSION['nama_lengkap'] ?>" readonly>
                          </div>
                          <div class="mb-4">
                            <label for="inputPinjam" class="form-label">Jumlah Pinjam</label>
                            <select class="form-select" name="jml_pinjam" id="inputPinjam" required>
                            <?php for ($i=1; $i <= $b['jml_buku']; $i++) { ?>
                              <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                            </select>
                          </div>
                          <div class="mb-3">
													  <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_pinjam" id="inputTgl">
													</div>
													<div class="input-group mb-3">
													  <span class="input-group-text">Dari Jam ke</span>
													  <select class="form-select" name="darijam" id="inputPinjam" required>
													        <option value="-">-</option>
														<?php for ($i=1; $i <= 10; $i++) { ?>
															<option value="<?= $i ?>"><?= $i ?></option>
														<?php } ?>
														</select>
													  <span class="input-group-text">Sampai Jam ke</span>
													  <select class="form-select" name="sampaijam" id="inputPinjam" required>
													        <option value="-">-</option>
														<?php for ($i=1; $i <= 10; $i++) { ?>
															<option value="<?= $i ?>"><?= $i ?></option>
														<?php } ?>
														</select>
													</div>
                          <div class="mb-3">
														<label for="inputGuru" class="form-label">Guru yang mengajar</label>
														<select required class="form-select" name="guru" id="inputGuru" required>
                                <option value="">Pilih Guru</option>
                                <option value="-">-</option>
                                <?php 
                                    $sql = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama ASC");
                                    while ($data = mysqli_fetch_array($sql)) {
                                
                                    echo '<option value=" '.$data['nama'].' "> '.$data['nama'].' </option>';
                                } ?>
                            </select>
													</div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" name="pinjam" class="btn btn-primary">Pinjam</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

        <?php } ?>


      </div>
    </div>

    <?php if (!isset($_GET['cari'])) {
      ?>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php if($page > 1) { ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?= $page - 1; ?>">&laquo;</a></li>
          <?php } ?>
          <?php for ($i=1; $i <= $pages; $i++) { ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a></li>
          <?php } ?>
          <?php if($page < $pages) { ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?= $page + 1; ?>">&raquo;</a></li>
          <?php } ?>
        </ul>
      </nav>
    <?php }?>
  </main>
</div>
</div>

<?php include "footer-user.php" ?>

