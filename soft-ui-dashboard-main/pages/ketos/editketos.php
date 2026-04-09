<?php
include "../header/config.php";

// ambil id dari url, kalau di url ad id, simpan di var $id, kalau ga ada, isi null
$id = $_GET['id'] ?? null;

// ambil data id
if($id){
    $query = mysqli_query($koneksi, "SELECT * FROM tblcalonketos WHERE id_calon = $id");
    // mysqli_fetch_assoc = ngambil satu baris dari query, terus di simpan di var siswa
    $siswa = mysqli_fetch_assoc($query);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $NamaCalonVar = $_POST['nama_calon'] ?? 0;
    $visiVar = $_POST['visi'] ?? 0;
    $misiVar = $_POST['misi'] ?? 0;
    $fotoVar = $_POST['foto'] ?? 0;
    
    


    //cek upload foto baru
    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        $tmpFile = $_FILES['foto']['tmp_name'];

        //folder upload
        $folder = "../../assets/img/";
        move_uploaded_file($tmpFile, $folder . $foto);

        //ipdate + foto baru
        $sql = "UPDATE tblcalonketos SET nama='$NamaCalonVar', visi='$visiVar', misi='$misiVar', foto='$foto' WHERE id_calon = $id";

    }else {
        //update tanpa foto baru
        $sql = "UPDATE tblsiswa SET nama='$NamaCalonVar', visi='$visiVar', misi='$misiVar' WHERE id_siswa = $id";
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
                    <h6 class="fw-bold">Data Atmin</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form class="px-4" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="form-control-label">Nama Calon</label>
                            <input type="text " class="form-control" name="nama_calon" value="<?php echo $calon['nama_calon']; ?>" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="" class="form-control-label">Kelas</label>
                            <input type="text " class="form-control" name="kelas" placeholder="X-1">
                        </div> -->
                        <div class="form-group">
                            <label for="" class="form-control-label">Visi Calon</label>
                            <input type="text" class="form-control" name="visi" value="<?php echo $calon['visi']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-control-label">Misi Calon</label>
                            <input type="text" class="form-control" name="misi" value="<?php echo $calon['misi']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="form-control-label">Foto Ketos</label>
                            <img src="../../assets/foto_calon/<?php echo $calon['foto']; ?>" class="avatar avatar-sm me-3" alt="user1">
                            <input type="file" class="form-control" name="foto" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary"><a href="../pages/tambahcalonketos.php"></a>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($success){ ?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil ditambahkan',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = 'calonketos.php';
        });
    </script>
<?php } ?>