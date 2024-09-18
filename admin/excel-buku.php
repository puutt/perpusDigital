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
    $sql = "SELECT * FROM buku ORDER BY id_buku DESC";
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
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                    <th>Tgl Masuk</th>
                </tr>
            </thead>
            <tbody>
        ';
        while ($row = mysqli_fetch_array($result)) {
            $output .='
                <tr>
                    <td>'.$no++.'</td>
                    <td>'.$row['judul'].'</td>                                     
                    <td>'.$row['penulis'].'</td>    
                    <td>'.$row['penerbit'].'</td>    
                    <td>'.$row['kategori'].'</td>    
                    <td>'.$row['tgl_masuk'].'</td>

                </tr>
            </tbody>
            ';

        }
        
        $output .='</table>';
        header("Content-Type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Laporan Buku.xls");
        echo $output;
    }
}
?>