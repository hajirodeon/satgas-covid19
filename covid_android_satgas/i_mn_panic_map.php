<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_mn_panic_map.php";
$filenyax = "$sumber/covid_android_satgas/i_mn_panic_map.php";
$judul = "Data PANIC MAP";
$juduli = $judul;



//nilai request
$sesiku = balikin($_REQUEST['sesiku']);
$kd = balikin($_REQUEST['kd']);


//echo "$sesiku --> $kd";



//KEY GOOGLE MAP///////////////////////////////////////////////////////////////////////////////////////////////////////
$keyku = "AIzaSyByk0KLTzm6gkP9a8SYTYwwJ0qHlbTfRi8";





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
pentol2();



// set update
setInterval(pentol, 15000);
setInterval(pentol2, 15000);
   
   
   
function pentol() 
	{

	  $.getJSON('i_mn_panic_map_i_display.php?sesiku=<?php echo $sesiku;?>', function(data) { 
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






function pentol2() 
	{

	  $.getJSON('i_mn_panic_map_i_display2.php?kd=<?php echo $kd;?>', function(data) { 
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


<body onload="initialize()">
<form id="form1" runat="server">
<div id="map_canvas" style="width: 100%; height: 100%"></div>
</form>
</body>



<?php
/*
$keyku = "AIzaSyByk0KLTzm6gkP9a8SYTYwwJ0qHlbTfRi8";






<!doctype html>
<html>
    <head>
        <title>Google Maps API - harviacode.com</title>
        <!--1. Memanggil google Maps API-->
        <script src="http://maps.googleapis.com/maps/api/js?key=<?php echo $keyku;?>"></script>

        <script>

		function initMap() {
		    var pointA = new google.maps.LatLng(51.7519, -1.2578),
		        pointB = new google.maps.LatLng(50.8429, -0.1313),
		        myOptions = {
		            zoom: 7,
		            center: pointA
		        },
		        map = new google.maps.Map(document.getElementById('map-canvas'), myOptions),
		        // Instantiate a directions service.
		        directionsService = new google.maps.DirectionsService,
		        directionsDisplay = new google.maps.DirectionsRenderer({
		            map: map
		        }),
		        markerA = new google.maps.Marker({
		            position: pointA,
		            title: "point A",
		            label: "A",
		            map: map
		        }),
		        markerB = new google.maps.Marker({
		            position: pointB,
		            title: "point B",
		            label: "B",
		            map: map
		        });
		
		    // get route from A to B
		    calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);
		
		}
		
		
		
		function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
		    directionsService.route({
		        origin: pointA,
		        destination: pointB,
		        avoidTolls: true,
		        avoidHighways: false,
		        travelMode: google.maps.TravelMode.DRIVING
		    }, function (response, status) {
		        if (status == google.maps.DirectionsStatus.OK) {
		            directionsDisplay.setDirections(response);
		        } else {
		            window.alert('Directions request failed due to ' + status);
		        }
		    });
		}
		
		initMap();

        </script>
        <style>
		html, body {
          height: 100%;
          margin: 0;
          padding: 0;
      }
      #map-canvas {
          height: 100%;
          width: 100%;
      }
        </style>
    </head>
    <body>
        

<div id="map-canvas"></div>

    </body>
</html>

*/ 
?>