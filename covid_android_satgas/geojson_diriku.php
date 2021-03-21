<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");






//nilai session
$sesiku = cegah($_SESSION['sesiku']);
$sesinama = cegah($_SESSION['sesinama']);
$kd = cegah($_SESSION['kd']);


//jika ada
if (!empty($kd))
	{
	$kdku = $kd;
	}
else
	{
	$kdku = $sesiku;
	}


//jika null, ambil dari history
$qyuk = mysqli_query($koneksi, "SELECT * FROM m_orang ".
									"WHERE kd = '$kdku'");
$ryuk = mysqli_fetch_assoc($qyuk);
$tyuk = mysqli_num_rows($qyuk);
$ku2_long = balikin($ryuk['lat_x']);
$ku2_lat = balikin($ryuk['lat_y']);


if (empty($ku2_long))
	{
	//lokasi terakhirku
	$qku2 = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$kdku' ".
							"AND lat_x <> '' ".
							"ORDER BY postdate DESC LIMIT 0,1");
	$rku2 = mysqli_fetch_assoc($qku2);
	$tku2 = mysqli_num_rows($qku2);
	$ku2_postdate = trim(balikin($rku2['postdate']));
	$ku2_long = trim(balikin($rku2['lat_x']));
	$ku2_lat = trim(balikin($rku2['lat_y']));

	//update
	mysqli_query($koneksi, "UPDATE m_orang SET lat_x = '$ku2_long', ".
								"lat_y = '$ku2_lat', ".
								"lat_postdate = '$today' ".
								"WHERE kd = '$sesiku'");
	}






echo "$ku2_long, $ku2_lat";





//hapus session, ganti sesi diriku
if (!empty($kd))
	{
	$_SESSION['kd'] = $sesiku;
	}
?>