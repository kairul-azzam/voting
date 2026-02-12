<?php

session_start();
// kalo session login belum ada
if(!isset($_SESSION['login'])) {
    //alihkan ke halaman login
    header("Location: pages/login.php");
}

include 'pages/header/config.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>voting osis</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets_siswa/img/favicon.png" rel="icon">
  <link href="assets_siswa/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets_siswa/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets_siswa/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets_siswa/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets_siswa/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets_siswa/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets_siswa/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: QuickStart
  * Template URL: https://bootstrapmade.com/quickstart-bootstrap-startup-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="assets_siswa/img/logoosis.jpg" alt="">

      </a>

      <nav id="navmenu" class="navmenu">

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="index.html#about"> <?= $_SESSION['nama']; ?></a>

      <a href="pages/logout.php" class="btn btn-danger" style="font-size: 14; padding: 8PX 25PX; margin: 0 0 0 10px; border-radius: 50px; transition: all 0.3s ease;" >Logout</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="assets_siswa/img/hero-bg-light.webp" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up">Voting calon <span>Ketua Osis</span></h1>
          <p data-aos="fade-up" data-aos-delay="100">Klik Sekarang, Tentukan Masa Depan<br></p>


          <form action="pages/voting.php" method="POST" id="formvote">


            <input type="hidden" name="id_calon" id="id_calon">


            <div class="container py-4">
              <div class="row justify-content-center g-4">
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM tblcalonketos");
                foreach ($query as $data):
                ?>
                  <div class="col-md-4">
                    <div class="card calon-card shadow" onclick="pilihcalon(<?= $data['id_calon'] ?>, this)">
                      <!-- kalo tombol ini diklik, jalankan fungsi pilihcalon sambil kirim data calon ini onclick="pilihcalon(5, this)" -->


                      <span class="badge bg-primary position-absolute top-0 start-0 m-2 fs-3 px-3 py-2">
                        <?= sprintf("%02d", $no++) ?>
                      </span>


                      <img src="assets/img/<?php echo $data['foto']; ?>" class="card-img-top" style="height: 400px; object-fit: cover;" alt="...">
                      <div class="card-body">
                        <h5 class="card-title fw-bolder"><?php echo $data['nama_calon']; ?></h5>
                        <p class="card-text"><span class="fw-bold">Visi:</span> <?php echo $data['visi']; ?></p>
                        <p class="card-text"><span class="fw-bold">Misi:</span> <?php echo $data['misi']; ?></p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

              </div>
              <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5" id="btnpilih" disabled>pilih</button>
              </div>
            </div>
          </form>


        </div>







      </div>

    </section><!-- /Hero Section -->



  </main>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets_siswa/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets_siswa/vendor/php-email-form/validate.js"></script>
  <script src="assets_siswa/vendor/aos/aos.js"></script>
  <script src="assets_siswa/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets_siswa/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets_siswa/js/main.js"></script>

  <script>
    //buat fungsi bernama pilihcalon yang menerima 2 parameter: id_calon dan element
    function pilihcalon(id, card) {

      //isi input hidden. kode ini buat nyimpen nomor calon yang kita klik supaya bisa dikirim ke databse 
      document.getElementById("id_calon").value = id;

      //aktifkan tombol pilih
      document.getElementById("btnpilih").disabled = false;

      //ambil semua elemen dengan class calon-card
      let semua_card = document.querySelectorAll(".calon-card");

      //beri tanda pada card yang dipilih
      card.classList.add("border-info", "border-4");

      //hilangkan tanda pada card yang tidak dipilih
      semua_card.forEach(kartu_satuan => {
        if (kartu_satuan !== card) {
          kartu_satuan.classList.remove("border-info", "border-4");
        }
      });
    }
  </script>

</body>

</html>