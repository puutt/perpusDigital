<?php include "header-user.php" ?>
<?php include "navbar-user.php" ?>
<div class="container" style="padding-top: 90px;">
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Buku yang dikembalikan</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="card mb-4 mt-3">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Pengembalian Buku
              </div>
              <div class="card-body">
                <table class="table" id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Buku</th>
                      <th>Tgl Peminjaman</th>
                      <th>Tgl Pengembalian</th>
                      <th>Jam Pinjam</th>
                      <th>Terlambat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id = $_GET['id'];
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM pengembalian AS p
                                          JOIN user AS u ON u.id_user = p.id_user 
                                          WHERE p.id_user='$id'");
                    while ($loop = mysqli_fetch_array($tampil)) :
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>                                        
                        <td><?= $loop['buku'] ?></td>                                        
                        <td><?= $loop['tgl_peminjaman'] ?></td>
                        <td><?= $loop['tgl_pengembalian'] ?></td>
                        <td><?= $loop['jam'] ?></td>
                        <td>
                          <?php  
                            if (strtotime($loop['tgl_pengembalian']) > strtotime($loop['tgl_peminjaman'])) {
                              echo "Ya | Denda Rp" . number_format($loop['denda'], 0, ',', '.');
                            } else {
                              echo "Tidak";
                            }
                          ?>
                        </td>
                        
                      <!-- Modal Kembali-->
                      <div class="modal fade" id="hapusPB<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="post">
                                <input type="hidden" name="id_peminjaman" value="<?php echo $loop['id_peminjaman'] ?>">
                                <h5 class="text-center">Apakah Anda yakin mengembalikan buku <span class="text-danger"><?php echo $loop['buku'] ?></span>?<br></h5>
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