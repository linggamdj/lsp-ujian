<?php
    session_start();

    include '../../templates/function/functions.php';

    // mengambil id dari url
    $id = $_GET["id"];

    // query
    $data = query("SELECT id, verifikasi
                    FROM daftar
                    WHERE id = $id
                    ")[0];
    // var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../templates/pages/style.php'; ?>

    <title>UJ Admin | Ubah Pendaftar</title>
</head>
<body>
    <?php include '../../templates/pages/navbar.php'; ?>

    </main>
        <div class="form-product column my-5 text-uppercase text-center">
            <div class="title-add mb-5">
                <h2>
                    Ubah Data Pendaftar
                </h2>
            </div>
            <form method="post" enctype="multipart/form-data" class="col-lg-6 col-md-6 col-sm-4 mx-auto w-20">
                <input type="hidden" name="id" value="<?= $data["id"] ?>">
                <div class="form-group text-left">
                    <label>Status Verifikasi</label>
                    <input type="text" class="form-control text-uppercase" name="verif" placeholder="NPM Mahasiswa" maxlength="5" value="<?= $data["verifikasi"]?>" required>
                </div>
                <button type="submit" name="ubah" class="btn btn-dark">UBAH</button>
            </form>
        </div>
    <main>
    
    <?php include '../../templates/pages/footer.php'; ?>

    <?php include '../../templates/jquery/jquery.php'; ?>

    <?php
        // mengecek apakah data berhasil diubah
        if (isset($_POST["ubah"])) {
            if (ubahPendaftar($_POST) >= 0) {
                echo "<script>alert('Data berhasil diubah!'); window.location.href='http://localhost/jwp/admin/pendaftar/pendaftar.php'</script>";
            } else {
                echo "<script>alert('Data gagal diubah!'); window.location.href='http://localhost/jwp/admin/pendaftar/pendaftar.php'</script>";
                exit;
            }
        }
    ?>
</body>
</html>
