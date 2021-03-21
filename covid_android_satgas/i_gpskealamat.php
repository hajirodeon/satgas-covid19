<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");


nocache;


//nilai
$filenya = "$sumber/covid_android_satgas/i_gpskealamat.php";



////cari yg belum ada alamatnya
$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
						"WHERE alamat = '' ".
						"ORDER BY postdate DESC, ".
						"lat_x DESC, ".
						"lat_y DESC LIMIT 0,1");
$rku = mysqli_fetch_assoc($qku);
$ku_lat_x = balikin($rku['lat_x']);
$ku_lat_y = balikin($rku['lat_y']);
$ku_postdate = balikin($rku['postdate']);

//echo "$ku_postdate -> $ku_lat_x, $ku_lat_y <br>";
?>


<script>
$.ajax({
	url: "http://sicekal.com/satgascovidkendal/gpskealamat.php?lat=<?php echo $ku_lat_x;?>&long=<?php echo $ku_lat_y;?>",
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){			
		$("#e_alamatku").html(data);	
		}
	});

</script>


