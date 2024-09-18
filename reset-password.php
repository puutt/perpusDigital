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

  <div class="popup-container" id="reset-pw-popup">
    <div class="reset popup">
      <form method="POST">
        <h2>
          <span>Reset Password</span>
        </h2>
        <input type="email" placeholder="Password Baru" name="email" autocomplete="off" required autofocus>
        <button type="submit" class="reset-link" name="kirim">Kirim</button>
      </form>
    </div>
  </div>

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

<!--   <script>
   
   function myMenuFunction() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'flex'
   }
 
  </script> -->

</body>
</html>