<?php
    session_start();

    include '../templates/function/functions.php';

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    // assign session npm
    $npm = $_SESSION["npm"];

    // query user id by npm
    $query = query("SELECT id FROM user WHERE npm='$npm'")[0];
    $userId = $query['id'];

    $daftarKursus = query("SELECT kursus.nama_kursus, kursus.waktu_kursus, daftar.upload, daftar.verifikasi
                            FROM kursus
                            INNER JOIN daftar ON kursus.id = daftar.id_kursus
                            WHERE daftar.id_user = $userId");
    // var_dump($daftarKursus);

    if ( isset($_POST["cari"]) ) {
        $daftarKursus = cariKursusMahasiswa($_POST["keyword"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/css/style.css?v=1.0" rel="stylesheet" type="text/css">

    <?php include '../templates/pages/style.php'; ?>

    <title>UJ | Kursus Anda</title>
</head>
<body>
    <?php include '../templates/pages/navbar.php'; ?>

    <?php if ( $_SESSION["role"] == "USER" ) { ?>
    <main>
        <div class="product-title text-center my-5">
            <h2 class="text-black">
                Daftar Kursus yang Anda Ikuti
            </h2>
        </div>
        <table class="table table-bordered bg-white w-75 mx-auto mt-3 mb-5">
            <form action="" method="post">
                <div class="input-group rounded w-50 mx-auto">
                    <input type="search" name="keyword" class="form-control rounded" placeholder="contoh: nama kursus, verifikasi" aria-label="Search" aria-describedby="search-addon" />
                    <button class="btn btn-dark text-white px-4 ml-2" name="cari" type="submit" href="#">Cari</button>
                    <a class="btn btn-dark text-white ml-2" href="http://localhost/jwp/">Ikuti Kursus Lainnya</a>
                </div>
            </form>
            
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Kursus</th>
                    <th scope="col">Waktu Kursus</th>
                    <th scope="col">KRS</th>
                    <th scope="col">Status Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($daftarKursus as $data) : ?>
                <tr>
                    <td class="font-weight-bold"scope="row"><?= $i; ?></td> 
                    <td><?= $data["nama_kursus"] ?></td>
                    <td><?= date("l, d M Y", strtotime($data["waktu_kursus"])) ?></td>
                    <td class="text-center"><a href="http://localhost/jwp/templates/uploads/<?= $data["upload"] ?>" class="btn btn-dark text-white ml-2" target="_blank">Lihat KRS</a></td>
                    <td> <?= $data["verifikasi"] ?> Terverifikasi</td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php } else { ?>
        <script>window.location.href='http://localhost/jwp/'</script>";
    <?php } ?>
    
    <?php include '../templates/pages/footer.php'; ?>

    <?php include '../templates/jquery/jquery.php'; ?>
</body>
</html>
