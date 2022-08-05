<?php
    $conn = mysqli_connect("localhost", "root", "", "jwp");

    // fungsi untuk melakukan query
    function query($data) {
        global $conn;
        
        // result
        $result = mysqli_query($conn, $data);

        $rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    // fungsi untuk registrasi
    function registrasi($data) {
        global $conn;

        // mengambil nilai inputan user
        $nama = strtolower(stripslashes($data["nama"]));
        $npm = strtolower(stripslashes($data["npm"]));
        $kelas = strtolower(stripslashes($data["kelas"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $repassword = mysqli_real_escape_string($conn, $data["repassword"]);

        // cek npm
        $queryNPM = "SELECT npm FROM user WHERE npm='$npm'";
        $result = mysqli_query($conn, $queryNPM);

        if (mysqli_fetch_assoc($result)) {
            echo "<script>alert('NPM sudah terdaftar! Silakan gunakan NPM lain.');</script>";
            return false;
        }

        // cek confirm password
        if ($password !== $repassword) {
            echo "<script>alert('Konfirm password tidak cocok!');</script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // query
        $query = "INSERT INTO user VALUES('', '$nama', '$npm', '$kelas', '$password', 'USER')";

        // result
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk login
    function login($data) {
        global $conn;

        // mengambil nilai inputan user
        $npm = $data['npm'];
        $password = $data['password'];

        // query pengecekan username ada atau tidak
        $query = "SELECT * FROM user WHERE npm='$npm'";

        // result
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // verifikasi password
            $verify = password_verify($password, $row["password"]);

            if ($verify) {
                // set session
                $_SESSION["login"] = true;
                $_SESSION["npm"] = $npm;
                $_SESSION["nama"] = $row['nama'];
                $_SESSION["role"] = $row["role"];

                if ($row["role"] == "ADMIN") {
                    echo "<script>alert('Login telah berhasil sebagai Admin'); window.location.href='http://localhost/jwp'</script>";
                    exit;
                } else if ($row["role"] == "USER") {
                    echo "<script>alert('Login telah berhasil sebagai Mahasiswa/i'); window.location.href='http://localhost/jwp'</script>";
                    exit;
                } else {
                    echo "<script>alert('Gagal login, silakan ulangi');</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Username atau password salah!');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Username belum terdaftar!');</script>";
            exit;
        }
    }

    // fungsi untuk tambah data kursus
    function tambahKursus($data) {
        global $conn;

        // mengambil nilai inputan user
        $nama = htmlspecialchars($data["nama"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);
        $waktu = htmlspecialchars($data["waktu"]);

        $query = "INSERT INTO kursus VALUES ('', '$nama', '$deskripsi', '$waktu')";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk daftar kursus mahasiswa
    function daftarKursusMahasiswa($data) {
        global $conn;

        // query user by npm
        $npm = $_SESSION["npm"];

        $queryUser = query("SELECT * FROM user WHERE npm='$npm'")[0];

        // mengambil nilai inputan user
        $idUser = $queryUser['id'];
        $idKursus = $data['id'];
        $upload = upload();

        $query = "INSERT INTO daftar VALUES ('', $idUser, $idKursus, '$upload', 'BELUM')";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk upload krs
    function upload() {
        // mengambil nilai-nilai file
        $fileName = $_FILES['krs']['name'];
        $fileSize = $_FILES['krs']['size'];
        $error = $_FILES['krs']['error'];
        $tmp = $_FILES['krs']['tmp_name'];

        // mengecek apakah file sudah terupload (4 = no file was uploaded)
        if ($error === 4) {
            echo "<script>alert('Pilih krs dahulu!');</script>";
            return false;
        }

        // ekstensi krs yang diterima
        $picExtension = ['jpg', 'jpeg', 'png', 'pdf'];

        // mengecek ekstensi file yang telah diupload
        $uploadedExtension = explode('.', $fileName);
        $uploadedExtension = strtolower(end($uploadedExtension));

        if (!in_array($uploadedExtension, $picExtension)) {
            echo "<script>alert('Gagal upload! File yang didukung: pdf, jpg, jpeg, dan png!');</script>";
            return false;
        }

        // membatasi ukuran file (byte)
        if ($fileSize > 5000000) {
            echo "<script>alert('File krs terlalu besar! Max 5MB');</script>";
            return false;
        }

        // generate nama file baru
        $newName = uniqid();
        $newName .= '.';
        $newName .= $uploadedExtension;


        // mengupload file
        move_uploaded_file($tmp, "C:/xampp/htdocs/jwp/templates/uploads/" . $newName);

        return $newName;
    }

    //fungsi untuk mengubah data produk
    function ubahKursus($data) {
        global $conn;

        // mengambil nilai inputan user
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);
        $waktu = htmlspecialchars($data["waktu"]);

        // query
        $query = "UPDATE kursus SET
                nama_kursus = '$nama',
                deskripsi = '$deskripsi',
                waktu_kursus = '$waktu'
                WHERE id = $id
                ";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    //fungsi untuk mengubah data mahasiswa
    function ubahMahasiswa($data) {
        global $conn;

        // mengambil nilai inputan user
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $npm = htmlspecialchars($data["npm"]);
        $kelas = htmlspecialchars($data["kelas"]);
        
        // cek npm
        $queryUser = "SELECT * FROM user WHERE npm='$npm'";
        $userNPM = $queryUser['npm'];
        $result = mysqli_query($conn, $userNPM);

        if (mysqli_fetch_assoc($result) > 1) {
            echo "<script>alert('NPM sudah terdaftar!);</script>";
            return false;
        }

        // query
        $query = "UPDATE user SET
                nama = '$nama',
                npm = '$npm',
                kelas = '$kelas'
                WHERE id = $id
                ";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    //fungsi untuk mengubah data pendaftar
    function ubahPendaftar($data) {
        global $conn;

        // mengambil nilai inputan user
        $id = $data["id"];
        $status = htmlspecialchars(strtoupper($data["verif"]));

        // query
        $query = "UPDATE daftar SET
                verifikasi = '$status'
                WHERE id = $id
                ";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    //fungsi untuk mengubah data user
    function ubahProfile($data) {
        global $conn;

        // mengambil nilai inputan user
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $kelas = htmlspecialchars($data["kelas"]);

        // query
        $query = "UPDATE user SET
                nama = '$nama',
                kelas = '$kelas'
                WHERE id = $id
                ";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk menghapus data kursus (admin)
    function hapusKursus($data) {
        global $conn;

        mysqli_query($conn, "DELETE FROM kursus WHERE id = $data");

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk menghapus data mahasiswa (admin)
    function hapusMahasiswa($data) {
        global $conn;

        mysqli_query($conn, "DELETE FROM user WHERE id = $data");

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk menghapus data pendaftar (admin)
    function hapusPendaftar($data) {
        global $conn;

        mysqli_query($conn, "DELETE IGNORE FROM daftar WHERE id = $data");

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk search kursus halaman admin
    function cariKursus($data) {
        $query = "SELECT * FROM kursus
                    WHERE nama_kursus LIKE '%$data%' OR
                    deskripsi LIKE '%$data%' OR
                    waktu_kursus LIKE '%$data%'
                    ORDER BY id ASC
                ";

        return query($query);
    }

    // fungsi untuk search pendaftar
    function cariPendaftar($data) {
        $query = "SELECT daftar.id, user.nama, user.npm, kursus.nama_kursus, kursus.waktu_kursus, daftar.upload, daftar.verifikasi
                        FROM kursus
                        INNER JOIN daftar ON kursus.id = daftar.id_kursus
                        INNER JOIN user ON user.id = daftar.id_user
                        WHERE  user.nama LIKE '%$data%' OR
                        user.npm LIKE '%$data%' OR
                        kursus.nama_kursus LIKE '%$data%' OR
                        kursus.waktu_kursus LIKE '%$data%' OR
                        daftar.verifikasi LIKE '%$data%'
                        ORDER BY daftar.id ASC
                        ";

        return query($query);
    }

    // fungsi untuk search kursus yang diikuti user
    function cariKursusMahasiswa($data) {
        // query user by npm
        $npm = $_SESSION["npm"];

        $queryUser = query("SELECT * FROM user WHERE npm='$npm'")[0];

        $query = "SELECT daftar.id, kursus.nama_kursus, kursus.waktu_kursus, daftar.verifikasi
                        FROM kursus
                        INNER JOIN daftar ON kursus.id = daftar.id_kursus
                        WHERE daftar.id_user = $queryUser[id] AND
                        (kursus.nama_kursus LIKE '%$data%' OR
                        kursus.waktu_kursus LIKE '%$data%' OR
                        daftar.verifikasi LIKE '%$data%')
                        ORDER BY daftar.id ASC
                        ";

        return query($query);
    }

    // fungsi untuk search mahasiswa halaman admin
    function cariMahasiswa($data) {
        $query = "SELECT * FROM user
                    WHERE role = 'USER' AND
                    (nama LIKE '%$data%' OR
                    npm LIKE '%$data%' OR
                    kelas LIKE '%$data%')
                    ORDER BY id ASC
                ";

        return query($query);
    }
?>