<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;




//sesi
$sesikode = cegah($_REQUEST['sesikode']);
$kd = cegah($_REQUEST['kd']);
$panickd = cegah($_REQUEST['panickd']);
$pkd = cegah($_REQUEST['pkd']);
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];




//jika baca artikel
if ($sesikode == "artikelbaca")
	{
	//buat sesi
	$_SESSION['sesikode'] = "artikelbaca";
	$_SESSION['kd'] = $kd;
	
	
	//re-direct
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "baca.html";

	});
	
	</script>
	<?php
	
	exit();
	}
	












//jika perilaku detail
if ($sesikode == "perilakudetail")
	{
	//buat sesi
	$_SESSION['sesikode'] = "perilakudetail";
	$_SESSION['kd'] = $kd;
	$_SESSION['pkd'] = $pkd;
	
	
	//re-direct
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "akun_notif_perilaku_detail.html";

	});
	
	</script>
	<?php
	
	exit();
	}
	


















//jika panic detail
if ($sesikode == "panicdetail")
	{
	//buat sesi
	$_SESSION['sesikode'] = "panicdetail";
	$_SESSION['panickd'] = $panickd;
	$_SESSION['pkd'] = $pkd;
	
	
	//re-direct
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "akun_notif_panic_detail.html";

	});
	
	</script>
	<?php
	
	exit();
	}
	














//jika cari satgas
if ($sesikode == "carisatgas")
	{
	//buat sesi
	$_SESSION['sesikode'] = "carisatgas";
	$_SESSION['kd'] = $kd;

	
	//re-direct
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "akun_tracking.html";

	});
	
	</script>
	<?php
	
	exit();
	}
	









	

//jika detail korban
if ($sesikode == "korban")
	{
	//buat sesi
	$_SESSION['sesikode'] = "korban";
	$_SESSION['kd'] = $kd;
	
	
	//re-direct
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "mn_panic_tolong.html";

	});
	
	</script>
	<?php
	
	exit();
	}
	
	







//jika detail tolong
if ($sesikode == "tolong")
	{
	//buat sesi
	$_SESSION['sesikode'] = "tolong";
	$_SESSION['kd'] = $kd;
	
	//echo "bantuan..";
	//re-direct
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "mn_panic_tolong_beri_bantuan.html";

	});
	
	</script>
	<?php
	
	exit();
	}
	









//jika tidakmampu
if ($sesikode == "tidakmampu")
	{
	//buat sesi
	$_SESSION['sesikode'] = "tidakmampu";
	$_SESSION['kd'] = $kd;
	
	

	//detailnya
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);

	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$kd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_kd = nosql($rku['kd']);
	$yuk2_umum_kd = nosql($rku['umum_kd']);
	$yuk21_umum_kode = cegah($rku['umum_kode']);
	$yuk21_umum_nama = cegah($rku['umum_nama']);
	
	
	
	/*
	//masukin
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong (kd, penolong_kd, penolong_kode, penolong_nama, ".
							"panic_kd, korban_kd, korban_kode, korban_nama, ".
							"postdate, gagal, gagal_postdate, alasan) VALUES ".
							"('$x', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$kd', '$yuk2_umum_kd', '$yuk21_umum_kode', '$yuk21_umum_nama', ".
							"'$today', '$false', '$today', 'SAYA TIDAK MAMPU')");
	 */ 

	//masukin
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong (kd, penolong_kd, penolong_kode, penolong_nama, ".
							"panic_kd, korban_kd, korban_kode, korban_nama,  ".
							"postdate, gagal, gagal_postdate, alasan) VALUES ".
							"('$x', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$kd', '$yuk2_umum_kd', '$yuk21_umum_kode', '$yuk21_umum_nama', ".
							"'$today', 'false', '$today', 'SAYA TIDAK MAMPU')");
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "main.html";

	});
	
	</script>
	<?php
	exit();
	}
	










//jika sibuk
if ($sesikode == "sibuk")
	{
	//buat sesi
	$_SESSION['sesikode'] = "sibuk";
	$_SESSION['kd'] = $kd;
	
	

	//detailnya
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);

	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$kd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_kd = nosql($rku['kd']);
	$yuk2_umum_kd = nosql($rku['umum_kd']);
	$yuk21_umum_kode = cegah($rku['umum_kode']);
	$yuk21_umum_nama = cegah($rku['umum_nama']);
	
	


	//masukin
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong (kd, penolong_kd, penolong_kode, penolong_nama, ".
							"panic_kd, korban_kd, korban_kode, korban_nama,  ".
							"postdate, gagal, gagal_postdate, alasan) VALUES ".
							"('$x', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$kd', '$yuk2_umum_kd', '$yuk21_umum_kode', '$yuk21_umum_nama', ".
							"'$today', 'false', '$today', 'SAYA SIBUK')");
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "main.html";

	});
	
	</script>
	<?php
	
	exit();
	}
	












//jika diluararea
if ($sesikode == "diluararea")
	{
	//buat sesi
	$_SESSION['sesikode'] = "diluararea";
	$_SESSION['kd'] = $kd;
	
	

	//detailnya
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);

	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$kd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_kd = nosql($rku['kd']);
	$yuk2_umum_kd = nosql($rku['umum_kd']);
	$yuk21_umum_kode = cegah($rku['umum_kode']);
	$yuk21_umum_nama = cegah($rku['umum_nama']);
	
	
	

	//masukin
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong (kd, penolong_kd, penolong_kode, penolong_nama, ".
							"panic_kd, korban_kd, korban_kode, korban_nama,  ".
							"postdate, gagal, gagal_postdate, alasan) VALUES ".
							"('$x', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$kd', '$yuk2_umum_kd', '$yuk21_umum_kode', '$yuk21_umum_nama', ".
							"'$today', 'false', '$today', 'SAYA DILUAR AREA')");
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "main.html";

	});
	
	</script>
	<?php
	
	exit();
	}
	









	
	
?>