<html>
<head>
	<style>
        body {
            font-family: Arial;
			font-size:6px;
        }
        table {
            border-collapse: collapse;
        }
        th {
            background-color: #cccccc;
        }
        th, td {
            border: 1px solid #000;
			text-align:center;
        }
    </style>
</head>
<body>
<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
$qdatasatker = mysql_query("SELECT * FROM satker WHERE kode_satker='".$_GET['kdsat']."'");
$dtsatker = mysql_fetch_array($qdatasatker);
echo'<H2>LAPORAN PELAKSANAAN LAPANGAN</H2>';
echo'<H4>SATKER : '.$dtsatker['nama_satker'].'</H4>';
echo'<H4>Status : '.tgl_indo(date("Y-m-d")).'</H4>';

$perintah1="SELECT inbox.ReceivingDateTime, inbox.SenderNumber, inbox.TextDecoded, inbox.ID, petugas.kode_satker, petugas.nama_petugas, petugas.jabatan, petugas.no_handphone, satker.kode_satker, satker.nama_satker FROM inbox, petugas, satker WHERE petugas.no_handphone = inbox.SenderNumber AND satker.kode_satker = petugas.kode_satker AND satker.kode_satker = '".$_GET['kdsat']."' ORDER by inbox.ReceivingDateTime DESC";
$hasil1=mysql_query($perintah1);

echo'
<table>
<thead>
	<tr>
		<th>NO</th>
		<th>PETUGAS</th>
		<th>JABATAN</th>
		<th>ISI PESAN</th>
		<th>TANGGAL/JAM</th>
 	</tr>
</thead>
<tbody>
';
do{list($ReceivingDateTime, $SenderNumber, $TextDecoded, $ID, $kode_satker, $nama_petugas, $jabatan, $no_handphone, $kode_satker, $nama_satker)=$row;
$pecah = explode(" ",$row[0]);
echo'
	<tr>
    <td>'.$no++.'</td>
    <td>'.strtoupper($row[5]).'<br>'.$row[7].'</td>
    <td>'.strtoupper($row[6]).'</td>
    <td>'.$row[2].'</td>
    <td>'.tgl_indo($row[0]).'<br>'.$pecah[1].'</td>
  	</tr>
';
}
while ($row=mysql_fetch_row($hasil1));
echo'
</tbody>
</table>
';
?>
</body>
</html>