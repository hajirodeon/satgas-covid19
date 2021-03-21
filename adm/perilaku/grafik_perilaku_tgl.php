<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_tgl.php";
$judul = "PER TANGGAL";
$judulku = "[PERILAKU MASYARAKAT] $judul";
$judulx = $judul;
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


$e_tgl1 = balikin($_REQUEST['e_tgl1']);
$e_tgl2 = balikin($_REQUEST['e_tgl2']);

$e_tgl12 = cegah($_REQUEST['e_tgl1']);
$e_tgl22 = cegah($_REQUEST['e_tgl2']);





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






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tampilkan
if ($_POST['btnTPL'])
	{
	//ambil nilai
	$e_tgl1 = cegah($_POST['e_tgl1']);
	$e_tgl2 = cegah($_POST['e_tgl2']);
	
	
	//re-direct
	$ke = "$filenya?e_tgl1=$e_tgl1&e_tgl2=$e_tgl2";
	xloc($ke);
	exit();
	}

//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






require("../template_atas.php");


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");



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
	
	
	
	
	//ketahui yg sukses
	$qyuk = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
							"WHERE round(DATE_FORMAT(postdate, '%d')) = '$tgl2_tgl' ".
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
      label               : 'Kontribusi',
      fillColor           : 'orange',
      strokeColor         : 'orange',
      pointColor          : 'orange',
      pointStrokeColor    : '#c1c7d1',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data                : [<?php echo $isi_data2;?>]
    },
    {
      label               : 'Verifikasi Satgas',
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







	 
	<div class="chart">
	<canvas id="areaChartp2" style="height:250px"></canvas>
	</div>


<?php
//ketahui ordernya...
$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
						  			"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
						  			"ORDER BY postdate DESC");
$tyuk = mysqli_num_rows($qyuk);





//ketahui ordernya...
$qyuk2 = mysqli_query($koneksi, "SELECT DISTINCT(perilaku_kd) AS totalku ".
									"FROM perilaku_satgas ".
						  			"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
						  			"ORDER BY postdate DESC");
$tyuk2 = mysqli_num_rows($qyuk2);
?>

          <font color="orange"><b><?php echo $tyuk;?></b> Kontribusi User</font>. 
          
          <font color="red"><b><?php echo $tyuk2;?></b> Verifikasi Kontribusi oleh Satgas</font>.

<br>
<hr>
	
<script>
$(document).ready(function() {
  		
	$.noConflict();

    
    var url_base64 = document.getElementById('areaChartp2').toDataURL('image/png');
    
    link.href = url_base64;
    
});
</script>
  

	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>




<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script>
	$(document).ready(function()
{
    $("[rel='tooltip']").tooltip();
});
</script>

<style>
	/* Global Styles */
@import 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
*, *:  before, *:after {
    -webkit-box-sizing: border-box !important;
    -moz-box-sizing: border-box !important;
    box-sizing: border-box !important;
}


a:hover{
    text-decoration:none;
}
/*page styling*/
.bs-callout {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #eee;
    border-image: none;
    border-radius: 3px;
    border-style: solid;
    border-width: 1px 1px 1px 5px;
    margin-bottom: 5px;
    padding: 20px;
}
.bs-right-panel{
	padding: 10px;
	width:100%;
	float:none;
	text-align:center;
	margin:0 auto;
}
.bs-right-panel img{
	width:100%;
	margin:0;
	padding:0;
	
}
.bs-callout:last-child {
    margin-bottom: 0px;
}
.bs-callout h4,
.bs-callout h5 {
    margin-bottom: 10px;
    margin-top: 5px;
    font-weight: 600;
}


.bs-callout-danger {
    border-left-color: #d9534f;
}

.bs-callout-danger h4,
.bs-callout-danger h5{
    color: #d9534f;
}



.bs-callout-info {
    border-left-color: cyan;
}

.bs-callout-info h4,
.bs-callout-info h5{
    color: cyan;
}






.bs-callout-primary {
    border-left-color: blue;
}

.bs-callout-primary h4,
.bs-callout-primary h5{
    color: blue;
}






.bs-callout-warning {
    border-left-color: orange;
}

.bs-callout-warning h4,
.bs-callout-warning h5{
    color: orange;
}







.bs-callout-success {
    border-left-color: green;
}

.bs-callout-success h4,
.bs-callout-success h5{
    color: green;
}




.header-title {
    color: #fff;
}
.title-thin {
	font-weight: 300;
}
.service-item {
	margin-bottom: 30px;
}
</style>








<!-- Datatable CSS -->
<link href='../../template/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

<!-- jQuery Library -->
<script src="../../template/js/jquery-3.3.1.min.js"></script>

<!-- Datatable JS -->
<script src="../../template/DataTables/datatables.min.js"></script>



<script src="../../template/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../template/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>




<script language='javascript'>
//membuat document jquery
$(document).ready(function(){


    $('#e_tgl1').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
    })
    

    $('#e_tgl2').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
    })
    
		
});

</script>
	

<?php


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">


<input name="e_tgl1" id="e_tgl1" type="text" size="10" value="'.$e_tgl1x.'" class="btn btn-warning">

Sampai 

<input name="e_tgl2" id="e_tgl2" type="text" size="10" value="'.$e_tgl2x.'" class="btn btn-warning">


<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">
<hr>


<a id="link" download="grafik_perilaku_tgl-'.$e_tgl1.'-sampai-'.$e_tgl2.'.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>

<a href="grafik_perilaku_tgl_xls.php?e_tgl1='.$e_tgl12.'&e_tgl2='.$e_tgl22.'" class="btn btn-danger">EXPORT EXCEL >></a>
<hr>';
?>






<div id="navbar-example">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#semua" role="tab">SEMUA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#belum" role="tab">BELUM PROSES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#proses" role="tab">PROSES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#selesai" role="tab">SELESAI</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#prank" role="tab">PRANK/FAKE</a>
        </li>
    </ul>

    <!-- Tab panes {Fade}  -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="semua" name="semua" role="tabpanel">
            <div class="bs-callout bs-callout-primary">
					
					
					<?php
					echo '<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
					            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
								<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
								<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML ORANG</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					        </tr>
					        </thead>';
					
							//hitung total
							$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS total_masker_pake, ".
																"SUM(jml_masker_tidak_pake) AS total_masker_tidak, ".
																"SUM(jml_jaga_jarak) AS total_jaga_jarak, ".
																"SUM(jml_jaga_jarak_tidak) AS total_jaga_jarak_tidak, ".
																"SUM(jml_ingatkan) AS total_ingatkan, ".
																"SUM(jml_ingatkan_tidak) AS total_ingatkan_tidak ".
																"FROM e_perilaku_masyarakat ".
																"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
							$ryuk = mysqli_fetch_assoc($qyuk);
							$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
							$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
							$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
							$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
							$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
							$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
							$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      
							
							
							
							echo '<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML ORANG <br>'.$yuk_total_wong.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER<br>'.$yuk_masker_pake.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER<br>'.$yuk_masker_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML JAGA JARAK<br>'.$yuk_jaga_jarak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK<br>'.$yuk_jaga_jarak_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML DIINGATKAN<br>'.$yuk_ingatkan.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN<br>'.$yuk_ingatkan_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": true, 
					        "order": [[ 0, "desc" ]],  
							"lengthChange": false, 
							"pageLength": 1,  
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_grafik_perilaku_tgl_data.php?e_tgl1=<?php echo $e_tgl12;?>&e_tgl2=<?php echo $e_tgl22;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'foto' },
					            { data: 'kategori_tempat' },
					            { data: 'tipe_laporan' },
					            { data: 'nama_lokasi' },
					            { data: 'alamat' },
					            { data: 'gps' },
					            { data: 'jml_orang' },
					            { data: 'jml_memakai_masker' },
					            { data: 'jml_tidak_memakai_masker' },
					            { data: 'jml_jaga_jarak' },
					            { data: 'jml_tidak_jaga_jarak' },
					            { data: 'jml_diingatkan' },
					            { data: 'jml_tidak_diingatkan' },
					            { data: 'kontributor_nama' }
					        ]
					    });
					    
					    
					
					});
					
					
					
					</script>
					

    		</div>
        </div>
      <div class="tab-pane fade" id="belum" role="tabpanel">
          <div class="bs-callout bs-callout-info">
				

					
					<?php
					echo '<table id="empTable2" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
					            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
								<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
								<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML ORANG</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					        </tr>
					        </thead>';
					
							//hitung total
							$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS total_masker_pake, ".
																"SUM(jml_masker_tidak_pake) AS total_masker_tidak, ".
																"SUM(jml_jaga_jarak) AS total_jaga_jarak, ".
																"SUM(jml_jaga_jarak_tidak) AS total_jaga_jarak_tidak, ".
																"SUM(jml_ingatkan) AS total_ingatkan, ".
																"SUM(jml_ingatkan_tidak) AS total_ingatkan_tidak ".
																"FROM e_perilaku_masyarakat ".
																"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
							$ryuk = mysqli_fetch_assoc($qyuk);
							$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
							$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
							$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
							$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
							$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
							$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
							$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      
							
							
							
							echo '<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML ORANG <br>'.$yuk_total_wong.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER<br>'.$yuk_masker_pake.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER<br>'.$yuk_masker_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML JAGA JARAK<br>'.$yuk_jaga_jarak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK<br>'.$yuk_jaga_jarak_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML DIINGATKAN<br>'.$yuk_ingatkan.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN<br>'.$yuk_ingatkan_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable2').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": true, 
					        "order": [[ 0, "desc" ]],  
							"lengthChange": false, 
							"pageLength": 1,  
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_grafik_perilaku_tgl_data.php?e_tgl1=<?php echo $e_tgl12;?>&e_tgl2=<?php echo $e_tgl22;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'foto' },
					            { data: 'kategori_tempat' },
					            { data: 'tipe_laporan' },
					            { data: 'nama_lokasi' },
					            { data: 'alamat' },
					            { data: 'gps' },
					            { data: 'jml_orang' },
					            { data: 'jml_memakai_masker' },
					            { data: 'jml_tidak_memakai_masker' },
					            { data: 'jml_jaga_jarak' },
					            { data: 'jml_tidak_jaga_jarak' },
					            { data: 'jml_diingatkan' },
					            { data: 'jml_tidak_diingatkan' },
					            { data: 'kontributor_nama' }
					        ]
					    });
					    
					    
					
					});
					
					
					
					</script>
					



			</div>
      </div>

      <div class="tab-pane fade" id="proses" role="tabpanel">
          <div class="bs-callout bs-callout-warning">

					
					<?php
					echo '<table id="empTable3" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
					            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
								<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
								<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML ORANG</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					        </tr>
					        </thead>';
					
							//hitung total
							$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS total_masker_pake, ".
																"SUM(jml_masker_tidak_pake) AS total_masker_tidak, ".
																"SUM(jml_jaga_jarak) AS total_jaga_jarak, ".
																"SUM(jml_jaga_jarak_tidak) AS total_jaga_jarak_tidak, ".
																"SUM(jml_ingatkan) AS total_ingatkan, ".
																"SUM(jml_ingatkan_tidak) AS total_ingatkan_tidak ".
																"FROM e_perilaku_masyarakat ".
																"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
							$ryuk = mysqli_fetch_assoc($qyuk);
							$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
							$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
							$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
							$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
							$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
							$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
							$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      
							
							
							
							echo '<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML ORANG <br>'.$yuk_total_wong.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER<br>'.$yuk_masker_pake.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER<br>'.$yuk_masker_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML JAGA JARAK<br>'.$yuk_jaga_jarak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK<br>'.$yuk_jaga_jarak_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML DIINGATKAN<br>'.$yuk_ingatkan.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN<br>'.$yuk_ingatkan_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable3').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": true, 
					        "order": [[ 0, "desc" ]],  
							"lengthChange": false, 
							"pageLength": 1,  
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_grafik_perilaku_tgl_data.php?e_tgl1=<?php echo $e_tgl12;?>&e_tgl2=<?php echo $e_tgl22;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'foto' },
					            { data: 'kategori_tempat' },
					            { data: 'tipe_laporan' },
					            { data: 'nama_lokasi' },
					            { data: 'alamat' },
					            { data: 'gps' },
					            { data: 'jml_orang' },
					            { data: 'jml_memakai_masker' },
					            { data: 'jml_tidak_memakai_masker' },
					            { data: 'jml_jaga_jarak' },
					            { data: 'jml_tidak_jaga_jarak' },
					            { data: 'jml_diingatkan' },
					            { data: 'jml_tidak_diingatkan' },
					            { data: 'kontributor_nama' }
					        ]
					    });
					    
					    
					
					});
					
					
					
					</script>
					




			</div>
      </div>



      <div class="tab-pane fade" id="selesai" role="tabpanel">
          <div class="bs-callout bs-callout-success">


					
					<?php
					echo '<table id="empTable4" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
					            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
								<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
								<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML ORANG</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					        </tr>
					        </thead>';
					
							//hitung total
							$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS total_masker_pake, ".
																"SUM(jml_masker_tidak_pake) AS total_masker_tidak, ".
																"SUM(jml_jaga_jarak) AS total_jaga_jarak, ".
																"SUM(jml_jaga_jarak_tidak) AS total_jaga_jarak_tidak, ".
																"SUM(jml_ingatkan) AS total_ingatkan, ".
																"SUM(jml_ingatkan_tidak) AS total_ingatkan_tidak ".
																"FROM e_perilaku_masyarakat ".
																"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
							$ryuk = mysqli_fetch_assoc($qyuk);
							$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
							$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
							$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
							$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
							$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
							$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
							$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      
							
							
							
							echo '<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML ORANG <br>'.$yuk_total_wong.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER<br>'.$yuk_masker_pake.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER<br>'.$yuk_masker_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML JAGA JARAK<br>'.$yuk_jaga_jarak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK<br>'.$yuk_jaga_jarak_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML DIINGATKAN<br>'.$yuk_ingatkan.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN<br>'.$yuk_ingatkan_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable4').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": true, 
					        "order": [[ 0, "desc" ]],  
							"lengthChange": false, 
							"pageLength": 1,  
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_grafik_perilaku_tgl_data.php?e_tgl1=<?php echo $e_tgl12;?>&e_tgl2=<?php echo $e_tgl22;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'foto' },
					            { data: 'kategori_tempat' },
					            { data: 'tipe_laporan' },
					            { data: 'nama_lokasi' },
					            { data: 'alamat' },
					            { data: 'gps' },
					            { data: 'jml_orang' },
					            { data: 'jml_memakai_masker' },
					            { data: 'jml_tidak_memakai_masker' },
					            { data: 'jml_jaga_jarak' },
					            { data: 'jml_tidak_jaga_jarak' },
					            { data: 'jml_diingatkan' },
					            { data: 'jml_tidak_diingatkan' },
					            { data: 'kontributor_nama' }
					        ]
					    });
					    
					    
					
					});
					
					
					
					</script>
					




			</div>
      </div>


      <div class="tab-pane fade" id="prank" role="tabpanel">
          <div class="bs-callout bs-callout-danger">


					
					<?php
					echo '<table id="empTable5" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
					            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
								<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
								<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
								<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML ORANG</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN</font></strong></th>
								<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					        </tr>
					        </thead>';
					
							//hitung total
							$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS total_masker_pake, ".
																"SUM(jml_masker_tidak_pake) AS total_masker_tidak, ".
																"SUM(jml_jaga_jarak) AS total_jaga_jarak, ".
																"SUM(jml_jaga_jarak_tidak) AS total_jaga_jarak_tidak, ".
																"SUM(jml_ingatkan) AS total_ingatkan, ".
																"SUM(jml_ingatkan_tidak) AS total_ingatkan_tidak ".
																"FROM e_perilaku_masyarakat ".
																"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
							$ryuk = mysqli_fetch_assoc($qyuk);
							$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
							$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
							$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
							$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
							$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
							$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
							$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      
							
							
							
							echo '<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
									<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML ORANG <br>'.$yuk_total_wong.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER<br>'.$yuk_masker_pake.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER<br>'.$yuk_masker_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML JAGA JARAK<br>'.$yuk_jaga_jarak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK<br>'.$yuk_jaga_jarak_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML DIINGATKAN<br>'.$yuk_ingatkan.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN<br>'.$yuk_ingatkan_tidak.'</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable5').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": true, 
					        "order": [[ 0, "desc" ]],  
							"lengthChange": false, 
							"pageLength": 1,  
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_grafik_perilaku_tgl_data.php?e_tgl1=<?php echo $e_tgl12;?>&e_tgl2=<?php echo $e_tgl22;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'foto' },
					            { data: 'kategori_tempat' },
					            { data: 'tipe_laporan' },
					            { data: 'nama_lokasi' },
					            { data: 'alamat' },
					            { data: 'gps' },
					            { data: 'jml_orang' },
					            { data: 'jml_memakai_masker' },
					            { data: 'jml_tidak_memakai_masker' },
					            { data: 'jml_jaga_jarak' },
					            { data: 'jml_tidak_jaga_jarak' },
					            { data: 'jml_diingatkan' },
					            { data: 'jml_tidak_diingatkan' },
					            { data: 'kontributor_nama' }
					        ]
					    });
					    
					    
					
					});
					
					
					
					</script>
					




			</div>
      </div>


    </div>
</div>







<?php
require("../template_bawah.php");



//null-kan
xclose($koneksi);
exit();
?>