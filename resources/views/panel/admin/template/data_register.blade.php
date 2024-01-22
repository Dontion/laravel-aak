<?php include "header.php" ?>


<body id="page-top">
    <div class="container">
        <br><br><br><br><br>
        <a class="btn btn-warning btn-sm" type="button" href="register.php"><i class="mdi mdi-border-color"></i> Tambahkan Data</a>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Akses</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include 'connection.php';
            $no = 1;
            $query = "SELECT *
            FROM user ";
            $sql = mysqli_query($conn, $query);
            while ($data = mysqli_fetch_assoc($sql)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['username']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['email']; ?></td>
            <td><?= $data['hak_akses']; ?></td>
            <!--update button-->
            <td align="center"><a class="btn btn-warning btn-sm" type="button" href="update_data.php?id_user=<?= $data['id_user']; ?>"><i class="mdi mdi-border-color"></i></a></td>
            <!-- delete button-->
            <td align="center"><a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Data akan di Hapus?')" href="delete_user.php?id_user=<?= $data['id_user']; ?>"> 
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