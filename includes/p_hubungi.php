<script language="javascript">
    function hanyaAngka(e, decimal) {
    var key;
    var keychar;
     if (window.event) {
         key = window.event.keyCode;
     } else
     if (e) {
         key = e.which;
     } else return true;
  
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
        return true;
    } else
    if ((("0123456789").indexOf(keychar) > -1)) {
        return true;
    } else
    if (decimal && (keychar == ".")) {
        return true;
    } else return false;
    }
</script>
<h1>Buku Tamu</h1>

            <p>
           Untuk memberikan saran dan kritik serta masukan dengan sistem perbandingan Algoritma Dijsktra dan Tabu Search Bisa mengisi form dibawah ini :
            </p>
<form class="cmxform" id="commentForm" method="post" action="">
               
                <fieldset>
                <table class="quote-form">
                <tr>
                    <td class="field-name"><label for="cname">Name:<span class="red">*</span></label></td>
                    <td> <input id="cname" name="nama" class="required"/></td>
                </tr>
                <tr>
                	<td class="field-name"><label for="cemail">E-Mail:<span class="red">*</span></label></td>
                    <td><input id="cemail" name="email" class="required email" /></td>
                </tr>
                <tr>
                	<td class="field-name"><label for="corg">Company:</label></td>
                	<td><input id="corg" name="company" value="" /></td>
                </tr>
                <tr>
                	<td class="field-name"><label for="cphone">Phone:</label></td>
                	<td><input id="cphone" name="telepon" value="" onkeypress="return hanyaAngka(event, false)" /></td>
                </tr>
                <tr>
                	<td class="field-name"><label for="csubject">Subject:<span class="red">*</span></label></td>
                	<td><input id="csubject" name="subjek" class="required" value="" /></td>
                </tr>

              <tr>
              	<td class="field-name"><label for="cmessage">Message<span class="red">*</span></label></td>
                <td>
                	<textarea id="cmessage" name="pesan" class="required" cols="3" rows="3"></textarea>
            	</td>
              </tr>
           	  <tr>
              	<td></td>
                <td><input class="submit" type="submit" name="save" value="Kirim"/></td>
               </tr>
            </table>

          </fieldset>
          </form>
<?php

if(isset($_POST['save'])){
	$nama=$_POST['nama'];
	$email=$_POST['email'];
	$company=$_POST['company'];
	$telepon=$_POST['telepon'];
	$subjek=$_POST['subjek'];
	$pesan=$_POST['pesan'];

	if(!preg_match ('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $_POST ['email']))
	{
 	 echo "<script>window.alert('Alamat Email Tidak Valid');
                window.location=('pengunjung.php?hal=hubungi')</script>";
	}
	else
	{
 		$q="insert into buku_tamu(nama,email,company,telepon,subjek,pesan) values('".$nama."', '".$email."','".$company."','".$telepon."','".$subjek."','".$pesan."')";
		mysqli_query($con,$q);
  				echo "<script>window.alert('Data Buku Tamu Berhasil');
                window.location=('pengunjung.php?hal=hubungi')</script>";

		}
}


?>