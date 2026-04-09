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


    echo "<script>
        alert('Import berhasil!');
        window.location='calonketos.php';
    </script>";
}


