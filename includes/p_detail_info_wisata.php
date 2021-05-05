
<?php
$link_list='?hal=detail_info';
$q="select * from berita  where id_berita=$_GET[id]";
$q=mysqli_query($con,$q);

?>


<?php 
		$h=mysqli_fetch_array($q);
		
		$id=$h['id_berita'];
		
		 $isi_berita = nl2br($h[berita]); ?>
            <div class="post">
                <h2><a href="#"><?php echo $h['judul']; ?></a></h2>
                <h3><?php echo $h['tanggal']; ?></h3>
                <div class="entry">
                
                
              <p>  <img src=foto_berita/<?php echo $h['gambar']; ?>   alt="Sample Image" class=alignleft width="258px" height="171px" /><?php echo $isi_berita; ?>
                </p>
             </div>
              <p class="postmeta"><a href="pengunjung.php?hal=info_wisata">Kembali</a></p>
            </div>
