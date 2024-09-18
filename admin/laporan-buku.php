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
                <h1 class="mt-4">Laporan Buku</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">Laporan Buku</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Laporan
                        </div>
                        <div>
                            <a href="print-buku" class="btn btn-sm btn-primary" style="margin-left: 7px;">Print</a>
                            <form action="excel-buku" method="post" style="display: inline;">
                                <button type="submit" class="btn btn-primary btn-sm" name="export" style="margin-left: 7px;">Export ke Excel</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
                                    <th>Tgl Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($loop = mysqli_fetch_array($tampil)) :
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $loop['judul'] ?></td>                                     
                                        <td><?= $loop['penulis'] ?></td>    
                                        <td><?= $loop['penerbit'] ?></td>    
                                        <td><?= $loop['kategori'] ?></td>    
                                        <td><?= $loop['tgl_masuk'] ?></td>
                                        <td>
                                            <button type="submit" name="hapus" class="badge text-bg-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusPetugas<?= $no ?>">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <?php 
    include 'layout/footer.php';
    ?>