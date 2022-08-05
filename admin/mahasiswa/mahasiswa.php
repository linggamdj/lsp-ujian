<?php
    session_start();

    include '../../templates/function/functions.php';

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    $mahasiswa = query("SELECT * FROM user WHERE role='USER'");

    if ( isset($_POST["cari"]) ) {
        $mahasiswa = cariMahasiswa($_POST["keyword"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../templates/css/style.css?v=1.0" rel="stylesheet" type="text/css">

    <?php include '../../templates/pages/style.php'; ?>

    <title>UJ Admin | Mahasiswa</title>
</head>
<body>
    <?php include '../../templates/pages/navbar.php'; ?>

    <?php if ( isset($_SESSION["role"]) == "ADMIN" ) { ?>
    <main>
        <div class="product-title text-center my-5">
            <h2 class="text-black">
                DAFTAR MAHASISWA
            </h2>
        </div>
        <table class="table table-bordered bg-white w-75 mx-auto mt-3 mb-5">
            <form action="" method="post">
                <div class="input-group rounded w-25 mx-auto">
                    <input type="search" name="keyword" class="form-control rounded" placeholder="contoh: nama, npm, kelas" aria-label="Search" aria-describedby="search-addon" />
                    <button class="btn btn-dark text-white px-4 ml-2" name="cari" type="submit" href="#">Cari</button>
                </div>
            </form>
            
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">NPM</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($mahasiswa as $data) : ?>
                <tr class="text-uppercase">
                    <td class="font-weight-bold"scope="row"><?= $i; ?></td> 
                    <td><?= $data["nama"] ?></td>
                    <td> <?= $data["npm"] ?></td>
                    <td> <?= $data["kelas"] ?></td>
                    <td class="action-button text-uppercase text-bold text-center">
                        <a class="btn btn-info text-white" href="ubah.php?id=<?= $data["id"] ?>">edit</a>
                        <a class="btn btn-danger text-white ml-2" href="hapus.php?id=<?= $data["id"] ?>" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?');">delete</a>
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
