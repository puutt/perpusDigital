<?php 
session_start();
include '../koneksi.php';

// if (!isset($_SESSION["username"])) {
//     header("Location:login.php");
//     exit;
// }

$output = '';
if (isset($_POST["export"])) {
    $no = 1;
    $sql = "SELECT * FROM pengembalian AS p
                                          JOIN user AS u ON u.id_user = p.id_user 
                                          ORDER BY p.id_pengembalian DESC";
    $result = mysqli_query($koneksi, $sql);
    if (mysqli_num_rows($result) > 0) {
        $output .= '
            <table class="table text-center" bordered="1">
            <thead>
                <tr>
                    <th colspan="9">Peminjaman Perpus SMK Inovasi Mandiri</th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Terlambat</th>
                </tr>
            </thead>
            <tbody>
        ';
        while ($row = mysqli_fetch_array($result)) {
            $output .='
                <tr>
                    <td>'.$no++.'</td>
                    <td>'.$row["nama_lengkap"].'</td>
                    <td>'.$row["tgl_peminjaman"]. .$row["jam_pinjam"].'</td>
                    <td>'.$row["tgl_pengembalian"]. .$row["jam"].'</td>
                    <td>'. ($row['denda'] > 0 ? "Ya | Denda Rp" . number_format($row['denda'], 0, ',', '.') : "Tidak") .'</td>

                </tr>
            </tbody>
            ';

        }
        
        $output .='</table>';
        header("Content-Type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan Peminjaman.xls");
        echo $output;
    }
}
?>