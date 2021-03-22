<?php
session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
$tpl = LoadTpl("../../template/coba_paging.html");


nocache;




//nilai
$filenya = "tabel.php";
$filenyax46 = "i_tabel6.php";
$filenyax47 = "i_tabel7.php";
$filenyax48 = "i_tabel8.php";
$judul = "COBA PAGING";
$judulku = "$judul";











//isi *START
ob_start();




?>





<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $sumber;?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>










<script language='javascript'>
//membuat document jquery
$(document).ready(function(){


var pageku = $("#pagesetnya6").val();


$.ajax({
	url: "<?php echo $filenyax46;?>?aksi=form&pageku="+pageku,
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){					
		$("#idetailtable6").html(data);
		}
	});







$.ajax({
	url: "<?php echo $filenyax46;?>?aksi=jmldatanya",
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){					
		$("#ijmldatanya6").html(data);
		}
	});










$("#cariku6").on('keyup', function(){
		var limitku = $("#pagesetnya6").val();
    	var cariku = $("#cariku6").val();

		$.ajax({
			url: "<?php echo $filenyax46;?>?aksi=form&limitku6="+limitku+"&cariku6="+cariku,
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){					
				$("#idetailtable6").html(data);
				}
			});
	});






$("#pagesetnya6").on('change', function(){
	var limitku = $("#pagesetnya6").val();


	$.ajax({
		url: "<?php echo $filenyax46;?>?aksi=form&limitku6="+limitku,
		type:$(this).attr("method"),
		data:$(this).serialize(),
		success:function(data){					
			$("#idetailtable6").html(data);
			}
		});
	

	});





});

</script>















<script language='javascript'>
//membuat document jquery
$(document).ready(function(){


var pageku = $("#pagesetnya7").val();


$.ajax({
	url: "<?php echo $filenyax47;?>?aksi=form&pageku="+pageku,
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){					
		$("#idetailtable7").html(data);
		}
	});







$.ajax({
	url: "<?php echo $filenyax47;?>?aksi=jmldatanya",
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){					
		$("#ijmldatanya7").html(data);
		}
	});










$("#cariku7").on('keyup', function(){
		var limitku = $("#pagesetnya7").val();
    	var cariku = $("#cariku7").val();

		$.ajax({
			url: "<?php echo $filenyax47;?>?aksi=form&limitku7="+limitku+"&cariku7="+cariku,
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){					
				$("#idetailtable7").html(data);
				}
			});
	});






$("#pagesetnya7").on('change', function(){
	var limitku = $("#pagesetnya7").val();
	var cariku = $("#cariku7").val();


	$.ajax({
		url: "<?php echo $filenyax47;?>?aksi=form&limitku7="+limitku+"&cariku7="+cariku,
		type:$(this).attr("method"),
		data:$(this).serialize(),
		success:function(data){					
			$("#idetailtable7").html(data);
			}
		});
	

	});





});

</script>


















<script language='javascript'>
//membuat document jquery
$(document).ready(function(){


var pageku = $("#pagesetnya8").val();


$.ajax({
	url: "<?php echo $filenyax48;?>?aksi=form&pageku="+pageku,
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){					
		$("#idetailtable8").html(data);
		}
	});







$.ajax({
	url: "<?php echo $filenyax48;?>?aksi=jmldatanya",
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){					
		$("#ijmldatanya8").html(data);
		}
	});










$("#cariku8").on('keyup', function(){
		var limitku = $("#pagesetnya8").val();
    	var cariku = $("#cariku8").val();

		$.ajax({
			url: "<?php echo $filenyax48;?>?aksi=form&limitku8="+limitku+"&cariku8="+cariku,
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){					
				$("#idetailtable8").html(data);
				}
			});
	});






$("#pagesetnya8").on('change', function(){
	var limitku = $("#pagesetnya8").val();
	var cariku = $("#cariku8").val();


	$.ajax({
		url: "<?php echo $filenyax48;?>?aksi=form&limitku8="+limitku+"&cariku8="+cariku,
		type:$(this).attr("method"),
		data:$(this).serialize(),
		success:function(data){					
			$("#idetailtable8").html(data);
			}
		});
	

	});





});

</script>















ke-6 : 



<div class="row">

	<div class="col-md-12" id="ijmldatanya6">
			<img src="../../img/progress-bar.gif" width="150" />
	</div>
	
</div>

<div class="row">
	
	<div class="col-md-10">
		
		<select name="pagesetnya6" id="pagesetnya6" class="btn btn-warning">
			<option value="10" selected>10</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select> Data per Halaman
	</div>
	
	<div class="col-md-2">
		 
		<input type="text" class="btn btn-block btn-warning" name="cariku6" id="cariku6" placeholder="Cari...">
	
	</div>

</div>
		



<div id="idetailtable6">
	<img src="../../img/progress-bar.gif" width="150" />
</div>








<hr>


ke-7 : 



<div class="row">

	<div class="col-md-12" id="ijmldatanya7">
			<img src="../../img/progress-bar.gif" width="150" />
	</div>
	
</div>

<div class="row">
	
	<div class="col-md-10">
		
		<select name="pagesetnya7" id="pagesetnya7" class="btn btn-warning">
			<option value="10" selected>10</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select> Data per Halaman
	</div>
	
	<div class="col-md-2">
		 
		<input type="text" class="btn btn-block btn-warning" name="cariku7" id="cariku7" placeholder="Cari...">
	
	</div>

</div>
		





<div id="idetailtable7">
	<img src="../../img/progress-bar.gif" width="150" />
</div>











<hr>


ke-8 : 



<div class="row">

	<div class="col-md-12" id="ijmldatanya8">
			<img src="../../img/progress-bar.gif" width="150" />
	</div>
	
</div>

<div class="row">
	
	<div class="col-md-10">
		
		<select name="pagesetnya8" id="pagesetnya8" class="btn btn-warning">
			<option value="10" selected>10</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select> Data per Halaman
	</div>
	
	<div class="col-md-2">
		 
		<input type="text" class="btn btn-block btn-warning" name="cariku8" id="cariku8" placeholder="Cari...">
	
	</div>

</div>
		





<div id="idetailtable8">
	<img src="../../img/progress-bar.gif" width="150" />
</div>










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







<?php

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>