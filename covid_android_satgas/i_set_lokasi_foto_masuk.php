<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/android_pegawai/i_set_lokasi_foto_masuk.php";
$filenyax = "$sumber/android_pegawai/i_set_lokasi_foto_masuk.php";
$judul = "Upload Foto Selfie";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_jabatan = cegah($rku['jabatan']);




//nilai
$new_image_name = "$ku_nip-$tahun$bulan$tanggal-masuk.jpg";



//hapus yg ada dulu...
$pathku = "../filebox/selfie/$new_image_name";
chmod($pathku,0777);
unlink($pathku);








//copy...
//move_uploaded_file($_FILES["file"]["tmp_name"], "../filebox/selfie/".$new_image_name);







$namabaru = $new_image_name;



// baseFromJavascript will be the javascript base64 string retrieved of some way (async or post submited)
$baseFromJavascript = balikin($_POST['base64']);//"data:image/png;base64,BBBFBfj42Pj4"; // $_POST['base64']; //your data in base64 'data:image/png....';


// We need to remove the "data:image/png;base64,"
$base_to_php = explode(',', $baseFromJavascript);


// the 2nd item in the base_to_php array contains the content of the image
//$data = base64_decode($base_to_php[1]);
$data = base64_decode($baseFromJavascript);

//echo "-> $data";


// here you can detect if type is png or jpg if you want
$filepath = "../filebox/selfie/$namabaru"; // or image.jpg

// Save the image in a defined path
file_put_contents($filepath,$data);









//chmod 755
chmod($pathku, 0755);




exit();	
?>
