<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_jml_notif.php";
$filenyax = "$sumber/covid_android_satgas/i_jml_notif.php";
$judul = "Jumlah Notif";
$juduli = $judul;






//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





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





//jika ada sesi
if (!empty($sesiku))
	{
	echo '<a href="akun_notif.html" title="PEMBERITAHUAN"><i class="fa fa-bell" style="font-size:24px;color:red"></i><span class="badge">'.$jml_notif.'</span>';
	}
else
	{
	//cuekin aja...
	}	

?>