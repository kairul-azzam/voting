<?php
include "../header/config.php";
include "../header/sidebar.php";


$query = mysqli_query($koneksi, "SELECT tblcalonketos.nama_calon, tblcalonketos.foto, COUNT(tblvoting.id_calon) AS jumlah
FROM tblcalonketos INNER JOIN tblvoting
ON tblvoting.id_calon = tblcalonketos.id_calon
GROUP BY tblvoting.id_calon");


foreach ($query as $row) {
    $nama_calon[] = $row['nama_calon'];
    $jumlah[] = $row['jumlah'];
}
?>




<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>


<body>


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>


                            <form action="export_pdf.php" method="POST" target="_blank">
                                <input type="hidden" name="chart_image" id="chart_image">
                                <button type="submit" onclick="exportPDF()" class="btn btn-danger">
                                    Export PDF
                                </button>
                            </form>

    
                        </h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div id="areaPDF">
                            <h3 align="center"> Grafik Perolehan Suara Ketua Osis</h3>
                            <h5 align="center"> SMK Informatika Pesat </h5>




                            <div>
                                <canvas id="myChart" height="100"></canvas>
                            </div>


                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


                            <script>
                                const nama = <?= json_encode($nama_calon); ?>;
                                const jumlah = <?= json_encode($jumlah); ?>;


                                const ctx = document.getElementById('myChart');


                                // 🔥 SIMPAN ke variabel
                                const myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: nama,
                                        datasets: [{
                                            label: '# of Votes',
                                            data: jumlah,
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });


                                function exportPDF() {
                                    document.getElementById('chart_image').value = myChart.toBase64Image();
                                }
                            </script>


                            <div class="container-fluid py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                                <h6>data calon ketos</h6>

                                            </div>
                                            <div class="card-body px-0 pt-0 pb-2">
                                                <div class="table-responsive p-0">
                                                    <table class="table align-items-center mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama calon</th>
                                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">jumlah suara</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr>
                                                                <?php
                                                                $no = 1;
                                                                // $query = mysqli_query($koneksi, "SELECT * FROM tblcalonketos");
                                                                foreach ($query as $data):
                                                                ?>
                                                                    <td>
                                                                        <div class="d-flex px-2 py-1">
                                                                            <div>
                                                                                <h6 class="mb-0 text-sm"><?= $no++; ?></h6>
                                                                            </div>
                                                                        </div>
                                                                    <td>
                                                                        <div class="d-flex px-2 py-1">
                                                                            <div>
                                                                                <img src="../../assets/img/<?= $data['foto'] ?>" class="avatar avatar-sm me-3" alt="user1">
                                                                            </div>
                                                                            <div class="d-flex flex-column justify-content-center">
                                                                                <h6 class="mb-0 text-sm"><?= $data['nama_calon'] ?></h6>
                                                                                <p class="text-xs text-secondary mb-0">sykkira@creative-tim.com</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td class="align-middle text-center">
                                                                        <span class="text-secondary text-xs font-weight-bold"><?= $data['jumlah'] ?></span>
                                                                    </td>


                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






</body>


</html>