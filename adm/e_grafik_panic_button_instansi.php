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
<h3 class="box-title">GRAFIK PANIC BUTTON : FORWARD INSTANSI</h3>
</div>
	            	            	            	            
	
	
	<!-- /.box-header -->
	<div class="box-body">
	
	
  	
					
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
		
	<div style="width: 100%; height: 400px" >
		<canvas id="panic_instansi" width="400" height="300"></canvas>
	</div>
	
	<script>
	//deklarasi chartjs untuk membuat grafik 2d di id mychart 
	var ctx = document.getElementById('panic_instansi').getContext('2d');
	
	var myChart = new Chart(ctx, {
	 //chart akan ditampilkan sebagai bar chart
	    type: 'bar',
	    data: {
	     //membuat label chart
	        labels: [<?php
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
															"WHERE no <= 9 ".
															"ORDER by round(no) ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_nama = balikin($rku['nama']);
				
							echo "'$i_nama', ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
															"WHERE no <= 9 ".
															"ORDER by round(no) DESC LIMIT 0,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_nama = balikin($rku['nama']);
				
							echo "'$i_nama'";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						?>
	
	],
	        datasets: [{
	            label: '',
	            //isi chart
	            data: [<?php
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
															"WHERE no <= 9 ".
															"ORDER by round(no) ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_nama = cegah($rku['nama']);
	
	
							//jml
							$qyuk41 = mysqli_query($koneksi, "SELECT DISTINCT(m_orang.kd) AS totalku ".
																"FROM m_orang, umum_sesi_penolong ".
																"WHERE umum_sesi_penolong.penolong_kd = m_orang.kd ".
																"AND m_orang.tipe_user = '$i_nama'");
							$tyuk41 = mysqli_num_rows($qyuk41);
				
							echo "'$tyuk41', ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
															"WHERE no <= 9 ".
															"ORDER by round(no) DESC LIMIT 0,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_nama = cegah($rku['nama']);
				
	
	
							//jml
							$qyuk41 = mysqli_query($koneksi, "SELECT DISTINCT(m_orang.kd) AS totalku ".
																"FROM m_orang, umum_sesi_penolong ".
																"WHERE umum_sesi_penolong.penolong_kd = m_orang.kd ".
																"AND m_orang.tipe_user = '$i_nama'");
							$tyuk41 = mysqli_num_rows($qyuk41);
				
							echo "'$tyuk41', ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						?>
						],
	            //membuat warna pada bar chart
	            backgroundColor: [<?php
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_warna ".
														"ORDER BY round(kd) ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['kd']);
							$i_nama = balikin($rku['kode']);
				
							echo "'$i_nama', ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_warna ".
														"ORDER BY round(kd) DESC LIMIT 0,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['kd']);
							$i_nama = balikin($rku['kode']);
				
							echo "'$i_nama'";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						?>
	            ],
	            borderColor: [<?php
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_warna ".
														"ORDER BY round(kd) ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['kd']);
							$i_nama = balikin($rku['kode']);
				
							echo "'$i_nama', ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_warna ".
														"ORDER BY round(kd) DESC LIMIT 0,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['kd']);
							$i_nama = balikin($rku['kode']);
				
							echo "'$i_nama'";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						?>
	            ],
	            borderWidth: 1, 
	            
	            
	        }]
	    },
	    options: {
			legend: {
				display: false
				}, 
	        
	        tooltips: {
	            enabled: true
				},
					
			responsive: true,
			maintainAspectRatio: false,
			scales: {
			            xAxes: [{
			                ticks: {
			                    autoSkip: false,
			                    maxRotation: 45,
			                    minRotation: 45
			                }
			            }]
			        }, 
			        
			      
	
	        hover: {
	            animationDuration: 1
		        },
		        
	        animation: {
	            duration: 1,
	            onComplete: function () {
	                var chartInstance = this.chart,
	                    ctx = chartInstance.ctx;
		                ctx.textAlign = 'center';
		                ctx.fillStyle = "red";
		                ctx.textBaseline = 'top';
		
		                this.data.datasets.forEach(function (dataset, i) {
		                    var meta = chartInstance.controller.getDatasetMeta(i);
		                    meta.data.forEach(function (bar, index) {
		                        var data = dataset.data[index];
		                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
		
		                    	});
		                	});
		            	}
		           }
			        
			        
			
	        
	  }
	  
	
	
	    
	    
	});
	</script>
	
	
	
	
		
	</div>
	
	
	<?php
	//jml kasus
	$qku2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
									"WHERE kecamatan <> ''");
	$rku2 = mysqli_fetch_assoc($qku2);
	$tku2 = mysqli_num_rows($qku2);
	
	
	?>
	<!-- /.box-body -->
	<div class="card-footer clearfix">
	  <b><?php echo $tku2;?></b> Data. 
	  <a href="k/grafik_panic_button_instansi.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
	</div>
	<!-- /.box-footer -->
	
	
	
</div>