<?php
include 'header.php';
include 'connection.php';


if (isset($_POST['simpan'])) {
    $username = strtolower(stripslashes($_POST['username']));
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $akses = htmlspecialchars($_POST['hak_akses']);
    $id_user = $_POST['id_user'];

    // Check if a new password was provided
    if (!empty($_POST['password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

        // Check password confirmation
        if ($password !== $password2) {
            echo "
            <script>
                alert('Konfirmasi Password Salah');
                document.location.href='update_data.php';
            </script>
            ";
            return false;
        }

        // Hash the new password
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE user SET
                id_user='$id_user',
                username='$username',
                `password` ='$password',
                nama='$nama',
                email='$email',
                hak_akses='$akses'
                WHERE id_user='$id_user'
                ";
    } else {
        // If no new password was provided, update without changing the password
        $query = "UPDATE user SET
                id_user='$id_user',
                username='$username',
                nama='$nama',
                email='$email',
                hak_akses='$akses'
                WHERE id_user='$id_user'
                ";
    }

    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Yeeeeayy.....Berhasil update');
                document.location.href='data_Pendaftar.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('YAhhh.....Gagal update');
                document.location.href='update_data.php';
            </script>
            ";
    }
}

$data = mysqli_query($conn, "SELECT *
FROM user WHERE id_user='" . $_GET['id_user'] . "'");
$edit = mysqli_fetch_assoc($data);
?>

<body id="page-top">


<br><br><br><br>
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update</h4>
                    <p class="card-description">  update </p>
                    <form class="forms-sample" method="post" s>
                      <div class="form-group">
                        <input type="hidden" name="id_user" id="id_user" value="<?= $edit['id_user']; ?>">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?= $edit['username']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $edit['email']; ?>"required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" id="password" name="password"  required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Re-Password</label>
                        <input type="password" class="form-control" id="password2"  name="password2"  required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName5">Name account</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $edit['nama']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Pilih Hak Akses</label>
                        <select class="form-control" id="hakakses" name="akses" value="<?= $edit['akses']; ?>" required>
                          <option value="operator">Operator</option>
                          <option value="admin">Admin</option>
                        </select>
                      
                      <button type="submit" name="simpan" class="btn btn-primary mr-2">update</button>
                      <button class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>


<script>
    function validateForm() {
        var nama = document.getElementById("nama").value;
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("Password").value;
        var repeatPassword = document.getElementById("RepeatPassword").value;
        var hakakses = document.getElementById("hakakses").value;

        if (nama === "" || username === "" || email === "" || password === "" || repeatPassword === "" || hakakses === "") {
            alert("Please fill in all fields");
            return false;
        }
        return true;
    }
</script>
<?php include "footer.php" ; ?>              