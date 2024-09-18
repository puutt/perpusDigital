<?php 

include 'koneksi.php';

$id = $_GET['id'];

$query = "DELETE FROM ulasan_buku WHERE id_ulasan='$id'";
$query_run = mysqli_query($koneksi, $query);

if ($query_run) {
    echo "<script>
    alert('Kamu berhasil menghapus ulasan buku.');
    document.location.href = 'perpusDigital/..';
    </script>";
} else {
    echo "<script>
    alert('Kamu gagal menghapus ulasan buku.');
    document.location.href = '';
    </script>";
}


?>