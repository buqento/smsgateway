<?php

include "config/koneksi.php";
//query untuk membaca SMS yang belum diproses
$query = "SELECT * FROM inbox WHERE Processed = 'false'";
$hasil = mysql_query($query);
$j = mysql_num_rows($hasil);
if($j>0){
	echo $j;
}
?>
