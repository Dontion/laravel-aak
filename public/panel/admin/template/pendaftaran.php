<?php  include "header.php";
include "connection.php";
?>
  
<?php

    if (isset($_POST['simpan'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $nama_siswa = htmlspecialchars($_POST['nama_siswa']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $jk = htmlspecialchars($_POST['jk']);
    $tmp_lahir = htmlspecialchars($_POST['tmp_lahir']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $status = htmlspecialchars($_POST['status']);
    $negara = htmlspecialchars($_POST['negara']);
    $agama = htmlspecialchars($_POST['agama']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $tgl_input = htmlspecialchars($_POST['tgl_input']);
    $user_input = htmlspecialchars($_POST['user_input']);
    $id_user = htmlspecialchars($_POST['id_user']);

    // Check if ID is already registered
    $result = mysqli_query($conn, "SELECT nis FROM pendaftaran WHERE nis = '$nis'");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('ID sudah terdaftar, silahkan ganti!');
            document.location.href='form_pendaftaran.php';
        </script>
        ";
        return false;
    }

    mysqli_query($conn, "INSERT INTO pendaftaran VALUES('$nis','$nama_siswa','$alamat','$jk','$tmp_lahir','$tgl_lahir','$status','$negara','$agama','$kelas','$tgl_input','$user_input','','','$id_user')");

    if (mysqli_affected_rows($conn) > 0) {
        echo "
        <script>
            alert('Data Pendaftaran Berhasil dibuat');
            document.location.href='data_pendaftaran.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Pendaftaran Gagal dibuat');
            document.location.href='pendaftaran.php';
        </script>
        ";
    }
}
?>

<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Pendaftaran Form</h4>
                    <p class="card-description">  Pendaftaran Form </p>
                    <form class="forms-sample" method="post" action="pendaftaran.php">
                      <div class="form-group">
                        <label for="nis1">NIS</label>
                        <input type="text" class="form-control" name="nis" id="nis" placeholder="NIS" required>
                      </div>
                      <div class="form-group">
                        <label for="namasiswa3">Nama Siswa</label>
                        <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa" required>
                      </div>
                      <div class="form-group">
                        <label for="alamatd4">Alamat</label>
                        <input type="textarea" class="form-control" id="alamat" name="alamat" placeholder="alamat" required>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Jenis Kelamin  :</label>      
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="jk1" name="jk" value="laki-laki">
                          <label class="custom-control-label" for="jk1">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" id="jk2" name="jk" value="perempuan" checked>
                          <label class="custom-control-label" for="jk2">perempuan</label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Name5">Name account</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="input ur acc name" required>
                      </div>
                    
                            <div class="form-group">
                                <label for="name6">Tempat Lahir</label> 
                                <input type="text" class="form-control form-control-user" id="tmp_lahir" name="tmp_lahir" placeholder="Tempat Lahir" required>
                            </div>
                            <div class="form-group">
                                <label for="Name7">Tanggal Lahir</label> 
                                <input type="date" class="form-control form-control-user" id="tgl_lahir" name="tgl_lahir" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Pilih Status</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Pindahan">Pindahan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Negara</label>
                                <select class="form-control" name="negara" id="negara">
                                    <option value="">Pilih Negara</option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM kewarganegaraan");
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <option value="<?= $data['id_negara'] ?>"><?= $data['nama_negara'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <select class="form-control" name="agama" id="agama">
                                    <option value="">Pilih Agama</option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM agama");
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <option value="<?= $data['id_agama'] ?>"><?= $data['nama_agama'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control" name="kelas" id="kelas">
                                    <option value="">Pilih Kelas</option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT jurusan.id_jurusan, CONCAT(jenjang.nama_jenjang,' ',jurusan.nama_jurusan) AS kelas FROM jurusan INNER JOIN jenjang ON jurusan.id_jenjang = jenjang.id_jenjang");
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <option value="<?= $data['id_jurusan'] ?>"><?= $data['kelas'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Tanggal Input</label>
                                <input type="date" class="form-control form-control-user" id="tgl_input" name="tgl_input" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">User Input</label>
                                <input type="text" class="form-control form-control-user" id="user_input" name="user_input" placeholder="User Input" required>
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
        </div>
    </div>
</div>
<!-- /page content -->


<?php include "footer.php" ; ?>