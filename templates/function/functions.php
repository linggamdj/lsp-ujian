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

        // cek username
        $queryUsername = "SELECT npm FROM user WHERE npm='$npm'";
        $result = mysqli_query($conn, $queryUsername);

        if (mysqli_fetch_assoc($result)) {
            echo "<script>alert('NPM sudah terdaftar! Silakan gunakan username lain.');</script>";
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

    // fungsi untuk tambah data
    function tambah($data) {
        global $conn;

        // mengambil nilai inputan user
        $nama = htmlspecialchars($data["nama"]);
        $deskripsi = htmlspecialchars($data["deskripsi"]);
        $waktu = htmlspecialchars($data["waktu"]);

        // mengupload gambar
        // $pic = upload();

        // if (!$pic) {
        //     return false;
        // }

        // query
        $query = "INSERT INTO kursus VALUES ('', '$nama', '$deskripsi', '$waktu')";

        // result
        query($query);

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk upload
    function upload() {
        // mengambil nilai-nilai file
        $fileName = $_FILES['gambar']['name'];
        $fileSize = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmp = $_FILES['gambar']['tmp_name'];

        // mengecek apakah file sudah terupload (4 = no file was uploaded)
        if ($error === 4) {
            echo "<script>alert('Pilih gambar dahulu!');</script>";
            return false;
        }

        // ekstensi gambar yang diterima
        $picExtension = ['jpg', 'jpeg', 'png', 'gif'];

        // mengecek ekstensi file yang telah diupload
        $uploadedExtension = explode('.', $fileName);
        $uploadedExtension = strtolower(end($uploadedExtension));

        if (!in_array($uploadedExtension, $picExtension)) {
            echo "<script>alert('Yang diupload bukan file gambar!');</script>";
            return false;
        }

        // membatasi ukuran file (byte)
        if ($fileSize > 2000000) {
            echo "<script>alert('File gambar terlalu besar! Max 2MB');</script>";
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
        // $oldPic = htmlspecialchars($data["gambarLama"]);

        // mengecek apakah user mengupload gambar baru
        // if ($_FILES['gambar']['error'] === 4) {
        //     $pic = $oldPic;
        // } else {
        //     $pic = upload();
        // }
        

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

    //fungsi untuk mengubah data user
    function ubahPengguna($data) {
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

    // fungsi untuk menghapus data
    function hapusKursus($data) {
        global $conn;

        // $file = mysqli_fetch_assoc(mysqli_query($conn, "SELECT gambar FROM produk WHERE ID_produk = $data"));
        
        // unlink("C:/xampp/htdocs/jwp/templates/uploads/", $file);

        mysqli_query($conn, "DELETE FROM kursus WHERE id = $data");

        return mysqli_affected_rows($conn);
    }

    // fungsi untuk search
    function cariKursus($data) {
        $query = "SELECT * FROM kursus
                    WHERE nama_kursus LIKE '%$data%' OR
                    deskripsi LIKE '%$data%' OR
                    waktu_kursus LIKE '%$data%'
                    ORDER BY id ASC
                ";

        return query($query);
    }
?>