<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;


//nilai session
$sesiku = cegah($_SESSION['sesiku']);
$sesinama = $_SESSION['sesinama'];





/*
//kasi forward semua //////////////////////////////////////////////////////////////////////////////////
//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_tipe_user = cegah($rku['tipe_user']);
$ku_lat_x = balikin($rku['lat_x']);
$ku_lat_y = balikin($rku['lat_y']);
$ku_lat_alamat = cegah($rku['lat_alamat']);


	




//baca list
$qmboh = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
									"WHERE umum_kd <> '$sesiku' ".
									"ORDER BY postdate DESC");
$rmboh = mysqli_fetch_assoc($qmboh);

do
	{
	//nilai
	$mb_kd = nosql($rmboh['kd']);
	$mb_ukd = cegah($rmboh['umum_kd']);
	$mb_ukode = cegah($rmboh['umum_kode']);
	$mb_unama = cegah($rmboh['umum_nama']);
	$mb_utipe = cegah($rmboh['umum_tipe_user']);
	$mb_lat_x = balikin($rmboh['lat_x']);
	$mb_lat_y = balikin($rmboh['lat_y']);
	$mb_lat_alamat = cegah($rmboh['lat_alamat']);
	$mb_postdate = balikin($rmboh['postdate']);
	


	$xyz = md5("$mb_kd$sesiku");

	//masukin database
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong (kd, panic_kd, penolong_kd, penolong_kode, ".
								"penolong_nama, penolong_tipe, penolong_lat_x, ".
								"penolong_lat_y, penolong_alamat, ".
								"korban_kd, korban_kode, korban_nama, korban_tipe, ".
								"alamat, lat_x, lat_y, ".
								"tkp_postdate, tugaskan, tugaskan_postdate, postdate) VALUES ".
								"('$xyz', '$mb_kd', '$sesiku', '$ku_nip', ".
								"'$ku_nama', '$ku_tipe_user', '$ku_lat_x', ".
								"'$ku_lat_y', '$ku_lat_alamat', ".
								"'$mb_ukd', '$mb_ukode', '$mb_unama', '$mb_utipe', ".
								"'$mb_lat_alamat', '$mb_lat_x', '$mb_lat_y', ".
								"'$mb_postdate', 'true', '$today', '$today')");

	

			 
	}
while ($rmboh = mysqli_fetch_assoc($qmboh));

//kasi forward semua //////////////////////////////////////////////////////////////////////////////////
*/





exit();
?>