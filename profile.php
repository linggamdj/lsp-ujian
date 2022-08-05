<?php
    session_start();

    include 'templates/function/functions.php';

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    // assign session npm
    $npm = $_SESSION["npm"];

    // query user by npm
    $user_detail = query("SELECT * FROM user WHERE npm='$npm'")[0];

    // var_dump($user_detail);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>UJ | Profile</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    </main>
        <section class="d-flex justify-content-center text-center mt-4">
            <div class="card" style="width: 16rem;">
                <img class="card-img-top img-thumbnail p-5" src="http://localhost/jwp/templates/img/logo-cat.png" alt="Card image cap">
                <div class="card-body">
                    <p class="card-title text-uppercase"><?= $user_detail["nama"] ?></p>
                    <p class="card-title"><?= $user_detail["npm"] ?></p>
                    <p class="card-title text-uppercase"><?= $user_detail["kelas"] ?></p>
                    <a href="ubah_profile.php" class="btn btn-dark text-white px-4 ml-2 my-2">Edit</a>
                </div>
            </div>
        </section>
    <main>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>

    <?php
        // mengecek apakah data berhasil diubah
        if (isset($_POST["ubah"])) {
            if (ubahProfile($_POST) >= 0) {
                echo "<script>alert('Data berhasil diubah!'); window.location.href='produk.php'</script>";
            } else {
                echo "<script>alert('Data gagal diubah!'); window.location.href='produk.php'</script>";
                exit;
            }
        }
    ?>
</body>
</html>
