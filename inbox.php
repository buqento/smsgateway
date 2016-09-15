<html>
<head>
<link rel="stylesheet" type="text/css" media="screen" href="pagingstyle.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		tampil_data(1);	
		pilih_pages();
		$("#1").css({'background-color' : '#3366FF'}); //agar paging button bagian pertama berubah warna, karena page 1 yang pertama di jalankan
	});
	//untuk memunculkan animasi loading
	//sebulumnya properti class loading sudah di set display:none
	function show_loader(){
		$(".loading").fadeIn(200);
	}
	//menghilangkan animasi loading
	function hide_loader(){
		$(".loading").fadeOut(200);
	}
	//menampilkan data
	function tampil_data(pages){
		show_loader();
		$("#tampil_data").load("tampil_inbox.php?page=" + pages, hide_loader);
	}
	function pilih_pages(){
		$("#paging_button li").click(function(){
			var pages = this.id;
			tampil_data(pages);
			$("#paging_button li").css({'background-color' : ''});
			$(this).css({'background-color' : '#3366FF'}); //ganti warna paging button yang di click
			return false;
		});
	}
</script>

</head>

<body>
<?php
include "config/koneksi.php";
$limit = 20;
$query = mysql_query("SELECT inbox.ReceivingDateTime, inbox.SenderNumber, inbox.TextDecoded, kontak.kode_satker, kontak.handphone FROM inbox, kontak WHERE kontak.handphone = inbox.SenderNumber ORDER BY inbox.ReceivingDateTime DESC");
$count = mysql_num_rows($query);
$pages = ceil($count/$limit);
?>
<div class="loading"><img src="ajax-loader.gif" border="0" /></div>
<div id="tampil_data"></div>
<a href="export.php?cetak=all" title="Export to Excel"><img src="images/Office-Excel-icon.png" border="0" width="40"/></a><br>
<br>

<div id="paging_button">
	<?php
		echo "<ul>";
		for($i=1; $i<=$pages; $i++){
			echo '<li id="'.$i.'">'.$i.'</li>';
		}
		echo "</ul>";
	?>
</div>
</body>
</html>
