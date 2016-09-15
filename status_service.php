<html>
<body>
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
	echo "";
}
// jika status terakhir = 0, maka service gammu berhenti
$submit = $_POST['submit'] = "";
if ($status == 0) {
	echo "<div>Status Layanan: <font color='#009900' face='Georgia'><b><u>Offline</u></b></font> <br> Klik tombol untuk menjalankan layanan SMS</div>";
	if ($submit)
	{
		passthru("c:\gammu\bin\gammu-smsd -c smsdrc -s");
	}
	else
	{
	echo "<form method='post' action=''>";
	echo "<input type='submit' name='submit' value='Jalankan Layanan' class='btnInput'>";
	echo "</form>";
	}

	}

?></body>
</html>