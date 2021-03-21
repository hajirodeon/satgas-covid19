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
$ku_jabatan = cegah($rku['jabatan']);
$ku_tgl_lahir = cegah($rku['tgl_lahir']);
$ku_alamat = cegah($rku['alamat']);
$ku_telp = cegah($rku['telp']);
$ku_email = cegah($rku['email']);





//upload
$new_image_name = strtolower($_FILES['file']['name']);
move_uploaded_file($_FILES["file"]["tmp_name"], "../filebox/panic/$kd/$panickd/".$new_image_name);
//move_uploaded_file($_FILES["file"]["tmp_name"], "../filebox/panic/".$new_image_name);



//$xyz = md5("$x$new_image_name");
$new_image_name2 = cegah($new_image_name);




//masukin ke database...
mysqli_query($koneksi, "INSERT INTO umum_sesi_suara(kd, umum_kd, umum_kode, umum_nama, ".
							"panic_kd, filex, postdate) VALUES ".
							"('$x', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$panickd', '$new_image_name2', '$today')");
				
		


exit();
?>