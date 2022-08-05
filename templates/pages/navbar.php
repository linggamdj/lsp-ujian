<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand text-white" href="http://localhost/jwp/">
    <?php if ( isset($_SESSION["nama"]) && $_SESSION["role"] == 'ADMIN') { ?>
      <h5 class="font-weight-500 ml-3 mb-0">UJ ADMIN</h5>
    <?php } else { ?>
      <h5 class="font-weight-500 ml-3 mb-0">UNIVERSITAS JWP</h5>
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
          <a class="nav-link" href="http://localhost/jwp/mahasiswa/kursus.php">KURSUS<span class="sr-only"></span></a>
        </li>
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            halo, <?php echo $_SESSION['nama'] ?>!
          </a>
          <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white" href="http://localhost/jwp/profile.php">profile</a>
            <a class="dropdown-item text-white" href="http://localhost/jwp/logout.php">logout</a>
          </div>
        </li>
      <?php } elseif ( isset($_SESSION["nama"]) && $_SESSION["role"] == 'ADMIN') { ?>
        <li class="nav-item active">
          <a class="nav-link" href="http://localhost/jwp/admin/kursus/kursus.php">KURSUS<span class="sr-only"></span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="http://localhost/jwp/admin/mahasiswa/mahasiswa.php">MAHASISWA<span class="sr-only"></span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="http://localhost/jwp/admin/pendaftar/pendaftar.php">PENDAFTAR<span class="sr-only"></span></a>
        </li>
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            halo, <?php echo $_SESSION['nama'] ?>!
          </a>
          <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white" href="http://localhost/jwp/profile.php">profile</a>
            <a class="dropdown-item text-white" href="http://localhost/jwp/logout.php">logout</a>
          </div>
        </li>
      <?php } else { ?>
        <li class="nav-item dropdown text-uppercase">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            login
          </a>
          <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white" href="http://localhost/jwp/login.php">mahasiswa</a>
            <a class="dropdown-item text-white" href="http://localhost/jwp/login_admin.php">admin</a>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>