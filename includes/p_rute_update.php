<?php
error_reporting(0);
ob_start();
$link_list='?hal=data_rute';
$link_update='?hal=update_rute';
include "fungsi_thumb.php";






$kode='';
$nama='';
if(isset($_POST['save'])){
	$id=$_POST['id'];
	$action=$_POST['action'];
	//echo $action;
	//exit;
	
	
	$lokasi_awal=$_POST['lokasi_awal'];
	$lokasi_tujuan=$_POST['lokasi_tujuan'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
		$nilai=$_POST['nilai'];
	$alamat=$_POST['alamat'];
	
	
	
 	
  
	
	if(empty($alamat) or empty($lokasi_awal) or empty($lokasi_tujuan) or empty($lat)){
		$error='Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	}
	
	else{
		if($action=='add'){
				$q="insert into rute_wisata(lokasi_awal,lokasi_tujuan,lat,lng,alamat,nilai) values('".$lokasi_awal."','".$lokasi_tujuan."','".$lat."','".$lng."','".$alamat."','".$nilai."')";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_list."';</script>");
			
		}
		if($action=='edit'){
			$q=mysqli_query($con,"select * from rute_wisata where id_rute='".$id."'");
			$h=mysqli_fetch_array($q);
			
			
		$q="update rute_wisata set lokasi_awal='".$lokasi_awal."',lokasi_tujuan='".$lokasi_tujuan."',lat='".$lat."',lng='".$lng."',alamat='".$alamat."',nilai='".$nilai."'  where id_rute='".$id."'";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_list."';</script>");
			
			
			
			
			
			
			
		}
		
	}
}else{
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from rute_wisata where id_rute='".$id."'");
		$h=mysqli_fetch_array($q);
		
		
		$id_wisata1=$h['lokasi_awal'];
		$id_wisata2=$h['lokasi_tujuan'];
		$lat=$h['lat'];
		$lng=$h['lng'];
		$alamat=$h['alamat'];
		$nilai=$h['nilai'];
		
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysqli_query($con,"delete from rute_wisata where id_rute='".$id."'");
		exit("<script>location.href='".$link_list."';</script>");
	}
}

// Lokasi awal 

$list_awal=array();
$q="select * from peta_wisata order by id_wisata";
$q=mysqli_query($con,$q);
while($h=mysqli_fetch_array($q)){
	if($h['nama']==$id_wisata1){$s=' selected';}else{$s='';}
	$list_awal.='<option value="'.$h['nama'].'"'.$s.'> '.$h['nama'].'</option>';
}

$list_tujuan=array();
$q="select * from peta_wisata order by id_wisata";
$q=mysqli_query($con,$q);
while($h=mysqli_fetch_array($q)){
	if($h['nama']==$id_wisata2){$s=' selected';}else{$s='';}
	$list_tujuan.='<option value="'.$h['nama'].'"'.$s.'>'.$h['nama'].'</option>';
}


?>

<?php 
if($_GET['action'] == 'edit'){
$cetak='Edit';
}
else{
$cetak='Tambah';

}




?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>


<h3 class="p2"><?php echo $cetak ?> Rute Wisata</h3>


<form action="<?php echo $link_update;?>" name="" method="post" enctype="multipart/form-data">
<input name="id" type="hidden" value="<?php echo $id;?>">
<input name="action" type="hidden" value="<?php echo $action;?>">
<?php
if(!empty($error)){
	echo '
	   <div class="alert alert-error ">
		  '.$error.'
	   </div>
	';
}
?>
<div id="map_canvas" align="left" width=100% height=20%></div>
<table width="100%" border="0" cellspacing="4" cellpadding="4" class="tabel_reg">
  
  <tr>
    <td><strong>Nilai Heuristik Jarak</strong></td>
    <td><input name="nilai" type="text" id="nilai" size="40" value="<?php echo $nilai;?>" class="m-wrap large" /></td>
  </tr>
  <tr>
	<td width="203"><strong>Lokasi Awal </strong><span class="required">*</span> </td>
	<td width="797"><select name="lokasi_awal" class="medium m-wrap">
	  <option>-- Pilih Lokasi Awal --</option>
	  <?php echo $list_awal;?></select></td>
  </tr>
  <tr>
    <td><strong>Lokasi Tujuan</strong> *</td>
    <td><select name="lokasi_tujuan" class="medium m-wrap">
      <option>-- Pilih Lokasi Tujuan --</option>
      <?php echo $list_tujuan;?>
    </select>    </td>
  </tr>
  
  <tr>
    <td>Latitude</td>
    <td><input name="lat" type=text id="lat" size="40" value="<?php echo $lat;?>" class="m-wrap large" readonly /> 
      Longitude : 
      <input name="lng" type=text id="long" size="40" value="<?php echo $lng;?>" class="m-wrap large" readonly /> </td>
  </tr>
  <tr>
    <td>Alamat Lokasi</td>
    <td><label>

    <textarea name="alamat" id="address" class="m-wrap large" style="width:85%" readonly="readonly"><?php echo $alamat;?></textarea>
    </label>
   
      <br>
        <span class="style1">* Latitude-Longitude serta Alamat otomatis tampil ketika peta di Klik</span></td>
  </tr>
  <?php
  if($_GET['action'] == 'edit'){
  ?>
  
  <?php } ?>
  
  <tr>
	<td></td>
	<td>
	<button type="submit" name="save" class="btn blue"><i class="icon-ok"></i> Simpan</button> 
	<button type="button" name="cancel" class="btn" onClick="location.href='<?php echo $link_list;?>'">Batal</button>	</td>
  </tr>
</table>
</form>
