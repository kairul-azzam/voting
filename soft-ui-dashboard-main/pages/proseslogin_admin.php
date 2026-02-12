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
        echo "<script>alert('Login berhasil'); window.location.href = 'dashboard/dashboard.php';</script>";
    } else {
        //jika tidak cocok, tampilkan pesan error
        echo "<script>alert('Username atau password salah'); window.location.href = 'login_admin.php';</script>";
    }
}


?>