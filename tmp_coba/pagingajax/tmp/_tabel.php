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
$filenyax4 = "i_tabel.php";
$judul = "COBA PAGING";
$judulku = "$judul";











//isi *START
ob_start();





require("class_paging.php");
?>





<!-- Bootstrap core JavaScript -->
<script src="{sumber}/template/vendor/jquery/jquery.min.js"></script>
<script src="{sumber}/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>







<script language='javascript'>
//membuat document jquery
$(document).ready(function(){


var pageku = $("#pagesetnya").val();


$.ajax({
	url: "<?php echo $filenyax4;?>?aksi=form&pageku="+pageku,
	type:$(this).attr("method"),
	data:$(this).serialize(),
	success:function(data){					
		$("#idetailtable").html(data);
		}
	});








$("#cariku").on('keyup', function(){
		var limitku = $("#pagesetnya").val();
    	var cariku = $("#cariku").val();

		$.ajax({
			url: "<?php echo $filenyax4;?>?aksi=form&limitku="+limitku+"&cariku="+cariku,
			type:$(this).attr("method"),
			data:$(this).serialize(),
			success:function(data){					
				$("#idetailtable").html(data);
				}
			});
	});






$("#pagesetnya").on('change', function(){
	var limitku = $("#pagesetnya").val();


	$.ajax({
		url: "<?php echo $filenyax4;?>?aksi=form&limitku="+limitku,
		type:$(this).attr("method"),
		data:$(this).serialize(),
		success:function(data){					
			$("#idetailtable").html(data);
			}
		});
	

	});





});

</script>






<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>


<td align="right">
	

<select name="pagesetnya" id="pagesetnya" class="btn btn-warning">
	<option value="10" selected>10</option>
	<option value="30">30</option>
	<option value="50">50</option>
	<option value="100">100</option>
</select> 
<input type="text" class="btn btn-warning" size="15" name="cariku" id="cariku" placeholder="Cari...">

</td>
</tr>
</table>
		


<div id="idetailtable">
	<img src="../../img/progress-bar.gif" width="150" />
</div>






<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{sumber}/template/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{sumber}/template/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{sumber}/template/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{sumber}/template/adminlte/bower_components/jvectormap/jquery-jvectormap.css">
  
  
  



  
  


<!-- jQuery 3 -->
<script src="{sumber}/template/adminlte/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{sumber}/template/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="{sumber}/template/adminlte/dist/js/adminlte.min.js"></script>



<!-- Bootstrap core JavaScript -->
<script src="{sumber}/template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Bootstrap core CSS -->
<link href="{sumber}/template/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">



<!-- ChartJS -->
<script src="{sumber}/template/adminlte/bower_components/chart.js/Chart.js"></script>


    



  <!-- Theme style -->
  <link rel="stylesheet" href="{sumber}/template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{sumber}/template/adminlte/dist/css/skins/skins-biasawae.css">







<?php

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>