<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");


nocache;


//nilai
$filenya = "$sumber/covid_android_satgas/i_set_lokasi.php";


//nilai session
$sesiku = $_SESSION['sesiku'];
$brgkd = $_SESSION['brgkd'];
$sesinama = $_SESSION['sesinama'];
$kd6_session = nosql($_SESSION['sesiku']);
$notaku = nosql($_SESSION['notaku']);
$notakux = md5($notaku);






//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_spesial = balikin($rku['spesial']);



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



<?php
//jika pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'pmasuk'))
	{
	//ambil nilai
	$latx = $_SESSION['latx_sesi'];
	$laty = $_SESSION['laty_sesi'];

	$latx2 = $_SESSION['latx_sesi'];
	$laty2 = $_SESSION['laty_sesi'];


	$waktu = $today;



	
	//jika ada
	if (!empty($latx2))
		{
		//hari ini..
		$hariku = "$tahun-$bulan-$tanggal";
		$xyz = md5("$sesiku$hariku-MASUK");


		//insert
		mysqli_query($koneksi, "INSERT INTO orang_lokasi(kd, orang_kd, orang_kode, orang_nama, ".
						"lat_x, lat_y, status, postdate) VALUES ".
						"('$xyz', '$sesiku', '$ku_nip', '$ku_nama', ".
						"'$latx', '$laty', 'MASUK', '$waktu')");


									
		//update
		mysqli_query($koneksi, "UPDATE m_orang SET lat_x = '$latx2', ".
									"lat_y = '$laty2', ".
									"lat_postdate = '$today' ".
									"WHERE kd = '$sesiku'");
	
		?>						
		<br>
		<br>
		<div class="col-md-4 col-sm-6 col-xs-12">
		      <div class="info-box">
		        <span class="info-box-icon bg-green"><img src="img/p_masuk.png" height="75" /></span>

		        <div class="info-box-content">
		          <span class="info-box-text"><?php echo $waktu;?></span>
		          <span class="info-box-number">
		          	<?php echo $latx2;?> 
		          	<br>
		          	<?php echo $laty2;?>              	
		          	</span>
		        </div>
		

		        <!-- /.info-box-content -->
		      </div>
		      <!-- /.info-box -->
		      
		      
		    </div>
		<?php
		}
	else
		{
		?>
		<br>
		<br>
		<div class="col-md-4 col-sm-6 col-xs-12">
	          <div class="info-box">
	            <span class="info-box-icon bg-red"><i class="fa fa-map-pin"></i></span>
	
	            <div class="info-box-content">
	              <span class="info-box-text">ERROR</span>
	              <span class="info-box-number">
	              	PASTIKAN GPS LOCATION AKTIF DAHULU...              	
	              	</span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
	          <!-- /.info-box -->
	        </div>
	        <!-- /.col -->
	        
		<?php 
		}


    exit();
	}

	

		

		
		
		
		
		
		
		
//jika realtime pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'psimpan'))
	{
	//ambil nilai
	$latx = balikin($_GET['latx']);
	$laty = balikin($_GET['laty']);


	$latx2 = balikin($_GET['latx']);
	$laty2 = balikin($_GET['laty']);
	
	$waktu = $today;


	//bikin sesi baru
	$_SESSION['latx_sesi'] = '';
	$_SESSION['laty_sesi'] = '';
	$_SESSION['latx_sesi'] = $latx2;
	$_SESSION['laty_sesi'] = $laty2;


	$xyz = md5("$sesiku$latx2$laty2");



	//jika ada koordinat
	if (!empty($latx2))
		{
		//jika ada usernya
		if (!empty($sesiku))
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO orang_lokasi(kd, orang_kd, orang_kode, orang_nama, ".
							"lat_x, lat_y, status, alamat, postdate) VALUES ".
							"('$xyz', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$latx2', '$laty2', 'REALTIME', '$alamatkux', '$waktu')");
							
							
			//update
			mysqli_query($koneksi, "UPDATE m_orang SET lat_x = '$latx2', ".
										"lat_y = '$laty2', ".
										"lat_postdate = '$today' ".
										"WHERE kd = '$sesiku'");
			}
		}


    exit();
	}

	

		
		
		
		
		
		
			
	
	
//jika error
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'error'))
	{
	?>

	<br>
	<br>
	<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-pin"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ERROR</span>
              <span class="info-box-number">
              	PASTIKAN GPS LOCATION AKTIF DAHULU...              	
              	</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
    <?php 
    exit();
	}

	
?>	
