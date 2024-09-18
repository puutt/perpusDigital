<?php
include '../koneksi.php';

//hapus data
if (isset($_POST['hapus'])) {

    $id = $_POST['id_ulasan'];

    $query = "DELETE FROM ulasan_buku WHERE id_ulasan='$id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        echo "<script>
        alert('Kamu berhasil menghapus ulasan buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menghapus ulasan buku.');
        document.location.href = '';
        </script>";
        exit();
    }
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
                <h1 class="mt-4">Ulasan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item active">Ulasan</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Ulasan
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Buku</th>
                                    <th>Ulasan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM buku AS b 
                                    JOIN ulasan_buku AS ub ON b.id_buku = ub.id_buku
                                    JOIN user AS u ON u.id_user = ub.id_user
                                    ");
                                while ($loop = mysqli_fetch_array($tampil)) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $loop['nama_lengkap'] ?></td>
                                        <td><?= $loop['judul'] ?></td>
                                        <td><?= $loop['ulasan'] ?></td>
                                        <td><?= $loop['tgl'] ?></td>
                                        <td>
                                            <button type="submit" name="hapus" class="badge text-bg-danger" data-bs-toggle="modal" data-bs-target="#hapusUlasan<?= $no ?>">hapus</button>
                                            </form>
                                        </td>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="hapusUlasan<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Ulasan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                            <input type="hidden" name="id_ulasan" value="<?= $loop['id_ulasan'] ?>">
                                                        <h5 class="text-center">Apakah Anda yakin ingin menghapus ulasan ini?<br></h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
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
        </main>

        <!-- Modal Tambah-->
        <div class="modal fade" id="tambahPetugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Petugas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="inputNama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="inputNama" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="inputUsn" class="form-label">Username</label>
                                <input type="text" class="form-control" name="usn" id="inputUsn" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="inputEmail" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="pw" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="inputRole" class="form-label">Role</label>
                                <input type="text" class="form-control" name="role" id="inputRole" value="Admin" readonly>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        include 'layout/footer.php';
        ?>