<?php
$username = $_POST['username'];

function randomPassword()
{
// function untuk membuat password random 6 digit karakter

$digit = 6;
$karakter = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

srand((double)microtime()*1000000);
$i = 0;
$pass = "";
while ($i <= $digit-1)
{
$num = rand() % 32;
$tmp = substr($karakter,$num,1);
$pass = $pass.$tmp;
$i++;
}
return $pass;
}

// membuat password baru secara random -> memanggil function randomPassword
$newPassword = randomPassword();

// perlu dibuat sebarang pengacak
$pengacak  = "NDJS3289JSKS190JISJI";

// mengenkripsi password dengan md5() dan pengacak
$newPasswordEnkrip = md5($newPassword);

// mencari alamat email si user
$query = "SELECT * FROM admin WHERE username = '$username'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$nama=$data['username'];

if ($_POST['username']!=$nama){
 echo "<div class='alert alert-error'>";
echo "Username Anda Tidak Terdaftar. Silahkan ulangi lagi.";
echo "</div>";
} 
else{



    $query = "UPDATE admin SET password = '$newPasswordEnkrip' WHERE username = '$username'";
    $hasil = mysql_query($query);
	$pesan  = "Username Anda : ".$username.". \nPassword Anda yang baru adalah ".$newPassword;
	echo $pesan;  
}
?>