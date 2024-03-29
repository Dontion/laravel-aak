<?php
session_start();
include '/admin/template/connection.php';

// Check if user is already logged in using session
if (isset($_SESSION["login"])) {
  header("Location: /admin/template/index.php");
  exit;
}

// Check if cookie exists and try to log in with cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  $stmt = mysqli_prepare($conn, "SELECT username FROM user WHERE id_user = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  if ($row && $key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
    header("Location: /admin/template/index.php");
    exit;
  }
}

// Attempt to log in with submitted form
if (isset($_POST['Login'])) {
  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);

  $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_user'] = $row['id_user'];
      $_SESSION['username'] = $username;
      $_SESSION['hak_akses'] = $row['hak_akses'];
      $_SESSION['login'] = true;

      if (isset($_POST['remember'])) {
        $secure_key = hash('sha256', $row['username']);
        setcookie('id', $row['id_user'], time() + 60, "/", null, true, true);
        setcookie('key', $secure_key, time() + 60, "/", null, true, true);
      }

      header("Location: /admin/template/index.php");
      exit;
    } else {
      echo "
      <script>
          alert('Password Salah!');
          window.location.href = '/loginn.php';
      </script>
      ";
    }
  } else {
    echo "
    <script>
        alert('Username Tidak Ditemukan!');
        window.location.href = '/loginn.php';
    </script>
    ";
  }
  mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgb(255,255,255);
  background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(239,253,29,1) 32%, rgba(252,176,69,1) 70%, rgba(244,71,44,1) 100%);
            
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            font-size: 60px;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #121212;
            color: #ffff00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <center>
        </center><br>
        <img src="luffy.png" width= "300px" height="250px">
        <input type="text" name="username" placeholder="Username" alt="username" required="required"><br>
        <input type="password" name="password" placeholder="Password" alt="password" required="required"><br><br>
        <input type="submit" name="Login" value="Login" alt="submit">
        
    </form>
</body>
</html>