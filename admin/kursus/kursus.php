<?php
    session_start();

    include '../../templates/function/functions.php';

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    $kursus = query("SELECT * FROM kursus");

    if ( isset($_POST["cari"]) ) {
        $kursus = cariKursus($_POST["keyword"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../templates/pages/style.php'; ?>

    <title>UJ Admin | Produk</title>
</head>
<body>
    <?php include '../../templates/pages/navbar.php'; ?>

    <?php if ( isset($_SESSION["role"]) == "ADMIN" ) { ?>
    <main>
        <div class="product-title text-center my-5">
            <h2 class="text-black">
                DAFTAR PRODUK
            </h2>
        </div>
        <table class="table table-bordered bg-white w-75 mx-auto mt-3 mb-5">
            <form action="" method="post">
                <div class="input-group rounded w-50 mx-auto">
                    <input type="search" name="keyword" class="form-control rounded" placeholder="contoh: ori, tuna, harga" aria-label="Search" aria-describedby="search-addon" />
                    <button class="btn btn-dark text-white px-4 ml-2" name="cari" type="submit" href="#">Cari</button>
                    <a class="btn btn-dark text-white ml-2" href="tambah.php">Tambah Produk</a>
                </div>
            </form>
            
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Kursus</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Waktu Kursus</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($kursus as $data) : ?>
                <tr>
                    <td class="font-weight-bold"scope="row"><?= $i; ?></td> 
                    <td><?= $data["nama_kursus"] ?></td>
                    <td> <?= $data["deskripsi"] ?></td>
                    <td><?= date("l, d M Y", strtotime($data["waktu_kursus"])) ?></td>
                    <td class="action-button text-uppercase text-bold">
                        <a href="ubah.php?id=<?= $data["id"] ?>">edit</a> | 
                        <a href="hapus.php?id=<?= $data["id"] ?>" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?');">delete</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <?php } else { ?>
        <script>window.location.href='index.php'</script>";
    <?php } ?>
    
    <?php include '../../templates/pages/footer.php'; ?>

    <?php include '../../templates/jquery/jquery.php'; ?>
</body>
</html>
