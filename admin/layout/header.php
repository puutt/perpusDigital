<?php 
session_start(); 
include '../koneksi.php';
error_reporting(0);

if (isset($_SESSION['login'])) {
    $role = $_SESSION['role'];

    if ($role == 'Peminjam'){
        header("Location: ../login");
        exit;

    }
} else {
    header("Location: ../login");
    exit;
}

// if (!$_SESSION['role'] == 'Admin') {
//     echo "<script>
//     alert('Anda tidak memiliki akses untuk pergi ke halaman ini.');
//     document.location.href = '../petugas/';
//     </script>";
//     exit();
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $_SESSION['role'] ?> - PerpusDigital</title>
    <link rel="icon" type="image/png" href="../img/logo-inovasi.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" type="text/css" />
    <!-- <link href='../css/sweetalert2.min.css' rel='stylesheet'> -->
    <style>
        .buku:hover {
            transform: scale(1.05);
            transition: 0.2s;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

        .body-card {
            width: 85%;
            height: 100px;
            padding: 10px;
        }

        .body-card p {
            font-size: 35px;
            color: white;
            font-weight: bold;
            line-height: 30px;
            padding-left: 10px;
            margin-top: 10px;
            display: inline-block;
        }

        .body-card span {
            font-size: 20px;
            font-weight: 400;
        }

        .box-icon {
            float: right;
            font-size: 40px!important;
            margin-top: 20px!important;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>