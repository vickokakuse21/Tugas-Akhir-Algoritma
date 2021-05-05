<?php
session_start();
require_once 'config.php';

if(isset($_POST['login'])){
	if(empty($_POST['username']) or empty($_POST['password'])){
		exit("<script>window.alert('Masukkan username dan password anda');window.history.back();</script>");
	}
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$q=mysqli_query($con,"SELECT * FROM admin WHERE username='".$username."' AND password='".$password."'");
	if(mysqli_num_rows($q)==0){
		exit("<script>window.alert('Username dan password salah');window.history.back();</script>");
	}
	$h=mysqli_fetch_array($q);
	$id_admin=$h['id_admin'];
	$nama=$h['username'];
	$level=$h['level'];
	
	$_SESSION['LOGIN_ID']=$id_admin;
	$_SESSION['username']=$nama;
	$_SESSION['level']=$level;
	exit("<script>window.location='".$www."';</script>");
}

?>