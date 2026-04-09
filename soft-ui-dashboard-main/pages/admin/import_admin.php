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
        $username    = $row[0];
        $email   = $row[1];
        $password   = $row[2];
        $nama_admin = $row[3];
        $Alamat  = $row[4];
        $foto = $row[5];
        





   //query tambah data       
        mysqli_query($koneksi, "INSERT INTO tbladmin (username, email, password, nama_admin, Alamat, foto) VALUES('$username','$email','$password','$nama_admin','$Alamat','$foto')");


        $no++;
    }


    fclose($file);


    echo " <script>
    
        alert('Import berhasil!');
        window.location='admin.php';
    </script>";
}


