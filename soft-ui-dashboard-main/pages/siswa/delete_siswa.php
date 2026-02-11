<?php
include "../header/config.php";

//ambil id dari url
$id = $_GET['id'] ?? null;

//proses delete
mysqli_query($koneksi, "DELETE FROM tblsiswa WHERE id_siswa = $id");

// kembali ke halaman siswa.php
header("Location: siswa.php");
exit;