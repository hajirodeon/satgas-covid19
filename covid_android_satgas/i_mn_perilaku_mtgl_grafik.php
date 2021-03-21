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


//ambil nilai
$e_tgl1 = balikin($_GET['etgl1']);
$e_tgl2 = balikin($_GET['etgl2']);



//jika null, kasi ini tanggal 
if (empty($e_tgl1))
	{
	$e_tgl1 = "$tanggal/$bulan/$tahun";
	$e_tgl2 = "$tanggal/$bulan/$tahun";
	}
	
	

$e_tgl12 = $e_tgl1;
$e_tgl22 = $e_tgl2;





//pecah tanggal
$tgl1_pecah = balikin($e_tgl1);
$tgl1_pecahku = explode("/", $tgl1_pecah);
$tgl1_tgl = trim($tgl1_pecahku[0]);
$tgl1_bln = trim($tgl1_pecahku[1]);
$tgl1_thn = trim($tgl1_pecahku[2]);
$tgl1_postdate = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";




//pecah tanggal
$tgl2_pecah = balikin($e_tgl2);
$tgl2_pecahku = explode("/", $tgl2_pecah);
$tgl2_tgl = trim($tgl2_pecahku[0]);
$tgl2_bln = trim($tgl2_pecahku[1]);
$tgl2_thn = trim($tgl2_pecahku[2]);
$tgl2_postdate = "$tgl2_thn-$tgl2_bln-$tgl2_tgl";



$e_tgl1x = $e_tgl1;
$e_tgl2x = $e_tgl2;


//jika null
if (empty($e_tgl1))
	{
	$e_tgl1x = "$tanggal/$bulan/$tahun";
	}

//jika null
if (empty($e_tgl2))
	{
	$e_tgl2x = "$tanggal/$bulan/$tahun";
	}








//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi *START
ob_start();

//tanggal tujuan
$m = $tgl2_bln;
$de = $tgl2_tgl;
$y = $tgl2_thn;



$start = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";
$end = "$tgl2_thn-$tgl2_bln-$tgl2_tgl";
$diffnya = (strtotime($end)- strtotime($start))/24/3600; 
//echo $diff;


//ambil selisih hari
for($i=0; $i<=$diffnya; $i++)
	{
	$nilku = date('Ymd',mktime(0,0,0,$m,($de-$i),$y)); 
	
	echo "$nilku, ";
	}


//isi
$isi_data1 = ob_get_contents();
ob_end_clean();










//isi *START
ob_start();

//tanggal tujuan
$m = $tgl2_bln;
$de = $tgl2_tgl;
$y = $tgl2_thn;


$start = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";
$end = "$tgl2_thn-$tgl2_bln-$tgl2_tgl";
$diffnya = (strtotime($end)- strtotime($start))/24/3600; 

//ambil selisih
for($i=0; $i<=$diffnya; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    
	
	
	//ketahui ordernya...
	$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
							"WHERE round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
	
			
	echo "$tyuk, ";
	}


//isi
$isi_data2 = ob_get_contents();
ob_end_clean();













//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>





<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Bootstrap core CSS -->
<link href="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">



<!-- ChartJS -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/chart.js/Chart.js"></script>


    
  


<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $sumber;?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>







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
var areaChartCanvas = $('#areaChartp2').get(0).getContext('2d')
// This will get the first returned node in the jQuery collection.
var areaChart       = new Chart(areaChartCanvas)

var areaChartData = {
  labels  : [<?php echo $isi_data1;?>],
  datasets: [
    {
      label               : 'Kontribusi',
      fillColor           : 'orange',
      strokeColor         : 'orange',
      pointColor          : 'orange',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [<?php echo $isi_data2;?>]
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







	 
	<div class="chart">
	<canvas id="areaChartp2" style="height:250px"></canvas>
	</div>


<?php
//ketahui ordernya...
$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
						  			"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
						  			"ORDER BY postdate DESC");
$tyuk = mysqli_num_rows($qyuk);



echo '<font color="orange"><b>'.$tyuk.'</b> Data Entri Kontribusi</font>.';


exit();
?>