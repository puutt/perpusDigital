<?php 

include "header-user.php";

include "navbar-user.php";

?>

<div class="container" style="padding-top: 90px;">
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-4">

        <h5>Kategori </h5>
        <div class="row layout-card-custom">
          <?php 
              $nm = $_GET['nama_ktg'];

              if ($nm != " Pelajaran ") {
                $query = "SELECT * FROM buku WHERE kategori='$nm'";
                $query_run = mysqli_query($koneksi, $query);
              } else {
                if (isset($_GET['kelas'])) {
                    $kelas = $_GET['kelas'];
                } else {
                    // Jika tidak ada nilai tombol kelas yang dikirimkan, default ke kelas X
                    $kelas = "Kelas X";
                }

                // Buat query untuk mengambil buku sesuai dengan kelas yang dipilih
                $query = "SELECT * FROM buku WHERE kategori='$nm' AND kelas='$kelas'";
                $query_run = mysqli_query($koneksi, $query);
              }
              
          ?>

          <!-- Tempatkan tombol kelas di luar loop foreach -->
          <?php if ($nm = " Pelajaran ") : ?>
              <div class="col-12 text-center mb-4">
                  <form method="get">
                    <button type="submit" name="kelas" value="Kelas X" class="btn btn-primary">Kelas X</button>
                    <button type="submit" name="kelas" value="Kelas XI" class="btn btn-primary">Kelas XI</button>
                    <button type="submit" name="kelas" value="Kelas XII" class="btn btn-primary">Kelas XII</button>
                  </form>
              </div>
          <?php endif; ?>

          <div class="row">
              <?php foreach ($query_run as $b) : ?>
                  <div class="col-xl-3 col-md-6 card m-4 card m-4" style="width: 15rem;">
                      <img src="img/<?= $b['foto'] ?>" class="card-img-top" alt="coverBuku" height="250px">
                      <div class="card-body">
                          <h5 class="card-title"><?= $b['judul'] ?></h5>
                      </div>
                      <ul class="list-group list-group-flush text-center">
                          <li class="list-group-item"><?= $b['kategori'] ?> | <?= $b['jumlah_halaman'] ?> halaman</li>
                      </ul>
                      <div class="card-body">
                          <a class="btn btn-success" href="detail-buku.php?id=<?= $b["id_buku"]; ?>">Detail</a>
                      </div>
                  </div>
              <?php endforeach; ?>
          </div>

        </div>
      </div>
    </main>
  </div>
</div>
<?php include "footer-user.php" ?>