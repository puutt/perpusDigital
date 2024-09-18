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
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-2 col-md-6 mt-2">
                        <div class="card bg-primary text-white">
                            <div class="card-body body-card">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM buku");
                                $row = mysqli_num_rows($query);
                                ?>
                                <p><?= $row; ?> <br/> <span>Buku</span></p>
                                <i class="fa-solid fa-book box-icon"></i>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="databuku.php">Lihat Detail</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 mt-2">
                        <div class="card text-bg-danger">
                            <div class="card-body body-card">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM peminjaman");
                                $row = mysqli_num_rows($query);
                                ?>
                                <p><?= $row; ?> <br/> <span>Dipinjam</span></p>
                                <i class="fa-solid fa-arrow-right-to-bracket box-icon"></i>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="peminjaman.php">Lihat Detail</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 mt-2">
                        <div class="card bg-success text-white">
                            <div class="card-body body-card">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM pengembalian");
                                $row = mysqli_num_rows($query);
                                ?>
                                <p><?= $row; ?> <br/> <span>Kembali</span></p>
                                <i class="fa-solid fa-arrow-right-from-bracket box-icon"></i>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="laporan.php">Lihat Detail</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 mt-2">
                        <div class="card text-bg-dark">
                            <div class="card-body body-card">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM user WHERE role='Peminjam'");
                                $row = mysqli_num_rows($query);
                                ?>
                                <p><?= $row; ?> <br/> <span>User</span></p>
                                <i class="fa-solid fa-users box-icon"></i>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="dataanggota.php">Lihat Detail</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 mt-2">
                        <div class="card text-bg-info text-white">
                            <div class="card-body body-card">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM guru");
                                $row = mysqli_num_rows($query);
                                ?>
                                <p><?= $row; ?> <br/> <span>Guru</span></p>
                                <i class="fa-solid fa-users box-icon"></i>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="dataguru.php">Lihat Detail</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-5">
                    <div class="col card p-3 me-3">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Pemberitahuan</th>
                            </tr>
                          </thead>
                          <tbody class="table-group-divider">
                            <?php 
                                $query = "SELECT * FROM peminjaman AS ub 
                                          JOIN user AS u ON ub.id_user = u.id_user 
                                          ORDER BY ub.tgl_peminjaman DESC LIMIT 8";
                                $query_run = mysqli_query($koneksi, $query);

                                // Inisialisasi variabel untuk menandakan apakah ada peminjaman terlambat
                                $adaPeminjamanTerlambat = false;

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {

                                        $tanggalPeminjaman = strtotime($row['tgl_peminjaman']);
                                        $tanggalJatuhTempo = strtotime($row['tgl_kembali']);
                                        $tanggalSekarang = strtotime(date('Y-m-d'));
                                        $selisihHari = floor(($tanggalSekarang - $tanggalJatuhTempo) / (60 * 60 * 24));

                                        if ($selisihHari > 0) { 
                                            $adaPeminjamanTerlambat = true; // Set variabel ke true jika ada peminjaman terlambat
                                    ?>
                                    
                                    <tr>
                                        <td> <a href="profile?id=<?= $row['id_user'] ?>" style="text-decoration: none;"><?= $row['nama_lengkap'] ?></a> terlambat <?= $selisihHari ?> hari mengembalikan buku <?= $row['buku'] ?></td>
                                    </tr>
                                    
                                    <?php   
                                        }
                                    }

                                    // Tampilkan pesan "Tidak ada pemberitahuan" jika tidak ada peminjaman terlambat
                                    if (!$adaPeminjamanTerlambat) { 
                                    ?>
                                        <tr>
                                            <td>Tidak ada pemberitahuan</td>
                                        </tr>
                                    <?php 
                                    }
                                } else {
                                    // Tampilkan pesan "Tidak ada pemberitahuan" jika tidak ada peminjaman
                                    ?>
                                    <tr>
                                        <td>Tidak ada pemberitahuan</td>
                                    </tr>
                                    <?php
                                }
                            ?>

                          </tbody>
                        </table>
                    </div>
                    <div class="col p-3 me-3">
                            <?php 
                                $query = "SELECT * FROM buku LIMIT 8";
                                $query_run = mysqli_query($koneksi, $query);

                                // Inisialisasi variabel untuk menandakan apakah ada stok buku yang habis
                                $adaStokHabis = false;

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        if ($row['jml_buku'] == 0) { 
                                            $adaStokHabis = true; // Set variabel ke true jika ada stok buku yang habis
                                            break; // Keluar dari loop karena sudah ada setidaknya satu buku dengan stok habis
                                        }
                                    }
                                    
                                    // Tampilkan pesan jika ada stok buku yang habis
                                    if ($adaStokHabis) { 
                                ?>
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <div>
                                                Stok buku <a href="databuku?id=<?= $row['id_buku'] ?>" style="text-decoration: none;"><?= $row['judul'] ?></a> telah habis
                                            </div>
                                        </div>
                                <?php   
                                    }
                                }
                                ?>

                    </div>
                </div>
            </div>
        </main>

        <?php
        include 'layout/footer.php';
        ?>

       <!--   <?php 
                    $id = $_SESSION['id_user'];
                    $query = "SELECT * FROM peminjaman AS p JOIN user AS u ON p.id_user = u.id_user";
                    $query_run = mysqli_query($koneksi, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                  ?>

                  <?php 
                      $tanggalJatuhTempo = strtotime($loop['tgl_kembali']);
                      $tanggalSekarang = strtotime(date('Y-m-d'));

                      // Periksa apakah tanggal jatuh tempo kurang dari tanggal sekarang (telat)
                      if ($tanggalJatuhTempo < $tanggalSekarang) {
                          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            '. $row['username'] .' terlambat mengembalikan buku
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>';
                      }                 
                  ?>
                
                   <?php
                        }
                    }
                   ?> -->