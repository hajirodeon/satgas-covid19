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
<h3 class="box-title">GRAFIK PERILAKU MASYARAKAT : PER JUMLAH DIINGATKAN</h3>
</div>
     	            	            

<?php
//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 7hari terakhir
for($i=0; $i<=7; $i++)
	{
	$nilku = date('Ymd',mktime(0,0,0,$m,($de-$i),$y)); 

	echo "$nilku, ";
	}


//isi
$isi_data1 = ob_get_contents();
ob_end_clean();










//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 7hari terakhir
for($i=0; $i<=7; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui ordernya...
	$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_ingatkan) AS totalku ".
							"FROM e_perilaku_masyarakat ".
							"WHERE round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$ryuk_= mysqli_fetch_assoc($qyuk);
	$tyuk = mysqli_num_rows($qyuk);
	$yuk_total = balikin($ryuk['totalku']);
	
	
	if (empty($yuk_total))
		{
		$yuk_total = "1";
		}
		
		
	echo "$yuk_total, ";
	}


//isi
$isi_data2 = ob_get_contents();
ob_end_clean();













//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 7hari terakhir
for($i=0; $i<=7; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    




	//ketahui ordernya...
	$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_ingatkan_tidak) AS totalku ".
							"FROM e_perilaku_masyarakat ".
							"WHERE round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$ryuk_= mysqli_fetch_assoc($qyuk);
	$tyuk = mysqli_num_rows($qyuk);
	$yuk_total = balikin($ryuk['totalku']);
	
	
	if (empty($yuk_total))
		{
		$yuk_total = "1";
		}
		
		
	echo "$yuk_total, ";
	}


//isi
$isi_data21 = ob_get_contents();
ob_end_clean();






?>

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChartp2_diingatkan').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : [<?php echo $isi_data1;?>],
      datasets: [
        {
          label               : 'Diingatkan',
          fillColor           : 'orange',
          strokeColor         : 'orange',
          pointColor          : 'orange',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $isi_data2;?>]
        },
        {
          label               : 'Tidak Diingatkan',
          fillColor           : 'red',
          strokeColor         : 'red',
          pointColor          : 'red',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $isi_data21;?>]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : false,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)



  })
</script>







	            <!-- /.box-header -->
	            <div class="box-body">
	
					<input name="tgl1" size="10" value="TanggalAwal" class="btn btn-default"> - 
					<input name="tgl2" size="10" value="TanggalAkhir" class="btn btn-default">
					
					<input type="button" name="btnku" id="btnku" class="btn btn-success" value="TAMPILKAN >>" />
					
					 
					<div class="chart">
					<canvas id="areaChartp2_diingatkan" style="height:250px"></canvas>
					</div>

				
	            </div>
	            
	            	            
	            <?php
				//ketahui 
				$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_ingatkan) AS totalku ".
													"FROM e_perilaku_masyarakat");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$tyuk = mysqli_num_rows($qyuk);
				$yuk_total = balikin($ryuk['totalku']);
				
				
				if (empty($yuk_total))
					{
					$yuk_total = "1";
					}
					
					
					
					
				//ketahui 
				$qyuk2 = mysqli_query($koneksi, "SELECT SUM(jml_ingatkan_tidak) AS totalku ".
										"FROM e_perilaku_masyarakat");
				$ryuk2 = mysqli_fetch_assoc($qyuk2);
				$tyuk2 = mysqli_num_rows($qyuk2);
				$yuk2_total = balikin($ryuk2['totalku']);
				
				
				if (empty($yuk2_total))
					{
					$yuk2_total = "1";
					}
				?>
	            

	            <!-- /.box-body -->
	            <div class="card-footer clearfix">
	              <font color="orange"><b><?php echo $yuk_total;?></b> Diingatkan</font>. 
	              
	              <font color="red"><b><?php echo $yuk2_total;?></b> Tidak Diingatkan</font>.
	               
	              <a href="perilaku/grafik_perilaku_jml_ingatkan.php" target="_parent" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
	            </div>



</div>