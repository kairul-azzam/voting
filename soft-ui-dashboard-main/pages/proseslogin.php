<?php
//session adalah tempat penyimpanan data sementara di server untuk mengingat siapa yang sedang login
session_start();
include 'header/config.php';

//jika tombol login diklik
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usernameVar = $_POST['username'] ?? '';
    $passwordVar = $_POST['password'] ?? '';

    //cek apakah username dan password cocok dengan yang ada di database
    $query = mysqli_query($koneksi, "SELECT * FROM tblsiswa WHERE username='$usernameVar' AND password='$passwordVar'");
    
    if (mysqli_num_rows($query) > 0) {
        //jika cocok, ambil data siswa
        $dataSiswa = mysqli_fetch_assoc($query);
        //simpan data siswa ke session
        $_SESSION['login'] = true;
        $_SESSION['nama'] = $dataSiswa['nama'];
        $_SESSION['id_siswa'] = $dataSiswa['id_siswa'];
        //jka benar, alihkan ke halaman index.php
        echo <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
Swal.fire({
  icon: 'success',
  title: 'Login berhasil',
  showConfirmButton: false,
  timer: 1500
}).then(() => { window.location.href = '../index.php'; });
</script>
</body>
</html>
HTML;
        exit;
    } else {
        //jika tidak cocok, tampilkan pesan error
        echo <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
Swal.fire({
  icon: 'error',
  title: 'Login gagal',
  text: 'Username atau password salah',
  confirmButtonText: 'OK'
}).then(() => { window.location.href = 'login.php'; });
</script>
</body>
</html>
HTML;
        exit;
    }
}
?>