<?php include "header-user.php" ?>
<?php include "navbar-user.php" ?>
<div class="container" style="padding-top: 90px;">
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-4">
        
            <h5>Kategori </h5>
            <div class="row layout-card-custom">
            <?php 
        $nm = $_GET['nama_ktg'];
        $no = 1;
        $query = "SELECT * FROM buku WHERE kategori='$nm'";
        $query_run = mysqli_query($koneksi, $query);

        if (!$query_run) {
            die("Query error: " . mysqli_error($koneksi));
        }

        foreach ($query_run as $b) :
            ?>
            
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
</main>
</div>
</div>
<?php include "footer-user.php" ?>