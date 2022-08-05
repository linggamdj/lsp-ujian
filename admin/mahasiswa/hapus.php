<?php
    include '../../templates/function/functions.php';

    $id = $_GET["id"];

    if (hapusMahasiswa($id) > 0) {
        echo "
        <script>
            alert('Data berhasil dihapus!');
            window.location.href='http://localhost/jwp/admin/mahasiswa/mahasiswa.php'
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal dihapus!');
            window.location.href='http://localhost/jwp/admin/mahasiswa/mahasiswa.php'
        </script>
        ";
    }
?>