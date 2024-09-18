<?php 
include 'layout/header.php';
?>

<body class="sb-nav-fixed">
    <?php
    include 'layout/sidebar.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Peminjaman</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Peminjaman Buku</li>
                </ol>

                <div class="card mb-4">
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
                          <th>Jam Pinjam</th>
                          <th>Jumlah Pinjam</th>
                          <th>Tgl Peminjaman</th>
                          <th>Tgl Pengembalian</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM peminjaman AS p
                                          JOIN user AS u ON u.id_user = p.id_user");
                    if (mysqli_num_rows($tampil) > 0) {
                      foreach ($tampil as $loop) {
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $loop['nama_lengkap'] ?></td>                                        
                        <td><?= $loop['buku'] ?></td>                                        
                        <td><?= $loop['jam'] ?></td>                                        
                        <td><?= $loop['jml_pinjam'] ?></td>                                        
                        <td><?= $loop['tgl_peminjaman'] ?></td>
                        <td><?= $loop['tgl_kembali'] ?></td>
                        <td>
                          <?php
                          $tanggalJatuhTempo = strtotime($loop['tgl_kembali']);
                          $tanggalSekarang = strtotime(date('Y-m-d'));

                          // Periksa apakah tanggal jatuh tempo kurang dari tanggal sekarang (telat)
                          if ($tanggalJatuhTempo < $tanggalSekarang) {
                              echo '<button class="badge text-bg-danger">Terlambat</button>';
                          } else if ($tanggalJatuhTempo == $tanggalSekarang) { // Periksa apakah tanggal jatuh tempo sama dengan tanggal sekarang
                              echo '<button class="badge text-bg-warning">Hari ini jatuh tempo</button>';
                          } else { // Jika tanggal jatuh tempo lebih besar dari tanggal sekarang (belum telat)
                              echo '<button class="badge text-bg-info">Dipinjam</button>';
                          }
                          ?>
                        </td>

                        <!-- Modal Kembali-->
                        <!-- <div class="modal fade" id="kembaliBuku<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                  <input type="hidden" name="id_peminjaman" value="<?= $loop['id_peminjaman'] ?>">
                                  <input type="hidden" name="id_peminjaman" value="<?= $loop['id_peminjaman'] ?>">
                                  <input type="hidden" name="id_peminjaman" value="<?= $loop['id_peminjaman'] ?>">
                                  <h5 class="text-center">Apakah Anda yakin mengembalikan buku <span class="text-danger"><?= $loop['buku'] ?></span>?<br></h5>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                  <button type="submit" name="kembalikan" class="btn btn-primary">Kembalikan</button>
                              </div>
                          </form>
                      </div> -->
                  </div>
              </div>
          </tr>
      <?php
        }
      }

      ?>
  </tbody>
</table>
</div>
</div>

</div>
</main>

<!-- Modal Tambah-->
<div class="modal fade" id="tambahBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inputJudul" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="inputJudul" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include 'layout/footer.php';
?>