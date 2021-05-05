<?php
$link_list='?hal=data_peta';
$link_update='?hal=update_peta';

$daftar='';$no=0;
$q="select * from peta_wisata order by id_wisata";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$id=$h['id_wisata'];
		
		$isi_berita = nl2br($h[deskripsi]); // membuat paragraf pada isi berita
      	 $isi = substr($isi_berita,0,150); // ambil sebanyak 150 karakter
     	 $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
		
		$daftar.='
		  <tr>
			<td valign="top">'.$no.'</td>
		
			<td valign="top">'.$h['nama'].'</td>
			<td valign="top">'.$isi.'</td>
			<td valign="top">'.$h['lat'].' |  '.$h['lng'].'</td>
			
			<td valign="top" align="center">'."<img src='foto_berita/$h[gambar]' width=80px height=50px >". '</td>
			<td align="center" valign="top"><a href="'.$link_update.'&amp;id='.$id.'&amp;action=edit" class="btn"><i class="icon-edit"></i></a> <a href="#" onclick="DeleteConfirm(\''.$link_update.'&amp;id='.$id.'&amp;action=delete\');return(false);" class="btn"><i class="icon-trash"></i></a></td>
		  </tr>
		';
	}
}


?>
<script language="javascript">
function DeleteConfirm(url){
	if (confirm("Anda yakin akan menghapus data ini ?")){
		window.location.href=url;
	}
}
</script>

<h3 class="p2">Keterangan Titik</h3>
<a href="<?php echo $link_update;?>" class="btn blue" style="float:right"><i class="icon-plus"></i> Tambah Data</a><br /><br />
<table width="1017" class="table table-striped table-hover table-bordered">
<thead>
		<tr>
			<th width="44">No</th>
		 
			<th width="268">Lokasi Titik</th>
          <th width="258">Deskripsi</th>
           <th width="160">Lat-Lng</th>
          <th width="118">Foto</th>
		  <th width="141" align="right">Control</th>
    </tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
