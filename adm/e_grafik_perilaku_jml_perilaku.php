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
<h3 class="box-title">GRAFIK PERILAKU MASYARAKAT : PER JUMLAH PERILAKU</h3>
</div>

	            	                        	            

<?php
//masker
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS tmaskerpake ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_masker = balikin($ryuk1['tmaskerpake']);




//masker tidak
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_masker_tidak_pake) AS tmaskertidakpake ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_masker_tidak = balikin($ryuk1['tmaskertidakpake']);



//jagajarak
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_jaga_jarak) AS tjagajarak ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_jagajarak = balikin($ryuk1['tjagajarak']);



//jagajarak tidak
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_jaga_jarak_tidak) AS tjagajaraktidak ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_jagajarak_tidak = balikin($ryuk1['tjagajaraktidak']);



//diingatkan
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_diingatkan) AS tdiingatkan ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_diingatkan = balikin($ryuk1['tdiingatkan']);



//diingatkan tidak
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_diingatkan_tidak) AS tdiingatkantidak ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_diingatkan_tidak = balikin($ryuk1['tdiingatkantidak']);




//total orang
$total_orang = $yuk1_masker + $yuk1_masker_tidak + $yuk1_jagajarak + $yuk1_jagajarak_tidak + $yuk1_diingatkan + $yuk1_diingatkan_tidak;
?>


<!-- /.box-header -->
<div class="box-body">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

		<canvas id="demobar_jml_perilaku"></canvas>


      	<script  type="text/javascript">

    	  var ctx = document.getElementById("demobar_jml_perilaku").getContext("2d");
    	  var data = {
    	            labels: ["Memakai Masker","Tidak Memakai Masker","Jaga Jarak","Tidak Jaga Jarak","Diingatkan","Tidak Diingatkan"],
    	            datasets: [
    	            {
    	              label: "Status",
    	              data: ["<?php echo $yuk1_masker;?>", "<?php echo $yuk1_masker_tidak;?>", "<?php echo $yuk1_jagajarak;?>", "<?php echo $yuk1_jagajarak_tidak;?>", "<?php echo $yuk1_diingatkan;?>", "<?php echo $yuk1_diingatkan_tidak;?>"],
                    backgroundColor: [
                      "#E52B50",
                      "#FFBF00",
                      "#9966CC",
                      "#FBCEB1", 
                      "#7FFFD4", 
                      "#007FFF"]
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
  <b><?php echo $total_orang;?></b> Data. 
  <a href="perilaku/grafik_perilaku_jml_perilaku.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
</div>
<!-- /.box-footer -->



</div>