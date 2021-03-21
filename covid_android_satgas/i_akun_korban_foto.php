<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_korban_foto.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_korban_foto.php";
$judul = "Upload Foto Selfie";
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
$ku_tipe_user = cegah($rku['tipe_user']);
$ku_jabatan = cegah($rku['jabatan']);


//waktunya
$niranku = "$tahun$bulan$tanggal$jam$menit";
$namabaru = "$sesiku-$niranku.jpg";




//jika null
if (empty($panickd))
	{
	//bikin sesi panic
	$kd_panic = md5("$sesiku-$niranku");
	$_SESSION['sesiku_panic'] = $kd_panic;
	}




//masukin ke database
$panickd = $_SESSION['sesiku_panic'];



//masukin
mysqli_query($koneksi, "INSERT INTO umum_sesi_panic (kd, umum_kd, umum_kode, ".
							"umum_nama, umum_tipe_user, postdate, filex_foto) VALUES ".
							"('$panickd', '$sesiku', '$ku_nip', ".
							"'$ku_nama', '$ku_tipe_user', '$today', '$namabaru')");		


//masukin 
mysqli_query($koneksi, "INSERT INTO umum_sesi_foto (kd, panic_kd, umum_kd, umum_kode, ".
							"umum_nama, umum_tipe_user, postdate, filex) VALUES ".
							"('$x', '$panickd', '$sesiku', '$ku_nip', ".
							"'$ku_nama', '$ku_tipe_user', '$today', '$namabaru')");		







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










// baseFromJavascript will be the javascript base64 string retrieved of some way (async or post submited)
$baseFromJavascript = balikin($_POST['base64']);//"data:image/png;base64,BBBFBfj42Pj4"; // $_POST['base64']; //your data in base64 'data:image/png....';


// We need to remove the "data:image/png;base64,"
$base_to_php = explode(',', $baseFromJavascript);
// the 2nd item in the base_to_php array contains the content of the image
$data = base64_decode($base_to_php[1]);
// here you can detect if type is png or jpg if you want
$filepath = "$foldernya/$panickd/$namabaru"; // or image.jpg

// Save the image in a defined path
file_put_contents($filepath,$data);





	

exit();	
?>