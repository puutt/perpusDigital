<?php 
include '../koneksi.php';

//ubah data profile 
if (isset($_POST['ubah'])) {

    //updating
  $query = "UPDATE profile SET 
  judul='$_POST[judul]',
  nama_sekolah='$_POST[nama]', 
  alamat='$_POST[alamat]', 
  deskripsi='$_POST[desk]',
  telp='$_POST[telp]',
  email='$_POST[email]'
  WHERE id_profile='$_POST[id_profile]'";
  $query_run = mysqli_query($koneksi, $query);

  if ($query_run) {
    echo "<script>
    alert('Kamu berhasil mengubah profile.');
    document.location.href = '';
    </script>";
  } else {
    echo "<script>
    alert('Kamu gagal mengubah profile.');
    document.location.href = '';
    </script>";
    exit();
  }
}


if (isset($_POST['profImg'])) {
  $foto_baru = $_FILES['foto']['name'];
  $foto_lama = $_POST['foto_old'];

  if ($foto_baru != '') {
    $update_filename = $_FILES['foto']['name'];
  } else {
    $update_filename = $foto_lama;
  }

      //updating
  $query = "UPDATE profile SET foto='$update_filename' WHERE id_profile='$_POST[id_profile]'";
  $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        if ($_FILES['foto']['name'] != '') {
            move_uploaded_file($_FILES["foto"]["tmp_name"], "../img/" . $_FILES["foto"]["name"]);
            unlink("../img/" . $foto_lama);
        }
        echo "<script>
        alert('Kamu berhasil mengubah foto profile.');
        document.location.href = '';
        </script>";
    } else {
        echo "<script>
        alert('Kamu gagal mengubah foto profile.');
        document.location.href = '';
        </script>";
        exit();
    }

}


?>

<?php include "layout/header.php" ?>
<body class="sb-nav-fixed">
<?php include 'layout/sidebar.php'  ?>
<div class="container">
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-4">
        <div class="row g-2 ms-2 mt-4 mb-4">
          <div class="col-md-3 card text-bg-light">
            <form method="post">
              <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <h5>Profile Web</h5>
                <?php 
                $no = 1;
                $query = "SELECT * FROM profile";
                $query_run = mysqli_query($koneksi, $query);

                if (mysqli_num_rows($query_run) > 0) {
                  foreach ($query_run as $row) {
                    ?>
                    <input type="hidden" name="id_profile" value="<?= $row['id_profile'] ?>">
                    <img src="../img/<?= $row['foto'] ?>" class="rounded mt-5" id="profile-pic" style="width: 150px;">
                    <span class="fw-bold"><?= $row['nama_sekolah']; ?></span>

                      <button type="button" name="ubah" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ubahProfile">Ubah foto profile</button>
                    </div>
                  </form>
                </div>
                <div class="col-md-8 card text-bg-light">
                  <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <h5>Pengaturan Profile</h5>
                    </div>
                    <div class="row mt-4">
                      <div class="col-6">
                        <form method="post">
                          <input type="hidden" name="id_profile" value="<?= $row['id_profile'] ?>">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Nama Sekolah</span>
                            <input type="text" class="form-control" autocomplete="off" name="nama" value="<?= $row['nama_sekolah']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Judul</span>
                            <input type="text" class="form-control" autocomplete="off" name="judul" value="<?= $row['judul']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Alamat</span>
                            <input type="text" class="form-control" autocomplete="off" name="alamat" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?= $row['alamat']; ?>" required>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Deskripsi</span>
                            <input type="text" class="form-control" autocomplete="off" name="desk" value="<?= $row['deskripsi']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">No Telp</span>
                            <input type="text" class="form-control" autocomplete="off" name="telp" value="<?= $row['telp']; ?>" required
                            >
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-group mb-3">
                            <span class="input-group-text">Email</span>
                            <input type="text" class="form-control" autocomplete="off" name="email" value="<?= $row['email']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-12 d-grid mt-3">
                          <button class="btn btn-primary" type="submit" name="ubah">Ubah profile</button>
                        </div>
                      </form>
                      <?php
                    }
                  }

                  ?>
                </div>
              </div>
            </div>

          </div>
        </main>

      <div class="modal fade" id="ubahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_profile" value="<?= $row['id_profile'] ?>">
                <input type="file" required="" name="foto" accept="image/*">
                <input type="hidden" name="foto_old" value="<?= $row['foto'] ?>">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" name="profImg" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>

    <?php include "layout/footer.php" ?>