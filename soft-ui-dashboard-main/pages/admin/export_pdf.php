<?php
require_once('../../TCPDF/tcpdf.php');
include "../header/config.php";


// ambil gambar chart
$chartImage = $_POST['chart_image'] ?? '';


// query data untuk di tabel
$query = mysqli_query($koneksi, "SELECT tblcalonketos.nama_calon, tblcalonketos.foto, COUNT(tblvoting.id_calon) AS jumlah
FROM tblcalonketos INNER JOIN tblvoting
ON tblvoting.id_calon = tblcalonketos.id_calon
GROUP BY tblvoting.id_calon");


// buat PDF
$pdf = new TCPDF();
$pdf->AddPage();


// tanggal
$tanggal = date('d-m-Y');


// ================= HEADER =================
$html = ' ';


// ================= GRAFIK =================
if (!empty($chartImage)) {
    $html .='<div>
                   <img src= "' . $chartImage . '" width="500">
              </div> ';
}


// ================= TABEL =================
$html .= '
<table border="1" cellpadding="5">
    <thead>
        <tr style="background-color:#f2f2f2;">
            <th>No</th>
            <th>Nama Calon</th>
            <th>Perolehan Suara</th>
        </tr>
    </thead>
    <tbody>
';


$no = 1;
foreach ($query as $row) {
    $html .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $row['nama_calon'] . '</td>
            <td>' . $row['jumlah'] . '</td>
        </tr>
    ';
}


$html .= '</tbody></table>';


// ================= FOOTER =================
$html .= '
<br><br>
<table width="100%">
    <tr>
        <td align="right">
            Dicetak pada: ' . $tanggal . '
        </td>
    </tr>
</table>
';


// render
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('laporan_voting.pdf', 'I');
