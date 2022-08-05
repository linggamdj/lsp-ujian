<?php
    session_start();

    include '../templates/function/functions.php';

    // mengambil id dari url
    $id = $_GET["id"];

    // query kursus by id
    $data = query("SELECT * FROM kursus WHERE id = $id")[0];

    // assign session npm
    $npm = $_SESSION["npm"];

    // query user by npm
    $data_user = query("SELECT * FROM user WHERE npm='$npm'")[0];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/css/style.css?v=1.0" rel="stylesheet" type="text/css">

    <?php include '../templates/pages/style.php'; ?>

    <title>UJ | Daftar Kursus</title>
</head>
<body>
    <?php include '../templates/pages/navbar.php'; ?>

    </main>
        <div class="form-product column my-5 text-center">
            <div class="title-add mb-5">
                <h2>
                    Daftar Kursus <?php echo $data['nama_kursus'] ?>
                </h2>
            </div>
            <form method="post" enctype="multipart/form-data" class="col-lg-6 col-md-6 col-sm-4 mx-auto w-20">
                <input type="hidden" name="id" value="<?= $data["id"] ?>">
                <div class="form-group text-left">
                    <label>Nama Mahasiswa</label>
                    <input disabled type="text" class="form-control" name="nama" value="<?= $data_user["nama"] ?>" placeholder="Nama Mahasiswa" required>
                </div>
                <div class="form-group text-left">
                    <label>NPM</label>
                    <input disabled type="text" class="form-control" name="npm" value="<?= $data_user["npm"] ?>" placeholder="NPM Mahasiswa" required>
                </div>
                <div class="form-group text-left">
                    <label>Kelas</label>
                    <input disabled type="text" class="form-control" name="kelas" value="<?= $data_user["kelas"] ?>" placeholder="Kelas Mahasiswa" required>
                </div>
                <div class="form-group text-left">
                    <label>Kursus yang Dipilih</label>
                    <input disabled type="text" class="form-control" name="kursus" value="<?= $data['nama_kursus'] ?>" placeholder="Kursus" required>
                </div>
                <div class="form-group text-left">
                    <label>Tanggal Kursus</label>
                    <input disabled type="text" class="form-control" name="kursus" value="<?= date("l, d M Y", strtotime($data["waktu_kursus"])) ?>" placeholder="Kursus" required>
                </div>
                <div class="form-group text-left">
                    <label>Upload KRS Aktif</label>
                    <input type="file" name="krs" class="form-control-file" required>
                </div>
                <button type="submit" name="daftar" class="btn btn-dark">Daftar Kursus</button>
            </form>
        </div>
    <main>
    
    <?php include '../templates/pages/footer.php'; ?>

    <?php include '../templates/jquery/jquery.php'; ?>

    <?php
        // mengecek apakah data berhasil ditambah (daftar)
        if (isset($_POST["daftar"])) {
            if (daftarKursusMahasiswa($_POST)) {
                echo "<script>alert('Berhasil mengikut kursus! Silakan cek secara berkala status verifikasi kursus anda.'); window.location.href='http://localhost/jwp/'</script>";
            } else {
                echo "<script>alert('Kesalahan pada server!'); window.location.href='http://localhost/jwp/'</script>";
                exit;
            }
        }
    ?>
</body>
</html>
