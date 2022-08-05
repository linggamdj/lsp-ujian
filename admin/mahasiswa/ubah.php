<?php
    session_start();

    include '../../templates/function/functions.php';

    // mengambil id dari url
    $id = $_GET["id"];

    // query
    $data = query("SELECT * FROM user WHERE id = $id")[0];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../templates/pages/style.php'; ?>

    <title>UJ | Ubah Mahasiswa</title>
</head>
<body>
    <?php include '../../templates/pages/navbar.php'; ?>

    </main>
        <div class="form-product column my-5 text-uppercase text-center">
            <div class="title-add mb-5">
                <h2>
                    Ubah Data
                </h2>
            </div>
            <form method="post" enctype="multipart/form-data" class="col-lg-6 col-md-6 col-sm-4 mx-auto w-20">
                <input type="hidden" name="id" value="<?= $data["id"] ?>">
                <div class="form-group text-left">
                    <label>Nama Mahasiswa</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Mahasiswa" maxlength="50" value="<?= $data["nama"] ?>" required>
                </div>
                <div class="form-group text-left">
                    <label>NPM</label>
                    <input type="text" class="form-control" name="npm" placeholder="NPM Mahasiswa" maxlength="8" value="<?= $data["npm"]?>" required>
                </div>
                <div class="form-group text-left">
                    <label>Kelas</label>
                    <input type="text" class="form-control" name="kelas" placeholder="Kelas Mahasiswa" maxlength="5" value="<?= $data["kelas"] ?>" required>
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
            if (ubahMahasiswa($_POST) >= 0) {
                echo "<script>alert('Data berhasil diubah!'); window.location.href='mahasiswa.php'</script>";
            } else {
                echo "<script>alert('NPM telah terdaftar!'); window.location.href='mahasiswa.php'</script>";
                exit;
            }
        }
    ?>
</body>
</html>
