<?php
$link_list='?hal=buku_tamu';
$link_update='?hal=update_buku_tamu';

$daftar='';$no=0;
$q="select * from buku_tamu order by id_buku_tamu";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$id=$h['id_buku_tamu'];
		
		$daftar.='
		  <tr>
			<td valign="top">'.$no.'</td>
			<td valign="top">'.$h['nama'].'</td>
			<td valign="top">'.$h['email'].'</td>
			<td valign="top">'.$h['company'].'</td>
			<td valign="top">'.$h['telepon'].'</td>
			<td valign="top">'.$h['subjek'].'</td>
			<td valign="top">'.$h['pesan'].'</td>		
			
			<td align="center" valign="top"><a href="#" onclick="DeleteConfirm(\''.$link_update.'&amp;id='.$id.'&amp;action=delete\');return(false);" class="btn"><i class="icon-trash"></i></a></td>
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

<h3 class="p2">Buku Tamu</h3>

<table width="100%" class="table table-striped table-hover table-bordered">
<thead>
		<tr>
			<th width="53">No</th>
		  <th width="183">Nama Pengirim</th>
			<th width="164">E-mail</th>
            <th width="118">Company</th>
            <th width="105">Telepon</th>
           <th width="92">Subjek</th>
          <th width="177">Pesan</th>
			<th width="113" align="right">Control</th>
    </tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
