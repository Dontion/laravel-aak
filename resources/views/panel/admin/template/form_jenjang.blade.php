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
    $id_jenjang = htmlspecialchars($_POST['id_jenjang']);
    $nama_jenjang = htmlspecialchars($_POST['nama_jenjang']);
    $tgl_input = htmlspecialchars($_POST['tgl_input']);
    $user_input = htmlspecialchars($_POST['user_input']);

    //cek id sudah terdaftar belum
    $result = mysqli_query($conn, "SELECT id_jenjang FROM jenjang WHERE id_jenjang = '$id_jenjang'");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('ID sudah terdaftar, silahkan gantiiii!');
            document.location.href='form_jenjang.php';
        </script>
        ";
        return false;
    }

    mysqli_query($conn, "INSERT INTO jenjang VALUES('$id_jenjang','$nama_jenjang','$tgl_input','$user_input','','')");

    // var_dump($cek);
    // exit();

    if (mysqli_affected_rows($conn) > 0) {
        echo "
        <script>
            alert('YEEAYYY...Data jenjang Berhasil dibuat');
            document.location.href='Jenjang.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('WADUHHHH.... Data jenjang Gagal dibuat');
            document.location.href='form_jenjang.php';
        </script>
        ";
    }
}
?>
<body id="page-top">

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Jenjang Form</h4>
                    <p class="card-description">  Jenjang Form </p>
                    <form class="forms-sample" method="post" action="form_jenjang.php">
                      <div class="form-group">
                        <label for="exampleInputName1">id_jenjang</label>
                        <input type="text" class="form-control" name="id_jenjang" id="id_jenjang" placeholder="id_jenjang" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Nama jenjang</label>
                        <input type="text" class="form-control" name="nama_jenjang" id="nama_jenjang" placeholder="nama jenjang" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputtgl_input4">Tanggal input</label>
                        <input type="date" class="form-control" id="tgl_input" name="tgl_input" placeholder="tanggal input" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName5">User Input</label>
                        <input type="text" class="form-control" name="user_input" id="user_input" placeholder="user input" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Pilih Hak Akses</label>
                        <select class="form-control" id="id_user" name="id_user"  required>
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
        var id_jenjang = document.getElementById("id_jenjang").value;
        var nama_jenjang = document.getElementById("nama_jenjang").value;
        var tgl_input = document.getElementById("tgl_input").value;
        var user_input = document.getElementById("user_input").value;
        var hakakses = document.getElementById("hak_akses").value;

        if (id_jenjang === "" || id_jenjang === "" || nama_jenjang === "" || tgl_input === "" |) {
            alert("Please fill in all fields");
            return false;
        }
        return true;
    }
</script>
<?php include "footer.php" ; ?>              