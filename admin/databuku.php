<?php 
include '../koneksi.php';
error_reporting(0);

//tambah data buku
if (isset($_POST['simpan'])) {
    $foto = $_FILES['foto']['name'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun_t'];
    $sinopsis = $_POST['sinopsis'];
    $kategori = $_POST['kategori'];
    $jml = $_POST['jml'];
    $jmlb = $_POST['jml_buku'];
    $tgl = date('Y-m-d');

    //memasukkan data buku ke db
    $query = mysqli_query($koneksi, "INSERT INTO buku (judul, foto, penulis, penerbit, sinopsis, tahun_terbit, kategori, jumlah_halaman, tgl_masuk, jml_buku) VALUES ('$judul', '$foto', '$penulis', '$penerbit', '$sinopsis', '$tahun', '$kategori', '$jml', '$tgl', '$jmlb')");

    if ($query) {
        move_uploaded_file($_FILES["foto"]["tmp_name"], "../img/" . $_FILES["foto"]["name"]);
        echo "<script>
        alert('Kamu berhasil menambah data buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menambah data buku.');
        document.location.href = '';
        </script>";
        exit();
    }
}

//ubah data buku 
if (isset($_POST['ubah'])) {

    $foto_baru = $_FILES['foto']['name'];
    $foto_lama = $_POST['foto_old'];

    if ($foto_baru != '') {
        $update_filename = $_FILES['foto']['name'];
    } else {
        $update_filename = $foto_lama;
    } 

    //updating
    $query = "UPDATE buku SET 
                                judul='$_POST[judul]', 
                                foto='$update_filename', 
                                penulis='$_POST[penulis]', 
                                penerbit='$_POST[penerbit]', 
                                sinopsis='$_POST[sinopsis]', 
                                tahun_terbit='$_POST[thn_t]',
                                kategori='$_POST[kategori]',
                                jumlah_halaman='$_POST[jml]',
                                jml_buku='$_POST[jml_buku]'
                                WHERE id_buku='$_POST[id_buku]'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        if ($_FILES['foto']['name'] != '') {
            move_uploaded_file($_FILES["foto"]["tmp_name"], "../img/" . $_FILES["foto"]["name"]);
            unlink("../img/" . $foto_lama);
        }
        echo "<script>
        alert('Kamu berhasil mengubah data buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal mengubah data buku.');
        document.location.href = '';
        </script>";
        exit();
    }
}

//delete data buku
if (isset($_POST['hapus'])) {

    $id = $_POST['id_buku'];
    $foto = $_POST['hapus_foto'];

    $query = "DELETE FROM buku WHERE id_buku='$id'";
    $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        unlink("../img/" . $foto);
        echo "<script>
        alert('Kamu berhasil menghapus data buku.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal menghapus data buku.');
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
                    <h1 class="mt-4">Data Buku</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">Data</li>
                        <li class="breadcrumb-item active">Buku</li>
                    </ol>

                    <?php 
                $id = $_GET['id'];
                $no = 1;
                $query = "SELECT * FROM buku WHERE id_buku='$id'";
                $query_run = mysqli_query($koneksi, $query);

                if (mysqli_num_rows($query_run) > 0) {
                  foreach ($query_run as $row) {
                    ?>
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <img class="border rounded p-3" src="../img/<?= $row['foto']; ?>" width="70%">
                            </div>
                            <div class="col card p-4">
                                <form action="" method="post">
                                <div class="input-group mb-3">
                                    <input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>">
                                    <span class="input-group-text" id="basic-addon1">Foto</span>
                                        <input type="file" class="form-control" name="foto" autocomplete="off">
                                        <input type="hidden" name="foto_old" value="<?= $row['foto'] ?>">
                                </div>
                                
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Judul</span>
                                    <input type="text" class="form-control" name="judul" aria-label="judul" value="<?= $row['judul'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Penulis</span>
                                    <input type="text" class="form-control" name="penulis" aria-label="penulis" value="<?= $row['penulis'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Penerbit</span>
                                    <input type="text" class="form-control" name="penerbit" aria-label="penerbit" value="<?= $row['penerbit'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Tahun Terbit</span>
                                    <input type="text" class="form-control" name="thn_t" aria-label="tahun" value="<?= $row['tahun_terbit'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Kategori</span>
                                    <select required class="form-select" name="kategori" id="inputKtg" required="">
                                        <option value="<?= $row['kategori'] ?>"><?= $row['kategori'] ?></option>
                                        <?php 
                                            $sql = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                                            while ($data = mysqli_fetch_array($sql)) {
                                        
                                            echo '<option value=" '.$data['nama_kategori'].' "> '.$data['nama_kategori'].' </option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Jumlah Halaman</span>
                                    <input type="number" class="form-control" name="jml" aria-label="jml_hal" value="<?= $row['jumlah_halaman'] ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Jumlah Buku</span>
                                    <input type="number" class="form-control" name="jml_buku" value="<?= $row['jml_buku'] ?>">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Sinopsis</span>
                                    <textarea class="form-control" name="sinopsis" value="<?= $row['sinopsis'] ?>"><?= $row['sinopsis'] ?></textarea>
                                </div>
                                <div class="col-12 d-grid mt-3">
                                    <button class="btn btn-primary" type="submit" name="ubah">Ubah data buku</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    <?php
                    }
                  }

                  ?>

                  <?php if($_GET['id'] == 0) { ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pendataan Buku
                            <button type="button" style="float: right;" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBuku">
                            Tambah
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Penerbit</th>
                                        <th>Jumlah Halaman</th>
                                        <th>Tahun Terbit</th>
                                        <th>Sinopsis</th>
                                        <th>Kategori</th>
                                        <th>Akdsi</th>
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
                                        <td><img src="../img/<?= $loop['foto'] ?>" style="width:50px; height:50px;" alt=""></td>
                                        <td><?= $loop['judul'] ?></td>
                                        <td><?= $loop['penulis'] ?></td>
                                        <td><?= $loop['penerbit'] ?></td>
                                        <td><?= $loop['jumlah_halaman'] ?></td>
                                        <td><?= $loop['tahun_terbit'] ?></td>
                                        <td>
                                            <?php if(strlen($loop['sinopsis']) >= 120) { 
                                               echo substr($loop['sinopsis'], 0, 120) . '...';
                                             } else { ?>
                                                <?= $loop['sinopsis'] ?>
                                            <?php } ?>
                                        </td>
                                        <td><?= $loop['kategori'] ?></td>
                                        <td>
                                            <button type="button" class="badge text-bg-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahBuku<?= $no ?>">Ubah</button>
                                            <button type="submit" name="hapus" class="badge text-bg-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusPetugas<?= $no ?>">hapus</button>
                                            </form>
                                        </td>

                                        <!-- Modal Edit-->
                                        <div class="modal fade" id="ubahBuku<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Petugas</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_buku" value="<?= $loop['id_buku'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="inputFoto" class="form-label">Foto</label>
                                                                    <img src="../img/<?= $loop['foto'] ?>" width= '95px'; alt="">
                                                                    <input type="file" name="foto" autocomplete="off">
                                                                    <input type="hidden" name="foto_old" value="<?= $loop['foto'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="inputNama" class="form-label">Judul</label>
                                                                    <input autocomplete="off" required type="text" class="form-control" name="judul" id="inputNama" value="<?= $loop['judul']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="inputUsn" class="form-label">Penulis</label>
                                                                    <input autocomplete="off" required type="text" class="form-control" name="penulis" id="inputUsn" value="<?= $loop['penulis']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="inputEmail" class="form-label">Penerbit</label>
                                                                    <input autocomplete="off" required type="text" class="form-control" name="penerbit" id="inputEmail" value="<?= $loop['penerbit']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputPassword1" class="form-label">Tahun Terbit</label>
                                                                    <input autocomplete="off" required type="number" class="form-control" name="thn_t" id="exampleInputPassword1" value="<?= $loop['tahun_terbit']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputJml" class="form-label">Jumlah Halaman</label>
                                                                    <input autocomplete="off" required type="number" class="form-control" name="jml" id="exampleInputJml" value="<?= $loop['jumlah_halaman']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleInputJmlB" class="form-label">Jumlah Buku</label>
                                                                    <input autocomplete="off" required type="number" class="form-control" name="jml_buku" id="exampleInputJmlB" value="<?= $loop['jml_buku']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="inputKtg" class="form-label">Kategori</label>
                                                                    <select required class="form-control" name="kategori" id="inputKtg" required="">
                                                                        <option value="<?= $loop['kategori'] ?>"><?= $loop['kategori'] ?></option>
                                                                        <?php 
                                                                            $sql = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                                                                            while ($data = mysqli_fetch_array($sql)) {
                                                                        
                                                                            echo '<option value=" '.$data['nama_kategori'].' "> '.$data['nama_kategori'].' </option>';
                                                                        } ?>
                                                                    </select>
                                                                </div>                    
                                                                <div class="mb-3">
                                                                    <label for="inputRole" class="form-label">Sinopsis</label>
                                                                    <textarea type="text" class="form-control" name="sinopsis" id="inputRole"><?= $loop['sinopsis']; ?></textarea>
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
                                        <div class="modal fade" id="hapusPetugas<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Buku</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="id_buku" value="<?php echo $loop['id_buku'] ?>">
                                                            <input type="hidden" name="hapus_foto" value="<?php echo $loop['foto'] ?>">
                                                        <h5 class="text-center">Apakah Anda yakin ingin menghapus data buku yang berjudul <span class="text-danger"><?php echo $loop['judul'] ?></span>?<br></h5>
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
                    <?php } ?>

                </div>
            </main>

                    <!-- Modal Tambah-->
        <div class="modal fade" id="tambahBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Petugas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="inputFoto" class="form-label">Foto</label>
                                <input autocomplete="off" required type="file" class="form-control" name="foto" id="inputFoto" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="inputJudul" class="form-label">Judul</label>
                                <input autocomplete="off" required type="text" class="form-control" name="judul" id="inputJudul" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="inputPenulis" class="form-label">Penulis</label>
                                <input autocomplete="off" required type="text" class="form-control" name="penulis" id="inputPenulis" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="inputPenerbit" class="form-label">Penerbit</label>
                                <input autocomplete="off" required type="text" class="form-control" name="penerbit" id="inputPenerbit" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleTahunTB" class="form-label">Tahun Terbit</label>
                                <input autocomplete="off" required type="number" class="form-control" name="tahun_t" id="exampleTahunTB">
                            </div>  
                            <div class="mb-3">
                                <label for="exampleJml" class="form-label">Jumlah Halaman</label>
                                <input autocomplete="off" required type="number" class="form-control" name="jml" id="exampleJml">
                            </div>    
                            <div class="mb-3">
                                <label for="exampleJmlB" class="form-label">Jumlah Buku</label>
                                <input autocomplete="off" required type="number" class="form-control" name="jml_buku" id="exampleJmlB">
                            </div>        
                                <div class="mb-3">
                                    <label for="inputKtg" class="form-label">Kategori</label>
                                    <select required class="form-control" name="kategori" id="inputKtg" required="">
                                        <option value="">- Pilih -</option>
                                        <?php 
                                            $sql = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                                            while ($data = mysqli_fetch_array($sql)) {
                                        
                                            echo '<option value=" '.$data['nama_kategori'].' "> '.$data['nama_kategori'].' </option>';
                                        } ?>
                                    </select>
                                </div>                                 
                            <div class="mb-3">
                                <label for="inputSinopsis" class="form-label">Sinopsis</label>
                                <textarea type="text" class="form-control" name="sinopsis" id="inputSinopsis"></textarea>
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