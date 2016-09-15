<?php
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input user
if ($module=='petugas' AND $act=='input'){
	$qcari = mysql_query("SELECT * FROM petugas WHERE no_handphone='".$_POST['no_handphone']."'");
	$jdata = mysql_num_rows($qcari);
	if($jdata >= 1){
		echo("Nomor Handphone telah terdaftar!");
		}else{
			$nama_petugas = strtoupper($_POST['nama_petugas']);
			$jabatan = strtoupper($_POST['jabatan']);
			$paket = strtoupper($_POST['paket']);
			$lokasi = strtoupper($_POST['lokasi']);
		  mysql_query("INSERT INTO petugas(kode_satker,
										 no_handphone,
										 nama_petugas,
										 jabatan,
										 paket,
										 lokasi) 
								   VALUES('$_POST[kode_satker]',
										'$_POST[no_handphone]',
										'$nama_petugas',
										'$jabatan',
										'$paket',
										'$lokasi')");
		}

  header('location:../../?module=petugas&act=tambahpetugas');
}
?>
