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








<!-- jQuery 3 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $sumber;?>/template/adminlte/dist/js/adminlte.min.js"></script>



  


<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $sumber;?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>





	
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

