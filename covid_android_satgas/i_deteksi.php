<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_deteksi.php";
$filenyax = "$sumber/covid_android_satgas/i_deteksi.php";
$judul = "Deteksi Hardware";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$passx = $_SESSION['passx'];



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika deteksi
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'deteksi'))
	{
	//ambil nilai
	$hkode = cegah($_GET["hkode"]);
	
	//jika ada
	$q = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE hardware_kode = '$hkode'");
	$row = mysqli_fetch_assoc($q);
	$total = mysqli_num_rows($q);
	
	//cek belum ada...
	if (empty($total))
		{
		//kasi kode
		mysqli_query($koneksi, "UPDATE m_orang SET hardware_kode = '$hkode' ".
						"WHERE kd = '$sesiku'");
		}
	 
	
	exit();
	}








/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>