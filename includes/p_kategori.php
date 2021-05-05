<?php
$link_list='?hal=data_kategori';
$link_update='?hal=update_kategori';

$daftar='';$no=0;
$q="select * from kategori order by id_kategori";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$id=$h['id_kategori'];
		
		$daftar.='
		  <tr>
			<td valign="top">'.$no.'</td>
			<td valign="top">'.$h['nama_kategori'].'</td>
		
			<td valign="top">'.$h['aktif'].'</td>
		
			<td valign="top" align="center">'."<img src='icon/$h[jenis]' width=50px height=50px >". '</td>
			
			
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

<h3 class="p2">Kategori Lokasi</h3>
<a href="<?php echo $link_update;?>" class="btn blue" style="float:right"><i class="icon-plus"></i> Tambah Data</a><br /><br />
<table width="1017" class="table table-striped table-hover table-bordered">
<thead>
		<tr>
			<th width="77">No</th>
		  <th width="158">Nama Kategori</th>
			<th width="378">Aktif</th>
          <th width="98">Jenis</th>
           
          
			<th width="282" align="right">Control</th>
    </tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
