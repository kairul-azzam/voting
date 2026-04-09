<?php 
require_once('../../TCPDF/tcpdf.php');
include "../header/config.php";

// query data untuk tabel
$query = mysqli_query($koneksi, "SELECT * FROM tbladmin");

$pdf = new TCPDF(); 
$pdf->AddPage();

// tanggal
$tanggal = date('d-m-Y');

// header
$html = '<h1 align="center">SMK Informatika Pesat</h1>';
$html .= '<p align="center">Tanggal: ' . $tanggal . '</p>';

// render header first
$pdf->writeHTML($html, true, false, true, false, '');

// table
$table = '
<table cellpadding="5" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr style="background-color: #f2f2f2;" align="center">
            <th style="border: 1px solid #000000; font-weight: bold;">No.</th>
            <th style="border: 1px solid #000000; font-weight: bold;">Nama</th>
            <th style="border: 1px solid #000000; font-weight: bold;">Username</th>
            <th style="border: 1px solid #000000; font-weight: bold;">Password</th>
        </tr>
    </thead>
    <tbody>
';

$no = 1;
while ($data = mysqli_fetch_assoc($query)) {
    $table .= '
        <tr>
            <td align="center" style="border: 1px solid #000000;">' . $no++ . '</td>
            <td style="border: 1px solid #000000;">' . $data['nama_admin'] . '</td>
            <td style="border: 1px solid #000000;">' . $data['username'] . '</td>
            <td align="center" style="border: 1px solid #000000;">' . $data['password'] . '</td>
            <td align="center" style="border: 1px solid #000000;">' . $data['Alamat'] . '</td>
        </tr>
    ';
}

$table .= '
    </tbody>
</table>
';


// render
$pdf->writeHTML($table, true, false, true, false, '');
$pdf->Output('laporan_admin.pdf', 'I');