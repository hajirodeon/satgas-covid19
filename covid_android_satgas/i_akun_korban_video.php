<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");




//nilai session
$sesiku = cegah($_SESSION['sesiku']);
$sesinama = cegah($_SESSION['sesinama']);
$kd = cegah($sesiku);
$panickd = cegah($_SESSION['sesiku_panic']);







//detail orang
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_tipe_user = cegah($rku['tipe_user']);
$ku_jabatan = cegah($rku['jabatan']);
$ku_tgl_lahir = cegah($rku['tgl_lahir']);
$ku_alamat = cegah($rku['alamat']);
$ku_telp = cegah($rku['telp']);
$ku_email = cegah($rku['email']);






$foldernya = "../filebox/panic/$kd/";
chmod($foldernya,0777);
			
			
//buat folder...
if (!file_exists('../filebox/panic/'.$kd.'')) {
    mkdir('../filebox/panic/'.$kd.'', 0777, true);
	}








//folder konversi /////////////////////////////////////////////////////////////////////////////////////
$foldernya = "../filebox/konversi/$panickd/";
chmod($foldernya,0777);
			
			
//buat folder...
if (!file_exists('../filebox/konversi/'.$panickd.'')) {
    mkdir('../filebox/konversi/'.$panickd.'', 0777, true);
	}










//upload //////////////////////////////////////////////////////////////////////////////////////////////
//$new_image_name = strtolower($_FILES['file']['name']);
//move_uploaded_file($_FILES["file"]["tmp_name"], "../filebox/panic/$kd/$panickd/".$new_image_name);



$new_image_name = "$tahun$bulan$tanggal$jam$menit$detik.mp4";

//masukin ke database...
mysqli_query($koneksi, "INSERT INTO umum_sesi_video(kd, umum_kd, umum_kode, umum_nama, ".
							"umum_tipe_user, panic_kd, filex, postdate) VALUES ".
							"('$x', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$ku_tipe_user', '$panickd', '$new_image_name', '$today')");


echo "$tahun$bulan$tanggal$jam$menit$detik";	
	
	

// baseFromJavascript will be the javascript base64 string retrieved of some way (async or post submited)
$baseFromJavascript = balikin($_POST['base64']);//"data:image/png;base64,BBBFBfj42Pj4"; // $_POST['base64']; //your data in base64 'data:image/png....';


// We need to remove the "data:image/png;base64,"
$base_to_php = explode(',', $baseFromJavascript);
// the 2nd item in the base_to_php array contains the content of the image
$data = base64_decode($base_to_php[1]);



// here you can detect if type is png or jpg if you want
$filepath = "../filebox/panic/$kd/$panickd/$new_image_name"; // .mp4

// Save the image in a defined path
file_put_contents($filepath,$data);












/*
//insert //////////////////////////////////////////////////////////////////////////////////////////////
//mambaca folder panic
$kode_ruas = "../filebox/panic/$kd/$panickd";

//$dir = ".";
$dir = "$kode_ruas/.";



$handle = opendir($dir); 




if (!empty($handle))
	{
	
	if($handle = opendir($dir)) 
		{
		 //tampilkan semua file dalam folder kecuali 
	
		while(($file = readdir($handle)) !== false) 
			{
			if (($file != ".") AND ($file != "..")) 
				{
				$xyz = md5("$file");
	
				//masukin ke database...
				mysqli_query($koneksi, "INSERT INTO umum_sesi_video(kd, umum_kd, umum_kode, umum_nama, ".
											"umum_tipe_user, panic_kd, filex, postdate) VALUES ".
											"('$xyz', '$sesiku', '$ku_nip', '$ku_nama', ".
											"'$ku_tipe_user', '$panickd', '$file', '$today')");
				} 
			}
		}
	} 
*/

















exit();
?>