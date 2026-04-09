<?php
include "../header/config.php";

// cek apakah ada parameter konfirmasi
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    mysqli_query($koneksi, "TRUNCATE TABLE tbladmin");
}

// redirect
header("Location: admin.php");
exit;