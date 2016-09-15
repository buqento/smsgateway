<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
if ($_GET['module']=='beranda'){
	include "inbox.php";   
}
elseif ($_GET['module']=='tampilsatker'){
  include "tampil_satker.php";
}
elseif ($_GET['module']=='lanjutkan'){
  include "sendsms.php";
}
elseif ($_GET['module']=='petugas'){
  include "modul/mod_petugas/petugas.php";
}
elseif ($_GET['module']=='statuslayanan'){
  include "status_service.php";
}
else{
  include "inbox.php";   
}
?>
