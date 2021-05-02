<?php
session_start();

$page='';
if(isset($_GET['hal'])){
	$page=$_GET['hal'];
}
switch($page){
	case 'data_berita':
		$page="include 'includes/p_berita.php';";
		break;
	
	case 'update_berita':
		$page="include 'includes/p_berita_update.php';";
		break;
		
	case 'data_peta':
		$page="include 'includes/p_peta.php';";
		break;
	
	case 'update_peta':
		$page="include 'includes/p_peta_update.php';";
		break;
		
	case 'data_kategori':
		$page="include 'includes/p_kategori.php';";
		break;
			
	case 'update_kategori':
		$page="include 'includes/p_kategori_update.php';";
		break;
		
	case 'data_rute':
		$page="include 'includes/p_rute.php';";
		break;
	
	case 'update_rute':
		$page="include 'includes/p_rute_update.php';";
		break;
		
	case 'info_wisata':
		$page="include 'includes/p_info_wisata.php';";
		break;
	
	case 'detail_info_wisata':
		$page="include 'includes/p_detail_info_wisata.php';";
		break;
		
	case 'rute_wisata_user':
		$page="include 'includes/rute_wisata_user.php';";
		break;
	
	case 'hubungi':
		$page="include 'includes/p_hubungi.php';";
		break;
	
	case 'buku_tamu':
		$page="include 'includes/p_buku_tamu.php';";
		break;
	
	case 'lihat_peta':
		$page="include 'includes/lihat_peta.php';";
		break;
		
	case 'update_buku_tamu':
		$page="include 'includes/p_buku_tamu_update.php';";
		break;
		
	case 'ubah_password':
		$page="include 'includes/p_ubah_password.php';";
		break;
		
	case 'ubah_password1':
		$page="include 'includes/p_ubah_password1.php';";
		break;
		
	case 'lupa_password':
		$page="include 'includes/p_lupa_password.php';";
		break;
		
		// Panitia 
		case 'data_hubungi':
		$page="include 'page_panitia/p_hubungi.php';";
		break;
		
			case 'data_hubungi_update':
		$page="include 'page_panitia/p_hubungi_update.php';";
		break;

		// Pengunjung
		case 'bantuan':
		$page="include 'page_user/kontak.php';";
		break;

		case 'simpanbantuan':
		$page="include 'page_user/simkontak.php';";
		break;

	default:
		
		$page="include 'includes/p_home.php';";

		break;
}
$CONTENT_["main"]=$page;

?>