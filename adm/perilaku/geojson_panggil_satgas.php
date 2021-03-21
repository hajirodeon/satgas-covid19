<?php
ini_set('max_execution_time', 0);
error_reporting(0);


//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


//nilai
$pkd = nosql($_REQUEST['pkd']);




header('Content-Type: application/json');
?>

{
  "type": "FeatureCollection",
  "features": [
  

	<?php 
    //detail e
	$qku = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
									"WHERE perilaku_kd = '$pkd' ".
									"AND tugaskan = 'false' ".
									"ORDER BY orang_tipe ASC, ".
									"orang_nama ASC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	
	do
		{
		$iku = $iku + 1;		
		$ku_kd = cegah($rku['kd']);
		$ku_kode = cegah($rku['orang_kode']);
		$ku_nama = cegah($rku['orang_nama']);
		$ku2_long = balikin($rku['lat_y']);
		$ku2_lat = balikin($rku['lat_x']);


		$markerku = "../../filebox/pegawai/$ku_kd/marker$ku_kode-1.jpg";


			?>

			    {
			      "type": "Feature",
			      "properties": {
			        "marker-color": "#7e7e7e",
			        "marker-size": "medium",
			        "marker-symbol": "<?php echo $ku_kode;?>. <?php echo $ku_nama;?>",
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
	while ($rku = mysqli_fetch_assoc($qku));
	?>




    <?php
	//detail terbaru
	$qku2 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
									"WHERE perilaku_kd = '$pkd' ".
									"AND tugaskan = 'false' ".
									"ORDER BY orang_tipe ASC, ".
									"orang_nama DESC LIMIT 0,1");
	$rku2 = mysqli_fetch_assoc($qku2);
	$tku2 = mysqli_num_rows($qku2);
	$ku_kd = cegah($rku2['orang_kd']);
	$ku_kode = cegah($rku2['orang_kode']);
	$ku_nama = cegah($rku2['orang_nama']);
	$ku2_postdate = trim(balikin($rku2['postdate']));
	$ku2_long = trim(balikin($rku2['lat_y']));
	$ku2_lat = trim(balikin($rku2['lat_x']));
	
	
	$markerku = "../../filebox/pegawai/$ku_kd/marker$ku_kode-1.jpg";
	
	?>

	    {
	      "type": "Feature",
	      "properties": {
	        "marker-color": "#7e7e7e",
	        "marker-size": "medium",
	        "marker-symbol": "<?php echo $ku_kode;?>. <?php echo $ku_nama;?>",
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