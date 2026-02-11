<?php
include "../header/sidebar.php";
include "../header/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usernameVar = $_POST['username'] ?? 0;
    $emailVar = $_POST['email'] ?? 0;
    $passwordVar = $_POST['password'] ?? 0;
    $nama_adminVar = $_POST['nama_admin'] ?? 0;
    $alamatVar = $_POST['Alamat'] ?? 0;
    $fotoVar = $_POST['foto'] ?? 0;

    //folder upload
    $folder = "../../assets/img/";

    //ambil data file
    $namaFile = $_FILES['foto']['name']; //ambil nama file
    $tmpFile = $_FILES['foto']['tmp_name']; //ambil lokasi sementara file
    
    //bikin nama unik biar ga nabrak
    $namaBaru = time() . "_" . $namaFile;
    //pindah file ke folder tujuan
    move_uploaded_file($tmpFile, $folder . $namaBaru);

    $query = mysqli_query($koneksi, "INSERT INTO tbladmin (username, email, password, nama_admin, Alamat, foto) VALUES('$usernameVar','$emailVar','$passwordVar','$nama_adminVar','$alamatVar','$namaBaru')");

    if ($query) {
        $berhasil = true;
    }
}

$halaman = basename($_SERVER['PHP_SELF']);
?>


<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah data admin</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-4 ">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-control-label">username</label>
                                <input class="form-control" type="text" placeholder="masukkan nama" id="example-text-input" name="username" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">email</label>
                                <input class="form-control" type="text" placeholder="masukkan email" id="example-text-input" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">password</label>
                                <input class="form-control" type="password" placeholder="masukkan password" id="example-text-input" name="password" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">nama admin</label>
                                <input class="form-control" type="text" placeholder="masukkan nama admin" id="example-text-input" name="nama_admin" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Alamat</label>
                                <input class="form-control" type="text" placeholder="masukkan alamat"  name="Alamat" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">foto</label>
                                <input class="form-control" type="file" placeholder="masukkan foto"  name="foto" required>
                            </div>
                            <button type="submit" class="btn btn-primary" >Kirim</button>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if($berhasil) { ?>

    <script>
     Swal.fire({
    title: "Kerja Bagus!",
    text: "Data Berhasil Ditambahkan!",
    icon: "success",
    timer: 2000,
    showConfirmButton: false,
    }).then(function() {
        window.location = "admin.php";
    });
    
    </script>  

<?php } ?>    