<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
if($_GET['cetak'] == 'all'){
	header("Content-Disposition: attachment; filename=".date("d-M-Y").".xls");
	include 'tabel_all.php';
	}else{
	header("Content-Disposition: attachment; filename=".$_GET['kdsat']."-".date("d-M-Y").".xls");
	include 'tabel_satker.php';
	}
?>