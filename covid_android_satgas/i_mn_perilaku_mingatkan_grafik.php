<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;





//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];









//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>






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
<script src="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Bootstrap core CSS -->
<link href="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">



<!-- ChartJS -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/chart.js/Chart.js"></script>


    
  


<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $sumber;?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>








<?php
//hitung total
$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_ingatkan) AS total_masker_pake, ".
									"SUM(jml_ingatkan_tidak) AS total_masker_tidak ".
									"FROM e_perilaku_masyarakat");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
$yuk_masker_total = $yuk_masker_pake + $yuk_masker_tidak;

$tku2x2 = $yuk_masker_total;
$tku2 = $yuk_masker_pake;



//jika null
if (empty($tku2))
	{
	$tku2x = 0;
	
	$persennya = 0;
	}
else
	{		
	$tku2x = $tku2;
	
	$persennya = round(($tku2x / $tku2x2) * 100,2); 
	}


echo '<div class="progress-group">
	<span class="progress-text">Diingatkan</span>
	<span class="progress-number"><b>'.$tku2x.'</b>/'.$tku2x2.'</span>

	<div class="progress sm">
		<div class="progress-bar progress-bar-red" style="width: '.$persennya.'%"></div>
	</div>
</div>';






$tku2x2 = $yuk_masker_total;
$tku2 = $yuk_masker_tidak;



//jika null
if (empty($tku2))
	{
	$tku2x = 0;
	
	$persennya = 0;
	}
else
	{		
	$tku2x = $tku2;
	
	$persennya = round(($tku2x / $tku2x2) * 100,2); 
	}


echo '<div class="progress-group">
	<span class="progress-text">Tidak Diingatkan</span>
	<span class="progress-number"><b>'.$tku2x.'</b>/'.$tku2x2.'</span>

	<div class="progress sm">
		<div class="progress-bar progress-bar-red" style="width: '.$persennya.'%"></div>
	</div>
</div>';






exit();
?>