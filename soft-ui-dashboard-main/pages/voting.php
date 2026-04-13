<?php
session_start();

include 'header/config.php';

// initialize status to avoid "undefined variable" notices and ensure safe id handling
$status = '';
$id_siswa = (int)($_SESSION['id_siswa'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id_calonVar = (int)($_POST['id_calon'] ?? 0);
    $tanggal_voteVar = date('Y-m-d H:i:s');
    
    //cek apakah siswa sudah pernah voting
    $cek_voting = mysqli_query($koneksi, "SELECT * FROM tblvoting WHERE id_siswa = $id_siswa");
    if ($cek_voting && mysqli_num_rows($cek_voting) > 0) {
        $status = "sudah_voting";
    } else {
        //simpan voting
        $simpan = mysqli_query($koneksi, "INSERT INTO tblvoting (id_calon, tanggal, id_siswa) VALUES($id_calonVar, '$tanggal_voteVar', $id_siswa)");
    
        if ($simpan) {
            $status = "berhasil";
        } else {
            $status = "gagal";
        }
    }
}

    // store status in session and redirect back to index.php
    if (!empty($status)) {
        $_SESSION['vote_status'] = $status;
        header("Location: ../index.php");
        exit;
    }

?>