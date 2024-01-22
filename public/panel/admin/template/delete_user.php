<?php 
    include "connection.php" ;
    $query = mysqli_query($conn, "DELETE FROM user WHERE id_user='" . $_GET['id_user'] . "'");

    if (mysqli_affected_rows($conn) > 0) {
        echo    "
                <script>
                    alert('Data  Sudah Terhapus Gan');
                    document.location.href='data_pendaftar.php';
                </script>
                ";
    } else {
        echo    "
                <script>
                    alert('Data Gagal Terhapus Gan');
                    document.location.href='data_pendaftar.php';
                </script>
                ";
    }

    