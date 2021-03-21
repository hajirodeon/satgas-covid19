<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_tracking.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_tracking.php";
$judul = "Tracking Real Time";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];


$sesikd = $sesiku;


//ambil nilai session
$latx_sesi = $_SESSION['latx_sesi'];
$laty_sesi = $_SESSION['laty_sesi'];
$xyz_sesi = $_SESSION['xyz_sesi'];
$latx = balikin($latx_sesi);
$laty = balikin($laty_sesi);

$e_latx = cegah($latx);
$e_laty = cegah($laty);
$e_xyz = cegah($xyz_sesi);



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//terpilih
$qku = mysqli_query($koneksi, "SELECT * FROM a_profil");
$rku = mysqli_fetch_assoc($qku);
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
zoom: 20,
mapTypeId: google.maps.MapTypeId.ROADMAP
};

var infoWindow = new google.maps.InfoWindow();
var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);


var markers = [];




   // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }






// execute once
pentol();
pentol2();

// set update
setInterval(pentol, 60000);
setInterval(pentol2, 60000);
   



   
function pentol() 
	{
	deleteMarkers();
	
	
	
	  $.getJSON('i_akun_tracking_data.php?sesikd=<?php echo $sesikd;?>', function(data) { 
	            $.each( data.points, function(i, value) {
	
	                var myLatlng = new google.maps.LatLng(value.lat, value.lon);
	                
	                map.setCenter(new google.maps.LatLng(value.lat, value.lon));

                                            
	                //alert(myLatlng);
	                var marker = new google.maps.Marker({
	                position: myLatlng,
	                map: map,
	                title: "."+value.nama
	                });
	                

		        markers.push(marker);
	            });
		});
	}
	
	
	
	
	
	   
function pentol2() 
	{
	deleteMarkers();
	
	
	var iw = new google.maps.InfoWindow();
	
	  $.getJSON('i_akun_tracking_data_lain.php?sesikd=<?php echo $sesikd;?>', function(data) { 
	            $.each( data.points, function(i, value) {
	
	                var myLatlng = new google.maps.LatLng(value.lat, value.lon);

	                //alert(myLatlng);
	                var marker = new google.maps.Marker({
	                position: myLatlng,
	                map: map,
	                title: "."+value.nama
	                });
	                
				marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
				
				
				
				google.maps.event.addListener(marker, 'click', function() {

					$.ajax({  
		                url: 'i_akun_tracking_data_lain_ket.php?sesikd=<?php echo $sesikd;?>&idku='+myLatlng,  
		                success: function(data) {  
		               		iw.setContent(data);  
		                    iw.open(map, marker);  
		                }  
		            });  
				});				



		        markers.push(marker);
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
exit();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>