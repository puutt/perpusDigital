<?php 
session_start(); 
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');


// if (!isset($_SESSION['username'])) {
//     header("Location: login");
//     exit;
// }

if (isset($_SESSION['login'])) {
    $role = $_SESSION['role'];

    if ($role != 'Peminjam'){
        header("Location: login");
        exit;

    }
} else {
    header("Location: login");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Perpustakaan Digital</title>
    <link rel="icon" type="image/png" href="img/logo-inovasi.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .buku:hover {
            transform: scale(1.05);
            transition: 0.2s;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

/*        .section{
            padding: 25px 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .container:after{
            content: '';
            display: block;
            clear: both;
        }

        .box {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 15px;
            box-sizing: border-box;;
            margin: 10px 0 25px 0;
        }

        .col-5 {
            width: 20%;
            height: 100px;
            border: 1px solid;
            }*/
/*            nav {
              display: flex;
              background-color: white;
              justify-content: space-around;
              padding: 20px 0;
          }

          nav ul {
              display: flex;
              list-style: none;
              width: 40%;
              justify-content: space-between;
          }*/

          .checked {
            color: orange;
          }
      </style>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">
      <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  </head>