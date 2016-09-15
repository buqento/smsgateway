<?php
include "config/koneksi.php";
$limit = 10;
$pages = $_GET["page"];
$start = ($pages-1)*10;
$perintah1="SELECT inbox.ReceivingDateTime, inbox.SenderNumber, inbox.TextDecoded, inbox.ID, petugas.kode_satker, petugas.no_handphone, petugas.nama_petugas, petugas.jabatan, satker.kode_satker, satker.nama_satker FROM inbox, petugas, satker WHERE petugas.no_handphone = inbox.SenderNumber AND petugas.kode_satker='".$_GET['kdsat']."' GROUP BY inbox.TextDecoded ORDER BY inbox.ReceivingDateTime DESC";
$hasil1=mysql_query($perintah1);
$row=mysql_fetch_row($hasil1);
$count = mysql_num_rows($hasil1);

$qnama_satker = mysql_query("SELECT kode_satker, nama_satker FROM satker WHERE kode_satker ='".$_GET['kdsat']."'");
$nama_satker = mysql_fetch_array($qnama_satker);
echo('<h2>Daftar Pesan Masuk:</h2>[ '.$nama_satker['kode_satker'].' ] '.$nama_satker['nama_satker']);
echo'
<table border="1">
  <tr>
    <th>Petugas</th>
    <th>Jabatan</th>
    <th>Isi Pesan</th>
    <th>Tanggal/Jam Terima</th>
  </tr>
';
	do{
	list($ReceivingDateTime, $SenderNumber, $TextDecoded, $ID, $kode_satker, $nama_petugas, $jabatan, $no_handphone, $kode_satker, $nama_satker)=$row;
	$no++;
	$pecah = explode(" ",$row[0]);
	if($no % 2 == 0){ echo "<tr class='baris'>";}else{echo "<tr>";}
	echo'
    <td class="tengah"><b>'.strtoupper($row[6]).'</b><br>'.$row[5].'</td>
    <td class="tengah">'.strtoupper($row[7]).'</td>
    <td><a href="?module=lanjutkan&idpesan='.$row[3].'" title="Lanjutkan Pesan"><b>'.$row[2].'</b></a></td>
    <td class="tengah">'.tgl_indo($row[0]).'<br>'.$pecah[1].'</td>
  </tr>
';
	}
	while ($row=mysql_fetch_row($hasil1));
echo'
</table>
';
echo'<a href="export.php?kdsat='.$_GET['kdsat'].'" title="Export to Excel"><img src="images/Office-Excel-icon.png" border="0" width="40"/></a><br>
';

?>