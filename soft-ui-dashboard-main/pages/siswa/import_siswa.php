<?php
include "../header/config.php"; // sesuaikan dengan path


if (isset($_FILES['file_excel']['tmp_name'])) {


    $file = fopen($_FILES['file_excel']['tmp_name'], "r");


    $line = fgets($file);
    $delimiter = (strpos($line, ";") !== false) ? ";" : ",";
    rewind($file);


    $no = 0;
    while (($row = fgetcsv($file, 1000, "$delimiter")) !== FALSE) {


        //Untuk melewati baris pertama (header) di file CSV
        if ($no == 0) {
            $no++;
            continue;
        }


	   //kolom nama yang akan di import
        $nama    = $row[0];
        $email   = $row[1];
        $kelas   = $row[2];
        $jurusan = $row[3];
        $alamat  = $row[4];
        
        $username = $row[5];
        $password = $row[6];
        $foto    = $row[7];




   //query tambah data       
        mysqli_query($koneksi, "INSERT INTO tblsiswa (nama, email, kelas, jurusan, alamat, username, foto, password) VALUES('$nama','$email','$kelas','$jurusan','$alamat','$username','$password','$foto')");


        $no++;
    }


    fclose($file);

    // gunakan SweetAlert2 untuk notifikasi yang lebih baik
    echo "<!DOCTYPE html><html><head><meta charset=\"utf-8\"><script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script></head><body>\n";
    echo "<script>Swal.fire({icon: 'success', title: 'Import berhasil', text: 'Data siswa berhasil diimport.', showConfirmButton: false, timer: 1800}).then(function(){ window.location = 'siswa.php'; });</script>";
    echo "</body></html>";
}

// jika tidak ada file terupload atau terjadi error, beri notifikasi
if (!isset($_FILES['file_excel']['tmp_name']) || empty($_FILES['file_excel']['tmp_name'])) {
    echo "<!DOCTYPE html><html><head><meta charset=\"utf-8\"><script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script></head><body>\n";
    echo "<script>Swal.fire({icon: 'error', title: 'Gagal', text: 'Tidak ada file yang diunggah.', confirmButtonText: 'OK'}).then(function(){ window.location = 'importsiswa.php'; });</script>";
    echo "</body></html>";
}


