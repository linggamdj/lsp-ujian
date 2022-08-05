<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand text-white" href="http://localhost/jwp/">
    <img src="http://localhost/jwp/templates/img/logo-cat.png" class="mb-1" alt="logo" height="35">
    <?php if ( isset($_SESSION["nama"]) && $_SESSION["role"] == 'ADMIN') { ?>
      <span class="ml-2">UJ ADMIN</span>
    <?php } else { ?>
      <span class="ml-2">UJ</span>
    <?php } ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mr-2">
      <li class="nav-item active">
        <a class="nav-link active" href="http://localhost/jwp/">BERANDA<span class="sr-only"></span></a>
      </li>
      
      <?php if ( isset($_SESSION["nama"]) && $_SESSION["role"] == 'USER') { ?>
        <li class="nav-item active">
          <a class="nav-link" href="produk.php">KURSUS<span class="sr-only"></span></a>
        </li>
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            halo, <?php echo $_SESSION['nama'] ?>!
          </a>
          <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white" href="profile.php">profile</a>
            <a class="dropdown-item text-white" href="logout.php">logout</a>
          </div>
        </li>
      <?php } elseif ( isset($_SESSION["nama"]) && $_SESSION["role"] == 'ADMIN') { ?>
        <li class="nav-item active">
          <a class="nav-link" href="admin/kursus/kursus.php">KURSUS<span class="sr-only"></span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="produk.php">MAHASISWA<span class="sr-only"></span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="produk.php">PENDAFTAR<span class="sr-only"></span></a>
        </li>
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            halo, <?php echo $_SESSION['nama'] ?>!
          </a>
          <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white" href="profile.php">profile</a>
            <a class="dropdown-item text-white" href="logout.php">logout</a>
          </div>
        </li>
      <?php } else { ?>
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            login
          </a>
          <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white" href="login.php">mahasiswa</a>
            <a class="dropdown-item text-white" href="login_admin.php">admin</a>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>