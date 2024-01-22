<?php
include 'connection.php';
if (isset($_GET['id_agama'])) {
    mysqli_query($conn, "DELETE FROM agama WHERE id_agama='" . $_GET['id_agama'] . "'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('TENG..Teng...Datamu telah terhapus');
                document.location.href='Agama.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Upsss...datamu gagal dihapuss');
                document.location.href='Agama.php';
            </script>
            ";
    }
}
?>