<?php
//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



//upload
$new_image_name = strtolower($_FILES['file']['name']);
move_uploaded_file($_FILES["file"]["tmp_name"], "../../filebox/panic/".$new_image_name);



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
