<?php include "header.php" ?>


<body id="page-top">
    <div class="container">
        <br><br><br><br><br>
        <a class="btn btn-warning btn-sm" type="button" href="form_jurusan.php"><i class="mdi mdi-border-color"></i> Tambahkan Data</a> 
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jurusan</th>
                <th>Tanggal Input</th>
                <th>User Input</th>
                <th>Tanggal Update</th>
                <th>User Update</th>
                <th>Akses</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
                            include 'connection.php';
                            $no = 1;
                            $query = "SELECT id_jurusan, CONCAT(jenjang.nama_jenjang,' ',jurusan.nama_jurusan) as kelas, jurusan.user_input,jurusan.tgl_input,jurusan.tgl_update,jurusan.user_update,CONCAT(user.hak_akses,' (',user.nama,')') as akses
                                      FROM jurusan
                                      LEFT JOIN jenjang
                                      ON jurusan.id_jenjang = jenjang.id_jenjang LEFT JOIN user ON jurusan.id_user = user.id_user";
                                      $sql = mysqli_query($conn, $query);
                                      while ($data = mysqli_fetch_assoc($sql)) { 
                                          ?> <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['kelas']; ?></td>*/-
            <td><?= $data['tgl_input']; ?></td>
            <td><?= $data['user_input']; ?></td>
            <td><?= $data['tgl_update']; ?></td>
            <td><?= $data['user_update']; ?></td>
            <td><?= $data['akses']; ?> </td>
            <!--update button-->
            <td align="center"><a class="btn btn-warning btn-sm" type="button" href="update_jurusan.php?id_jurusan=<?= $data['id_jurusan']; ?>"><i class="mdi mdi-border-color"></i></a></td>
            <!-- delete button-->
            <td align="center"><a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Yakin dihapus nihhh?')" href="delete_jurusan.php?id_jurusan=<?= $data['id_jurusan']; ?>"> 
            <i class="mdi mdi-close-circle-outline"></i></a></td>
        </tr>
    <?php
    }
?>
        </tbody>
    </table><br><br><br>
    </div>
    <!-- script -->
    <script>
        $(document).ready(function(){
        new DataTable('#example');
    })
    </script>

    <script src="assets/js/js_datatb_1.js"></script>
    <script src="assets/js/js_datatb_3.js"></script>