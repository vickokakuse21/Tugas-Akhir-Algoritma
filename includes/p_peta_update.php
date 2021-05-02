<?php
error_reporting(0);
ob_start();
$link_list='?hal=data_peta';
$link_update='?hal=update_peta';
include "fungsi_thumb.php";
$kode='';
$nama='';
if(isset($_POST['save'])){
	$id=$_POST['id'];
	$action=$_POST['action'];
	//echo $action;
	//exit;
	
	$nama=$_POST['nama'];
	$deskripsi=$_POST['deskripsi'];
	$lat=$_POST['lat'];
	$lng=$_POST['lng'];
	$alamat=$_POST['alamat'];
	$id_kategori=$_POST['kategori'];
	$jenis='wisata.png';
	
	 $lokasi_file    = $_FILES['fupload']['tmp_name'];
 	 $tipe_file      = $_FILES['fupload']['type'];
  	$nama_file      = $_FILES['fupload']['name'];
 	
  
	
	if(empty($nama) or empty($deskripsi)){
		$error='Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	}else{
		if($action=='add'){
	
				UploadImage($nama_file);
				$q="insert into peta_wisata(id_kategori,nama,deskripsi,lat,lng,alamat,gambar) values('".$id_kategori."','".$nama."', '".$deskripsi."','".$lat."','".$lng."','".$alamat."','".$nama_file."')";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_list."';</script>");
			
		}
		if($action=='edit'){
			$q=mysqli_query($con,"select * from peta_wisata where id_wisata='".$id."'");
			$h=mysqli_fetch_array($q);
			if (!empty($lokasi_file)){
  				UploadImage($nama_file);
				$q="update peta_wisata set id_kategori='".$id_kategori."',nama='".$nama."', deskripsi='".$deskripsi."',lat='".$lat."',lng='".$lng."',alamat='".$alamat."',gambar='".$nama_file."' where id_wisata='".$id."'";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_list."';</script>");
			}
			else{
		$q="update peta_wisata set id_kategori='".$id_kategori."',nama='".$nama."', deskripsi='".$deskripsi."',lat='".$lat."',lng='".$lng."',alamat='".$alamat."' where id_wisata='".$id."'";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_list."';</script>");
			}
			
			
			
			
			
			
		}
		
	}
}else{
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from peta_wisata where id_wisata='".$id."'");
		$h=mysqli_fetch_array($q);
		$nama=$h['nama'];
		$id_kategori=$h['id_kategori'];
		$deskripsi=$h['deskripsi'];
		$lat=$h['lat'];
		$lng=$h['lng'];
		$alamat=$h['alamat'];
		$gambar=$h['gambar'];
		
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysqli_query($con,"delete from peta_wisata where id_wisata='".$id."'");
		exit("<script>location.href='".$link_list."';</script>");
	}
}


// List Kategori 
$list_kategori=array();
$q="select * from kategori order by id_kategori";
$q=mysqli_query($con,$q);
while($h=mysqli_fetch_array($q)){
	if($h['id_kategori']==$id_kategori){$s=' selected';}else{$s='';}
	$list_kategori.='<option value="'.$h['id_kategori'].'"'.$s.'>'.$h['id_kategori'].' - '.$h['nama_kategori'].'</option>';
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




<h3 class="p2"><?php echo $cetak ?> Data Peta Wisata</h3>

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
<div id="map_canvas" align="left" width=100% height=60%></div>
<table width="100%" border="0" cellspacing="4" cellpadding="4" class="tabel_reg">
  
  <tr>
	<td width="203">Nama Wisata <span class="required">*</span> </td>
	<td width="797"><input name="nama" type="text" size="50" value="<?php echo $nama;?>" class="m-wrap large" style="width: 400px;"></td>
  </tr>
  <tr>
    <td>Kategori Wisata</td>
    <td><select name="kategori" class="medium m-wrap">
      <option value="#">-- Pilih Kategori Wisata --</option>
      <?php echo $list_kategori;?>
    </select></td>
  </tr>
  
  <tr>
    <td>Deskripsi </td>
    <td><label>
      <textarea name="deskripsi" id="textarea" cols="350" rows="5" style="width: 740px; height: 115px;"><?php echo $deskripsi;?></textarea>
    </label></td>
  </tr>
  <tr>
    <td>Latitude</td>
    <td><input name="lat" type=text id="lat" size="40" value="<?php echo $lat;?>" class="m-wrap large" readonly="readonly" /> 
      Longitude : 
      <input name="lng" type=text id="long" size="40" value="<?php echo $lng;?>" class="m-wrap large" readonly="readonly"  /> </td>
  </tr>
  <tr>
    <td>Alamat Lokasi</td>
    <td><input name="alamat" type="text" size="50" id="address" value="<?php echo $alamat;?>" class="m-wrap large" style="width: 550px;" readonly="readonly">
      <br>
        <span class="style1">* Lat-Lang serta Alamat otomatis tampil ketika peta di Atas Anda Klik</span></td>
  </tr>
  <?php
  if($_GET['action'] == 'edit'){
  ?>
  <tr>
    <td>Gambar </td>
    <td><img src="foto_berita/<?php echo $gambar;?>" width="80px" height="50px" ></td>
  </tr>
  <?php } ?>
  <tr>
    <td>Upload Gambar</td>
    <td><input type=file name='fupload' size=40> 
                                          <br>
      * Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td>
  </tr>
  <tr>
	<td></td>
	<td>
	<button type="submit" name="save" class="btn blue"><i class="icon-ok"></i> Simpan</button> 
	<button type="button" name="cancel" class="btn" onClick="location.href='<?php echo $link_list;?>'">Batal</button>	</td>
  </tr>
</table>
</form>
<?php
$locations = mysql_query("SELECT * FROM peta_wisata,kategori where peta_wisata.id_kategori=kategori.id_kategori");
		
			// take the locations from the db one by one
			while ($locat = mysql_fetch_array($locations))
			{
				// add lcoation data to info strings
			
			    $ids .= $locat['id_wisata'].";;";
				$juds .= $locat['judul_seo'].";;";
				$lats .= $locat['lat'].";;";
				$lngs .= $locat['lng'].";;";
				$addresses .= $locat['alamat'].";;";
				$names .= $locat['nama'].";;";
				$descrs .= $locat['deskripsi'].";;";
				$gambars .= $locat['gambar'].";;";
				$jens .= $locat['jenis'].";;";

				 
				// show the location name in the right of the map with link that calls the highlightMarker function
			
				$i++;
				
			
			}
			// hidden inputs for saving the info for all the locations in the db
			
            echo" 
			<input type=hidden value='$ids;' id='ids' name='ids'/>
			<input type=hidden value='$juds;' id='juds' name='juds'/>
			<input type=hidden value='$lats;' id='lats' name='lats'/>
			<input type=hidden value='$lngs;' id='lngs' name='lngs'/>
			<input type=hidden value='$addresses;' id='addresses' name='addresses'/>
			<input type=hidden value='$jadwal;' id='jadwal' name='jadwal'/>
			<input type=hidden value='$status;' id='status' name='status'/>
			<input type=hidden value='$names;' id='names' name='names'/>
			<input type=hidden value='$descrs;' id='descrs' name='descrs'/>
			<input type=hidden value='$nops;' id='nops' name='nops'/>
			<input type=hidden value='$gambars;' id='gambars' name='gambars'/>
			<input type=hidden value='$jens;' id='jens' name='jens'/>";
            
			










?>