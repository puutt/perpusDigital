<?php 
include '../../koneksi.php';
error_reporting(0);

$awal = $_GET['awal'];
$tawal = InggrisTgl($awal);

$tglAwal = isset($_GET['awal']) ? $_GET['awal'] : "01-".date('m-Y');
$tglAkhir = isset($_POST['akhir']) ? $_GET['akhir'] : date('d-m-Y');
$SqlPeriode = "where tgl_peminjaman BETWEEN '$awal'  AND '$akhir' ";
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Perpus</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../css/styles.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body onload="print()">
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit">

<?php if (!empty($tglAwal)) { ?>
    <center>
        <h2>DAFTAR LAPORAN PEMINJAMAN PERPUSTAKAAN SMK INOVASI MANDIRI </h2><hr><br>
        <h4>PERIODE PESANAN <b><?= IndonesiaTgl($awal); ?> s/d <?= IndonesiaTgl($akhir); ?></b></h4><br>
    </center>
<?php } else { ?>
    <center><h2>DAFTAR LAPORAN PEMINJAMAN</h2></center>
    <hr>
<?php } ?>

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
</form>

<?php 
include '../layout/footer.php';
?>