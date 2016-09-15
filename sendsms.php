<html>
<head></head>

<body>

<h4>Lanjutkan Pesan:</h4>
<form method="post" action="">
<table>
<tr>
<th>
Kepada</th>
<td>
<input type="text" name="nohp" class="txtInput" value="+62">
<!--<select name="xnohp" class='txtInput'>
include("config/koneksi.php");
$querysatker = mysql_query("SELECT * FROM petugas ORDER BY nama_petugas ASC");
while($datasatker = mysql_fetch_array($querysatker)){
	echo'<option value="'.$datasatker['no_handphone'].'" title="'.$datasatker['nama_satker'].'">'.$datasatker['kode_satker'].' &raquo; '.strtoupper($datasatker['nama_petugas']).'</option>';
}
</select>
-->
</td>
<tr>
<th>
Isi Pesan</th>
<td>
<?php
$querypesan = mysql_query("SELECT ID, TextDecoded FROM inbox WHERE ID = ".$_GET['idpesan']);
$isipesan = mysql_fetch_array($querypesan);
?>
<textarea name="msg" rows="5" cols="50" class='txtInput'><?php echo $isipesan['TextDecoded'];?></textarea></td>
<tr>
<td>
</td>
<td>
<input type="submit" name="submit" value="Kirim Pesan" class='btnInput'>
</td>
</tr>
</table>
</form>

<?php
$noTujuan = $_POST['nohp'] = "";
$message = $_POST['msg']  = "";
$submit = $_POST['submit']  = "";

if($submit){
$query = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('$noTujuan', '$message', 'Gammu')";
$hasil = mysql_query($query);
if ($hasil){
	echo "SMS berhasil dikirim";
}else{
	echo "SMS gagal dikirim";
}
}
?>

</body>
</html>
