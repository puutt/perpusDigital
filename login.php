<?php
session_start();
include 'koneksi.php';

if (isset($_SESSION['username'])) {
    header("Location: index");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $akun_query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $akun_query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['role']=="Admin") {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['alamat'] = $row['alamat'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = "Admin";
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];

            echo "<script>
            alert('Selamat Datang!');
            document.location.href = 'admin/';
            </script>";
            exit();
        } else if ($row['role']=='Petugas') {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['alamat'] = $row['alamat'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['kelas'] = $row['kelas'];
            $_SESSION['role'] = "Petugas";
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];

            echo "<script>
            alert('Selamat Datang!');
            document.location.href = 'admin/';
            </script>";
            exit();
        } else if ($row['role']=='Peminjam') {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['alamat'] = $row['alamat'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['kelas'] = $row['kelas'];
            $_SESSION['role'] = "Peminjam";
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];

            echo "<script>
            alert('Selamat Datang!');
            document.location.href = 'perpusDigital/../';
            </script>";
            exit();
        }
    } else {
        echo "<script>
        alert('Username dan Password salah');
        document.location.href = '';
        </script>";
        exit();
    }
}

if (isset($_POST['regist'])){
    $daftarnama = $_POST['nama'];
    $daftarusn = $_POST['username'];
    $daftarpw = $_POST['password'];
    $daftaremail = $_POST['email'];
    $daftarpw2 = $_POST['rpw'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];
    $foto = $_POST['foto'];

    //cek username
    $username_query = "SELECT * FROM user WHERE username = '$daftarusn'";
    $username_query_run = mysqli_query($koneksi, $username_query);
    if (mysqli_num_rows($username_query_run) > 0){
        echo "<script>
        alert('Username sudah digunakan');
        document.location.href = '';
        </script>";
        exit();
    }

    // if(strlen($daftarpw)<4){
    //   echo "<script>
    //     alert('Kata Sandi Harus Lebih Dari 4 kata');
    //     document.location.href = '';
    //     </script>";
    //     exit();
    // }

    //konfirmasi password
    if($daftarpw !== $daftarpw2){
        echo "<script>
        alert('Konfirmasi password tidak sesuai');
        document.location.href = '';
        </script>";
        exit();
    } 

    //enkripsi password
    // $daftarpw = password_hash($daftarpw, PASSWORD_DEFAULT);

    //memasukkan data akun ke db
    $query = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap, username, password, email, role, alamat, foto, kelas) VALUES ('$daftarnama','$daftarusn', '$daftarpw', '$daftaremail', 'Peminjam', '$alamat', '$foto', '$kelas')");
    if ($query){
        echo "<script>
            alert('Kamu berhasil mendaftarkan akun!');
            document.location.href = '';
            </script>";
    } else {
        echo "<script>
        alert('Kamu gagal mendaftarkan akun!');
        document.location.href = '';
        </script>";
        exit();
    }
}

if (isset($_POST['kirim'])) {
  $email = mysqli_real_escape_string($koneksi, $_POST['email']);
  $token = md5(rand());

  $cek_email = "SELECT email FROM user WHERE email = '$email' LIMIT 1";
  $cek_email_run = mysqli_query($koneksi, $cek_email);

  if (mysqli_num_rows($cek_email_run) > 0) {
    $row = mysqli_fetch_array($cek_email_run);
    $get_name = $row['nama_lengkap'];
    $get_email = $row['email'];
  } else {
    echo "<script>
        alert('Email tidak ditemukan');
        document.location.href = '';
        </script>";
        exit();
  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PerpusDigital - Login & Daftar</title>
  <link rel="icon" type="image/png" href="img/logo-inovasi.png">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href='https://unpkg.com/aos@next/dist/aos.css' rel='stylesheet'>
  <!-- <link href='css/sweetalert2.min.css' rel='stylesheet'> -->
  <link rel="stylesheet" href="css/style-login.css">
</head>
<body>
<?php 
    $query = "SELECT * FROM profile";
    $query_run = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($query_run) > 0) {
      foreach ($query_run as $row) {
        ?>

  <header>
    <h2><?= $row['judul']; ?></h2>
    <nav class="nav-menu" id="navMenu">
          <a href="#home" class="link">Beranda</a>
          <a href="#about" class="link">Tentang</a>
          <a href="#kontak" class="link">Kontak</a>
    </nav>
    <div class='sign-in-up'>
      <button type='button' onclick="popup('login-popup')">LOGIN</button>
      <button type='button' onclick="popup('register-popup')">Daftar</button>
    </div>
    <div class="nav-menu-btn hamburger">
        <i class="bx bx-menu" onclick="myMenuFunction()"></i>
    </div>
  </header>



    <section class="home" id="home">
        <div class="home-content">
            <h3 data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-duration="1500"><?= $row['nama_sekolah']; ?></h3>
            <p data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-duration="1500"><?= $row['alamat']; ?></p>
        </div>

        <div class="home-img">
            <img src="img/<?= $row['foto']; ?>" data-aos="fade-left" data-aos-easing="ease-in-out" data-aos-duration="1500">
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-content">
            <h2 class="heading" data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-duration="1500">Tentang Peprustakaan <span><?= $row['nama_sekolah']; ?></span></h2>
            <p data-aos="slide-right" data-aos-easing="ease-in-out" data-aos-duration="1500"><?= $row['deskripsi'] ?></p>

            <h2 class="heading" style="margin-top: 20px;" data-aos="fade-right" data-aos-easing="ease-in-out" data-aos-duration="1500">Peraturan</h2>
            <ul data-aos="slide-right" data-aos-easing="ease-in-out" data-aos-duration="1500">
              <li>Pinjam buku jangan lebih dari 1 minggu / 7 hari.</li>
              <li>Pinjam buku maksimal 3.</li>
              <li>Isi kelas, alamat, dan email dengan benar.</li>
            </ul>
        </div>
    </section>

    <section class="about" id="kontak">
        <div class="about-content">
            <h2 class="heading" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="1500">Kontak <span>Kami</span></h2>
            <p data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="1500">
            <span>Telepon</span> <br>
            <?= $row['telp']; ?> <br>
            <span>Email</span> <br>
            <?= $row['email']; ?>
            </p>
        </div>
    </section>

    <?php
        }
      }

      ?>

  <div class="popup-container" id="login-popup">
    <div class="popup">
      <form method="POST">
        <h2>
          <span>LOGIN</span>
          <button type="reset" onclick="popup('login-popup')">X</button>
        </h2>
        <input type="text" placeholder="Username" name="username" autocomplete="off" required autofocus>
        <input type="password" placeholder="Password" name="password" autocomplete="off" required>
        <button type="submit" class="login-btn" name="login">LOGIN</button>
      </form>
      <!-- <div class="forgot-btn">
        <button type="button" onclick="forgotPopup()">Lupa Password?</button>
      </div> -->
    </div>
  </div>

  <div class="popup-container" id="forgot-popup">
    <div class="forgot popup">
      <form method="POST">
        <h2>
          <span>Lupa Password</span>
          <button type="reset" onclick="popup('forgot-popup')">X</button>
        </h2>
        <input type="email" placeholder="Email" name="email" autocomplete="off" required autofocus>
        <button type="submit" class="reset-btn" name="kirim">Kirim</button>
      </form>
    </div>
  </div>

  <div class="popup-container" id="register-popup">
    <div class="register popup">
      <form method="POST">
        <h2>
          <span>DAFTAR</span>
          <button type="reset" onclick="popup('register-popup')">X</button>
        </h2>
        <input class="form-control" name="foto" type="hidden" value="default.png" />
        <input type="text" autocomplete="off" required placeholder="Nama Lengkap" name="nama" autofocus>
        <input type="text" autocomplete="off" required placeholder="Username" name="username">
        <input type="email" autocomplete="off" required placeholder="Email" name="email">
        <input type="password" autocomplete="off" required placeholder="Password" name="password">
        <input type="password" autocomplete="off" required placeholder="Ulang Password" name="rpw">
        <input type="text" autocomplete="off" required placeholder="Alamat" name="alamat">
        <select required name="kelas">
          <option value="">- Pilih Kelas -</option>
          <option value="X AKL">X AKL</option>
          <option value="XI AKL">XI AKL</option>
          <option value="XII AKL">XII AKL</option>
          <option value="X RPL 1">X RPL 1</option>
          <option value="X RPL 2">X RPL 2</option>
          <option value="X RPL 3">X RPL 3</option>
          <option value="X RPL 4">X RPL 4</option>
          <option value="XI RPL 1">XI RPL 1</option>
          <option value="XI RPL 2">XI RPL 2</option>
          <option value="XI RPL 3">XI RPL 3</option>
          <option value="XI RPL 4">XI RPL 4</option>
          <option value="XII RPL 1">XII RPL 1</option>
          <option value="XII RPL 2">XII RPL 2</option>
          <option value="XII RPL 3">XII RPL 3</option>
          <option value="XII RPL 4">XII RPL 4</option>
          <option value="X TBSM 1">X TBSM 1</option>
          <option value="X TBSM 2">X TBSM 2</option>
          <option value="X TBSM 3">X TBSM 3</option>
          <option value="X TBSM 4">X TBSM 4</option>
          <option value="XI TBSM 1">XI TBSM 1</option>
          <option value="XI TBSM 2">XI TBSM 2</option>
          <option value="XI TBSM 3">XI TBSM 3</option>
          <option value="XI TBSM 4">XI TBSM 4</option>
          <option value="XII TBSM 1">XII TBSM 1</option>
          <option value="XII TBSM 2">XII TBSM 2</option>
          <option value="XII TBSM 3">XII TBSM 3</option>
          <option value="XII TBSM 4">XII TBSM 4</option>
        </select>
        <button type="submit" class="register-btn" name="regist">DAFTAR</button>
      </form>
    </div>
  </div>

  <script>
    function popup(popup_name)
    {
      get_popup=document.getElementById(popup_name);
      if(get_popup.style.display=="flex")
      {
        get_popup.style.display="none";
      }
      else
      {
        get_popup.style.display="flex";
      }
    }

    function forgotPopup(){
      document.getElementById('login-popup').style.display="none";
      document.getElementById('forgot-popup').style.display="flex";
    }
  </script>

  <script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");
    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<!-- <script src="js/sweetalert2.all.min.js"></script> -->
<!-- <script>
  Swal.fire("SweetAlert2 is working!");
</script> -->
<script>
    AOS.init();
    AOS.refresh();
</script>

<!--   <script>
   
   function myMenuFunction() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'flex'
   }
 
  </script> -->

</body>
</html>