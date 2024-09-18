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
            $_SESSION['password'] = $row['password'];
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
            $_SESSION['password'] = $row['password'];
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['alamat'] = $row['alamat'];
            $_SESSION['email'] = $row['email'];
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
            $_SESSION['password'] = $row['password'];
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['alamat'] = $row['alamat'];
            $_SESSION['email'] = $row['email'];
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
    $role = $_POST['role'];
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

    if(strlen($daftarpw)<4){
      echo "<script>
        alert('Kata Sandi Harus Lebih Dari 4 kata');
        document.location.href = '';
        </script>";
        exit();
    }

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
    $query = mysqli_query($koneksi, "INSERT INTO user (nama_lengkap, username, password, email, role, alamat, foto) VALUES ('$daftarnama','$daftarusn', '$daftarpw', '$daftaremail', '$role', '$alamat', '$foto')");
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
        <!-- <div class="sidebar">
          <a href=""><i class="fa-solid fa-xmark"></i></a>
          <a href="#home">Beranda</a>
          <a href="#about">Tentang</a>
          <a href="#kontak">Kontak</a>
        </div> -->
          <a href="#home" class="link">Beranda</a>
          <a href="#about" class="link">Tentang</a>
          <a href="#kontak" class="link">Kontak</a>
    </nav>
    <div class='sign-in-up'>
      <button type='button' onclick="popup('login-popup')">LOGIN</button>
      <button type='button' onclick="popup('forgot-popup')">Forgot</button>
      <button type='button' onclick="popup('register-popup')">Daftar</button>
    </div>
    <div class="nav-menu-btn hamburger">
        <i class="bx bx-menu" onclick="myMenuFunction()"></i>
    </div>
  </header>



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
    </div>
  </div>

  <div class="popup-container" id="forgot-popup">
    <div class="popup">
      <form method="POST">
        <h2>
          <span>Lupa Password</span>
          <button type="reset" onclick="popup('forgot-popup')">X</button>
        </h2>
        <input type="email" placeholder="Masukkan email yang telah anda daftarkan" name="lpw" autocomplete="off" required autofocus>
        <button type="submit" class="login-btn" name="kirim">Kirim</button>
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
        <select name="role" required>
            <option value="">- Pilih -</option>
            <option value="Petugas">Petugas</option>
            <option value="Peminjam">Peminjam</option>
        </select>
        <input type="password" autocomplete="off" required placeholder="Password" name="password">
        <input type="password" autocomplete="off" required placeholder="Ulang Password" name="rpw">
        <input type="text" autocomplete="off" required placeholder="Alamat" name="alamat">
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