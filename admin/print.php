<?php
include "../koneksi.php";
?>

<?php 
include 'layout/header.php';
?>
<body onload="window.print()">
    <h3>Laporan Peminjaman</h3>
    <hr>
    <table class="table text-center" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jam Pinjam</th>
                    <th>Tgl Peminjaman</th>
                    <th>Tgl Pengembalian</th>
                    <th>Terlambat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $tampil = mysqli_query($koneksi, "SELECT * FROM pengembalian AS p
                                          JOIN user AS u ON u.id_user = p.id_user 
                                          ORDER BY p.id_pengembalian DESC");
                while ($loop = mysqli_fetch_array($tampil)) :
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $loop['nama_lengkap'] ?></td>                                     
                        <td><?= $loop['jam'] ?></td>                                     
                        <td><?= $loop['tgl_peminjaman'] ?></td>    
                        <td><?= $loop['tgl_pengembalian'] ?></td>
                        <td>
                          <?php  
                                if ($loop['denda'] > 0) {
                                  echo "Ya | Denda Rp" . number_format($loop['denda'], 0, ',', '.');
                                } else {
                                  echo "Tidak";
                                }
                            ?>
                        </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div style="text-align: right; margin-top: 8px;">
                <?php
                $id = $_SESSION['id_user'];
                $tampil = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id'");
                while ($loop = mysqli_fetch_array($tampil)) :
                    ?>
        <p>Sumedang, <?= date('Y-m-d') ?></p><br><br>
        <p style="text-transform: uppercase;"><?= $loop['nama_lengkap'] ?></p>
        <?php endwhile; ?>
    </div>
</body>
</html>