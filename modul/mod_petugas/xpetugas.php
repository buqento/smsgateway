<?php
  $aksi="modul/mod_petugas/aksi_petugas.php";
switch($_GET[act]){
  // Tampil petugas
  default:


     $tampil=mysql_query("SELECT p.kode_satker, p.no_handphone, p.nama_petugas, p.paket, p.lokasi, s.kode_satker, s.nama_satker FROM petugas AS p, satker AS s WHERE p.kode_satker = s.kode_satker ORDER BY p.kode_satker");
      echo "<h2>Daftar Petugas</h2>";
      echo "<input type=button value='Tambah Petugas' onclick=\"window.location.href='?module=petugas&act=tambahpetugas';\">";
	  	
		echo'<table border="1">
		  <tr>
			<th>No</th>
			<th>Kode</th>
			<th>Nama Petugas</th>
			<th>Handphone</th>
			<th>Paket</th>
			<th>Lokasi</th>
		  </tr>';
		  $no = 0;	
		while($baris = mysql_fetch_array($tampil)){
			$no++;
			echo'
			<td>'.$no.'</td>
			<td><a href="?module=tampilsatker&kdsat='.$baris['kode_satker'].'" title="'.$baris['nama_satker'].'">'.$baris['kode_satker'].'</a></td>
			<td>'.strtoupper($baris["nama_petugas"]).'</td>
			<td>'.$baris["no_handphone"].'</td>
			<td>'.strtoupper($baris["paket"]).'</td>
			<td>'.strtoupper($baris["lokasi"]).'</td>
			</tr>';
		}
		echo'</table>';

    break;

  //tambah petugas
  case "tambahpetugas":
    echo "<h2>Tambah Petugas</h2>
          <form method=POST action='$aksi?module=petugas&act=input'>
          <table>
          <tr><th>Kode Satker</th>     <td> 
		  
		  <select name='kode_satker'>";
		  
			$querysatker = mysql_query("SELECT * FROM satker ORDER BY kode_satker ASC");
			while($datasatker = mysql_fetch_array($querysatker)){
				echo'<option value="'.$datasatker['kode_satker'].'" title="'.$datasatker['nama_satker'].'">'.$datasatker['kode_satker'].' &raquo; '.$datasatker['nama_satker'].'</option>';
			}
			
			echo"</select>
			</td></tr>
          <tr><th>Nama Petugas</th> <td><input type=text name='nama_petugas' size='30'></td></tr>  
          <tr><th>Handphone</th> <td><input type=text name='no_handphone' size='30' value='+62'></td></tr>  
          <tr><th>Jabatan</th> <td><input type=text name='jabatan' size=50></td></tr>  
          <tr><th>Paket</th> <td><textarea name='paket' size=30 cols='50'></textarea></td></tr>  
          <tr><th>Lokasi</th> <td><input type=text name='lokasi' size=30></td></tr>  
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
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
