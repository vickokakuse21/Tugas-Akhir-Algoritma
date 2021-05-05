<?php
include "tanggal.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="xhtml/index.html">

<head>

	<title>Algoritma A* dan Algoritma Dijkstra</title>
	<meta name="description" content="Algoritma A* | Algoritma Dijkstra "/>
	<meta name="keywords" content="Algoritma A* | Algoritma Dijkstra "/>
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1"/>
	<meta http-equiv="content-language" content="en"/>
	<link rel="stylesheet" type="text/css" media="screen" title="screen" href="css/reset.css"/>
	<link rel="stylesheet" type="text/css" media="screen" title="screen" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" media="screen" title="screen" href="css/template_style.css"/>
    <link rel="stylesheet" type="text/css" media="screen" title="screen" href="css/bootstrap.css"/>
     
   <link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.3.2.min.js"></script>
	<script src="js/jquery-1.7.2.js"></script>
    
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.datepicker.js"></script>
    <script src="js/jquery.ui.timepicker.js?v=0.3.3"></script>
    
    <!-- drop down menu -->
    <link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen" />
    <script type="text/javascript" src="js/hoverIntent.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript">
		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
	</script>
    
    <!-- clients list fade effect --> 
    <script type="text/javascript" src="js/innerfade/jquery.innerfade.js"></script>
		<script type="text/javascript">
	   $(document).ready(
				function(){		
					$('ul#clients').innerfade({
						speed: 1000,
						timeout: 3000,
						type: 'sequence',
						containerheight: '53px'
					});
			});
  	</script>
<script type="text/javascript">    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayTime(){
        //buat object date berdasarkan waktu saat ini
        var time = new Date();
        //ambil nilai jam,
        //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
        var sh = time.getHours() + "";
        //ambil nilai menit
        var sm = time.getMinutes() + "";
        //ambil nilai detik
        var ss = time.getSeconds() + "";
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>

<script>

// memeriksa apakah pengguna menyediakan semua data untuk menambahkan lokasi baru
function check()
{
	if (document.getElementById('lat').value == "" || document.getElementById('long').value == "" || document.getElementById('address').value == "")
	{
		alert("Click on the map to choose location!");
		return false;
	}
	
if (document.getElementById('id_locations').value == "")
	{
		alert("Write a name for the new location!");
		return false;
	}
	
	if (document.getElementById('judul_seo').value == "")
	{
		alert("Write a description for the new location!");
		return false;
	}
	
	if (document.getElementById('judul').value == "")
	{
		alert("Write a name for the new location!");
		return false;
	}
	
	if (document.getElementById('description').value == "")
	{
		alert("Write a description for the new location!");
		return false;
	}
	

	if (document.getElementById('telepon').value == "")
	{
		alert("Write a nomor pemilik for the new location!");
		return false;
	}
	

	if (document.getElementById('gambar').value == "")
	{
		alert("Choose a gambar for the new location!");
		return false;
	}

}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Xd4GJtDxGPUI7nlMV-I99x5EQqYqhGc&callback=initialize">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
	
	
var geocoder;
var map;

var directionsDisplay = new google.maps.DirectionsRenderer();
var directionsService = new google.maps.DirectionsService();

function initialize()
	{

		
		var pati = new google.maps.LatLng(-6.751732, 111.038382);
		
		// define map options
		var myOptions = {
			zoom: 10,
			center: pati,

			mapTypeId: google.maps.MapTypeId.ROADMAP,
			
		};
	
	
		// initialize map
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		// menambahkan pendengar acara ketika pengguna mengklik pada peta
		google.maps.event.addListener(map, 'click', function(event) {
			findAddress(event.latLng);
		});
		
		}

	// menemukan alamat untuk lokasi yang diberikan
	function findAddress(loc)
	{
		geocoder = new google.maps.Geocoder(); 
		
		if (geocoder) 
		{
			geocoder.geocode({'latLng': loc}, function(results, status) 
			{
				if (status == google.maps.GeocoderStatus.OK) 
				{
					if (results[0]) 
					{
						address = results[0].formatted_address;
						
						// fill in the results in the form
						document.getElementById('lat').value = loc.lat();
						document.getElementById('long').value = loc.lng();
						document.getElementById('address').value = address;
					}
				} 
				else 
				{
					alert("Geocoder failed due to: " + status);
				}
			});
		}
	}
	
	
	
	// initialize the array of markers
	var markers = new Array();
	
	// fungsi yang menambahkan spidol untuk peta
	function addMarkers()
	{
		// get the values for the markers from the hidden elements in the form
        var ids = document.getElementById('ids').value;
		var juds = document.getElementById('juds').value;
		var lats = document.getElementById('lats').value;
		var lngs = document.getElementById('lngs').value;
		var addresses = document.getElementById('addresses').value;
		var names = document.getElementById('names').value;
		var descrs = document.getElementById('descrs').value;
		var nops = document.getElementById('nops').value;
		var gambars = document.getElementById('gambars').value;
		var jens = document.getElementById('jens').value;
	
        var is  = ids.split(";;")
		var jds = juds.split(";;")
		var las = lats.split(";;")
		var lgs = lngs.split(";;")
		var ads = addresses.split(";;")
		var nms = names.split(";;")
		var dss = descrs.split(";;")
		var nop = nops.split(";;")
		var gbr = gambars.split(";;")
		var jns  = jens.split(";;")
	
		
		
		// untuk setiap lokasi, membuat penanda baru dan infowindow untuk itu
		for (i=0; i<las.length; i++)
		{
			if (las[i] != "")
			{
				// add marker	
				set_icon(jns[i]);			
				var loc = new google.maps.LatLng(las[i],lgs[i]);
				var marker = new google.maps.Marker({
					position: loc, 
					map: window.map,
					icon: gambar_tanda,
					title: nms[i]
					
				});
			
				
				markers[i] = marker;
				
				var contentString = [
				
  				// buat tooltips tabs
				  '<div id="tabsview">',
					'<div id="tab1" class="tab_sel" onClick="javascript: displayPanel(1);" align="center">&nbsp; Photo &nbsp;</div>',
					
					
				  '</div>',
				  
				'<div class="tab_bdr">','</div>',
				// tampilan tabs 1
				  '<div class="panel" id="panel1" style="display: block;">',
				  '<span>',
				  '<ul>',				      				  
					  '<table>',
				    
					'<tr>',
					  '<td align="left">','<a id="galeri" href="foto_berita/'+gbr[i]+'" title='+nms[i]+'>','<img src="foto_berita/'+gbr[i]+'"/>'+'</a>',
					  
					  '</td>','</tr>',
					  '</table>',
					  
				  '</ul>',
				  '</span>',
				  '</div>',
				  
				 
				  
				// akhir tampilan tabs
				  
				].join('');
				
				var infowindow = new google.maps.InfoWindow;
				
				bindInfoWindow(marker, window.map, infowindow, contentString);
			}
		}
	}
	
	// membuat sambungan antara jendela info dan penanda (jendela info yang muncul ketika pengguna pergi dengan mouse di atas penanda)
	function bindInfoWindow(marker, map, infoWindow, contentString)
	{
		google.maps.event.addListener(marker, 'click', function() {
			
			map.setCenter(marker.getPosition());
			
			infoWindow.setContent(contentString);
			infoWindow.open(map, marker);
			$("#tabs").tabs();
		 });
		 
	}



function set_icon(jenisnya){
    switch(jenisnya){
         case "lokasi_umum.png":
            gambar_tanda = 'icon/lokasi_umum.png';
            break;
        case "wisata.png":
            gambar_tanda = 'icon/wisata.png';
            break;
		
    }
}
jQuery(document).ready(function(){		
	/*Function for creating the roadmap*/
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
			
			jQuery('#driveit').click(function(){
			
			
				var srcAddr = jQuery('#address').val();
				var destAddr = jQuery('#to').val();
				var mode = jQuery('#mode').val();
				calcRoute(srcAddr, destAddr, mode);
			});
	
				
	});

</script>
<script src="js/jquery-1.4.3.min.js" type="text/javascript"></script>








</head>
<body onload="initialize(); addMarkers()">

<div id="main_container">
	
    <div id="header_wrap">
      <!-- end #client_login -->
	  <a id="logo_link" href="index.php"></a>
	  <!-- end #logo_link	 -->
  </div>
<!-- end #header_wrap -->
	
    <div id="menu_wrap">
    
        <ul class="sf-menu">
            <li>
                <a href="./">Home</a>
            </li>
            
            <li> <a href="?hal=data_berita">Berita</a></li>
             <li> <a href="?hal=data_kategori">Kategori Peta</a></li>
             <li> <a href="?hal=data_peta">Peta Wisata</a></li>
                <li> <a href="?hal=data_rute">Setting Rute</a></li>
               
				<!--<li> <a href="?hal=buku_tamu">Buku Tamu</a></li>-->
            
            <li><a href="?hal=ubah_password">Ubah Password</a></li>

	    <li>
                <a href="logout.php">Logout</a>
            </li>	
		</ul><!-- end .sf-menu --> 
    	
      
    </div><!-- end #menu_wrap -->
    
    <div id="content_wrap">
    	<div id="content">
            <?php eval($CONTENT_["main"]);?>
           
                
          

           
                      
   
            

           
      </div>
<!-- end #content -->
        
        
        <div id="sidebar"></div>
    <!-- end #sidebar -->
        
        <div class="clear"></div>  <!-- end #clear -->  
        
    </div><!-- end #content_wrap -->
  <!-- end #features_wrap -->
  <!-- end #clients_wrap -->
</div>
<!-- end #main_container -->

<div id="footer_container">
	 <div id="footer">
	 <!--&copy; Copyright 2016 <a href="">Algoritma A* | Algoritma Dijkstra </a>.-->
       <!-- end #footer_menu -->
  </div>
  <!-- end #clients_wrap -->
</div><!-- end #footer_container -->

</body>

<!-- Mirrored from charismaticmedia.com/themes/prolucrative/blue/about.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 04 Jul 2014 23:40:29 GMT -->
</html>
