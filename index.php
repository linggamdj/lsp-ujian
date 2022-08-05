<?php
    session_start();

    include 'templates/function/functions.php';

    $kursus = query("SELECT * FROM kursus");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>Selamat Datang di Universitas Jewepe</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    <header class="navbar-home text-center">
        <h1>SELAMAT DATANG DI<br>WEBSITE PENDAFTARAN KURSUS</h1>
    </header>

    </main>
        <section class="section-title">
            <div class="product-title">
                <h2 class="py-5">
                    Daftar Kursus
                </h2>
            </div>
        </section>
        
        <section class="section-product">
            <div class="container">
                <div class="row justify-content-center">
                    <?php foreach($kursus as $data) : ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 mx-4 mb-4">
                            <div class="d-flex flex-column text-left mx-auto">
                                <div class="card card-product mx-auto" style="width: 17rem;">
                                    <img class="card-image bg-white p-4" src="templates/img/kursus.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $data["nama_kursus"] ?></h5>
                                        <p class="card-text"><?= $data["deskripsi"] ?></p>
                                        <p class="card-text text-bold"><?= date("l, d M Y", strtotime($data["waktu_kursus"])) ?></p>
                                        <?php if ( isset($_SESSION["login"]) ) { ?>
                                            <a class="btn btn-info text-white mx-auto" href="http://localhost/jwp/mahasiswa/daftar.php?id=<?= $data["id"] ?>">Ikut Kursus</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <main>
    
    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>
</body>
</html>
