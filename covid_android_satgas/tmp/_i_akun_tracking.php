<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_tracking.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_tracking.php";
$judul = "Tracking Real Time";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	?>

	<iframe style="width: 100%;height: 200vh;position: relative;" src="http://sicekal.com/covid_android_satgas/i_akun_tracking_ifr_map.php?sesikd=<?php echo $sesiku;?>" frameborder="0" allowfullscreen></iframe>

	<?php
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>