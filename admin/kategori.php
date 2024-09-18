<?php 
session_start();
include '../koneksi.php';
error_reporting(0);

//tambah data kategori
if (isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];

    //cek kategori, jgn ada yang sama
    $ktg_query = "SELECT * FROM kategoribuku WHERE nama_kategori = '$kategori'";
    $ktg_query_run = mysqli_query($koneksi, $ktg_query);
    if (mysqli_num_rows($ktg_query_run) > 0){
        $_SESSION['info'] = 'Kategori sudah tersedia';
        // header("location: kategori");
    }

    //memasukkan data buku ke db
    $query = mysqli_query($koneksi, "INSERT INTO kategoribuku (nama_kategori) VALUES ('$kategori')");

    if ($query) {
        $_SESSION['info'] = 'Anda berhasil menambah data kategori';
        // header("location: kategori");
    } else {
        $_SESSION['info'] = 'Anda gagal menghapus data';
        // header("location: kategori");
    }
}

//delete data buku
if (isset($_POST['hapus'])) {

    $id = $_POST['id_kategori'];

    $query = "DELETE FROM kategoribuku WHERE id_kategori='$id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        $_SESSION['info'] = 'Anda berhasil menghapus data';
        // header("location: kategori");
    } else {
        $_SESSION['info'] = 'Anda gagal menghapus data';
        // header("location: kategori");
    }
}

if (isset($_POST['ubah'])) {

    //updating
    $query = "UPDATE kategoribuku SET nama_kategori='$_POST[ktg_buku]' WHERE id_kategori='$_POST[id_kategori]'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        $_SESSION['info'] = 'Anda berhasil mengubah data';
        // header("location: kategori");
    } else {
        $_SESSION['info'] = 'Anda gagal mengubah data';
        // header("location: kategori");
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

                    <h1 class="mt-4">Kategori</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">Data</li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>

                    <?php
                    if (isset($_SESSION['info'])) {
                    ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      <?= $_SESSION['info']; ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['info']);
                    }
                    ?>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Kategori
                            <button type="button" style="float: right;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBuku">
                            Tambah
                        </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                                while ($loop = mysqli_fetch_array($tampil)) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $loop['nama_kategori'] ?></td>                                        
                                        <td>
                                            <button type="button" class="badge text-bg-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahKategori<?= $no ?>">Ubah</button>
                                            <button type="submit" name="hapus" class="badge text-bg-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusKategori<?= $no ?>">Hapus</button>
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
                                                                <input type="hidden" name="id_kategori" value="<?= $loop['id_kategori'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="inputNama" class="form-label">Kategori</label>
                                                                    <input type="text" class="form-control" autocomplete="off" name="ktg_buku" id="inputNama" value="<?= $loop['nama_kategori']; ?>">
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
                                <input type="text" class="form-control" autocomplete="off" required name="kategori" id="inputJudul">
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