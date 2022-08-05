<?php
    session_start();

    include '../../templates/function/functions.php';

    if ( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    $daftarKursus = query("SELECT daftar.id, user.nama, user.npm, kursus.nama_kursus, kursus.waktu_kursus, daftar.upload, daftar.verifikasi
                            FROM daftar
                            INNER JOIN user ON user.id = daftar.id_user
                            INNER JOIN kursus ON kursus.id = daftar.id_kursus
                            ORDER BY id ASC
                            ");
    // var_dump($daftarKursus);

    if ( isset($_POST["cari"]) ) {
        $daftarKursus = cariPendaftar($_POST["keyword"]);
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

    <title>UJ Admin | Pendaftar</title>
</head>
<body>
    <?php include '../../templates/pages/navbar.php'; ?>

    <?php if ( $_SESSION["role"] == "ADMIN" ) { ?>
    <main>
        <div class="product-title text-center my-5">
            <h2 class="text-black">
                MAHASISWA YANG TELAH MENDAFTAR
            </h2>
        </div>
        <table class="table table-bordered bg-white w-75 mx-auto mt-3 mb-5">
            <form action="" method="post">
                <div class="input-group rounded w-50 mx-auto">
                    <input type="search" name="keyword" class="form-control rounded" placeholder="contoh: nama kursus, verifikasi" aria-label="Search" aria-describedby="search-addon" />
                    <button class="btn btn-dark text-white px-4 ml-2" name="cari" type="submit" href="#">Cari</button>
                </div>
            </form>
            
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">NPM</th>
                    <th scope="col">Nama Kursus</th>
                    <th scope="col">Waktu Kursus</th>
                    <th scope="col">KRS</th>
                    <th scope="col">Status Verifikasi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($daftarKursus as $data) : ?>
                <tr>
                    <td class="font-weight-bold"scope="row"><?= $i; ?></td> 
                    <td><?= $data["nama"] ?></td>
                    <td><?= $data["npm"] ?></td>
                    <td><?= $data["nama_kursus"] ?></td>
                    <td><?= date("l, d M Y", strtotime($data["waktu_kursus"])) ?></td>
                    <td class="text-center"><a class="btn btn-dark text-white" href="http://localhost/jwp/templates/uploads/<?= $data["upload"] ?>" target="_blank">LIHAT KRS</a></td>
                    <td><?= $data["verifikasi"] ?> Terverifikasi</td>
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
        <script>window.location.href='http://localhost/jwp/'</script>";
    <?php } ?>
    
    <?php include '../../templates/pages/footer.php'; ?>

    <?php include '../../templates/jquery/jquery.php'; ?>
</body>
</html>
