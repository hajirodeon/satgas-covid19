<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>





<div class="box box-success box-solid">
<div class="box-header with-border">
<h3 class="box-title">GRAFIK PERILAKU MASYARAKAT : PER TIPE LAPORAN</h3>
</div>

            	                        	            


<!-- /.box-header -->
<div class="box-body">

<?php
//total
$qyuk4 = mysqli_query($koneksi, "SELECT DISTINCT(kd) AS totalku ".
									"FROM e_perilaku_masyarakat ".
									"WHERE tipe_laporan <> ''");
$tyuk4 = mysqli_num_rows($qyuk4);



//query 
$qku = mysqli_query($koneksi, "SELECT * FROM e_m_tipe_laporan ".
								"ORDER by round(nama) ASC");
$rku = mysqli_fetch_assoc($qku);


do 
	{
	$i_nox = $i_nox + 1;
	$i_nama = balikin($rku['nama']);
	$i_nama2 = cegah($rku['nama']);


	//jml
	$qyuk41 = mysqli_query($koneksi, "SELECT DISTINCT(kd) AS totalku ".
										"FROM e_perilaku_masyarakat ".
										"WHERE tipe_laporan = '$i_nama2'");
	$tyuk41 = mysqli_num_rows($qyuk41);


	//jika null, kasi 1
	if (empty($tyuk41))
		{
		$nil_persen = "1";
		$jmlku = "0";
		}
	else
		{
		//persen
		$nil_persen = ($tyuk41/$tyuk4) * 100;
		$jmlku = $tyuk41; 	
		}
	
	

	//warnanya
	$qyuk42 = mysqli_query($koneksi, "SELECT * FROM m_warna ".
										"WHERE kd = '$i_nox'");
	$ryuk42 = mysqli_fetch_assoc($qyuk42);
	$i_warna = balikin($ryuk42['kode']);
		
	
    echo '<div class="progress-group"> 
      '.$i_nama.'
      <span class="float-right"><b>'.$jmlku.'</b></span>
      <div class="progress progress-sm">
        <div class="progress-bar" style="background-color:'.$i_warna.'; width: '.$nil_persen.'%"></div>
      </div>
    </div>';
	}
while ($rku = mysqli_fetch_assoc($qku));
?>
	
</div>
<!-- /.box-body -->
<div class="card-footer clearfix">
  <b><?php echo $tyuk4;?></b> Data. 
  <a href="perilaku/grafik_perilaku_kategori.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
</div>
<!-- /.box-footer -->



</div>