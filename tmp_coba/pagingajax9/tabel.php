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
$filenyax49 = "i_tabel9.php";
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










$("#btnBARU").on('click', function(){

	$.ajax({
		url: "<?php echo $filenyax46;?>?aksi=formbaru",
		type:$(this).attr("method"),
		data:$(this).serialize(),
		success:function(data){				
			$(".modal-title").html("ENTRI BARU");
			$(".modal-body").html(data);
			$("#myModal").modal('show');
			}
		});

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





});

</script>

















<style type="text/css">

#myModal {
	z-index: 9999;
	}

</style>

	
<link rel="stylesheet" href="../../template/css/bootstrap-side-modals.css">



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
<div class="modal-content">
<div class="modal-header btn-danger">
<h5 class="modal-title">judulnya</h5>
<button type="button" class="btn-warning close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<p>isinya...</p>
</div>

</div>
</div>
</div>










ke-6 : 




<div class="row">
	
	<div class="col-md-9">
		<button id="btnBARU" class="btn btn-danger"><i class="fa fa-pencil"></i> ENTRI BARU</button>
	</div>
	
	<div class="col-md-3" align="right">
		<select name="pagesetnya6" id="pagesetnya6" class="btn btn-warning">
			<option value="10" selected>10</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>  
		<input type="text" class="btn btn-warning" name="cariku6" id="cariku6" placeholder="Cari...">
	
	</div>

</div>
		





<div id="idetailtable6">
	<img src="../../img/progress-bar.gif" width="150" />
</div>










<hr>










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