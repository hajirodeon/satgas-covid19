<?php
ini_set('max_execution_time', 0);
error_reporting(0);


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



//nilai
$sesikd = nosql($_REQUEST['sesikd']);


header('Content-Type: application/json');

 
?>






{

"points":[

	<?php
	/* 
	//detail e
	$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$sesikd' ".
							"AND lat_x <> '' ".
							"ORDER BY postdate DESC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$iku = $iku + 1;
	$ku2_long = trim(balikin($rku['lat_x']));
	$ku2_lat = trim(balikin($rku['lat_y']));

    echo '{"id":'.$iku.',"nama":'.$iku.',"lat":'.$ku2_long.',"lon":'.$ku2_lat.'},';
	*/



	
	//kasi yang terakhir
	$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$sesikd' ".
							"AND lat_x <> '' ".
							"ORDER BY postdate DESC LIMIT 0,1");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$iku = $iku + 1;
	$ku_long = trim(balikin($rku['lat_x']));
	$ku_lat = trim(balikin($rku['lat_y']));
		
    echo '{"id":'.$iku.',"nama":'.$iku.',"lat":'.$ku_long.',"lon":'.$ku_lat.'}';
	
	?>

]


}