<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_mn_perilaku_map.php";
$filenyax = "$sumber/covid_android_satgas/i_mn_perilaku_map.php";
$judul = "Data PERILAKU MAP";
$juduli = $judul;


//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];







//terpilih
$qku = mysqli_query($koneksi, "SELECT * FROM a_profil");
$rku = mysqli_fetch_assoc($qku);
$ku_judul = balikin($rku['judul']);
$ku_isi = balikin($rku['isi']);
$ku_web = balikin($rku['web']);
$ku_email = balikin($rku['email']);
$ku_alamat = balikin($rku['alamat']);
$ku_alamat2 = balikin($rku['alamat_googlemap']);
$ku_telp = balikin($rku['telp']);
$ku_fax = balikin($rku['fax']);
$ku_fb = balikin($rku['fb']);
$ku_twitter = balikin($rku['twitter']);
$ku_youtube = balikin($rku['youtube']);
$ku_wa = balikin($rku['wa']);
$ku_instagram = balikin($rku['instagram']);
$ku_latx = balikin($rku['lat_x']);
$ku_laty = balikin($rku['lat_y']);



$datax_lat = $ku_laty;
$datax_long = $ku_latx; 

?>








<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> 
<script type="text/javascript" src = "http://maps.google.com/maps/api/js?sensor=false&key=<?php echo $keyku;?>"></script>

</script>
<script type="text/javascript">
function initialize() {

var mapOptions = {
center: new google.maps.LatLng(<?php echo $datax_long;?>, <?php echo $datax_lat;?>),
zoom: 16,
mapTypeId: google.maps.MapTypeId.ROADMAP
};

var infoWindow = new google.maps.InfoWindow();
var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);





// execute once
pentol();

// set update
setInterval(pentol, 15000);
   
   
function pentol() 
	{

	  $.getJSON('i_mn_perilaku_map_i_display.php', function(data) { 
	            $.each( data.points, function(i, value) {
	
	                var myLatlng = new google.maps.LatLng(value.lat, value.lon);
	                //alert(myLatlng);
	                var marker = new google.maps.Marker({
	                position: myLatlng,
	                map: map,
	                title: "NO : "+value.nama
	                });
	
	            });
		});
	}






}

</script>




<div id="map_canvas" style="width: 100%; height: 500px"></div>


