<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>

<?php
error_reporting(0);
ob_start();
$link_list='?hal=buku_tamu';
$link_update='?hal=update_buku_tamu';
include "fungsi_thumb.php";
$kode='';
$nama='';
if(isset($_POST['save'])){
	$id=$_POST['id'];
	$action=$_POST['action'];
	//echo $action;
	//exit;
	
	$judul=$_POST['judul'];
	$berita=$_POST['berita'];
	$tanggal=$_POST['tanggal'];

	 $lokasi_file    = $_FILES['fupload']['tmp_name'];
 	 $tipe_file      = $_FILES['fupload']['type'];
  	$nama_file      = $_FILES['fupload']['name'];
 	
  
	
	if(empty($judul) or empty($berita)){
		$error='Masih ada beberapa kesalahan. Silahkan periksa lagi form di bawah ini.';
	}else{
		if($action=='add'){
	
				UploadImage($nama_file);
				$q="insert into berita(judul,berita,tanggal,gambar) values('".$judul."', '".$berita."','".$tanggal."','".$nama_file."')";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_list."';</script>");
			
		}
		if($action=='edit'){
			$q=mysqli_query($con,"select * from berita where id_berita='".$id."'");
			$h=mysqli_fetch_array($q);
			if (!empty($lokasi_file)){
  				UploadImage($nama_file);
				$q="update berita set judul='".$judul."', berita='".$berita."',tanggal='".$tanggal."',gambar='".$nama_file."' where id_berita='".$id."'";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_list."';</script>");
			}
			else{
		$q="update berita set judul='".$judul."', berita='".$berita."',tanggal='".$tanggal."' where id_berita='".$id."'";
				mysqli_query($con,$q);
				exit("<script>location.href='".$link_list."';</script>");
			}
			
			
			
			
			
			
		}
		
	}
}else{
	if(empty($_GET['action'])){$action='add';}else{$action=$_GET['action'];}
	if($action=='edit'){
		$id=$_GET['id'];
		$q=mysqli_query($con,"select * from berita where id_berita='".$id."'");
		$h=mysqli_fetch_array($q);
		$judul=$h['judul'];
		$berita=$h['berita'];
		$tanggal=$h['tanggal'];
		$gambar=$h['gambar'];
		
	}
	if($action=='delete'){
		$id=$_GET['id'];
		mysqli_query($con,"delete from buku_tamu where id_buku_tamu='".$id."'");
		exit("<script>location.href='".$link_list."';</script>");
	}
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



<h3 class="p2"><?php echo $cetak ?> Data Berita</h3>

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

<table width="100%" border="0" cellspacing="4" cellpadding="4" class="tabel_reg">
  <tr>
	<td width="153">Judul Berita <span class="required">*</span> </td>
	<td width="852"><input name="judul" type="text" size="50" value="<?php echo $judul;?>" class="m-wrap large" style="width: 400px;"></td>
  </tr>
  
  <tr>
    <td>Isi Berita</td>
    <td><label>
      <textarea name="berita" id="textarea" cols="350" rows="5" style="width: 740px; height: 115px;"><?php echo $berita;?></textarea>
    </label></td>
  </tr>
  <tr>
    <td>Tanggal Posting</td>
    <td><input name="tanggal" type="text" size="40" id="datepicker" value="<?php echo $tanggal;?>" class="m-wrap large" /></td>
  </tr>
  <?php
  if($_GET['action'] == 'edit'){
  ?>
  <tr>
    <td>Gambar </td>
    <td><img src=foto_berita/<?php echo $h[gambar];?> width=80px height=50px ></td>
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
