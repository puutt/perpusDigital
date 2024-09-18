<?php
include 'koneksi.php';

//tambah data buku
if (isset($_POST['kembalikan'])) {
  
  $tgl = $_POST['tgl_pengembalian'];
  $id_user = $_POST['id_user'];
  $id_buku = $_POST['id_buku'];
  $nama = $_POST['nama'];
  $buku = $_POST['buku'];
  $tgl_p = $_POST['tgl_peminjaman'];
  $jam = $_POST['jam'];
  $tgl_kembali = strtotime($tgl);
  $tgl_peminjaman = strtotime($tgl_p);

  // Mendapatkan selisih hari antara tanggal pengembalian dengan tanggal peminjaman
  $selisih_hari = ($tgl_kembali - $tgl_peminjaman) / (60 * 60 * 24);

  // Menghitung denda 1000/hari
  $denda_per_hari = 1000;
  $denda_total = $selisih_hari * $denda_per_hari;

  //memasukkan data buku ke db
  $queryInsert = mysqli_query($koneksi, "INSERT INTO pengembalian (tgl_pengembalian, id_user, id_buku, denda, tgl_peminjaman, buku, jam) VALUES ('$tgl', '$id_user', '$id_buku', '$denda_total', '$tgl_p', '$buku', '$jam')");

  if ($queryInsert) {
    $sisa = $_POST["jml_pinjam"];
    $id = $_POST['id_peminjaman']; 
    // Hapus data dari peminjaman dan kembalikan jumlah buku yang dipinjam setelah sukses mengembalikan buku
    $queryDelete = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman='$id'");
    $queryUpdate = mysqli_query($koneksi, "UPDATE buku SET jml_buku = jml_buku + $sisa WHERE id_buku = '$_POST[id_buku]'");
    
    if ($queryDelete && $queryUpdate) {
      echo "<script>
      alert('Kamu berhasil mengembalikan buku.');
      document.location.href = '';
      </script>";
    } else {
      echo "<script>
      alert('Kamu gagal mengembalikan buku.');
      document.location.href = '';
      </script>";
    }
  } else {
    echo "<script>
    alert('Kamu gagal mengembalikan buku.');
    document.location.href = '';
    </script>";
    exit();
  }
}
?>



<?php include "header-user.php" ?>
<?php include "navbar-user.php" ?>
<div class="container" style="padding-top: 90px;">
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-4">
        <!-- <?php
        // Tanggal peminjaman dan tanggal jatuh tempo dari database atau sumber data lainnya
        $tanggalPeminjaman = strtotime($_POST['tgl_pengembalian']);
        $tanggalJatuhTempo = strtotime('2024-01-15');
        $tanggalSekarang = strtotime(date('Y-m-d'));

        // Hitung selisih hari
        $selisihHari = floor(($tanggalSekarang - $tanggalJatuhTempo) / (60 * 60 * 24));

        // Tampilkan pesan jika terlambat
        if ($selisihHari > 0) {
            echo '<p style="color: red;">Anda terlambat ' . $selisihHari . ' hari mengembalikan buku. Harap segera mengembalikan.</p>';
        }
        ?> -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Peminjaman</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="card mb-4 mt-3">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Peminjaman Buku
              </div>
              <div class="card-body">
                <table class="table" id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Buku</th>
                      <th>Jml Pinjam</th>
                      <th>Tgl Peminjaman</th>
                      <th>Tgl Kembali</th>
                      <th>Jam Pinjam</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id = $_GET['id'];
                    $tampil = mysqli_query($koneksi, "SELECT * FROM peminjaman AS p JOIN user AS u ON u.id_user = p.id_user WHERE p.id_user='$id'");
                    if (!$tampil) {
                        die('Error: ' . mysqli_error($koneksi));
                    }
                    while ($loop = mysqli_fetch_array($tampil)) :
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $loop['nama_lengkap'] ?></td>                                        
                        <td><?= $loop['buku'] ?></td>                                        
                        <td><?= $loop['jml_pinjam'] ?></td>                                        
                        <td><?= $loop['tgl_peminjaman'] ?></td>
                        <td><?= $loop['tgl_kembali'] ?></td>                                        
                        <td><?= $loop['jam'] ?></td>                                        
                        <td>
                          <button type="submit" name="kembali" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#kembaliBuku<?= $no ?>">Kembalikan</button>
                        </td>

                        <!-- Modal Kembali-->
                        <div class="modal fade" id="kembaliBuku<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form method="post">
                                  <input type="hidden" name="id_peminjaman" value="<?= $loop['id_peminjaman'] ?>">
                                  <input type="hidden" class="d-none" name="tgl_pengembalian" value="<?= date('Y-m-d') ?>">
                                  <input type="hidden" name="nama" value="<?= $loop['nama_lengkap'] ?>">
                                  <input type="hidden" name="id_buku" value="<?= $loop['id_buku'] ?>">
                                  <input type="hidden" name="id_user" value="<?= $loop['id_user'] ?>">
                                  <input type="hidden" name="buku" value="<?= $loop['buku'] ?>">
                                  <input type="hidden" name="tgl_peminjaman" value="<?= $loop['tgl_peminjaman'] ?>">
                                  <input type="hidden" name="jml_pinjam" value="<?= $loop['jml_pinjam'] ?>">
                                  <input type="hidden" name="tgl_kembali" value="<?= date('Y-m-d') ?>">
                                  <input type="hidden" name="jam" value="<?= $loop['jam'] ?>">
                                  <h5 class="text-center">Apakah Anda yakin mengembalikan buku <span class="text-danger"><?= $loop['buku'] ?></span> pada tanggal <?= date('Y-m-d') ?>?<br></h5>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" name="kembalikan" class="btn btn-primary">Kembalikan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  </div>

  <?php include "footer-user.php" ?>