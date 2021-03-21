<?php
session_start();
ini_set('max_execution_time', 0);
error_reporting(0);


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



//ambil nilai
$sesiku = balikin($_GET['sesiku']);





header('Content-Type: application/json');

?>

{
  "type": "FeatureCollection",
  "features": [
  

	<?php 
	/*
	//detail
	$qx = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
	$rowx = mysqli_fetch_assoc($qx);
	 * 
	 */
	
	
	//detail random
	$qx = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE lat_x <> '' ".
						"ORDER BY RAND()");
	$rowx = mysqli_fetch_assoc($qx);	
	$ku_kd = balikin($rowx['kd']);	
	$ku_kode = balikin($rowx['nip']);
	$i_lat_x = balikin($rowx['lat_x']);
	$i_lat_y = balikin($rowx['lat_y']);


	$markerku = "$sumber/filebox/pegawai/$ku_kd/marker$ku_kode-1.jpg";

	?>

	    {
	      "type": "Feature",
	      "properties": {
	        "marker-color": "#7e7e7e",
	        "marker-size": "medium",
	        "marker-symbol": "GPS KU",
	        "marker-animation": "",
	        "icon": "<?php echo $markerku;?>",
	        "description": "GPS KU"
	      },
	      "geometry": {
	        "type": "Point",
	        "coordinates": [<?php echo $i_lat_x;?>,<?php echo $i_lat_y;?>]
	      }
	    }
    
  ]
}



