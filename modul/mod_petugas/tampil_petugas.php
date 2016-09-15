<?php
include "../../config/koneksi.php";
$limit = 10;
$pages = $_GET["page"];
$start = ($pages-1)*10;
$no = $start;
$query=mysql_query("SELECT k.handphone, k.nama_petugas, k.kode_satker, s.kode_satker, s.nama_satker FROM kontak AS k, satker AS s WHERE k.kode_satker = s.kode_satker ORDER BY k.kode_satker LIMIT $start, $limit");
echo "<h2>Daftar Petugas</h2>
          <input type=button value='Tambah Petugas' class='btnInput' onclick=\"window.location.href='?module=petugas&act=tambahpetugas';\">";
echo'<table border="1">
  <tr>
			<th>No</th>
			<th>Kode</th>
			<th>Nama Petugas</th>
  </tr>';
while($baris = mysql_fetch_array($query)){
			$no++;
			if($no % 2 == 0){ echo "<tr class='baris'>";}else{echo "<tr>";}
			echo'
			<td class="tengah">'.$no.'</td>
			<td class="tengah"><a href="?module=tampilsatker&kdsat='.$baris['kode_satker'].'" title="'.$baris['nama_satker'].'">'.$baris['kode_satker'].'</a></td>
			<td class="tengah"><b>'.strtoupper($baris["nama_petugas"]).'</b><br>'.$baris["handphone"].'</td>
			</tr>';
}
echo'</table>';
?>
