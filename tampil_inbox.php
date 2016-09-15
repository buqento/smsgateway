<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
$limit = 20;
$pages = $_GET["page"];
$start = ($pages-1)*20;
$perintah1="SELECT inbox.ReceivingDateTime, inbox.SenderNumber, inbox.TextDecoded, inbox.ID, kontak.kode_satker, kontak.nama_petugas, kontak.handphone, satker.kode_satker, satker.nama_satker FROM inbox, kontak, satker WHERE kontak.handphone = inbox.SenderNumber AND satker.kode_satker = kontak.kode_satker ORDER BY inbox.ReceivingDateTime DESC LIMIT $start, $limit";

$hasil1=mysql_query($perintah1);
$row=mysql_fetch_row($hasil1);
$count = mysql_num_rows($hasil1);
$no = 0;
echo('<h2>Daftar Pesan Masuk:</h2>');
echo'
<table>
  <tr>
    <th>Kode satker</th>
    <th>Nama</th>
    <th>Nope</th>
    <th>Isi Pesan</th>
    <th>Tanggal/Jam Terima</th>
  </tr>
';

	do{
	list($ReceivingDateTime, $SenderNumber, $TextDecoded, $ID, $kode_satker, $nama_petugas, $jabatan, $handphone, $nama_satker)=$row;

	$no++;
	$pecah = explode(" ",$row[0]);
	if($no % 2 == 0){ echo "<tr class='baris'>";}else{echo "<tr>";}
	echo'
    <td class="tengah"><a href="?module=tampilsatker&kdsat='.$row[4].'" title="'.$row[7].'">'.$row[4].'</a></td>
    <td class="tengah"><b>'.strtoupper($row[5]).'</b><br>'.$row[6].'</td>
    <td class="tengah">'.strtoupper($row[6]).'</td>
    <td><a href="?module=lanjutkan&idpesan='.$row[3].'" title="Lanjutkan Pesan"><b>'.$row[2].'</b></a></td>
    <td class="tengah">'.tgl_indo($row[0]).'<br>'.$pecah[1].'</td>
  </tr>
';
	}
	while ($row=mysql_fetch_row($hasil1));
echo'
</table>
';

?>