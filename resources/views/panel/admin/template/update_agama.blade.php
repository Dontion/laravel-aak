<?php 
include "header.php" ; 
include "connection.php" ;

if ($_SESSION['hak_akses'] != 'admin') {
    echo "
    <script>
        alert('Tidak Memiliki Akses, DILARANG MASUK!');
        document.location.href='index.php';
    </script>
    ";
}

if (isset($_POST['simpan'])) {
    $id_agama = htmlspecialchars($_POST['id_agama']);
    $nama_agama = htmlspecialchars($_POST['nama_agama']);
    $tgl_input = htmlspecialchars($_POST['tgl_input']);
    $user_input = htmlspecialchars($_POST['user_input']);
    $id_user = htmlspecialchars($_POST['id_user']);
    $query = "UPDATE agama SET
            id_agama='$id_agama',
            nama_agama='$nama_agama',
            tgl_update='$tgl_update',
            user_update='$user_update',
            id_user='$id_user'
            WHERE id_agama='$id_agama'
            ";

    mysqli_query($conn, $query);

    // var_dump($cek);
    // exit();

    if (mysqli_affected_rows($conn) > 0) {
        echo "
        <script>
            alert('YEAYYYY data telah berhasil');
            document.location.href='Agama.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('WADUHHH datanya gagal dibuat guyss');
            document.location.href='update_agama.php';
        </script>
        ";
    }
}
 $data = mysqli_query($conn, "SELECT *
 FROM agama
 LEFT JOIN user
 ON agama.id_user = user.id_user WHERE id_agama='" . $_GET['id_agama'] . "'");
 $edit = mysqli_fetch_assoc($data);
?>   

<body id="page-top">

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Agama Form</h4>
                    <p class="card-description">Update  Agama Form </p>
                    <form class="forms-sample" method="post" action="update_agama.php">
                      <div class="form-group">
                        <label for="exampleInputName1">id_agama</label>
                        <input type="text" class="form-control" name="id_agama" id="id_agama" placeholder="id_agama" value="<?= $edit['id_agama'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Nama Agama</label>
                        <input type="text" class="form-control" name="nama_agama" id="nama_agama" placeholder="nama agama" value="<?= $edit['nama_agama']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputtgl_input4">Tanggal input</label>
                        <input type="date" class="form-control" id="tgl_input" name="tgl_input" placeholder="tanggal input" value="<?= $edit['tgl_input']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName5">User Input</label>
                        <input type="text" class="form-control" name="user_input" id="user_input" placeholder="user input" value="<?= $edit['user_input']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Pilih Hak Akses</label>
                        <select class="form-control" id="id_user" name="id_user" value="<?= $edit['id_user']; ?>" required>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM user WHERE hak_akses = '$status' AND id_user='$_SESSION[id_user];'");
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <option value="<?= $data['id_user'] ?>"><?= $data['hak_akses'] ?> (<?= $data['nama'] ?>)</option>
                                    <?php
                                    }
                                    ?>
                        </select>
                                  </div>
                      <button type="submit" name="simpan" class="btn btn-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-dark">Reset</button>
                    </form>
                  </div>
                </div>
              </div>


<script>
    function validateForm() {
        var id_agama = document.getElementById("id_agama").value;
        var nama_agama = document.getElementById("nama_agama").value;
        var tgl_input = document.getElementById("tgl_input").value;
        var user_input = document.getElementById("user_input").value;
        var hakakses = document.getElementById("hak_akses").value;

        if (id_agama === "" || id_agama === "" || nama_agama === "" || tgl_input === "" || hak_akses === "") {
            alert("Please fill in all fields");
            return false;
        }
        return true;
    }
</script>
<?php include "footer.php" ; ?>              