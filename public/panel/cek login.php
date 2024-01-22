<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cek login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #007bff;
        }
        center {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['email'])) {
        echo '<script>window.location.replace("./index.php");</script>';
    } else {
        $email = "admin@email.com";
        $password = "123456";
        if(isset($_POST['email']) && isset($_POST['password'])) {
            if($_POST['email'] == $email && $_POST['password'] == $password) {
                session_start();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                echo '<meta http-equiv="refresh" content="2; url=./index.php"/>';
                echo "<center><h1>Berhasil, dalam 2 detik kamu akan dialihkan ke halaman utama</h1></center>";
            } elseif($_POST['email'] != $email && $_POST['password'] == $password) {
                echo "<center><h1>Gagal!, Email Salah</h1></center>";
            } elseif($_POST['email'] == $email && $_POST['password'] != $password) {
                echo "<center><h1>Gagal!, Password Salah</h1></center>";
            } elseif($_POST['email'] != $email && $_POST['password'] != $password) {
                echo "<center><h1>Gagal!, Email & Password Salah</h1></center>";
            } 
        } else {
            echo "<center><h1>Gagal!, jangan biarkan email & password kosong</h1></center>";
        }
    }
    ?>
</body>
</html>
