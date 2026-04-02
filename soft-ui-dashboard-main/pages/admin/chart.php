<?php
include '../header/config.php';
include '../header/sidebar.php';

$query = mysqli_query($koneksi, "SELECT tblcalonketos.nama_calon, tblcalonketos.foto, COUNT(tblvoting.id_calon) AS jumlah
FROM tblcalonketos INNER JOIN tblvoting
on tblvoting.id_calon=tblcalonketos.id_calon
GROUP BY tblvoting.id_calon");

foreach ($query as $data) {
    $nama_calon[] = $data['nama_calon'];
    $jumlah[] = $data['jumlah'];
}
?>



<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h1 align="center">grafik </h1>
                    <h5 align="center">Hasil Voting</h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <div>
                                <canvas id="myChart" height="100"></canvas>
                            </div>

                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                            <script>
                                const nama = <?= json_encode($nama_calon) ?>;
                                const jumlah = <?= json_encode($jumlah) ?>;

                                const ctx = document.getElementById('myChart');

                                new Chart(ctx, {
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
                            </script>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    $no =1;
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
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>