<?php

//koneksi ke mysql database
mysql_connect("localhost","root","");
mysql_select_db("smsd");

//query untuk membaca SMS yang belum diproses
$query = "SELECT * FROM inbox WHERE Processed = 'false'";
$hasil = mysql_query($query);
while($data= mysql_fetch_array($hasil)){

//baca id sms
$id = $data['ID'];

//baca no pengirim
$noPengirim = $data['SenderNumber'];

//baca pesan SMS dan ubah jadi kapital
$msg = strtoupper($data['TextDecoded']);
//proses parsing
//pecah pesan berdasarkan karakter
$pecah = explode(" ",$msg);

//jika kata terdepan dari SMS adalah 'INFO'
/*if($pecah[0] == "INFO"){
if($pecah[1] == "PAKET"){
if($pecah[2] == "PEKERJAAN"){
//sms balasan
$reply = "Paket pekerjaan Satker Pelaksanaan Jembatan Merah Putih: \n
1. Jembatan Pendekat\n
2. Bentang Tengah\n
";

}
else{
$reply = "Belum ada data untuk satker tersebut";
}
}else{
$reply = "Belum ada info untuk satker tersebut";
}
}
else{
$reply = "Maaf, format SMS salah!\nKetik: info&lt;spasi&gt;paket&lt;spasi&gt;kotaanda\nTerima kasih :)";

}*/
$reply = "Laporan telah kami terima. \n Terima kasih :)";
$query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded, creatorID) VALUES('$noPengirim','$reply','buqento')";
mysql_query($query3);
//ubah nilai 'processed' menjadi 'true' untuk setiap SMS
//yang telah diproses
$query3 = "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'";
mysql_query($query3);

}
?>