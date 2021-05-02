<?php
session_start();
$link_update='?hal=ubah_password';

if(isset($_POST['save'])){

	$id_login=$_SESSION['LOGIN_ID'];
	if(empty($_POST['password']) or empty($_POST['password_baru']) or empty($_POST['ulangi'])){
		$error='Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	}else{
		if($_POST['password_baru']!=$_POST['ulangi']){
			$error='Password baru tidak sama. Silahkan ulangi lagi.';
		}else{
			$id_login=$_SESSION['LOGIN_ID'];
			if(mysqli_num_rows(mysqli_query($con,"select * from admin where id_admin='".$id_login."' and password='".md5($_POST['password'])."'"))>0){
				mysqli_query($con,"update admin set password='".md5($_POST['password_baru'])."' where id_admin='".$id_login."'");
				$success='Password anda berhasil diubah.';
			}else{
				$error='Password anda salah. Silahkan ulangi lagi.';
			}
		}
	}
}


?>
 
<h3 class="p2">Ubah Password</h3>

<form action="<?php echo $link_update;?>" name="" method="post" enctype="multipart/form-data">
<?php
if(!empty($error)){
	echo '
	   <div class="alert alert-error ">
		  '.$error.'
	   </div>
	';
}
if(!empty($success)){
	echo '
	   <div class="alert alert-success ">
		  '.$success.'
	   </div>
	';
}
?>

<table width="100%" border="0" cellspacing="4" cellpadding="4" class="tabel_reg">
  <tr>
	<td width="120">Password Anda<span class="required">*</span> </td>
	<td><input name="password" type="password" size="40" value="" class="m-wrap large"></td>
  </tr>
  <tr>
	<td>Password Baru<span class="required">*</span> </td>
	<td><input name="password_baru" type="password" size="40" value="" class="m-wrap large"></td>
  </tr>
  <tr>
	<td>Ulangi<span class="required">*</span> </td>
	<td><input name="ulangi" type="password" size="40" value="" class="m-wrap large"></td>
  </tr>
  <tr>
	<td></td>
	<td><button type="submit" name="save" class="btn blue"><i class="icon-ok"></i> Simpan</button> 
	<button type="button" name="cancel" class="btn" onclick="location.href='<?php echo $www;?>'">Batal</button></td>
  </tr>
</table>
</form>
