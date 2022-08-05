<?php
    session_start();

    // menghilangkan session
    $_SESSION = [];
    session_unset();
    session_destroy();

    echo "<script>alert('Anda Telah Logout'); window.location.href='http://localhost/jwp'</script>";
    exit;
?>
