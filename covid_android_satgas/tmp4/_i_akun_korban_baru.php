<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_korban_baru.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_korban_baru.php";
$judul = "korban baru...";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$kd = cegah($sesiku);





//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_tipe_user = cegah($rku['tipe_user']);
$ku_jabatan = cegah($rku['jabatan']);
$ku_lat_x = balikin($rku['lat_x']);
$ku_lat_y = balikin($rku['lat_y']);
$ku_lat_alamat = balikin($rku['lat_alamat']);


//waktunya
$niranku = "$tahun$bulan$tanggal$jam$menit";




//bikin sesi panic
$kd_panic = md5("$sesiku-$niranku");
$_SESSION['sesiku_panic'] = $kd_panic;




//masukin ke database
$panickd = $_SESSION['sesiku_panic'];



//masukin
mysqli_query($koneksi, "INSERT INTO umum_sesi_panic (kd, umum_kd, umum_kode, ".
							"umum_nama, umum_tipe_user, postdate) VALUES ".
							"('$panickd', '$sesiku', '$ku_nip', ".
							"'$ku_nama', '$ku_tipe_user', '$today')");		



$foldernya = "../filebox/panic/$kd/";
chmod($foldernya,0777);
			
			
//buat folder...
if (!file_exists('../filebox/panic/'.$kd.'')) {
    mkdir('../filebox/panic/'.$kd.'', 0777, true);
	}




$foldernya2 = "../filebox/panic/$kd/$panickd";
chmod($foldernya2,0777);
			
			
//buat folder...
if (!file_exists('../filebox/panic/'.$kd.'/'.$panickd.'')) {
    mkdir('../filebox/panic/'.$kd.'/'.$panickd.'', 0777, true);
	}



exit();	
?>