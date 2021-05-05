<?php
$link_list='?hal=data_berita';
$link_update='?hal=update_berita';

$daftar='';$no=0;
$q="select * from berita order by id_berita";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$id=$h['id_berita'];
		
		 $isi_berita = nl2br($h[berita]); // membuat paragraf pada isi berita
      	 $isi = substr($isi_berita,0,150); // ambil sebanyak 150 karakter
     	 $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
		
		
		
		$daftar.='
		  <tr>
			<td valign="top">'.$no.'</td>
			<td valign="top">'.$h['judul'].'</td>
			<td valign="top">'.$isi.'</td>
			<td valign="top">'.$h['tanggal'].'</td>
		
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

<h3 class="p2">Berita Terkini</h3>
<a href="<?php echo $link_update;?>" class="btn blue" style="float:right"><i class="icon-plus"></i> Tambah Data</a><br /><br />
<table width="1017" class="table table-striped table-hover table-bordered">
<thead>
		<tr>
			<th width="66">No</th>
		  <th width="135">Judul Berita</th>
			<th width="323">Berita</th>
            <th width="124">Tanggal Post</th>
           
          <th width="144">Foto</th>
			<th width="197" align="right">Control</th>
    </tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
