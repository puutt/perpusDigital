<?php 
include '../koneksi.php';
error_reporting(0);

//Mengenalkan  variabel teks
$SqlPeriode = "";
$awalTgl = "";
$akhirTgl = "";
$tglAwal = "";
$tglAkhir = "";

if (isset($_POST['btnTampil'])) {
    $tglAwal = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
    $tglAkhir = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');
    $SqlPeriode = " where A.tgl_peminjaman BETWEEN '".$tglAwal."'  AND '".$tglAkhir."' ";
} else {
    $awalTgl = "01-".date('m-Y');
    $akhirTgl = date('d-m-Y');

    $SqlPeriode = " where tgl_peminjaman BETWEEN '".$awalTgl."'  AND '".$akhirTgl."' ";
}

?>

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
                <h1 class="mt-4">Laporan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">Laporan</li>
                </ol>

                <h4>Laporan Periode <b><?= ($tglAwal); ?></b> s/d <b><?= ($tglAwal); ?></b></h4>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Laporan
                        <a href="modul/mod_cetak/cetak.php?awal=<?= $tglAwal; ?>&&akhir=<?= $tglAkhir; ?>" targert="_blank" alt="Edit data" style="float: right; margin-left: 7px;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBuku">
                            Cetak Laporan
                        </button>
                        <button type="button" style="float: right;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBuku">
                            Export
                        </button>
                    </div>
                    <div class="card-body">
                        <form method="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form10" target="_self">
                            <div class="row mb-4">
                                <div class="col-lg-3">
                                    <input type="date" name="txtTglAwal" class="form-control" value="<?= $awalTgl ?>">
                                </div>
                                <div class="col-lg-3">
                                    <input type="date" name="txtTglAkhir" class="form-control" value="<?= $akhirTgl ?>">
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" name="btnTampil" class="btn btn-success">Tampilkan</button>
                                </div>
                            </div>
                        </form>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tgl Peminjaman</th>
                                    <th>Tgl Pengembalian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM pengembalian");
                                while ($loop = mysqli_fetch_array($tampil)) :
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $loop['nama'] ?></td>                                     
                                        <td><?= $loop['tgl_peminjaman'] ?></td>    
                                        <td><?= $loop['tgl_pengembalian'] ?></td>
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