<?php
    include '../../templates/function/functions.php';

    $id = $_GET["id"];

    if (hapusPendaftar($id) > 0) {
        echo "
        <script>
            alert('Data berhasil dihapus!');
            window.location.href='pendaftar.php'
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal dihapus!');
            window.location.href='pendaftar.php'
        </script>
        ";
    }
?>