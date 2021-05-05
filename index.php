<?php
session_start();

require_once 'config.php';
require_once 'page.php';
if(isset($_SESSION['LOGIN_ID'])){
	$id_login = $_SESSION['LOGIN_ID'];
	require_once 'content.php';
}else{
	require_once 'hal.php';
}



?>