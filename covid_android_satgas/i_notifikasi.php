<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_nofitikasi.php";
$filenyax = "$sumber/covid_android_satgas/i_nofitikasi.php";
$judul = "notifikasi";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$kd = cegah($sesiku);





//jumlah panic
$sel = mysqli_query($koneksi,"select count(*) as allcount ".
								"from umum_sesi_penolong ".
								"WHERE penolong_kd = '$sesiku' ".
								"AND notif = 'false'");
$records = mysqli_fetch_assoc($sel);
$jml_panic = balikin($records['allcount']);




//jumlah perilaku	
$sel = mysqli_query($koneksi,"select count(*) as allcount ".
								"from perilaku_satgas ".
								"WHERE orang_kd = '$sesiku' ".
								"AND notif = 'false'");
$records = mysqli_fetch_assoc($sel);
$jml_perilaku = balikin($records['allcount']);





$jml_notif = $jml_panic + $jml_perilaku;





//jika ada
if (!empty($jml_notif))
	{
	?>			
	<script>
	  
	document.addEventListener("deviceready", ondeviceready, false);
	
	function ondeviceready() {

		cordova.plugins.notification.local.schedule({
			id: 1,
			title: "<?php echo $jml_notif;?> Pemberitahuan Baru",
			text: "Cek Aplikasi SATGAS"
			});
			
		
		}
	</script>
	
	<?php
	}


	
	
exit();	
?>