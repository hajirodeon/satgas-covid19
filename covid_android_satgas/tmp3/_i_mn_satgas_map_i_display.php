<?php
ini_set('max_execution_time', 0);
error_reporting(0);


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



header('Content-Type: application/json');

 
?>






{

"points":[

	<?php 
    //detail e
	$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
							"WHERE lat_x <> '' ".
							"ORDER BY postdate DESC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	
	do
		{
		$iku = $iku + 1;
		$ku2_namax = trim(balikin($rku['orang_kode']));
		$ku2_long = trim(balikin($rku['lat_x']));
		$ku2_lat = trim(balikin($rku['lat_y']));


	    echo '{"id":'.$iku.',"nama":'.$iku.',"lat":'.$ku2_long.',"lon":'.$ku2_lat.'},';
		}
	while ($rku = mysqli_fetch_assoc($qku));

	
	//kasi yang terakhir
	$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
							"WHERE lat_x <> '' ".
							"ORDER BY postdate DESC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$ku_namax = trim(balikin($rku['orang_kode']));
	$ku_long = trim(balikin($rku['lat_x']));
	$ku_lat = trim(balikin($rku['lat_y']));
		
    echo '{"id":'.$iku.',"nama":'.$iku.',"lat":'.$ku_long.',"lon":'.$ku_lat.'}';
	?>

]


}