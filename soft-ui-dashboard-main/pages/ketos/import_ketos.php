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
        $nama_calon    = $row[0];
        $visi   = $row[1];
        $misi   = $row[2];
        $foto = $row[3];
        





   //query tambah data       
        mysqli_query($koneksi, "INSERT INTO tblcalonketos (nama_calon, visi, misi, foto) VALUES('$nama_calon','$visi','$misi','$foto')");


        $no++;
    }


    fclose($file);
    // gunakan SweetAlert2 untuk notifikasi yang lebih baik
    echo "<!DOCTYPE html><html><head><meta charset=\"utf-8\"><script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script></head><body>\n";
    echo "<script>Swal.fire({icon: 'success', title: 'Import berhasil', text: 'Data calon berhasil diimport.', showConfirmButton: false, timer: 1800}).then(function(){ window.location = 'calonketos.php'; });</script>";
    echo "</body></html>";
}

// jika tidak ada file terupload atau terjadi error, beri notifikasi
if (!isset($_FILES['file_excel']['tmp_name']) || empty($_FILES['file_excel']['tmp_name'])) {
    echo "<!DOCTYPE html><html><head><meta charset=\"utf-8\"><script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script></head><body>\n";
    echo "<script>Swal.fire({icon: 'error', title: 'Gagal', text: 'Tidak ada file yang diunggah.', confirmButtonText: 'OK'}).then(function(){ window.location = 'importketos.php'; });</script>";
    echo "</body></html>";
}


