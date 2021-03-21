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
//jml semua
$qku2x = mysqli_query($koneksi, "SELECT kd FROM umum_sesi_penolong ".
									"WHERE korban_tipe <> ''");
$rku2x = mysqli_fetch_assoc($qku2x);
$tku2x = mysqli_num_rows($qku2x);


//jika null
if (empty($tku2x))
	{
	$tku2x2 = 0;
	}
else 
	{
	$tku2x2 = $tku2x;
	}







//tampilkan
$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
								"ORDER by round(no) ASC LIMIT 0,10");
$rku = mysqli_fetch_assoc($qku);
$tku = mysqli_num_rows($qku);


do 
	{
	$i_nama = balikin($rku['nama']);
	$i_nama2 = cegah($rku['nama']);


	//jml kejadian
	$qku2 = mysqli_query($koneksi, "SELECT kd FROM umum_sesi_penolong ".
									"WHERE korban_tipe = '$i_nama2'");
	$rku2 = mysqli_fetch_assoc($qku2);
	$tku2 = mysqli_num_rows($qku2);

	
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
		<span class="progress-text">'.$i_nama.'</span>
		<span class="progress-number"><b>'.$tku2x.'</b>/'.$tku2x2.'</span>
	
		<div class="progress sm">
			<div class="progress-bar progress-bar-red" style="width: '.$persennya.'%"></div>
		</div>
	</div>';
	}
while ($rku = mysqli_fetch_assoc($qku));





exit();
?>