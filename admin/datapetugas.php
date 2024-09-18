<?php
include '../koneksi.php';

//tambah data
if (isset($_POST['simpan'])) {
    $daftarnama = $_POST['nama'];
    $daftarusn = $_POST['usn'];
    $daftarpw = $_POST['pw'];
    $daftarole = $_POST['role'];
    $daftaremail = $_POST['email'];

    //cek username
    $username_query = "SELECT * FROM user WHERE username = '$daftarusn'";
    $username_query_run = mysqli_query($koneksi, $username_query);
    if (mysqli_num_rows($username_query_run) > 0) {
        echo "<script>
        alert('Username sudah digunakan');
        document.location.href = '';
        </script>";
        exit();
    }

    //memasukkan data akun ke db
    $query = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap, username, password, email, role) VALUES ('$daftarnama','$daftarusn', '$daftarpw', '$daftaremail', '$daftarole')");
    if ($query) {
        echo "<script>
            alert('Kamu berhasil menambah akun!');
            document.location.href = '';
            </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menambah akun!');
        document.location.href = '';
        </script>";
        exit();
    }
}

//hapus data
if (isset($_POST['hapus'])) {

    $id = $_POST['id_user'];

    $query = "DELETE FROM user WHERE id_user='$id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        echo "<script>
        alert('Kamu berhasil menghapus akun!');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menghapus akun!');
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
                <h1 class="mt-4">Data Petugas</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item active">Petugas</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Petugas
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#tambahPetugas">
                            Tambah
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = mysqli_query($koneksi, "SELECT * FROM user WHERE role = 'Petugas' OR role='Admin' ");
                                while ($loop = mysqli_fetch_array($tampil)) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $loop['nama_lengkap'] ?></td>
                                        <td><?= $loop['username'] ?></td>
                                        <td><?= $loop['email'] ?></td>
                                        <td><?= $loop['role'] ?></td>
                                        <td><?= $loop['alamat'] ?></td>
                                        <td>
                                            <?php if ($loop['role'] == 'Admin') { ?>
                                            <button type="button" class="badge text-bg-primary" data-bs-toggle="modal" data-bs-target="#lihatPetugas<?= $no ?>">Lihat</button>    
                                            <?php } else { ?>
                                            <button type="button" class="badge text-bg-primary" data-bs-toggle="modal" data-bs-target="#lihatPetugas<?= $no ?>">Lihat</button>
                                            <button type="submit" name="hapus" class="badge text-bg-danger" data-bs-toggle="modal" data-bs-target="#hapusPetugas<?= $no ?>">hapus</button>
                                            <?php } ?>
                                            </form>
                                        </td>

                                        <!-- Modal Lihat-->
                                        <div class="modal fade" id="lihatPetugas<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Petugas</h1>
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
                                                                    <?= $loop['nama_lengkap'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="row justify-content-md-left">
                                                                <div class="col col-lg-5">
                                                                    Username
                                                                </div>
                                                                <div class="col-md-auto">
                                                                    :
                                                                </div>
                                                                <div class="col col-lg-5">
                                                                    <?= $loop['username'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="row justify-content-md-left">
                                                                <div class="col col-lg-5">
                                                                    Email
                                                                </div>
                                                                <div class="col-md-auto">
                                                                    :
                                                                </div>
                                                                <div class="col col-lg-5">
                                                                    <?= $loop['email'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="row justify-content-md-left">
                                                                <div class="col col-lg-5">
                                                                    Role
                                                                </div>
                                                                <div class="col-md-auto">
                                                                    :
                                                                </div>
                                                                <div class="col col-lg-5">
                                                                    <?= $loop['role'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="row justify-content-md-left">
                                                                <div class="col col-lg-5">
                                                                    Alamat
                                                                </div>
                                                                <div class="col-md-auto">
                                                                    :
                                                                </div>
                                                                <div class="col col-lg-5">
                                                                    <?= $loop['alamat'] ?>
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
                                        <div class="modal fade" id="hapusPetugas<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Petugas</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post">
                                                        <input type="hidden" name="id_user" value="<?= $loop['id_user'] ?>">
                                                        <h5 class="text-center">Apakah Anda yakin ingin menghapus Admin bernama <span class="text-danger"><?= $loop['nama_lengkap'] ?></span>?<br></h5>
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
                                <input type="text" autocomplete="off" required class="form-control" name="nama" id="inputNama" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="inputUsn" class="form-label">Username</label>
                                <input type="text" autocomplete="off" required class="form-control" name="usn" id="inputUsn" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" autocomplete="off" required class="form-control" name="email" id="inputEmail" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" autocomplete="off" required class="form-control" name="pw" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="inputRole" class="form-label">Role</label>
                                <input type="text" class="form-control" name="role" id="inputRole" value="Petugas" readonly>
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