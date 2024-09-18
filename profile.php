<?php 
include 'koneksi.php';

//ubah data profile 
if (isset($_POST['ubah'])) {

    //updating
  $query = "UPDATE user SET 
  nama_lengkap='$_POST[nama]',
  username='$_POST[usn]', 
  password='$_POST[pw]', 
  email='$_POST[email]', 
  alamat='$_POST[alamat]',
  kelas='$_POST[kelas]'
  WHERE id_user='$_POST[id_user]'";
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
  $query = "UPDATE user SET foto='$update_filename' WHERE id_user='$_POST[id_user]'";
  $query_run = mysqli_query($koneksi, $query);

    if ($query_run) {
        if ($_FILES['foto']['name'] != '') {
            move_uploaded_file($_FILES["foto"]["tmp_name"], "img/" . $_FILES["foto"]["name"]);
            unlink("img/" . $foto_lama);
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

<?php include "header-user.php" ?>
<?php include "navbar-user.php" ?>
<div class="container" style="padding-top: 90px;">
  <div id="layoutSidenav_content">
    <main>
      <div class="container px-4">
        <div class="row g-2 ms-2 mt-4 mb-4">
          <div class="col-md-3 card text-bg-light">
            <form method="post">
              <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <h5>Profile</h5>
                <?php 
                $id = $_GET['id'];
                $no = 1;
                $query = "SELECT * FROM user WHERE id_user='$id'";
                $query_run = mysqli_query($koneksi, $query);

                if (mysqli_num_rows($query_run) > 0) {
                  foreach ($query_run as $row) {
                    ?>
                    <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                    <img src="img/<?= $row['foto'] ?>" class="rounded mt-5" id="profile-pic" style="width: 150px;">
                    <span class="fw-bold"><?= $row['nama_lengkap']; ?></span>
                    <span class="fw-bold text-black-50"><?= $row['email']; ?></span>

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
                          <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Nama Lengkap</span>
                            <input type="text" class="form-control" autocomplete="off" name="nama" value="<?= $row['nama_lengkap']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
                            <input type="text" class="form-control" autocomplete="off" name="usn" value="<?= $row['username']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Kelas</span>
                            <input type="text" class="form-control" autocomplete="off" name="kelas" value="<?= $row['kelas']; ?>" readonly>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
                            <input type="password" class="form-control" autocomplete="off" name="pw" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?= $row['password']; ?>" readonly>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                            <input type="email" class="form-control" autocomplete="off" name="email" value="<?= $row['email']; ?>" required="">
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Role</span>
                            <input type="text" class="form-control" autocomplete="off" name="role" value="<?= $row['role']; ?>" readonly>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-group mb-3">
                            <span class="input-group-text">Alamat</span>
                            <input type="text" class="form-control" autocomplete="off" name="alamat" value="<?= $row['alamat']; ?>" required="">
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
      </div>
      </div>

      <div class="modal fade" id="ubahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
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


<!--     <script type="text/javascript">
      let profilePic = document.getElementById("profile-pic");
      let profileImg = document.getElementById("profile-img");

      profileImg.onchange = function(){
        profilePic.src = URL.createObjectURL(profileImg.files[0]);
      }
      
    </script> -->


    <?php include "footer-user.php" ?>