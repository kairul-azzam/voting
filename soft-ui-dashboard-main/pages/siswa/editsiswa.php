<?php
include "../header/config.php";

// ambil id dari url, kalau di url ad id, simpan di var $id, kalau ga ada, isi null
$id = $_GET['id'] ?? null;

// ambil data id
if($id){
    $query = mysqli_query($koneksi, "SELECT * FROM tblsiswa WHERE id_siswa = $id");
    // mysqli_fetch_assoc = ngambil satu baris dari query, terus di simpan di var siswa
    $siswa = mysqli_fetch_assoc($query);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $NamaPanjangVar = $_POST['namaPanjang'] ?? 0;
    $EmailVar = $_POST['email'] ?? 0;
    $KelasVar = $_POST['kelas'] ?? 0;
    $JurusanVar = $_POST['jurusan'] ?? 0;
    $AlamatVar = $_POST['alamat'] ?? 0;
    


    //cek upload foto baru
    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        $tmpFile = $_FILES['foto']['tmp_name'];

        //folder upload
        $folder = "../../assets/img/";
        move_uploaded_file($tmpFile, $folder . $foto);

        //ipdate + foto baru
        $sql = "UPDATE tblsiswa SET nama='$NamaPanjangVar', email='$EmailVar', kelas='$KelasVar', jurusan='$JurusanVar', alamat='$AlamatVar', foto='$foto' WHERE id_siswa = $id";

    }else {
        //update tanpa foto baru
        $sql = "UPDATE tblsiswa SET nama='$NamaPanjangVar', email='$EmailVar', kelas='$KelasVar', jurusan='$JurusanVar', alamat='$AlamatVar' WHERE id_siswa = $id";
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
                    <h6 class="fw-bold">Data Siswa</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="px-4" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="form-control-label">Nama Panjang</label>
                            <input type="text " class="form-control" name="namaPanjang" required value="<?php echo $siswa['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Email</label>
                            <input type="text " class="form-control" name="email" required value="<?php echo $siswa['email']; ?>">
                        </div>
                        <!-- <div class="form-group">
                            <label for="" class="form-control-label">Kelas</label>
                            <input type="text " class="form-control" name="kelas" value="X-1">
                        </div> -->
                        <label for="" class="form-control-label">Kelas</label>
                        <select class="form-control" name="kelas" required value="<?php echo $siswa['kelas']; ?>">
                            <option>X-1</option>
                            <option>X-2</option>
                            <option>X-3</option>
                        </select>
                        <!-- <div class="form-group">
                            <label for="" class="form-control-label">Jurusan</label>
                            <input type="text " class="form-control" name="jurusan" value="RPL">
                        </div> -->
                        <label for="" class="form-control-label">Jurusan</label>
                        <select class="form-control" name="jurusan" required value="<?php echo $siswa['jurusan']; ?>">
                            <option>RPL</option>
                            <option>DKV</option>
                            <option>TKJ</option>
                        </select>
                        <div class="form-group">
                            <label for="" class="form-control-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" required value="<?php echo $siswa['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Foto</label>
                            <img src="../../assets/img/<?= $siswa['foto'] ?>" class="avatar avatar-sm me-3" alt="user1">
                            <input type="file" class="form-control" name="foto" value="<?php echo $siswa['foto']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary"><a href="../pages/tambah_siswa.php"></a>kirim</button>
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
        window.location = "siswa.php";
    });
    
    </script>  

<?php } ?> 