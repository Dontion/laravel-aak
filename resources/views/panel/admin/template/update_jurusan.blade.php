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
    $id_jurusan = htmlspecialchars($_POST['id_jurusan']);
    $nama_jurusan = htmlspecialchars($_POST['nama_jurusan']);
    $tgl_update = date(Y-M-D);
    $user_update = htmlspecialchars($_POST['user_update']);

    $id_user = htmlspecialchars($_POST['id_user']);
    $query = "UPDATE jurusan SET
            id_jurusan='$id_jurusan',
            nama_jurusan='$nama_jurusan',
            tgl_update='$tgl_update,
            user_update='$user_update'
            WHERE id_jurusan='$id_jurusan' ";

    mysqli_query($conn, $query);

    // var_dump($cek);
    // exit();

    if (mysqli_affected_rows($conn) > 0) {
        echo "
        <script>
            alert('YEAYYYY data telah berhasil');
            document.location.href='Jurusan.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('WADUHHH datanya gagal dibuat guyss');
            document.location.href='update_jurusan.php';
        </script>
        ";
    }
}
$data = mysqli_query($conn, "SELECT *
FROM jurusan
LEFT JOIN user
ON jurusan.id_user = user.id_user LEFT JOIN jenjang ON jurusan.id_jenjang = jenjang.id_jenjang WHERE id_jurusan='" . $_GET['id_jurusan'] . "'");
$edit = mysqli_fetch_assoc($data);
?>
<!-- //  var_dump($edit);
//     exit();
?>    -->

<body id="page-top">

<div class="col-12 grid-margin stretch-card">
<div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update jurusan Form</h4>
                    <p class="card-description"> Update jurusan Form </p>
                    <form class="forms-sample" method="post" action="update_jurusan.php">
                      <div class="form-group">
                        <label for="exampleInputName1">id_jurusan</label>
                        <input type="text" class="form-control" name="id_jurusan" id="id_jurusan" placeholder="id_jurusan" value="<?= $edit['id_jurusan'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Nama jurusan</label>
                        <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" placeholder="nama jurusan"value="<?= $edit['nama_jurusan'] ?>" >
                      </div>

                      <div class="form-group">
                        <label for="exampleInputName1">Jenjang</label>
                        <select class="form-control" name="id_jenjang" id="id_jenjang">
                                <option value="<?= $edit['id_jenjang'] ?>"><?= $edit['nama_jenjang'] ?></option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM jenjang");
                                while ($data = mysqli_fetch_assoc($sql)) { 
                                ?>
                                    <option value="<?= $data['id_jenjang'] ?>"><?= $data['nama_jenjang'] ?></option>
                                
                                <?php
                                }
                                ?>
                          </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">User Input</label>
                        <input type="text" class="form-control" name="user_input" id="user_input" placeholder="user input" value="<?= $edit['user_input'] ?>" >
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Pilih Hak Akses</label>
                        <select class="form-control" id="id_user" name="id_user" value="<?= $edit['id_user']; ?>"  >
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
        var id_jurusan = document.getElementById("id_jurusan").value;
        var nama_jurusan = document.getElementById("nama_jurusan").value;
        var id_jenjang = document.getElementById("id_jenjang").value;
        var tgl_input = document.getElementById("tgl_input").value;
        var user_input = document.getElementById("user_input").value;
        var hakakses = document.getElementById("hak_akses").value;



        if (id_jurusan === "" || id_jurusan === "" || nama_jenjang === "" || tgl_update === "" || hak_akses === "") {
            alert("Please fill in all fields");
            return false;
        }
        return true;
    }
</script>
<?php include "footer.php" ; ?>              