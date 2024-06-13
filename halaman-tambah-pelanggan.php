<?php 
require "config.php";
session_start();
if(isset($_SESSION) && isset($_SESSION["login"]) && !$_SESSION["login"]){
    header("Location: login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $telepon = $_POST["telepon"];

    $sql = "CALL tambah_pelanggan_baru(?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama, $email, $telepon);
    if($stmt->execute()){
        $_SESSION["flash"] = [
            "status" => "success",
            "message" => "Pelanggan Berhasil ditambahkan"
        ];
        header("Location: halaman-daftar-pelanggan.php");
        }else{
        $_SESSION["flash"] = [
            "status" => "danger",
            "message" => "Pelanggan Berhasil ditambahkan"
        ];
        header("Location: halaman-daftar-pelanggan.php");
        // $error = "Error " . $sql . "<br>". $conn->error;
    };
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / Data - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">NiceAdmin</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle " href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION["user"]["nama_pengguna"] ?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?= $_SESSION["user"]["nama_pengguna"] ?></h6>
          <span>Admin</span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="logout.php">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#game-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Game</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="game-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="halaman-daftar-pelanggan.php">
            <i class="bi bi-circle" ></i><span>Daftar Pelanggan</span>
            </a>
        </li>
        </ul>
        <li>
            <a href="halaman-tambah-pelanggan.php" class="active">
            <i class="bi bi-circle"></i><span>Tambah Pelanggan</span>
            </a>
        </li>
        </ul>

    </li><!-- End Game Nav -->
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Daftar Game</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="components-alerts.html">
            <i class="bi bi-circle"></i><span>Alerts</span>
            </a>
        </li>
        <li>
            <a href="components-accordion.html">
            <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
        </li>
        <li>
            <a href="components-badges.html">
            <i class="bi bi-circle"></i><span>Badges</span>
            </a>
        </li>
        <li>
            <a href="components-breadcrumbs.html">
            <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
        </li>
        <li>
            <a href="components-buttons.html">
            <i class="bi bi-circle"></i><span>Buttons</span>
            </a>
        </li>
        <li>
            <a href="components-cards.html">
            <i class="bi bi-circle"></i><span>Cards</span>
            </a>
        </li>
        <li>
            <a href="components-carousel.html">
            <i class="bi bi-circle"></i><span>Carousel</span>
            </a>
        </li>
        <li>
            <a href="components-list-group.html">
            <i class="bi bi-circle"></i><span>List group</span>
            </a>
        </li>
        <li>
            <a href="components-modal.html">
            <i class="bi bi-circle"></i><span>Modal</span>
            </a>
        </li>
        <li>
            <a href="components-tabs.html">
            <i class="bi bi-circle"></i><span>Tabs</span>
            </a>
        </li>
        <li>
            <a href="components-pagination.html">
            <i class="bi bi-circle"></i><span>Pagination</span>
            </a>
        </li>
        <li>
            <a href="components-progress.html">
            <i class="bi bi-circle"></i><span>Progress</span>
            </a>
        </li>
        <li>
            <a href="components-spinners.html">
            <i class="bi bi-circle"></i><span>Spinners</span>
            </a>
        </li>
        <li>
            <a href="components-tooltips.html">
            <i class="bi bi-circle"></i><span>Tooltips</span>
            </a>
        </li>
        </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="forms-elements.html">
            <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
        </li>
        <li>
            <a href="forms-layouts.html">
            <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
        </li>
        <li>
            <a href="forms-editors.html">
            <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
        </li>
        <li>
            <a href="forms-validation.html">
            <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
        </li>
        </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="tables-general.html">
            <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
        </li>
        <li>
            <a href="tables-data.html">
            <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
        </li>
        </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="charts-chartjs.html">
            <i class="bi bi-circle"></i><span>Chart.js</span>
            </a>
        </li>
        <li>
            <a href="charts-apexcharts.html">
            <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
        </li>
        <li>
            <a href="charts-echarts.html">
            <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
        </li>
        </ul>
    </li><!-- End Charts Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="icons-bootstrap.html">
            <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
        </li>
        <li>
            <a href="icons-remix.html">
            <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
        </li>
        <li>
            <a href="icons-boxicons.html">
            <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
        </li>
        </ul>
    </li><!-- End Icons Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
        <i class="bi bi-person"></i>
        <span>Profile</span>
        </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
        </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
        <i class="bi bi-envelope"></i>
        <span>Contact</span>
        </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
        </a>
    </li><!-- End Register Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
        </a>
    </li><!-- End Login Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
        </a>
    </li><!-- End Error 404 Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
        <i class="bi bi-file-earmark"></i>
        <span>Blank</span>
        </a>
    </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tambah Pelanggan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Game</li>
          <li class="breadcrumb-item active">Tambah Game</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Pelanggan</h5>

              <!-- Vertical Form -->
              <form class="row g-3" method="post">
                <div class="col-12">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-12">
                  <label for="telepon" class="form-label">Telepon</label>
                  <input type="text" class="form-control" id="telepon" name="telepon" required>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Tambah Pelanggan</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>