<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['email']);
unset($_SESSION['id_user']);
unset($_SESSION['nama_lengkap']);
unset($_SESSION['alamat']);
unset($_SESSION['role']);

session_destroy();
echo "<script>
alert('Kamu telah logout.');
document.location.href = 'login';
</script>";
?>