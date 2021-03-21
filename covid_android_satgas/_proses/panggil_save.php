<?php
//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");




//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$kd = cegah($sesiku);

$panickd = $_SESSION['sesiku_panic'];




//upload
$new_image_name = strtolower($_FILES['file']['name']);
move_uploaded_file($_FILES["file"]["tmp_name"], "../../filebox/panic/$kd/$panickd/".$new_image_name);



$xyz = md5("$x$new_image_name");
$new_image_name2 = cegah($new_image_name);




/*
//masukin ke database...
mysql_query("INSERT INTO sesi_panggilan(kd, filex, postdate) VALUES ".
				"('$xyz', '$new_image_name2', '$today')");
				
		
mysql_free_result();
*/




exit();
?>
