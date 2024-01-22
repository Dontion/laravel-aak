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
    $tgl_update = date(Y-m-d);
    $user_update = htmlspecialchars($_POST['user_update']);
    $query = "UPDATE jenjang SET
            id_jenjang='$id_jenjang',
            nama_jenjang='$nama_jenjang',
            tgl_update='$tgl_update',
            user_update='$user_update'
            WHERE id_jenjang='$id_jenjang' ";

    mysqli_query($conn, $query);

    // var_dump($cek);
    // exit();

    if (mysqli_affected_rows($conn) > 0) {
        echo "
        <script>
            alert('YEAYYYY data telah berhasil');
            document.location.href='Jenjang.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('WADUHHH datanya gagal dibuat guyss');
            document.location.href='update_jenjang.php';
        </script>
        ";
    }
}
$data = mysqli_query($conn, "SELECT *
 FROM jenjang WHERE id_jenjang='" . $_GET['id_jenjang'] . "'");
 $edit = mysqli_fetch_assoc($data);
//  var_dump($edit);
//     exit();
?>   

<body id="page-top">

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Jenjang Form</h4>
                    <p class="card-description">Update  Jenjang Form </p>
                    <form class="forms-sample" method="post" action="update_jenjang.php">
                      <div class="form-group">
                        <label for="exampleupdateName1">id_jenjang</label>
                        <input type="text" class="form-control" name="id_jenjang" id="id_jenjang" value="<?= $edit['id_jenjang'] ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="exampleupdateEmail3">Nama Jenjang</label>
                        <input type="text" class="form-control" name="nama_jenjang" id="nama_jenjang" placeholder="nama_jenjang" value="<?= $edit['nama_jenjang']; ?>" >
                      </div>
                      <div class="form-group">
                        <label for="exampleupdatetgl_update4">Tanggal update</label>
                        <input type="date" class="form-control" id="tgl_update" name="tgl_update" placeholder="tanggal update" value="<?= $edit['tgl_update']; ?>" >
                      </div>
                      <div class="form-group">
                        <label for="exampleupdateName5">User update</label>
                        <input type="text" class="form-control" name="user_update" id="user_update" placeholder="user update" value="<?= $edit['user_update']; ?>" >
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
        var tgl_update = document.getElementById("tgl_update").value;
        var user_update = document.getElementById("user_update").value;
        var hakakses = document.getElementById("hak_akses").value;

        if (id_jenjang === "" || id_jenjang === "" || nama_jenjang === "" || tgl_update === "" || hak_akses === "") {
            alert("Please fill in all fields");
            return false;
        }
        return true;
    }
</script>
<?php include "footer.php" ; ?>              