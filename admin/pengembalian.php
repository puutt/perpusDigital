<?php 
include '../koneksi.php';
error_reporting(0);

//tambah data buku
if (isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];

    //memasukkan data buku ke db
    $query = mysqli_query($koneksi, "INSERT INTO kategoribuku (nama_kategori) VALUES ('$kategori')");

    if ($query) {
        echo "<script>
        alert('Kamu berhasil menambah kategori buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menambah kategori buku.');
        document.location.href = '';
        </script>";
        exit();
    }
}

//delete data buku
if (isset($_POST['hapus'])) {

    $id = $_POST['id_kategori'];

    $query = "DELETE FROM kategoribuku WHERE id_kategori='$id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        unlink("../img/" . $foto);
        echo "<script>
        alert('Kamu berhasil menghapus kategori buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menghapus kategori buku.');
        document.location.href = '';
        </script>";
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
                <h1 class="mt-4">Pengembalian Buku</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">Riwayat</li>
                    <li class="breadcrumb-item active">Pengembalian Buku</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Pengembalian Buku
                        <button type="button" style="float: right;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBuku">
                            Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Buku</th>
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
                                        <td><?= $loop['id_user'] ?></td>                                        
                                        <td><?= $loop['id_buku'] ?></td>                                        
                                        <td><?= $loop['tgl_peminjaman'] ?></td>    
                                        <td><?= $loop['tgl_pengembalian'] ?></td>                                           
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahKategori<?= $no ?>">Ubah</button>
                                            <button type="submit" name="hapus" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusKategori<?= $no ?>">Hapus</button>
                                        </form>
                                    </td>

                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="ubahKategori<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Kategori</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post">
                                                        <input type="hidden" name="id_buku" value="<?= $loop['id_kategori'] ?>">
                                                        <div class="mb-3">
                                                            <label for="inputNama" class="form-label">Kategori</label>
                                                            <input type="text" class="form-control" name="kategori" id="inputNama" value="<?= $loop['nama_kategori']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus-->
                                <div class="modal fade" id="hapusKategori<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Kategori</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post">
                                                    <input type="hidden" name="id_kategori" value="<?php echo $loop['id_kategori'] ?>">
                                                    <h5 class="text-center">Apakah Anda yakin ingin menghapus kategori buku <span class="text-danger"><?php echo $loop['nama_kategori'] ?></span>?<br></h5>
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
<div class="modal fade" id="tambahBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inputJudul" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="inputJudul" aria-describedby="emailHelp">
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