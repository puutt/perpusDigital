<?php
include "../koneksi.php";
?>

<?php 
include 'layout/header.php';
?>
<body onload="window.print()">
    <h3>Laporan Peminjaman</h3>
    <hr>
    <table class="table table-borderless text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
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
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>