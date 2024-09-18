<?php
include '../koneksi.php';

//tambah data
if (isset($_POST['simpan'])) {
    $daftarnama = $_POST['nama'];

    //memasukkan data akun ke db
    $query = mysqli_query($koneksi, "INSERT INTO guru (nama) VALUES ('$daftarnama')");
    if ($query) {
        echo "<script>
            alert('Kamu berhasil menambah data guru!');
            document.location.href = '';
            </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menambah data guru!');
        document.location.href = '';
        </script>";
        exit();
    }
}

if (isset($_POST['ubah'])) {

    //updating
    $query = "UPDATE guru SET nama='$_POST[nama]' WHERE id_guru='$_POST[id_guru]'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        echo "<script>
        alert('Kamu berhasil mengubah data guru.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal mengubah data guru.');
        document.location.href = '';
        </script>";
        exit();
    }
}

//hapus data
if (isset($_POST['hapus'])) {

    $id = $_POST['id_guru'];

    $query = "DELETE FROM guru WHERE id_guru='$id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        echo "<script>
        alert('Kamu berhasil menghapus data guru!');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menghapus data guru!');
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
                <h1 class="mt-4">Data Guru</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item active">Guru</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Guru
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#tambahGuru">
                            Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama ASC");
                                while ($loop = mysqli_fetch_array($tampil)) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $loop['nama'] ?></td>
                                        <td>
                                            <?php if ($_SESSION['role'] == 'Admin') { ?>
                                            <button type="button" class="badge text-bg-primary" data-bs-toggle="modal" data-bs-target="#editGuru<?= $no ?>">Ubah</button>
                                            <button type="submit" name="hapus" class="badge text-bg-danger" data-bs-toggle="modal" data-bs-target="#hapusGuru<?= $no ?>">Hapus</button>  
                                            <?php } else { ?>
                                            <button type="submit" class="badge text-bg-info" data-bs-toggle="modal" data-bs-target="#lihatGuru<?= $no ?>">Lihat</button> 
                                            <?php } ?>
                                            </form>
                                        </td>

                                        <!-- Modal Edit-->
                                        <div class="modal fade" id="editGuru<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Guru</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                                <input type="hidden" name="id_guru" value="<?= $loop['id_guru'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="inputNama" class="form-label">Nama</label>
                                                                    <input autocomplete="off" required type="text" class="form-control" name="nama" id="inputNama" value="<?= $loop['nama']; ?>">
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

                                        <!-- Modal Lihat -->
                                        <div class="modal fade" id="lihatGuru<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="row justify-content-md-left">
                                                                <div class="col col-lg-5">
                                                                    Nama Lengkap
                                                                </div>
                                                                <div class="col-md-auto">
                                                                    :
                                                                </div>
                                                                <div class="col col-lg-5">
                                                                    <?= $loop['nama'] ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="hapusGuru<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Guru</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                        <input type="hidden" name="id_guru" value="<?= $loop['id_guru'] ?>">
                                                        <h5 class="text-center">Apakah Anda yakin ingin menghapus Admin bernama <span class="text-danger"><?= $loop['nama'] ?></span>?<br></h5>
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
        <div class="modal fade" id="tambahGuru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Guru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="inputNama" class="form-label">Nama Guru</label>
                                <input type="text" autocomplete="off" required class="form-control" name="nama" id="inputNama" aria-describedby="emailHelp">
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