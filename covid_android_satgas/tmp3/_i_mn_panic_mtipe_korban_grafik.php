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







$e_tgl1 = "01/12/2020";
$e_tgl2 = "31/12/2020";





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









//masukin semua ke database ///////////////////////////////////////////////////////////////////////////
//list
$empQuery2 = "SELECT DISTINCT(DATE(postdate)) AS tglku ".
				"FROM umum_sesi_penolong ".
				"ORDER BY postdate ASC";
$empRecords2 = mysqli_query($koneksi, $empQuery2);

while ($row2 = mysqli_fetch_assoc($empRecords2)) 
	{
	//nilai
	$i_tglku = balikin($row2['tglku']);


	//insert
	$xyz = md5("$i_tglku");
	mysqli_query($koneksi, "INSERT INTO panic_tipe_korban(kd, tanggal, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");

	
	
	//membaca semua data, trus masukin ke satu table
	$empQuery = "SELECT * FROM m_tipe_user ".
					"ORDER by round(no) ASC LIMIT 0,10";
	$empRecords = mysqli_query($koneksi, $empQuery);
	
	while ($row = mysqli_fetch_assoc($empRecords)) 
		{
		//nilai
		$nomer = $nomer + 1;
		$i_kec = cegah($row['nama']);


		//korban
		$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS total ".
											"FROM umum_sesi_penolong ".
											"WHERE postdate LIKE '$i_tglku%' ".
											"AND korban_tipe = '$i_kec'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tjml_korban = mysqli_num_rows($qyuk);
		
	

		
		//update
		mysqli_query($koneksi, "UPDATE panic_tipe_korban SET nil$nomer = '$tjml_korban' ".
									"WHERE kd = '$xyz'");
		}
		
		
	//netralkan
	$nomer = 0;
	}
//masukin semua ke database ///////////////////////////////////////////////////////////////////////////
	








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





<?php
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
	$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS totalku ".
							"FROM umum_sesi_penolong ".
							"WHERE tugaskan = 'true' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
	
			
	echo "$tyuk, ";
	}


//isi
$isi_data2 = ob_get_contents();
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



//ambil selisihnya
for($i=0; $i<=$diffnya; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 

	
	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    
	
	
	
	
	//ketahui 
	$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS totalku ".
							"FROM umum_sesi_penolong ".
							"WHERE tugaskan = 'false' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$tgl2_tgl' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$tgl2_bln' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$tgl2_thn'");
	$tyuk = mysqli_num_rows($qyuk);
	
	
	
	//yg offline
	$tyuk2 = $tku - $tyuk;
	
	
	
	
	echo "$tyuk2, ";
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
var areaChartCanvas = $('#areaChartp2').get(0).getContext('2d')
// This will get the first returned node in the jQuery collection.
var areaChart       = new Chart(areaChartCanvas)

var areaChartData = {
  labels  : [<?php echo $isi_data1;?>],
  datasets: [
    {
      label               : 'Orang Korban Tertolong',
      fillColor           : 'orange',
      strokeColor         : 'orange',
      pointColor          : 'orange',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [<?php echo $isi_data2;?>]
    },
    {
      label               : 'Orang Korban Tidak Tertolong',
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





	
<script>
$(document).ready(function() {
  		
	$.noConflict();
    
		
    var url_base64 = document.getElementById('areaChartp2').toDataURL('image/png');
    
    link.href = url_base64;
});
</script>



<?php


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

	
	

	
//korban tertolong
$qyuk1 = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS totalku ".
									"FROM umum_sesi_penolong ".
									"WHERE tugaskan = 'true' ".
									"AND postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_korban = mysqli_num_rows($qyuk1);




//korban tidak tertolong
$qyuk1 = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS totalku ".
									"FROM umum_sesi_penolong ".
									"WHERE tugaskan = 'false' ".
									"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_korban_tidak = mysqli_num_rows($qyuk1);
	


echo '<form action="'.$filenya.'" method="post" name="formx">




	<div class="chart">
	<canvas id="areaChartp2" style="height:250px"></canvas>
	</div>


	<p>
          <font color="orange"><b>'.$yuk1_korban.'</b> Orang Korban Tertolong</font>.
    </p>
    
	<p>
			<font color="red"><b>'.$yuk1_korban_tidak.'</b> Orang Korban Tidak Tertolong</font>.
	</p>';





exit();
?>