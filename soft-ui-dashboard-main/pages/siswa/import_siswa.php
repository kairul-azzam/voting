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


    echo "<script>
        alert('Import berhasil!');
        window.location='siswa.php';
    </script>";
}


