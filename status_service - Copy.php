<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<h2>Status Layanan SMS</h2>
<?php
// menjalankan command untuk mengenerate file service.log
passthru("net start > service.log");

// membuka file service.log
$handle = fopen("service.log", "r");

// status awal = 0 (dianggap servicenya tidak jalan)
$status = 0;

// proses pembacaan isi file
while (!feof($handle))
{
   // baca baris demi baris isi file
   $baristeks = fgets($handle);
   if (substr_count($baristeks, 'Gammu SMSD Service (GammuSMSD)') > 0)
   {
     // jika ditemukan baris yang berisi substring 'Gammu SMSD Service (GammuSMSD)'
     // statusnya berubah menjadi 1
     $status = 1;
   }
}
// menutup file
fclose($handle);

// jika status terakhir = 1, maka gammu service running
if ($status == 1){ 
	echo "Layanan SMS sedang berjalan...";
}
// jika status terakhir = 0, maka service gammu berhenti
else if ($status == 0) {
	echo "<div>Status : <b><u>Offline</u></b> <br> Klik tombol untuk menjalankan layanan SMS</div><br>";
	if ($_POST['submit'])
	{
		passthru("c:\gammu\bin\gammu-smsd -c smsdrc -s");
	}
	else
	{
	echo "<form method='post' action=''>";
	echo "<input type='submit' name='submit' value='Jalankan Layanan'>";
	echo "</form>";
	}

	}

?></body>
</html>