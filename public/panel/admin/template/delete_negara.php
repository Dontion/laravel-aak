<?php
include 'connection.php';
if (isset($_GET['id_negara'])) {
    mysqli_query($conn, "DELETE FROM kewarganegaraan WHERE id_negara='" . $_GET['id_negara'] . "'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('TENG..Teng...Datamu telah terhapus');
                document.location.href='Kewarganegaraan.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Upsss...datamu gagal dihapuss');
                document.location.href='Kewarganegaraan.php';
            </script>
            ";
    }
}
?>