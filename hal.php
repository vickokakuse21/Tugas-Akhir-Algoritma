<?php
session_start();
unset($_SESSION['username']);
require_once 'config.php';
require_once 'page.php';
include "tanggal.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="www.w3.org/1999/xhtml/index.html">
<head>

	<title>Algoritma Dijkstra dan Astar</title>
	<meta name="description" content="Algoritma A* | Algoritma Dijkstra"/>
	<meta name="keywords" content="Algoritma A* | Algoritma Dijkstra"/>
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1"/>
	<meta http-equiv="content-language" content="en"/>
	<link rel="stylesheet" type="text/css" media="screen" title="screen" href="css/reset.css"/>
	<link rel="stylesheet" type="text/css" media="screen" title="screen" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" media="screen" title="screen" href="css/template_style.css"/>
    
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
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
    
    <!-- Banner Annimation -->
    <script type="text/javascript" src="js/jCarousel/jcarousellite_1.0.1.pack.js"></script>
	<script type="text/javascript">
		$(function() {
			$("#slideshow").jCarouselLite({
				btnNext: ".next",
				btnPrev: ".prev",
				vertical: true ,
				speed: 500,
				auto:4000,
				visible: 1
			});
		
			$("#slideshow2").jCarouselLite({
				btnNext: ".next",
				btnPrev: ".prev",
				visible: 1, 
				auto:4000,
				speed:500		
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
    <style type="text/css">
    /*.style1 {color: #00ff00} */
    </style>
</head>
<body onload="displayTime();setInterval('displayTime()', 1000);">

<div id="main_container">
    <div id="header_wrap">
    	<div id="client_login">
            <form method="post" id="loginform" action="login.php">
            <label class="client_label">Login :</label>
            <input type="text" placeholder="USERNAME" name="username"/>
            <input type="password" placeholder="PASSWORD" name="password" />
            <input type="submit"  value="Login" name="login" />
            </form>
        </div>
    	<!-- end #client_login -->
    </div><!-- end #header_wrap -->
	<div id="menu_wrap">
        <ul class="sf-menu">
            <li>
                <a href="index.php">Beranda</a>
            </li>
            <li>
                <a href="pengunjung.php?hal=rute_wisata_user">Rute Wisata</a>
            </li>
            <li>
                <a href="pengunjung.php?hal=info_wisata">Info Lokasi Wisata</a>
            </li>
            <li>
                <a href="pengunjung.php?hal=hubungi">Buku Tamu</a>
            </li>
		</ul><!-- end .sf-menu --> 
        <div id="search">
        	<?php echo"$tglsekarang";?> &nbsp; | &nbsp; 
			<span id="clock"></span>
        </div>
    </div><!-- end #menu_wrap -->
    
    <div id="banner_wrap">
        <div id="banner">
            <div id="imgs">  
                <div id="slideshow">
                    <ul>
                        <li><img src="images/banner/full1.jpg" alt="screenshot" width="445" height="245" /></li>
                        <li><img src="images/banner/full2.jpg" alt="screenshot" width="445" height="245" /></li>
                    </ul>
                </div><!-- end #slideshow -->
            </div><!-- end #imgs -->
        <div id="description">
            <div id="slideshow2">
                <ul>
                    <li> 
                        <h2>Pariwisata Kab.Pati</h2>
                        Kabupaten Pati merupakan karisedanan di Jawa Tengah yang meliputi Pati, Kudus, Grobogan, Rembang, Blora dan Jepara. Kabupaten Pati atau terkenal dengan slogan Bumi Mina Tani dikenal juga memiliki potensi alam pegunungan dan lautan yang menjadikan Kabupaten tersebut kaya akan destinasi wisatanya.
                    </li>
                    <li> 
                        <h2>Goa Pancurs</h2>
                        Gua Pancur berlokasi di Desa Jimbaran, Kecamatan Kayen, 20 km dari Kota Pati, gua sepanjang 736 m, dengan stalaktit dan stalagmit, kolam pancing, rumah makan, dan hutan jati.
		</li></li>
                </ul>
            </div><!-- end #slideshow2 -->
        </div><!-- end #description -->
    </div><!-- end #banner -->
    <!-- end #banner_bottom -->
</div><!-- end #banner_wrap -->    
	<!-- end #features_wrap -->
    <!-- end #clients_wrap -->
</div><!-- end #main_container -->

<div id="footer_container">
	<div id="footer">
        <!--&copy; Copyright 2016 <a href="">Algoritma A* | Algoritma Dijkstra </a>. end #footer_menu -->
        <!-- end #footer_menu -->
</div>
<!-- end #clients_wrap -->
</div><!-- end #footer_container -->

</body>

</html>
