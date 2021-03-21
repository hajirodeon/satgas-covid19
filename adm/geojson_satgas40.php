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
  "type": "FeatureCollection",
  "features": [
  

	<?php 
    //detail e
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"ORDER BY nama ASC");
	$rku = mysqli_fetch_assoc($qku);
	$tku = mysqli_num_rows($qku);
	
	do
		{
		$iku = $iku + 1;		
		$ku_kd = cegah($rku['kd']);
		$ku_kode = cegah($rku['nip']);
		$ku_nama = cegah($rku['nama']);

		
		//detail terbaru
		$qku2 = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
								"WHERE kontributor_nik = '$ku_kode' ".
								"AND lat_x <> '' ".
								"ORDER BY postdate DESC LIMIT 0,1");
		$rku2 = mysqli_fetch_assoc($qku2);
		$tku2 = mysqli_num_rows($qku2);
		$ku2_postdate = trim(balikin($rku2['postdate']));
		$ku2_long = trim(balikin($rku2['lat_x']));
		$ku2_lat = trim(balikin($rku2['lat_y']));


		$markerku = "../filebox/pegawai/$ku_kd/marker$ku_kode-1.jpg";




		if (!empty($tku2))
			{
			?>

			    {
			      "type": "Feature",
			      "properties": {
			        "marker-color": "#7e7e7e",
			        "marker-size": "medium",
			        "marker-symbol": "<?php echo $ku_kode;?>. <?php echo $ku_nama;?>",
			        "icon": "<?php echo $markerku;?>",
			        "description": "<?php echo $ku_nama;?>"
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
	?>




    <?php
	//detail terbaru
	$qku2 = mysqli_query($koneksi, "SELECT m_orang.kd AS okd, ".
							"m_orang.nip AS onip, ".
							"m_orang.nama AS onama, ".
							"e_perilaku_masyarakat.* ".
							"FROM m_orang, e_perilaku_masyarakat ".
							"WHERE e_perilaku_masyarakat.kontributor_kd = m_orang.nip ".
							"ORDER BY e_perilaku_masyarakat.postdate DESC LIMIT 0,1");
	$rku2 = mysqli_fetch_assoc($qku2);
	$tku2 = mysqli_num_rows($qku2);
	$ku_kd = cegah($rku2['akd']);
	$ku_kode = cegah($rku2['onip']);
	$ku_nama = cegah($rku2['onama']);
	$ku2_postdate = trim(balikin($rku2['postdate']));
	$ku2_long = trim(balikin($rku2['lat_x']));
	$ku2_lat = trim(balikin($rku2['lat_y']));
	
	
	$markerku = "../filebox/pegawai/$ku_kd/marker$ku_kode-1.jpg";
	
	?>

	    {
	      "type": "Feature",
	      "properties": {
	        "marker-color": "#7e7e7e",
	        "marker-size": "medium",
	        "marker-symbol": "",
	        "icon": "<?php echo $markerku;?>",
	        "description": "<?php echo "$ku_kode. $ku_nama";?>"
	      },
	      "geometry": {
	        "type": "Point",
	        "coordinates": [<?php echo $ku2_long;?>,<?php echo $ku2_lat;?>]
	      }
	    }

    
    
    
  ]
}