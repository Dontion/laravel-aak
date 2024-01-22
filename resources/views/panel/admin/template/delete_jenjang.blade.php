<?php
include 'connection.php';
if (isset($_GET['id_jenjang'])) {
    mysqli_query($conn, "DELETE FROM jenjang WHERE id_jenjang='" . $_GET['id_jenjang'] . "'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('TENG..Teng...Datamu telah terhapus');
                document.location.href='Jenjang.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Upsss...datamu gagal dihapuss');
                document.location.href='Jenjang.php';
            </script>
            ";
    }
}
?>