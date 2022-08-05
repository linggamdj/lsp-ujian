<?php
    session_start();

    include 'templates/function/functions.php';;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include 'templates/pages/style.php'; ?>

    <title>UJ | Login</title>
</head>
<body>
    <?php include 'templates/pages/navbar.php'; ?>

    <?php if ( !isset($_SESSION["npm"]) ) { ?>
    </main>
        <div class="column my-5">
            <div class="login-logo text-center mb-4">
                <img src="http://localhost/jwp/templates/img/logo-cat.png" alt="logo" height="100">
            </div>
            <form method="post" class="text-center col-lg-2 col-md-4 col-sm-8 mx-auto w-20">
                <div class="form-group">
                    <label for="username">NPM</label>
                    <input type="text" class="form-control text-center" name="npm" placeholder="NPM" required>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" class="form-control text-center" name="password" placeholder="Password" required>
                </div>
                <input type="submit" class="btn btn-dark" name="login" value="LOGIN">
                <div class="d-flex justify-content-center links mt-2">
						Belum punya akun?<a href="register.php" class="ml-1 text-primary">Daftar</a>
                </div>

            </form>
        </div>
    <main>
    <?php } else { ?>
        <script>window.location.href='index.php'</script>";
    <?php } ?>

    <?php include 'templates/pages/footer.php'; ?>

    <?php include 'templates/jquery/jquery.php'; ?>

    <?php
        if (isset($_POST['login'])) {
            login($_POST);
        }
    ?>
</body>
</html>
