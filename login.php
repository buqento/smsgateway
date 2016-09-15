<html>
<head>
<script language="javascript">
function validasi(form){
  if (form.username.value == ""){
    alert("Anda belum mengisikan Username.");
    form.username.focus();
    return (false);
  }
     
  if (form.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form.password.focus();
    return (false);
  }
  return (true);
}
</script>
</head>
<body OnLoad="document.login.username.focus();">
		<h2>Form Login</h2>
    <img src="images/login-welcome.jpg" width="97" height="105" hspace="10" align="left">
<form name="login" action="cek_login.php" method="POST" onSubmit="return validasi(this)">
<table>
<tr><td>Username</td><td> : <input type="text" name="username"></td></tr>
<tr><td>Password</td><td> : <input type="password" name="password"></td></tr>
<tr><td colspan="2"><input type="submit" value="Login">
<a href="media.php?module=pendaftaran">Pendaftaran</a></td></tr>
</table>
</form>
</body>
</html>
