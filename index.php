<html>
<head>
<title>Sistem Informasi Pelaksanaan Lapangan</title>
<meta http-equiv="Copyright" content="Buqento Richard"> 
<meta name="Author" content="Buqento Richard">
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="aurefresh.js"></script>
</head>
<body>
<!--pes: <span id="notifikasi"></span>-->
<div id="header">
	<div id="menu">
      <ul>
        <li><a href=?module=beranda>&#187; Beranda</a></li>
        <?php include "menu.php"; ?>
      </ul>
 	</div>
<div id="content">
	<?php include "status_service.php"; ?>
	<?php include "content.php"; ?>
</div>
<div id="footer">
	<?php include("footer.php");?>
</div>
</div>
</body>
</html>