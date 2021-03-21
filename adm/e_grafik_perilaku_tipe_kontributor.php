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






<div class="box box-success box-solid">
<div class="box-header with-border">
<h3 class="box-title">GRAFIK PERILAKU MASYARAKAT : Tipe User Kontributor</h3>
</div>

   	            	            

	
	<!-- /.box-header -->
	<div class="box-body">
	  	
	  	
	  	
						
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
			<canvas id="demobar_perilaku2"></canvas>
	
	
	      	<script  type="text/javascript">
	
	    	  var ctx = document.getElementById("demobar_perilaku2").getContext("2d");
	    	  var data = {
	    	            labels: [
						<?php
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 0,9");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['no']);
							$i_nama = balikin($rku['nama']);
				
							echo "\"$i_nama\", ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 9,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['no']);
							$i_nama = balikin($rku['nama']);
				
							echo "\"$i_nama\"";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						?>
	
	
	    	            
	    	            ],
	    	            datasets: [
	    	            {
	    	              label: "GRAFIK TIPE USER",
	    	              data: [
	    	              
	    	            <?php  
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 0,9");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_nama = cegah($rku['nama']);
				
							//jml user e
							$qku2 = mysqli_query($koneksi, "SELECT DISTINCT(e_perilaku_masyarakat.kontributor_kd) AS total ".
															"FROM m_orang, e_perilaku_masyarakat ".
															"WHERE e_perilaku_masyarakat.kontributor_kd = m_orang.kd ".
															"AND m_orang.tipe_user = '$i_nama'");
							$rku2 = mysqli_fetch_assoc($qku2);
							$tku2 = mysqli_num_rows($qku2);
				
				
							echo "\"$tku2\", ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 9,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_nama = cegah($rku['nama']);
	
							//jml user e
							$qku2 = mysqli_query($koneksi, "SELECT DISTINCT(e_perilaku_masyarakat.kontributor_kd) AS total ".
															"FROM m_orang, e_perilaku_masyarakat ".
															"WHERE e_perilaku_masyarakat.kontributor_kd = m_orang.kd ".
															"AND m_orang.tipe_user = '$i_nama'");
							$rku2 = mysqli_fetch_assoc($qku2);
							$tku2 = mysqli_num_rows($qku2);
				
							echo "\"$tku2\"";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						?>
	
	    	              
	    	              ],
	                    backgroundColor: [
	
						<?php
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 0,9");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['no']);
							$i_nama = balikin($rku['warna']);
				
							echo "\"$i_nama\", ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 9,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['no']);
							$i_nama = balikin($rku['warna']);
				
							echo "\"$i_nama\"";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						?>
	
	
	
							]
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
	
	
	<?php
	//jml user e
	$qku2 = mysqli_query($koneksi, "SELECT DISTINCT(kontributor_kd) AS total ".
										"FROM e_perilaku_masyarakat");
	$tku2 = mysqli_num_rows($qku2);
	?>
	
	<div class="card-footer clearfix">
	  <b><?php echo $tku2;?></b> Data.
	  <a href="perilaku/grafik_perilaku_tipe_kontributor.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
	</div>
	<!-- /.box-footer -->


</div>