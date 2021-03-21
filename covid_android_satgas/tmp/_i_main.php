<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;


//nilai
$filenya = "$sumber/covid_android_satgas/i_main.php";
$filenya_jamku = "$sumber/covid_android_satgas/i_jamku.php";


//nilai session
$sesiku = $_SESSION['sesiku'];
$brgkd = $_SESSION['brgkd'];
$sesinama = $_SESSION['sesinama'];
$kd6_session = nosql($_SESSION['sesiku']);
$notaku = nosql($_SESSION['notaku']);
$notakux = md5($notaku);


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





<script>
$(document).ready(function(){


	setInterval(loadLog, 1000);
	
	function loadLog(){
		console.log("interval...");
		$("#ijamku").load("<?php echo $filenya_jamku;?>");
	}







})
</script>




<br>

<div class="row">

	<div class="col-md-12" align="center">

			<img src="img/logo.png" height="100" />
			
	</div>
	
</div>

<div class="row">

	<div class="col-md-12" align="center">

		
		<h3>
			SATGAS COVID-19
		</h3>

		<div id="ijamku"></div>	
	</div>

</div>

<hr>


<?php
if (!empty($sesiku))
	{
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = balikin($rku['nip']);
	$ku_nama = balikin($rku['nama']);
	$ku_jabatan = balikin($rku['jabatan']);
	$ku_filex = balikin($rku['filex1']);
	
	
	
	$tanggalx = round($tanggal);
	$bulanx = round($bulan);
	
	
	//deteksi, presensi masuk hari ini...
	$qyuk = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
							"WHERE orang_kd = '$sesiku' ".
							"AND round(DATE_FORMAT(postdate, '%d')) = '$tanggalx' ".
							"AND round(DATE_FORMAT(postdate, '%m')) = '$bulanx' ".
							"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' ".
							"AND status = 'MASUK' ".
							"ORDER BY postdate ASC");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$tyuk = mysqli_num_rows($qyuk);
	?>		


    
  <div class="row">

	<?php
	//jika belum presensi masuk
	if (empty($tyuk))
		{
		//jadikan kode
		$tujuan_kode = round("$masuk_jam$masuk_menit");
		$asal_kode = round("$jam$menit");
		
		

		//tombol aktif
		echo '<div class="col-6" align="center">
			<a href="p_masuk.html" class="btn btn-success"><img src="img/p_masuk.png" height="100" /></a>
		</div>';
		}


	else
		{
		//tombol pasif
		echo '<div class="col-6" align="center">
			<img src="img/p_masuk.png" height="100" />
		</div>';
		}
	?>
        
        
  </div>
  
  
  <hr>
  
  <div class="row">

		<div class="col-12" align="center">
		<p>
		NIK :
		<br>
		<b><?php echo $ku_nip;?></b>
		</p>
		
		<p>
		Nama : 
		<br>
		<b><?php echo $ku_nama;?></b>
		</p>
		
		</div>
	
	</div>


  <div class="row">

	<div class="col-1">

	</div>

		<div class="col-10" align="center">
			<hr>
					<table width="100%" border="0" cellpadding="5" cellspacing="5">
					<tr align="top">
					<td valign="top" align="left">
						<font color="green">HISTORY</font>
					</td>
					
					<td valign="top" align="right">
						
						<?php
						//history hadir ...
						$qku = mysqli_query($koneksi, "SELECT orang_lokasi.*, ".
												"DATE_FORMAT(postdate, '%H') AS jam, ".
												"DATE_FORMAT(postdate, '%i') AS menit ".
												"FROM orang_lokasi ".
												"WHERE orang_kd = '$sesiku' ".
												"AND status = 'MASUK' ".
												"AND round(DATE_FORMAT(postdate, '%d')) = '$tanggalx' ".
												"AND round(DATE_FORMAT(postdate, '%m')) = '$bulanx' ".
												"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun' ".
												"ORDER BY postdate DESC");
						$ryuk = mysqli_fetch_assoc($qku);
						$yuk_postdate = balikin($ryuk['postdate']);
						$yuk_jam = balikin($ryuk['jam']);
						$yuk_menit = balikin($ryuk['menit']);
						
						//jika ada
						if (!empty($yuk_jam))
							{
							echo "<font color='green'><b>$yuk_jam:$yuk_menit WIB</b></font>";
							}
						?>
					

					</td>
					</tr>
					</table>
			<hr>

		</div>

		
		<div class="col-1">
	
		</div>
		
	</div>





	<?php
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////
	$todayx = $today;
	
				
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);
	
				
	//insert
	mysqli_query($koneksi, "INSERT INTO orang_login(kd, orang_kd, orang_kode, ".
					"orang_nama, postdate) VALUES ".
					"('$x', '$sesiku', '$ku_nip', ".
					"'$ku_nama', '$todayx')");
	//kasi log login ///////////////////////////////////////////////////////////////////////////////////
	}



else
	{
	echo '<div align="center">
	<h3>SILAHKAN LOGIN DAHULU...</h3>
	</div>';
	}
?>