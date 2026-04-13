<?php
include "../header/config.php";

// ambil id dari url, kalau di url ad id, simpan di var $id, kalau ga ada, isi null
$id = $_GET['id'] ?? null;

// ambil data id
if($id){
    $query = mysqli_query($koneksi, "SELECT * FROM tbladmin WHERE id_admin = $id");
    // mysqli_fetch_assoc = ngambil satu baris dari query, terus di simpan di var siswa
    $siswa = mysqli_fetch_assoc($query);
}

$berhasil = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usernameVar = mysqli_real_escape_string($koneksi, $_POST['username'] ?? '');
    $passwordVar = mysqli_real_escape_string($koneksi, $_POST['password'] ?? '');
    $emailVar = mysqli_real_escape_string($koneksi, $_POST['email'] ?? '');
    $namaadminVar = mysqli_real_escape_string($koneksi, $_POST['nama_admin'] ?? '');
    $alamatVar = mysqli_real_escape_string($koneksi, $_POST['alamat'] ?? '');
    

    //cek upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $foto = basename($_FILES['foto']['name']);
        $tmpFile = $_FILES['foto']['tmp_name'];

        //folder upload
        $folder = "../../assets/img/";
        move_uploaded_file($tmpFile, $folder . $foto);

        //ipdate + foto baru
        $sql = "UPDATE tbladmin SET username='$usernameVar', password='$passwordVar', email='$emailVar', nama_admin='$namaadminVar', Alamat='$alamatVar', foto='$foto' WHERE id_admin = $id";

    } else {
        //update tanpa foto baru
        $sql = "UPDATE tbladmin SET username='$usernameVar', password='$passwordVar', email='$emailVar', nama_admin='$namaadminVar', Alamat='$alamatVar' WHERE id_admin = $id";
    }

    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        $berhasil = true;
    }

}
include "../header/sidebar.php";

$halaman = basename($_SERVER['PHP_SELF']);
?>



<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="fw-bold">Data admin</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="px-4" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="form-control-label">username</label>
                            <input type="text " class="form-control" name="username" required value="<?php echo $siswa['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">password</label>
                            <input type="password" class="form-control" name="password" required value="<?php echo $siswa['password']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">email</label>
                            <input type="email" class="form-control" name="email" required value="<?php echo $siswa['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Nama Admin</label>
                            <input type="text" class="form-control" name="nama_admin" required value="<?php echo $siswa['nama_admin']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" required value="<?php echo $siswa['Alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Foto</label>
                            <img src="../../assets/img/<?= $siswa['foto'] ?>" class="avatar avatar-sm me-3" alt="user1">
                            <input type="file" class="form-control" name="foto" value="<?php echo $siswa['foto']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><a href="../pages/tambah_admin.php"></a>kirim</button>
                    </form>
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
    showConfirmButton: false,
    timer: 2000,
    }).then(function() {
        window.location = "admin.php";
    });
    
    </script>  

<?php } ?> 