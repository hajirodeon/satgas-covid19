<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");


nocache;


//nilai
$filenya = "$sumber/covid_android_satgas/i_reg_gps.php";


//nilai session
$e_kd = $_SESSION['e_kd'];
$kd = $e_kd;
$sesiku = $e_kd;


		
//jika realtime pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'psimpan'))
	{
	//ambil nilai
	$latx = balikin($_GET['latx']);
	$laty = balikin($_GET['laty']);


	$latx2 = balikin($_GET['latx']);
	$laty2 = balikin($_GET['laty']);
	
	$waktu = $today;


	//bikin sesi baru
	$_SESSION['latx_sesi'] = '';
	$_SESSION['laty_sesi'] = '';
	$_SESSION['latx_sesi'] = $latx2;
	$_SESSION['laty_sesi'] = $laty2;



	//insert
	mysqli_query($koneksi, "INSERT INTO orang_lokasi(kd, orang_kd, orang_kode, orang_nama, ".
					"lat_x, lat_y, status, alamat, postdate) VALUES ".
					"('$e_kd', '$e_kd', '$ku_nip', '$ku_nama', ".
					"'$latx2', '$laty2', 'REGISTRASI', '$alamatkux', '$waktu')");



    exit();
	}

	

		
		
		
		
	