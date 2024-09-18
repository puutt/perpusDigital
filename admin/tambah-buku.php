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
    $j = $_POST['jml'];

    //memasukkan data buku ke db
    $query = mysqli_query($koneksi, "INSERT INTO buku (judul, foto, penulis, penerbit, sinopsis, tahun_terbit, kategori, jumlah_halaman) VALUES ('$judul', '$foto', '$penulis', '$penerbit', '$sinopsis', '$tahun', '$j')");

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
                                jumlah_halaman='$_POST[jml]'
                                WHERE id_buku='$_POST[id]'";
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
                        <li class="breadcrumb-item">Data Buku</li>
                        <li class="breadcrumb-item active">Buku</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pendataan Buku
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBuku">
                            Tambah
                            </button>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="inputFoto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" name="foto" id="inputFoto" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="inputJudul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul" id="inputJudul" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="inputPenulis" class="form-label">Penulis</label>
                                    <input type="text" class="form-control" name="penulis" id="inputPenulis" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="inputPenerbit" class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" name="penerbit" id="inputPenerbit" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleTahunTB" class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" name="tahun_t" id="exampleTahunTB">
                                </div>  
                                <div class="mb-3">
                                    <label for="exampleJml" class="form-label">Jumlah Halaman</label>
                                    <input type="number" class="form-control" name="jml" id="exampleJml">
                                </div>        
                                <div class="mb-3">
                                    <label for="inputKtg" class="form-label">Kategori</label>
                                    <select class="form-control" name="kategori" id="inputKtg" required="">
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </main>

<?php 
include 'layout/footer.php';
?>