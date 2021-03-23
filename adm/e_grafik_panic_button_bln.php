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




<div class="box box-primary box-solid">
<div class="box-header with-border">
<h3 class="box-title">GRAFIK PANIC BUTTON : PER BULAN</h3>
</div>


	
	<?php
	//total
	$qyuk1x = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic");
	$tyuk1x = mysqli_num_rows($qyuk1x);
	
	
	
	
	
	//belum diproses
	$qyuk1 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
										"WHERE tuntas = 'false'");
	$tyuk1 = mysqli_num_rows($qyuk1);
	
	
	
	//proses
	$qyuk2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
										"WHERE tuntas = 'true'");
	$tyuk2 = mysqli_num_rows($qyuk2);
	
	
	
	
	//berhasil
	$qyuk3 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
										"WHERE tuntas = 'true' ".
										"AND sukses = 'true'");
	$tyuk3 = mysqli_num_rows($qyuk3);
	
	
	
	
	//gagal
	$qyuk4 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
										"WHERE tuntas = 'true' ".
										"AND sukses = 'false'");
	$tyuk4 = mysqli_num_rows($qyuk4);
	
	
	?>
	
	
	<!-- /.box-header -->
	<div class="box-body">
	
		<input name="bln2" size="10" value="BulanTahun" class="btn btn-default"> - 
		
		<input type="button" name="btnku" id="btnku" class="btn btn-success" value="TAMPILKAN >>" />
	
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
	
			<canvas id="demobar_panic"></canvas>
	
	
	      	<script  type="text/javascript">
	
	    	  var ctx = document.getElementById("demobar_panic").getContext("2d");
	    	  var data = {
	    	            labels: ["Belum Diproses","Proses","Berhasil","Gagal"],
	    	            datasets: [
	    	            {
	    	              label: "Status Panic BUtton",
	    	              data: ["<?php echo $tyuk1;?>", "<?php echo $tyuk2;?>", "<?php echo $tyuk3;?>", "<?php echo $tyuk4;?>"],
	                    backgroundColor: [
	                      "rgba(59, 100, 222, 1)",
	                      "rgba(203, 222, 225, 0.9)",
	                      "rgba(102, 50, 179, 1)",
	                      "rgba(246, 34, 19, 1)"]
	    	            }
	    	            ]
	    	            };
	
	    	  var myBarChart = new Chart(ctx, {
	    	            type: 'pie',
	    	            data: data,
	    	            options: {
	                    	responsive: true, 
	                    	legend: {
					            display: true,
					            position:'left',
					            labels: {
					                fontColor: 'rgb(255, 99, 132)'
					            }
					        },
					        
							tooltips: {
							    enabled: true
							  },
							  plugins: {
							    datalabels: {
							      formatter: (value, ctx) => {
							
							        let sum = ctx.dataset._meta[0].total;
							        let percentage = (value * 100 / sum).toFixed(2) + "%";
							        return percentage;
							
							
							      },
							      color: '#fff',
							    }
						 	}
						 
	    	          	}
	    	        });
	    	</script>
	
	
	
	</div>
	<!-- /.box-body -->
	<div class="card-footer clearfix">
	  <b><?php echo $tyuk1x;?></b> Data. 
	  <a href="k/grafik_panic_button_bln.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
	</div>
	<!-- /.box-footer -->
	
	
	
	
	


</div>