<?php
include '../header/config.php';
include '../header/sidebar.php';

$query = mysqli_query($koneksi, "SELECT tblcalonketos.nama_calon, COUNT(tblvoting.id_calon) AS jumlah
FROM tblcalonketos INNER JOIN tblvoting
on tblvoting.id_calon=tblcalonketos.id_calon
GROUP BY tblvoting.id_calon");

foreach ($query as $data) {
    $nama_calon[] = $data['nama_calon'];
    $jumlah[] = $data['jumlah'];
}
?>

<h1 align="center">grafik </h1>
<h5 align="center">Hasil Voting</h5>

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