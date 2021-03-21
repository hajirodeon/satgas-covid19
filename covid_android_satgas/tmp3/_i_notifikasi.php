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
$panickd = $_SESSION['sesiku_panic'];




//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_jabatan = cegah($rku['jabatan']);






//perlu ditolong
$qku2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE umum_kd <> '$sesiku' ".
						"ORDER BY postdate DESC");
$rku2 = mysqli_fetch_assoc($qku2);
$tku2 = mysqli_num_rows($qku2);

//jika ada
if (!empty($tku2))
	{
	?>			
	<script>
	  
	document.addEventListener("deviceready", ondeviceready, false);
	
	function ondeviceready() {

		cordova.plugins.notification.local.schedule({
			id: 1,
			title: "Permintaan MINTA TOLONG",
			text: "Cek Aplikasi SATGAS"
			});
			
			
			
		window.location.href = "mn_panic.html";
		
		
		}
	</script>
	
	<?php
	}


	
	
exit();	
?>