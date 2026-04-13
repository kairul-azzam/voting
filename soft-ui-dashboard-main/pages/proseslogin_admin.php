<?php
//session adalah tempat penyimpanan data sementara di server untuk mengingat siapa yang sedang login
session_start();
include 'header/config.php';

//jika tombol login diklik
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usernameVar = $_POST['username'] ?? 0;
    $passwordVar = $_POST['password'] ?? 0;

    //cek apakah username dan password cocok dengan yang ada di database
    $query = mysqli_query($koneksi, "SELECT * FROM tbladmin WHERE username='$usernameVar' AND password='$passwordVar'");
    
    if (mysqli_num_rows($query) > 0) {
        //jika cocok, ambil data siswa
        $dataSiswa = mysqli_fetch_assoc($query);
        //simpan data siswa ke session
        $_SESSION['login'] = true;
        $_SESSION['nama_admin'] = $dataSiswa['nama_admin'];
        $_SESSION['id_admin'] = $dataSiswa['id_admin'];
        //jka benar, alihkan ke halaman dashboard admin
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
}).then(() => { window.location.href = 'dashboard/dashboard.php'; });
</script>
</body>
</html>
HTML;
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
}).then(() => { window.location.href = 'login_admin.php'; });
</script>
</body>
</html>
HTML;
    }
}


?>