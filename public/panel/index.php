<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<body>
    <img src="../asset/panel/img/luff(1).jpg">
    <?php
session_start();
if(isset($_SESSION['email'])) {
 
// ----------------------------------CONTENT HERE---------------------------------- //
    echo '<center><h1>Selamat Datang ;)</h1><br/><a href="./logout.php">Logout</a>';
// ----------------------------------CONTENT HERE---------------------------------- //

} else {
    echo '<script>window.location.replace("./login.php");</script>';
}
?>
</body>
</html>