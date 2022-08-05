<?php
    session_start();

    include '../../templates/function/functions.php';

    // mengambil id dari url
    $id = $_GET["id"];

    // query
    $data = query("SELECT * FROM kursus WHERE id = $id")[0];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include '../../templates/pages/style.php'; ?>

    <title>UJ | Ubah Kursus</title>
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
                    <label>Nama Kursus</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Kursus" value="<?= $data["nama_kursus"] ?>" required>
                </div>
                <div class="form-group text-left">
                    <label>Deskripsi Kursus</label>
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi Kursus" required><?= $data["deskripsi"] ?></textarea>
                </div>
                <div class="form-group text-left">
                    <label>Waktu Kursus</label>
                    <input type="date" name="waktu" class="form-control" placeholder="Waktu Kursus" value="<?= $data["waktu_kursus"] ?>" required>
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
            if (ubahKursus($_POST) >= 0) {
                echo "<script>alert('Data berhasil diubah!'); window.location.href='kursus.php'</script>";
            } else {
                echo "<script>alert('Data gagal diubah!'); window.location.href='kursus.php'</script>";
                exit;
            }
        }
    ?>
</body>
</html>
