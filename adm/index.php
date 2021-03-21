<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/adm.php");


nocache;

//nilai
$filenya = "index.php";
$judul = "Admin SATGAS COVID-19 Kota BIASAWAE";
$judulku = "$judul  [$adm_session]";





//terpilih
$qku = mysqli_query($koneksi, "SELECT * FROM a_profil");
$rku = mysqli_fetch_assoc($qku);
$ku_latx = balikin($rku['lat_x']);
$ku_laty = balikin($rku['lat_y']);
$datax_lat = $ku_laty;
$datax_long = $ku_latx; 



?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $judul;?></title>


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo $sumber;?>/template/flexor/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo $sumber;?>/template/flexor/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo $sumber;?>/template/flexor/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo $sumber;?>/template/flexor/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo $sumber;?>/template/flexor/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo $sumber;?>/template/flexor/assets/css/style.css" rel="stylesheet">
  
  



  

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/skins/skins-biasawae.css">






  


  

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/skins/skins-biasawae.css">








<!-- jQuery 3 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $sumber;?>/template/adminlte/dist/js/adminlte.min.js"></script>



  


<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $sumber;?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>






</head>

<body onload="<?php echo $diload;?>">

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <ul>
          <li><i class="icofont-envelope"></i>SATGAS COVID-19 Kota BIASAWAE</li>
        </ul>

      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="<?php echo $sumber;?>/adm/index.php"><span>ADMIN</span></a></h1>
      </div>



	<div id="i_notifku"></div>

    </div>
  </header><!-- End Header -->




  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">







      <div class="container">

        <div class="row">

          <div class="col-lg-12 col-md-12 footer-contact">
          	
			<h1><?php echo $judulku;?></h1>


	       <div class="row">
	
			<div class="col-md-12">
			<div class="box">
			
			<div class="box-body">
			<div class="row">
			
			
				<div class="col-md-12">





	
			<style>
				
			#btn1 {
				  position: relative;
				  top: 175px;
				  left: 10px;
				  z-index: 9999;
				}
			</style>
        	
			<button id="btn1" style='font-size:24px'><i class='fas fa-crosshairs'></i></button>
			<br>							
			
			
			<input type="text" name="kunci" id="kunci" class="btn btn-default" placeholder="Nama User" required>
			<input type="hidden" name="elatku" id="elatku">
			<input type="hidden" name="elatx" id="elatx">
			<input type="hidden" name="elaty" id="elaty">
			
			<button id="btn2" class="btn btn-danger">CARI >></button>



    
      <div class="row">
        <!-- /.col -->
        <div class="col-md-8">
    
    
  			<div id="map_canvas"></div>
  			
  		</div>

        <!-- /.col -->
        <div class="col-md-4">
        	
        	


			<!-- jQuery -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			 
			<!-- jQuery UI -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
			 
			<!-- Bootstrap CSS -->
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">




			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&key=<?php echo $keyku;?>"></script>
			
			<script language='javascript'>
						  	
			$.noConflict();
			
				var map;
			
				function initialize() {
				  map = new google.maps.Map(document.getElementById('map_canvas'), {
				    center: {
				      lng: <?php echo $datax_lat;?>,
				      lat: <?php echo $datax_long;?>
				    },
				    zoom: 8,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				  });
				  
			
			
				  
				  var infowindow = new google.maps.InfoWindow();
				
			
			
			
			
				
					
						//tni
					  geojesonlayer1 = new google.maps.Data();
					  geojesonlayer1.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas1.php');
					  geojesonlayer1.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer1.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
							
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer1.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'),
								optimized: false, 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
						//polri
					  geojesonlayer2 = new google.maps.Data();
					  geojesonlayer2.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas2.php');
					  geojesonlayer2.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer2.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer2.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
						//satpol pp dan damkar
					  geojesonlayer3 = new google.maps.Data();
					  geojesonlayer3.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas3.php');
					  geojesonlayer3.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer3.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer3.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
						//dinkes
					  geojesonlayer4 = new google.maps.Data();
					  geojesonlayer4.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas4.php');
					  geojesonlayer4.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer4.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer4.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
						//bpbd
					  geojesonlayer5 = new google.maps.Data();
					  geojesonlayer5.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas5.php');
					  geojesonlayer5.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer5.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer5.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
						//kominfo
					  geojesonlayer6 = new google.maps.Data();
					  geojesonlayer6.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas6.php');
					  geojesonlayer6.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer6.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer6.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
						//pemdes
					  geojesonlayer7 = new google.maps.Data();
					  geojesonlayer7.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas7.php');
					  geojesonlayer7.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer7.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer7.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
				
				
				
						//rw
					  geojesonlayer8 = new google.maps.Data();
					  geojesonlayer8.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas8.php');
					  geojesonlayer8.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer8.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer8.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
				
				
				
				
				
						//rt
					  geojesonlayer9 = new google.maps.Data();
					  geojesonlayer9.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas9.php');
					  geojesonlayer9.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer9.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer9.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
				
				
				
						//masyarakat
					  geojesonlayer10 = new google.maps.Data();
					  geojesonlayer10.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas10.php');
					  geojesonlayer10.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer10.addListener('click', function(event) {
					  		
							var myHTML = event.feature.getProperty("description");
							
							$.ajax({  
				                url: 'i_marker_user.php?aksi=form&userkd='+myHTML,  
				                success: function(data) {  
									$(".modal-title").html("PROFIL USER");
									$(".modal-body").html(data);
									$("#myModal").modal('show');
								
				  
				                }  
				            });
				            
				            
				
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer10.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
				
				
				
				
						//kena covid-19
					  geojesonlayer20 = new google.maps.Data();
					  geojesonlayer20.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas20.php');
					  geojesonlayer20.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer20.addListener('click', function(event) {
							var myHTML = event.feature.getProperty("description");
							infowindow.setContent("<div style='width:150px;'>"+myHTML+"</div>");
							
							// position the infowindow on the marker
							infowindow.setPosition(event.feature.getGeometry().get());
							
							// anchor the infowindow on the marker
							infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
							infowindow.open(map);
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer20.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
						//panic button
					  geojesonlayer30 = new google.maps.Data();
					  geojesonlayer30.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas30.php');
					  geojesonlayer30.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer30.addListener('click', function(event) {
							var myHTML = event.feature.getProperty("description");
							infowindow.setContent("<div style='width:150px;'>"+myHTML+"</div>");
							
							// position the infowindow on the marker
							infowindow.setPosition(event.feature.getGeometry().get());
							
							// anchor the infowindow on the marker
							infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
							infowindow.open(map);
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer30.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
						//perilaku masyarakat
					  geojesonlayer40 = new google.maps.Data();
					  geojesonlayer40.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas40.php');
					  geojesonlayer40.setMap(map);
					  
					  // When the user clicks, open an infowindow
					  geojesonlayer40.addListener('click', function(event) {
							var myHTML = event.feature.getProperty("description");
							infowindow.setContent("<div style='width:150px;'>"+myHTML+"</div>");
							
							// position the infowindow on the marker
							infowindow.setPosition(event.feature.getGeometry().get());
							
							// anchor the infowindow on the marker
							infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
							infowindow.open(map);
						});
				
				
						// Use custom marker from "icon" field in the geojson
						geojesonlayer40.setStyle(function(feature) {
							return {
								icon:feature.getProperty('icon'), 
								title:feature.getProperty('marker-symbol')					
								};
						});
				
				
				
				
				
				
				
				
				
				
				
				
				
					$("#layer1_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer1.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer1.setMap(null);
								geojesonlayer1.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas1.php');
								geojesonlayer1.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer1.setMap(null);
						  	}
						});
					
					
					
					
					
					$("#layer2_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer2.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer2.setMap(null);
								geojesonlayer2.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas2.php');
								geojesonlayer2.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer2.setMap(null);
						  	}
						});
					
					
				
				
					
					
					
					$("#layer3_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer3.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer3.setMap(null);
								geojesonlayer3.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas3.php');
								geojesonlayer3.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer3.setMap(null);
						  	}
						});
					
				
				
				
				
					
					$("#layer4_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer4.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer4.setMap(null);
								geojesonlayer4.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas4.php');
								geojesonlayer4.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer4.setMap(null);
						  	}
						});
					
				
				
				
				
				
				
				
					
					$("#layer5_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer5.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer5.setMap(null);
								geojesonlayer5.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas5.php');
								geojesonlayer5.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer5.setMap(null);
						  	}
						});
					
				
				
				
				
					
					$("#layer6_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer6.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer6.setMap(null);
								geojesonlayer6.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas6.php');
								geojesonlayer6.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer6.setMap(null);
						  	}
						});
					
				
				
				
				
					
					$("#layer7_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer7.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer7.setMap(null);
								geojesonlayer7.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas7.php');
								geojesonlayer7.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer7.setMap(null);
						  	}
						});
					
				
				
				
				
				
					
					$("#layer8_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer8.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer8.setMap(null);
								geojesonlayer8.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas8.php');
								geojesonlayer8.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer8.setMap(null);
						  	}
						});
					
				
				
				
				
				
				
					
					$("#layer9_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer9.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer9.setMap(null);
								geojesonlayer9.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas9.php');
								geojesonlayer9.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer9.setMap(null);
						  	}
						});
					
				
				
				
				
					
					$("#layer10_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer10.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer10.setMap(null);
								geojesonlayer10.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas10.php');
								geojesonlayer10.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer10.setMap(null);
						  	}
						});
					
				
				
				
				
				
				
				
				
				
				
					
					$("#layer20_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer20.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer20.setMap(null);
								geojesonlayer20.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas20.php');
								geojesonlayer20.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer20.setMap(null);
						  	}
						});
					
				
				
				
				
				
				
					$("#layer30_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer30.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer30.setMap(null);
								geojesonlayer30.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas30.php');
								geojesonlayer30.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer30.setMap(null);
						  	}
						});
					
			
			
			
			
				
				
				
					$("#layer40_checkbox").change(function() {
					  	if (this.checked) 
						  	{
						    geojesonlayer40.setMap(map);
				
							setInterval(loadLog31, 30000);
							
							function loadLog31()
								{
								geojesonlayer40.setMap(null);
								geojesonlayer40.loadGeoJson('<?php echo $sumber;?>/adm/geojson_satgas40.php');
								geojesonlayer40.setMap(map);
								}
						  	} 
						  else 
						  	{
						    geojesonlayer40.setMap(null);
						  	}
						});
					
			
			
			
			
			
			
			
			
				$("#checkAll").change(function () {
				    $("input:checkbox").prop('checked', $(this).prop("checked"));
				    
					  if (this.checked) {
					    geojesonlayer1.setMap(map);
					    geojesonlayer2.setMap(map);
					    geojesonlayer3.setMap(map);
					    geojesonlayer4.setMap(map);
					    geojesonlayer5.setMap(map);
					    geojesonlayer6.setMap(map);
					    geojesonlayer7.setMap(map);
					    geojesonlayer8.setMap(map);
					    geojesonlayer9.setMap(map);
					    geojesonlayer10.setMap(map);
					    geojesonlayer20.setMap(map);
					    geojesonlayer30.setMap(map);
					    geojesonlayer40.setMap(map);
					    } 
					  else 
					  	{
					    geojesonlayer1.setMap(null);
					    geojesonlayer2.setMap(null);
					    geojesonlayer3.setMap(null);
					    geojesonlayer4.setMap(null);
					    geojesonlayer5.setMap(null);
					    geojesonlayer6.setMap(null);
					    geojesonlayer7.setMap(null);
					    geojesonlayer8.setMap(null);
					    geojesonlayer9.setMap(null);
					    geojesonlayer10.setMap(null);
					    geojesonlayer20.setMap(null);
					    geojesonlayer30.setMap(null);
					    geojesonlayer40.setMap(null);
					  	}
					});
			
			
			
			
			    }
			
			
			
			
			
			
			google.maps.event.addDomListener(window, 'load', initialize);
			
			</script>
			
			
			
			
			<script>
			$(document).ready(function () {
			
			$.noConflict();
			
			
				
				$("#btn1").on('click', function ()
				    {
					map.setCenter({
						lat : <?php echo $datax_long;?>,
						lng : <?php echo $datax_lat;?>
					});
					
				
					map.setZoom(18);
					});
			
			
			
			
			
				
				$("#btn2").on('click', function ()
				    {
				    var nilku = $("#kunci").val();
				    var elatku = $("#elatku").val();
				    var elaty = parseFloat($("#elatx").val());
				    var elatx = parseFloat($("#elaty").val()); 
			
					
					map.setCenter({
						lat : elatx,
						lng : elaty
					});
					
				
					map.setZoom(18);
					
			
					//$("#elatx").val("");
					//$("#elaty").val("");
					
				    
					});
			
			
				
				
				
				
			});
			    </script>
			
			
			
			
			 
			<script type="text/javascript">
			  $(function() {
			  	
			  	$.noConflict();

			     $( "#kunci" ).autocomplete({
			       source: 'i_cari_nama.php',
			       minLength: 3,
			       select: function (event, ui) {
					   // Set selection
					   $('#kunci').val(ui.item.label); 
					   $('#elatx').val(ui.item.value1); 
					   $('#elaty').val(ui.item.value2); 
					   return false;
					  }
			     });
			    
			    
			    
			     
			  });
			

			</script>





		<?php
		echo '<form name="formx" id="formx">
		<table class="table table-hover" border="1"cellpadding="3" cellspacing="3" width="100%">
		<tr valign="top" bgcolor="'.$warnaheader.'">
			<th width="5">
				<label><input type="checkbox" id="checkAll"/></label>
			</th>
			<th><strong><font color="'.$warnatext.'">URAIAN</font></strong></th>
		</tr>
		</thead>
	    <tbody>';

		//list 
		$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
								"ORDER BY round(no) ASC");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		
		do
			{
			$iku = $iku + 1;		
			$ku_kd = cegah($rku['kd']);
			$ku_no = cegah($rku['no']);
			$ku_nama = cegah($rku['nama']);
			$ku_nama2 = balikin($rku['nama']);
			$ku_warna = balikin($rku['warna']);


					
					
							//jika orang 
							if ($ku_no <= 10)
								{
								//total
								$qku21 = mysqli_query($koneksi, "SELECT kd FROM m_orang ".
														"WHERE tipe_user = '$ku_nama' ".
														"ORDER BY nama ASC");
								$ryuk21 = mysqli_fetch_assoc($qku21);
								$tku21 = mysqli_num_rows($qku21);
								}
								
							//jika kena covid 
							else if ($ku_no == 20)
								{
								//total
								$qku21 = mysqli_query($koneksi, "SELECT kd FROM m_orang ".
														"WHERE kenacovid = 'true' ".
														"ORDER BY nama ASC");
								$ryuk21 = mysqli_fetch_assoc($qku21);
								$tku21 = mysqli_num_rows($qku21);
								}
								
					
								
								
							//jika panic button 
							else if ($ku_no == 30)
								{
								//total
								$qku21 = mysqli_query($koneksi, "SELECT DISTINCT(umum_sesi_panic.umum_kd) AS total ".
														"FROM m_orang, umum_sesi_panic ".
														"WHERE umum_sesi_panic.umum_kd = m_orang.kd ".
														"ORDER BY m_orang.nama ASC");
								$ryuk21 = mysqli_fetch_assoc($qku21);
								$tku21 = mysqli_num_rows($qku21);
								}
								
								
								
								
								
								
							//jika perilaku masyarakat 
							else if ($ku_no == 40)
								{
								//total
								$qku21 = mysqli_query($koneksi, "SELECT DISTINCT(e_perilaku_masyarakat.kontributor_nik) AS total ".
														"FROM m_orang, e_perilaku_masyarakat ".
														"WHERE e_perilaku_masyarakat.kontributor_nik = m_orang.nip ".
														"ORDER BY e_perilaku_masyarakat.postdate DESC");
								$ryuk21 = mysqli_fetch_assoc($qku21);
								$tku21 = mysqli_num_rows($qku21);
								}
								
								
				
				

			echo '<tr valign="top">
				<th>
					<input id="layer'.$iku.'_checkbox" type="checkbox" checked />
				</th>
				<th>
					<i class="fa fa-square" style="font-size:24px;color:'.$ku_warna.'"></i> '.$ku_nama2.' ['.$tku21.']
				</th>
			</tr>';
			}
		while ($rku = mysqli_fetch_assoc($qku));

		echo '<tr valign="top" bgcolor="'.$warnaheader.'">
				<th width="50">
					<label><input type="checkbox" id="checkAll"/></label>
				</th>
				<th><strong><font color="'.$warnatext.'">URAIAN</font></strong></th>
			</tr>
	    </tbody>
	    
	    </table>';

		
		echo '</form>';
		?>











        </div>
      </div>





<style type="text/css">
#map_canvas 
	{ 
	height:800px; width:100%; 
	}
	
#myModal {
	z-index: 9999;
	}

</style>

	
<link rel="stylesheet" href="../template/css/bootstrap-side-modals.css">





<div id="myModal" class="modal full fade" id="fullscreen_modal" tabindex="-1" role="dialog" aria-labelledby="fullscreen_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">judulnya...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	isinya
      </div>
    </div>
  </div>
</div>











        	    
	    	    </div>
				</div>
				</div>
				</div>
			</div>
			</div>

            
          </div>


        </div>
      </div>
      




  </footer><!-- End Footer -->



    <div class="container d-lg-flex py-4">

      <div class="mr-lg-auto text-center text-lg-left">
        <div class="copyright">
          &copy; 2021 <strong><span><?php echo $versi;?></span></strong>.
        </div>
      </div>
    </div>


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>














	 <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo $sumber;?>/template/css/bootstrap.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo $sumber;?>/template/css/font-awesome.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    
    




<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/jvectormap/jquery-jvectormap.css">
  
  
  



  
  


<!-- jQuery 3 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $sumber;?>/template/adminlte/dist/js/adminlte.min.js"></script>



<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Bootstrap core CSS -->
<link href="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">



<!-- ChartJS -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/chart.js/Chart.js"></script>


    



  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/skins/skins-biasawae.css">








  <!-- Vendor JS Files -->
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo $sumber;?>/template/flexor/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo $sumber;?>/template/flexor/assets/js/main.js"></script>




<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>







<script>
$(document).ready(function(){


$.noConflict();


$.ajax({
	url: "<?php echo $sumber;?>/adm/i_notif_menu.php",
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){					
		$("#i_notifku").html(data);
		}
	});





setInterval(loadLog3, 30000);

function loadLog3()
	{
	$.ajax({
		url: "<?php echo $sumber;?>/adm/i_notif_menu.php",
		type:$(this).attr("method"),
		data:$(this).serialize(),
		success:function(data){					
			$("#i_notifku").html(data);
			}
		});

	}


})
</script>











</body>

</html>            


<?php
exit();
?>