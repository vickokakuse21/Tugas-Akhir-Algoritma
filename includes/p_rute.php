<?php
$link_list='?hal=data_rute';
$link_update='?hal=update_rute';

$daftar='';$no=0;
$q="select * from rute_wisata order by id_rute";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$id=$h['id_rute'];
		
		
		
		$daftar.='
		  <tr>
			<td valign="top">'.$no.'</td>
		
		
			<td valign="top">'.$h['lokasi_awal'].'</td>
			<td valign="top">'.$h['lokasi_tujuan'].'</td>
			
			<td valign="top">'.$h['alamat'].'</td>
			<td valign="top">'.$h['nilai'].'</td>
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

<h3 class="p2">Rute Angkot</h3>
<a href="<?php echo $link_update;?>" class="btn blue" style="float:right"><i class="icon-plus"></i> Tambah Data</a><br /><br />
<table width="1077" class="table table-striped table-hover table-bordered">
<thead>
		<tr>
			<th width="51">No</th>
		
		  <th width="143">Lokasi Awal</th>
          <th width="153">Lokasi Tujuan</th>
          <th width="270">Alamat</th>
		  <th width="123" align="right">Nilai Heuristik</th>
		  <th width="123" align="right">Control</th>
    </tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
