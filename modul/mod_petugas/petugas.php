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
		$("#tampil_data").load("modul/mod_petugas/tampil_petugas.php?page=" + pages, hide_loader);
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
$aksi="modul/mod_petugas/aksi_petugas.php";
$act = $_GET['act'] = "";
switch($act){

//Tampilkan petugas
  default:
	$limit = 10;
	$query=mysql_query("SELECT * FROM kontak AS k, satker AS s WHERE k.kode_satker = s.kode_satker ORDER BY k.kode_satker");
	$count = mysql_num_rows($query);
	$pages = ceil($count/$limit);
	
	?>
	<div class="loading"><img src="ajax-loader.gif" border="0" /></div>
	<div id="tampil_data"></div>
	<div id="paging_button">
	<?php
		echo "<ul>";
		for($i=1; $i<=$pages; $i++){
			echo '<li id="'.$i.'">'.$i.'</li>';
		}
		echo "</ul>";
	?>
	</div>
	
<?php
    break;

  //tambahkan petugas
  case "tambahpetugas":
    echo "<h2>Tambah Petugas</h2>
          <form method=POST action='$aksi?module=petugas&act=input'>
          <table>
          <tr><th>Kode Satker</th>     <td> 
		  
		  <select name='kode_satker' class='txtInput'>";
		  
			$querysatker = mysql_query("SELECT * FROM satker ORDER BY kode_satker ASC");
			while($datasatker = mysql_fetch_array($querysatker)){
				echo'<option value="'.$datasatker['kode_satker'].'" title="'.$datasatker['nama_satker'].'">'.$datasatker['kode_satker'].' &raquo; '.$datasatker['nama_satker'].'</option>';
			}
			
			echo"</select>
			</td></tr>
          <tr><th>Nama Petugas</th> <td><input type='text' name='nama_petugas' size='30' class='txtInput'></td></tr>  
          <tr><th>Handphone</th> <td><input type='text' name='no_handphone' size='30' value='+62' class='txtInput'></td></tr>  
          <tr><th>Jabatan</th> <td><input type='text' name='jabatan' size='53' class='txtInput'></td></tr>  
          <tr><th>Paket</th> <td><textarea name='paket' class='txtInput autogrow' size='30' cols='50'></textarea></td></tr>
          <tr><th>Lokasi</th> <td><input type='text' name='lokasi' size='30' class='txtInput'></td></tr>  
          <tr><td colspan=2><input type=submit value=Simpan class='btnInput'>
                            <input type=button class='btnInput' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
	 
   //edit petugas
  case "editpetugas":
    $edit=mysql_query("SELECT * FROM users WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
    echo "<h2>Edit User</h2>
          <form method=POST action=$aksi?module=petugas&act=update>
          <input type=hidden name=id value='$r[id_session]'>
          <table>
          <tr><td>Username</td>     <td> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>
          <tr><td>Password</td>     <td> : <input type=text name='password'> *) </td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>";

    if ($r[blokir]=='N'){
      echo "<tr><td>Blokir</td>     <td> : <input type=radio name='blokir' value='Y'> Y   
                                           <input type=radio name='blokir' value='N' checked> N </td></tr>";
    }
    else{
      echo "<tr><td>Blokir</td>     <td> : <input type=radio name='blokir' value='Y' checked> Y  
                                          <input type=radio name='blokir' value='N'> N </td></tr>";
    }
    
    echo "<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) Username tidak bisa diubah.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";     
    }
    else{
    echo "<h2>Edit User</h2>
          <form method=POST action=$aksi?module=user&act=update>
          <input type=hidden name=id value='$r[id_session]'>
          <input type=hidden name=blokir value='$r[blokir]'>
          <table>
          <tr><td>Username</td>     <td> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>
          <tr><td>Password</td>     <td> : <input type=text name='password'> *) </td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>";    
    echo "<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) Username tidak bisa diubah.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";     
    }
    break;  
}


?>
</body>
</html>
