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
    $id_negara = htmlspecialchars($_POST['id_negara']);
    $nama_negara = htmlspecialchars($_POST['nama_negara']);
    $tgl_input = htmlspecialchars($_POST['tgl_input']);
    $user_input = htmlspecialchars($_POST['user_input']);
    $id_user = htmlspecialchars($_POST['id_user']);
    $query = "UPDATE kewarganegaraan SET
            id_negara='$id_negara',
            nama_negara='$nama_negara',
            tgl_update='$tgl_update',
            user_update='$user_update',
            id_user='$id_user'
            WHERE id_negara='$id_negara'
            ";

    mysqli_query($conn, $query);

    // var_dump($cek);
    // exit();

    if (mysqli_affected_rows($conn) > 0) {
        echo "
        <script>
            alert('YEAYYYY data telah berhasil');
            document.location.href='Kewarganegaraan.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('WADUHHH datanya gagal dibuat guyss');
            document.location.href='update_negara.php';
        </script>
        ";
    }
}
 $data = mysqli_query($conn, "SELECT *
 FROM kewarganegaraan
 LEFT JOIN user
 ON kewarganegaraan.id_user = user.id_user WHERE id_negara='" . $_GET['id_negara'] . "'");
 $edit = mysqli_fetch_assoc($data);
?>   

<body id="page-top">

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Negara Form</h4>
                    <p class="card-description">Update  Negara Form </p>
                    <form class="forms-sample" method="post" action="update_negara.php">
                      <div class="form-group">
                        <label for="exampleInputName1">id_negara</label>
                        <input type="text" class="form-control" name="id_negara" id="id_negara" placeholder="id_negara" value="<?= $edit['id_negara'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Nama Negara</label>
                        <input type="text" class="form-control" name="nama_negara" id="nama_negara" placeholder="nama negara" value="<?= $edit['nama_negara']; ?>" required>
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
        var id_negara = document.getElementById("id_negara").value;
        var nama_negara = document.getElementById("nama_negara").value;
        var tgl_input = document.getElementById("tgl_input").value;
        var user_input = document.getElementById("user_input").value;
        var hakakses = document.getElementById("hak_akses").value;

        if (id_negara === "" || id_negara === "" || nama_negara === "" || tgl_input === "" || hak_akses === "") {
            alert("Please fill in all fields");
            return false;
        }
        return true;
    }
</script>
<?php include "footer.php" ; ?>              