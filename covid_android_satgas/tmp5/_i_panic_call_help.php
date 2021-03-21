<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_panic_call_help.php";
$filenyax = "$sumber/covid_android_satgas/i_panic_call_help.php";
$judul = "call help";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$kd = cegah($sesiku);





//detail
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nip = cegah($rku['nip']);
$ku_nama = cegah($rku['nama']);
$ku_jabatan = cegah($rku['jabatan']);




//ambil sesi
$panickd = $_SESSION['sesiku_panic'];





//jika realtime pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'psimpan'))
	{
	//ambil nilai
	$latx2 = $_SESSION['latx_sesi'];
	$laty2 = $_SESSION['laty_sesi'];
	
	$waktu = $today;


	//tampilkan fotonya...


	//echo "-> $latx2 . $laty2";
	
	$panickd = $_SESSION['sesiku_panic'];


	//jadikan alamat
	$latitude = $latx2;
	$longitude = $laty2;
	$geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&sensor=false&key='.$keyku.'');
	$output= json_decode($geocode);
	$alamatku = @$output->results[0]->formatted_address;
	$alamatkux = cegah($alamatku);

		
	
	//jika ada usernya
	if (!empty($sesiku))
		{
		//update
		mysqli_query($koneksi, "UPDATE umum_sesi_panic SET lat_x = '$latx2', ".
									"lat_y = '$laty2', ".
									"alamat = '$alamatkux' ".
									"WHERE umum_kd = '$sesiku' ".
									"ORDER BY postdate DESC LIMIT 0,1");
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



	

exit();	
?>