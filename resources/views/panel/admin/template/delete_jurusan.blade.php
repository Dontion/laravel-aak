<?php
include 'connection.php';
if (isset($_GET['id_jurusan'])) {
    mysqli_query($conn, "DELETE FROM jurusan WHERE id_jurusan='" . $_GET['id_jurusan'] . "'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('TENG..Teng...Datamu telah terhapus');
                document.location.href='Jurusan.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Upsss...datamu gagal dihapuss');
                document.location.href='Jurusan.php';
            </script>
            ";
    }
}
?>