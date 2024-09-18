<?php 
include 'koneksi.php';

if (isset($_POST['hapusKoleksi'])) {

    $b = $_POST['id_buku'];
    $b = $_POST['id_buku'];
    $k = $_POST['idK'];

    $query = "DELETE FROM koleksi_pribadi WHERE id_koleksi='$k'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        echo "<script>
        alert('Kamu berhasil menghapus buku dari koleksi anda.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menghapus buku dari koleksi anda.');
        document.location.href = '';
        </script>";
    }
}

?>

<?php include "header-user.php" ?>

<!-- navbar -->
<?php include "navbar-user.php" ?>
<!-- navbar -->

<div class="container" style="padding-top: 90px;">
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-4">
        <h5> Daftar Koleksi Anda </h5>
        <div class="row layout-card-custom">

          <?php
          $id = $_GET['id'];

          $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM koleksi_pribadi WHERE id_user = '$id'");
          $result = mysqli_fetch_assoc($query);
          $jumlah_buku = $result['jumlah'];

          if ($jumlah_buku == 0) {
              // Jika pengguna memiliki koleksi buku, tampilkan daftar buku
              // Anda dapat menambahkan kode tampilan daftar buku di sini
              echo "<p class='text-center'>Tidak ada koleksi buku</p>";
          } else {
              // Jika pengguna tidak memiliki koleksi buku, tampilkan pesan "Tidak ada koleksi buku"
            $tampil = mysqli_query($koneksi, "SELECT * FROM buku AS b JOIN koleksi_pribadi AS k ON b.id_buku = k.id_buku WHERE k.id_user='$id'");
          
          $no = 1;
          foreach ($tampil as $b) :
          

          
          ?>
            <div class="col-xl-3 col-md-6 card m-4" style="width: 15rem;">
              <img src="img/<?= $b['foto'] ?>" class="card-img-top p-1 rounded" alt="coverBuku" height="250px">
              <div class="card-body">
                <h5 class="card-title"><?= substr($b['judul'], 0, 35) ?></h5>
              </div>
              <ul class="list-group list-group-flush text-center">
                <li class="list-group-item"><?= $b['kategori'] ?> • <?= $b['jumlah_halaman'] ?> halaman</li>
              </ul>
              <div class="card-body">
                <a class="btn btn-success btn-sm" href="detail-buku?id=<?= $b["id_buku"]; ?>">Detail</a>
                <?php if ($b['jml_buku'] >= 1) { ?>
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pinjamBuku<?= $b['id_buku'] ?>">Pinjam</button>
                <?php } else { ?>
                  <p style="color: red;">Buku telah dipinjam, tunggu stok buku tersedia kembali.</p>
                <?php } ?>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusKoleksiBuku<?= $b['id_buku'] ?>"><i class="fa-solid fa-trash"></i></button>
              </div>
            </div>

            <div class="modal fade" id="pinjamBuku<?= $b['id_buku'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <div class="mb-3">
                            <label for="inputPinjam" class="form-label">Jumlah Pinjam</label>
                            <input type="number" class="form-control" name="jml_pinjam" id="inputPinjam">
                          </div>
                          <div class="mb-3">
                            <label for="inputTgl" class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam" id="inputTgl">
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

            <div class="modal fade" id="hapusKoleksiBuku<?= $b['id_buku']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post">
                      <div class="mb-3">
                        <input type="hidden" value="<?= $b['id_koleksi']; ?>" name="idK">
                        <input type="hidden" value="<?= $b['id_buku']; ?>" name="id_buku">
                        <input type="hidden" value="<?= $_SESSION['id_user']; ?>" name="id_user">
                        <label for="inputJudul" class="form-label">Apakah anda ingin menghapus buku ini dari koleksi anda?</label>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" name="hapusKoleksi" class="btn btn-primary">Hapus</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; } ?>
        </div>
      </div>
    </main>
  </div>
</div>

<?php include "footer-user.php" ?>