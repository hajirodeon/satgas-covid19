<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/android_pegawai/i_set_lokasi_foto_pulang.php";
$filenyax = "$sumber/android_pegawai/i_set_lokasi_foto_pulang.php";
$judul = "Upload Foto Selfie Pulang";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_jabatan = cegah($rku['jabatan']);





//nilai
$new_image_name = "$ku_nip-$tahun$bulan$tanggal-pulang.jpg";





//hapus yg ada dulu...
$pathku = "../filebox/selfie/$new_image_name";
chmod($pathku,0777);
unlink($pathku);








//copy...
move_uploaded_file($_FILES["file"]["tmp_name"], "../filebox/selfie/".$new_image_name);






//chmod 755
chmod($pathku, 0755);




?>





<!-- jQuery 3 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>






<script>
$(document).ready(function(){

	$("#lihat1").hide();
	$("#lihat2").hide();


})
</script>





<div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-orange"><img src="img/p_pulang.png" height="75" /></span>

        <div class="info-box-content">
          <span class="info-box-text">FOTO SELFIE</span>
          <span class="info-box-number">
          	Berhasil Unggah...              	
          	</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      
</div>



<?php	
exit();	
?>