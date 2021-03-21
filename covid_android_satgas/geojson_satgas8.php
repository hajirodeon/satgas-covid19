<?php
ini_set('max_execution_time', 0);
error_reporting(0);


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");


header('Content-Type: application/json');


$ku_jenis = "RW";
?>

{
  "type": "FeatureCollection",
  "features": [
  

	<?php 
    //detail e
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE tipe_user = '$ku_jenis' ".
							"ORDER BY nama ASC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	
	do
		{
		$iku = $iku + 1;		
		$ku_kd = cegah($rku['kd']);
		$ku_kode = cegah($rku['nip']);
		$ku_nama = cegah($rku['nama']);
		$ku2_long = balikin($rku['lat_x']);
		$ku2_lat = balikin($rku['lat_y']);


		
		if (empty($ku2_long))
			{
			//lokasi terakhirku
			$qku2 = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
									"WHERE orang_kd = '$ku_kd' ".
									"AND lat_x <> '' ".
									"ORDER BY postdate DESC LIMIT 0,1");
			$rku2 = mysqli_fetch_assoc($qku2);
			$tku2 = mysqli_num_rows($qku2);
			$ku2_postdate = trim(balikin($rku2['postdate']));
			$ku2_long = trim(balikin($rku2['lat_x']));
			$ku2_lat = trim(balikin($rku2['lat_y']));
		
			//update
			mysqli_query($koneksi, "UPDATE m_orang SET lat_x = '$ku2_long', ".
										"lat_y = '$ku2_lat', ".
										"lat_postdate = '$today' ".
										"WHERE kd = '$ku_kd'");
			}



		$markerku = "$sumber/filebox/pegawai/$ku_kd/marker$ku_kode-1.jpg";


//icons=["media/green.png","media/red.gif","media/blue.png","media/yellow.png"];

		if (!empty($ku2_long))
			{
			?>

			    {
			      "type": "Feature",
			      "properties": {
			        "marker-color": "#7e7e7e",
			        "marker-size": "medium",
			        "marker-symbol": "[<?php echo $ku_jenis;?>] <?php echo $ku_nama;?>",
			        "marker-animation": "",
			        "icon": "<?php echo $markerku;?>",
			        "description": "<?php echo $ku_kd;?>"
			      },
			      "geometry": {
			        "type": "Point",
			        "coordinates": [<?php echo $ku2_lat;?>,<?php echo $ku2_long;?>]
			      }
			    },
			    
			<?php
			}
		}
	while ($rku = mysqli_fetch_assoc($qku));




    //detail e
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE tipe_user = '$ku_jenis' ".
							"ORDER BY nama DESC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	$ku_kd = cegah($rku['kd']);
	$ku_kode = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);
	$ku2_long = balikin($rku['lat_x']);
	$ku2_lat = balikin($rku['lat_y']);


	
	$markerku = "$sumber/filebox/pegawai/$ku_kd/marker$ku_kode-1.jpg";
	
	?>

	    {
	      "type": "Feature",
	      "properties": {
	        "marker-color": "#7e7e7e",
	        "marker-size": "medium",
	        "marker-symbol": "[<?php echo $ku_jenis;?>]. <?php echo $ku_nama;?>",
	        "icon": "<?php echo $markerku;?>",
	        "description": "<?php echo $ku_kd;?>"
	      },
	      "geometry": {
	        "type": "Point",
	        "coordinates": [<?php echo $ku2_long;?>,<?php echo $ku2_lat;?>]
	      }
	    }
	

        
    
    
  ]
}