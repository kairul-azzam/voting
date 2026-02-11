<?php
include "../header/sidebar.php";
include "../header/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_calonVar = $_POST['nama_calon'] ?? 0;
    $visiVar = $_POST['visi'] ?? 0;
    $misiVar = $_POST['misi'] ?? 0;
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



    $query = mysqli_query($koneksi, "INSERT INTO tblcalonketos (nama_calon, visi, misi, foto) VALUES('$nama_calonVar','$visiVar','$misiVar','$namaBaru')");

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
                    <h6>Tambah data calon ketua osis</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-4 ">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-control-label">Nama calon</label>
                                <input class="form-control" type="text" placeholder="masukkan nama" id="example-text-input" name="nama_calon" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Visi</label>
                                <input class="form-control" type="text" placeholder="masukkan visi" id="example-text-input" name="visi" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Misi</label>
                                <input class="form-control" type="text" placeholder="masukkan misi" id="example-text-input" name="misi" required>
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
    showConfirmButton: false,
    timer: 2000,
    }).then(function() {
        window.location = "calonketos.php";
    });
    
    </script>  

<?php } ?>