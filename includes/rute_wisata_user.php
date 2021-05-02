<?php
session_start();
error_reporting(0);
ob_start();
// List Peta Wisata
$list_kategori=array();
$q="select * from peta_wisata order by id_wisata";
$q=mysqli_query($con,$q);
while($h=mysqli_fetch_array($q)){
	if($h['id_wisata']==$id_wisata){$s=' selected';}else{$s='';}
	$list_kategori.='<option value="'.$h['nama'].'"'.$s.'>'.$h['nama'].'</option>';
}
?>
<style type="text/css">
/*.style1 {color: #FF0000} */
</style>

<h3 class="p2"> Rute Wisata</h3>

<form action="" name="" method="post" enctype="multipart/form-data">
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
	<td width="203">Lokasi Awal <span class="required">*</span> </td>
	<td width="797"><select name="lokasi_awal" class="medium m-wrap">
      <option value="">-- Objek Wisata Asal --</option>
      <?php echo $list_kategori;?>
    </select></td>
  </tr>
  <tr>
    <td>Lokasi Tujuan </td>
    <td><select name="lokasi_tujuan" class="medium m-wrap">
      <option value="">-- Objek Wisata Tujuan --</option>
      <?php echo $list_kategori;?>
    </select></td>
  </tr>
  <tr>
    <td>Pilih Algoritma *</td>
    <td>
      <label>
        <input type="radio" name="algoritma" value="Djikstra">
        Algoritma Djikstra</label>
   
      <label>
        <input type="radio" name="algoritma" value="Astar">
        Algoritma A*</label>
     </td>
  </tr>
  
  
  
  <tr>
	<td></td>
	<td>
	<button type="submit" name="lihat_rute" class="btn blue"><i class="icon-ok"></i> Lihat Rute</button> 
	<button type="button" name="cancel" class="btn" onClick="location.href='<?php echo $link_list;?>'">Batal</button>	</td>
  </tr>
</table>
</form>
<?php
if(isset($_POST['lihat_rute'])){
$lokasi_awal=$_POST['lokasi_awal'];
$lokasi_tujuan=$_POST['lokasi_tujuan'];
$algoritma=$_POST['algoritma'];


if(empty($lokasi_awal) or empty($lokasi_tujuan) or empty($algoritma)){
		echo "<script>window.alert('Periksa Kembali Form Anda');
                window.location=('pengunjung.php?hal=rute_wisata_user')</script>";
	}
else{

		
		
		
	

















// Algoritma Djikstra
if($algoritma=="Djikstra"){

$daftar='';$no=0;
$q="select * from rute_wisata where lokasi_awal='".$lokasi_awal."'";

//echo $q;

$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$id=$h['id_rute'];
		
		$lokasi_pertama="select alamat from peta_wisata where nama='".$lokasi_awal."'";
		$lokasi_pertama2=mysqli_query($con,$lokasi_pertama);
		$lokasi_pertama3=mysqli_fetch_array($lokasi_pertama2);
		// Hitung Jarak dan Waktu
		//echo $lokasi_pertama3['alamat'];
		
		

		$asal   = !empty($lokasi_pertama3['alamat']) ? urlencode($lokasi_pertama3['alamat']) : null;
 
		$tujuan = !empty($h['alamat']) ? urlencode($h['alamat']) : null;
 
		
 
 		$urlApi = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$asal."&destinations=".$tujuan."&key=AIzaSyB2Xd4GJtDxGPUI7nlMV-I99x5EQqYqhGc";
 
 
		$result = file_get_contents($urlApi);
 
		$data   = json_decode($result, true);
		
		$q1="update rute_wisata set waktu='".$data['rows'][0]['elements'][0]['duration']['text']."',km='".$data['rows'][0]['elements'][0]['distance']['text']."' where id_rute='".$id."'";
				mysqli_query($con,$q1);
		
		
		
		$daftar.='
		  <tr>
			<td valign="top">'.$h['lokasi_awal'].'</td>
			<td valign="top">'.$h['lokasi_tujuan'].'</td>
			<td valign="top">'.$h['alamat'].'</td>
			<td valign="top">'.$data['rows'][0]['elements'][0]['duration']['text'].'</td>
			<td valign="top">'.$data['rows'][0]['elements'][0]['distance']['text'].'</td>
		
			
			
		  </tr>
		';
	}
}






?>
<br/>
<h2>Hasil Pengujian Pencarian Rute Terpendek <?php echo $algoritma; ?> </h2>
<table width="1017" class="table table-striped table-hover table-bordered">
<thead>
		<tr>
		  <th width="228">Objek Asal</th>
			<th width="192">Objek Tujuan</th>
            <th width="314">Rute Perjalanan dengan Algoritma <?php echo $algoritma; ?> </th>
           
            <th width="162">Waktu</th>
			<th width="97" align="right">Jarak</th>
    </tr>
  </thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
<br />
<h3 align="center"> ::: Hasil Pencarian Rute Jalan Menggunakan Algoritma <?php echo $algoritma ?> :::</h3>

<?php
// Ambil nilai MIN KM
$q3="SELECT MIN(km) as km FROM rute_wisata where lokasi_awal='".$lokasi_awal."'";
$q4=mysqli_query($con,$q3);
$h5=mysqli_fetch_array($q4);
$km=$h5['km'];

//echo $q3;
// Select Dataa
$q6="SELECT * FROM rute_wisata where km='".$km."'";

//echo $q6;
$q7=mysqli_query($con,$q6);

$h4=mysqli_fetch_array($q7);
$lokasi_awal1=$h4['lokasi_awal'];
$lokasi_tujuan1=$h4['lokasi_tujuan'];
$waktu1=$h4['waktu'];
$km1=$h4['km'];





$alamat1=$h4['alamat'];


		$lokasi_pertama="select alamat from peta_wisata where nama='".$lokasi_awal."'";
		$lokasi_pertama2=mysqli_query($con,$lokasi_pertama);
		$lokasi_pertama3=mysqli_fetch_array($lokasi_pertama2);
		$alamat0=$lokasi_pertama3['alamat'];

		$lokasi_pertama10="select km,alamat from rute_wisata where lokasi_awal='".$lokasi_awal."' and lokasi_tujuan='".$lokasi_tujuan."'";
		$lokasi_pertama20=mysqli_query($con,$lokasi_pertama10);
		$lokasi_pertama30=mysqli_fetch_array($lokasi_pertama20);
		
		$km5=$lokasi_pertama30['km'];
		$alamat20=$lokasi_pertama30['alamat'];

		if($alamat20==""){
			$notifalamat="Rute Perjalanan Tidak di Temukan di dalam database";
			$nilaikm="Jarak Tidak Diketahui";
		}
		else{
		$notifalamat=$lokasi_pertama30['alamat'];
		$nilaikm=$lokasi_pertama30['km'];
		}
		
		



?>
<table width="100%" border="1">
  <tr>
    <td width="33%">Lokasi Awal</td>
    <td width="1%">:</td>
    <td width="66%"><?php echo $lokasi_awal; ?></td>
  </tr>
  <tr>
    <td>Lokasi Tujuan </td>
    <td>:</td>
    <td><?php echo $lokasi_tujuan; ?></td>
  </tr>
  <tr>
    <td>Rute Perjalanan Anda</td>
    <td>:</td>
    <td><?php echo $notifalamat; ?></td>
  </tr>
  <tr>
    <td>Jarak Tempuh </td>
    <td>:</td>
    <td><b><?php echo $nilaikm; ?> </b></td>
  </tr>
  <tr>
    <td>Silahkan Lihat Pada Peta Rute Perjalanan Anda </td>
    <td>&nbsp;</td>
    <td><input type="hidden" id="start"  value="<?php echo $lokasi_awal; ?>">
		<input type="hidden" id="end" value="<?php echo $lokasi_tujuan; ?>">
	
<button id="lihat">Lihat Jalur</button></td>
  </tr>
</table>
<br />
<div id="map_canvas2" style="width: 100%; height: 400px;"></div>
<div id="directions"></div>
<?php
// Tutup Djikstra
}
else{
// Ini Rumuas Algoritma A*
?>
<?php
$daftar='';$no=0;
$q="select * from rute_wisata where lokasi_awal='".$lokasi_awal."'";
$q=mysqli_query($con,$q);
if(mysqli_num_rows($q) > 0){
	while($h=mysqli_fetch_array($q)){
		$no++;
		$id=$h['id_rute'];
		
		$lokasi_pertama="select alamat from peta_wisata where nama='".$lokasi_awal."'";
		$lokasi_pertama2=mysqli_query($con,$lokasi_pertama);
		$lokasi_pertama3=mysqli_fetch_array($lokasi_pertama2);
		// Hitung Jarak dan Waktu
		//echo $lokasi_pertama3['alamat'];
		
		

		$asal   = !empty($lokasi_pertama3['alamat']) ? urlencode($lokasi_pertama3['alamat']) : null;
 
		$tujuan = !empty($h['alamat']) ? urlencode($h['alamat']) : null;
 
		
 
 		$urlApi = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$asal."&destinations=".$tujuan."&key=AIzaSyB2Xd4GJtDxGPUI7nlMV-I99x5EQqYqhGc";
 
 
		$result = file_get_contents($urlApi);
 
		$data   = json_decode($result, true);
		
		$total_rows="SELECT COUNT(*) as total FROM rute_wisata where lokasi_awal='".$lokasi_awal."'";
		$total=mysqli_query($con,$total_rows);
		$totaloke=mysqli_fetch_array($total);
		$asli=$totaloke['total'];
		
		$time_star=$data['rows'][0]['elements'][0]['duration']['text'];
		$km_star=$data['rows'][0]['elements'][0]['distance']['text'];
		
		
		$heuristik=$km_star*$h['nilai'];
		$kecepatan=($km_star/$time_star);
		$waktuoke=round($kecepatan+$time_star);
		
		
		
		$q1="update rute_wisata set waktu='".$waktuoke."',km='".$km_star."' where id_rute='".$id."'";
				mysqli_query($con,$q1);
		
		
		
		$daftar.='
		  <tr>
			<td valign="top">'.$h['lokasi_awal'].'</td>
			<td valign="top">'.$h['lokasi_tujuan'].'</td>
			<td valign="top">'.$h['alamat'].'</td>
			<td valign="top">'.$waktuoke.' Menit</td>
			<td valign="top">'.$km_star.'</td>
		
			<td valign="top">'.$heuristik.'</td>
			
		  </tr>
		';
	}
}






?>
<br/>
<h2>Hasil Pengujian Pencarian Rute Terpendek <?php echo $algoritma; ?> </h2>
<table width="1017" class="table table-striped table-hover table-bordered">
<thead>
		<tr>
		  <th width="228">Objek Asal</th>
			<th width="192">Objek Tujuan</th>
            <th width="314">Rute Perjalanan dengan Algoritma <?php echo $algoritma; ?> </th>
           
            <th width="162">Waktu</th>
			<th width="97" align="right">Jarak</th>
            <th width="97" align="right">Hasil Heuristik</th>
	</tr>
	</thead>
	<tbody>
		<?php echo $daftar;?>
	</tbody>
</table>
<br />
<h3 align="center"> ::: Hasil Pencarian Rute Jalan Menggunakan Algoritma <?php echo $algoritma ?> :::</h3>

<?php
// Ambil nilai MIN KM
$q3="SELECT MIN(km) as km FROM rute_wisata where lokasi_awal='".$lokasi_awal."'";

//echo $q3;
$q4=mysqli_query($con,$q3);
$h5=mysqli_fetch_array($q4);
$km=$h5['km'];

//echo $q3;
// Select Dataa
$q6="SELECT * FROM rute_wisata where km='".$km."'";

//echo $q6;
$q7=mysqli_query($con,$q6);

$h4=mysqli_fetch_array($q7);
$lokasi_awal1=$h4['lokasi_awal'];
$lokasi_tujuan1=$h4['lokasi_tujuan'];
$waktu1=$h4['waktu'];
$km1=$h4['km'];
$alamat1=$h4['alamat'];

		$lokasi_pertama="select alamat from peta_wisata where nama='".$lokasi_awal."'";
		$lokasi_pertama2=mysqli_query($con,$lokasi_pertama);
		$lokasi_pertama3=mysqli_fetch_array($lokasi_pertama2);
		$alamat0=$lokasi_pertama3['alamat'];
		
		$lokasi_pertama10="select km,alamat from rute_wisata where lokasi_awal='".$lokasi_awal."' and lokasi_tujuan='".$lokasi_tujuan."'";
		$lokasi_pertama20=mysqli_query($con,$lokasi_pertama10);
		$lokasi_pertama30=mysqli_fetch_array($lokasi_pertama20);
		
		$km5=$lokasi_pertama30['km'];
		
		$alamat20=$lokasi_pertama30['alamat'];
		
		if($alamat20==""){
			$notifalamat="Rute Perjalanan Tidak di Temukan di dalam database";
			$nilaikm="Jarak Tidak Diketahui";
		}
		else{
		$notifalamat=$lokasi_pertama30['alamat'];
		$nilaikm=$lokasi_pertama30['km'];
		}
		
?>
<table width="100%" border="1">
  <tr>
    <td width="33%">Lokasi Awal</td>
    <td width="1%">:</td>
    <td width="66%"><?php echo $lokasi_awal; ?></td>
  </tr>
  <tr>
    <td>Lokasi Tujuan </td>
    <td>:</td>
    <td><?php echo $lokasi_tujuan; ?></td>
  </tr>
  <tr>
    <td>Rute Perjalanan Anda</td>
    <td>:</td>
    <td><?php echo $notifalamat; ?></td>
  </tr>
  <tr>
    <td>Jarak Tempuh </td>
    <td>:</td>
    <td><b><?php echo $nilaikm; ?> </b></td>
  </tr>
  
  
  <tr>
    <td>Silahkan Lihat Pada Peta Rute Perjalanan Anda </td>
    <td>&nbsp;</td>
    <td><input type="hidden" id="start"  value="<?php echo $lokasi_awal; ?>">
		<input type="hidden" id="end" value="<?php echo $lokasi_tujuan; ?>">
	
<button id="lihat">Lihat Jalur</button></td>
  </tr>
</table>
<br />
<div id="map_canvas2" style="width: 100%; height: 400px;"></div>
<div id="directions"></div>






<?php
}
}
}
?>



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Xd4GJtDxGPUI7nlMV-I99x5EQqYqhGc&callback=initialize">
<script type="text/javascript" src="js/maps_js.js"></script>
<script type="text/javascript">
function init(){
 var service = new google.maps.DirectionsService;
 var view = new google.maps.DirectionsRenderer;

 var info_window = new google.maps.InfoWindow();
 var zoom = 10;

 var pos = new google.maps.LatLng(-6.751732, 111.038382);
 var options = {
  'center': pos,
  'zoom': zoom,
  'mapTypeId': google.maps.MapTypeId.ROADMAP
 };

 var map = new google.maps.Map(document.getElementById('map_canvas2'), options);
 view.setMap(map);
 info_window = new google.maps.InfoWindow({
  'content': 'loading...'
 });

 var result = function(){
  lihat(service, view);
 }
 document.getElementById('lihat').addEventListener('click', result)
}
function lihat(service, view){
 var start = document.getElementById('start').value;
 var end = document.getElementById('end').value;

 var request = {
  origin: start,
  destination: end,
  travelMode: google.maps.TravelMode.DRIVING
 };

 service.route(request, function(response, status){
  if(status == google.maps.DirectionsStatus.OK){
   view.setDirections(response);
  }else{
   window.alert('Directions request failed due to ' + status);
  }
 });
}
google.maps.event.addDomListener(window, 'load', init);




function calcRoute(start, end, mode) {
				var request = {
					origin:start,
					destination:end,
					travelMode: google.maps.TravelMode[mode]
				};
				directionsService.route(request, function(result, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(result);
					}
				});
				
				directionsDisplay.setMap(map);

				/*Show directions panel*/
				directionsDisplay.setPanel(document.getElementById("directions"));
			}



</script>













