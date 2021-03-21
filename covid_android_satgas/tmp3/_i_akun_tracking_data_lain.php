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
    //detail e
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd <> '$sesikd' ".
							"ORDER BY nama ASC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	
	do
		{
		$iku = $iku + 1;		
		$ku_kd = cegah($rku['kd']);
		$ku_nama = cegah($rku['nama']);

		
		//detail terbaru
		$qku2 = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
								"WHERE orang_kd = '$ku_kd' ".
								"AND lat_x <> '' ".
								"ORDER BY postdate DESC LIMIT 0,1");
		$rku2 = mysqli_fetch_assoc($qku2);
		$tku2 = mysqli_num_rows($qku2);
		$ku2_postdate = trim(balikin($rku2['postdate']));
		$ku2_long = trim(balikin($rku2['lat_x']));
		$ku2_lat = trim(balikin($rku2['lat_y']));
		
		$ku2_nama = strip_tags($ku2_postdate);

		if (!empty($tku2))
			{
		    echo '{"id":'.$iku.',"nama":'.$iku.',"lat":'.$ku2_long.',"lon":'.$ku2_lat.'},';
			}
		}
	while ($rku = mysqli_fetch_assoc($qku));

	
	//kasi yang terakhir
	$qku3 = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
							"WHERE orang_kd <> '$sesikd' ".
							"ORDER BY postdate DESC LIMIT 0,1");
	$rku3 = mysqli_fetch_assoc($qku3);
	$tku3 = mysqli_num_rows($qku3);
	$ku3_long = trim(balikin($rku3['lat_x']));
	$ku3_lat = trim(balikin($rku3['lat_y']));
	

	if (!empty($tku3))
		{
		echo '{"id":'.$iku.',"nama":'.$iku.',"lat":'.$ku3_long.',"lon":'.$ku3_lat.'}';
		}
	?>


]


}