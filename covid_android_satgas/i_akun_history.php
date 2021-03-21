<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_history.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_history.php";
$judul = "History Presensi";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
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
	echo '<br>


	<table width="100%" border="0" cellpadding="5" cellspacing="5">
	<tr align="top">

	<td width="10">&nbsp;</td>
	<td valign="top">
			
	<div class="row">

		<div class="col-12" align="left">
			<div class="box box-danger">
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">';
	
	
				//history hadir ...
				$qku = mysqli_query($koneksi, "SELECT orang_lokasi.*, ".
										"DATE_FORMAT(postdate, '%d') AS tanggal, ".
										"DATE_FORMAT(postdate, '%m') AS bulan, ".
										"DATE_FORMAT(postdate, '%Y') AS tahun, ".
										"DATE_FORMAT(postdate, '%H') AS jam, ".
										"DATE_FORMAT(postdate, '%i') AS menit ".
										"FROM orang_lokasi ".
										"WHERE orang_kd = '$sesiku' ".
										"AND status = 'MASUK' ".
										"ORDER BY postdate DESC");
				$ryuk = mysqli_fetch_assoc($qku);
				$tku = mysqli_num_rows($qku);
				
				//jika ada
				if (!empty($tku))
					{
					do
						{
						//nilai
						$yuk_postdate = balikin($ryuk['postdate']);
						$yuk_kode = balikin($ryuk['orang_kode']);
						$yuk_tanggal = balikin($ryuk['tanggal']);
						$yuk_bulan = balikin($ryuk['bulan']);
						$yuk_tahun = balikin($ryuk['tahun']);
						$yuk_jam = balikin($ryuk['jam']);
						$yuk_menit = balikin($ryuk['menit']);
						$yuk_lat_x = balikin($ryuk['lat_x']);
						$yuk_lat_y = balikin($ryuk['lat_y']);
						$new_image_name = "$yuk_kode-$yuk_tahun$yuk_bulan$yuk_tanggal-masuk.jpg";
						
						echo '<table width="100%" border="0" cellpadding="5" cellspacing="5">
						<tr align="top">
						<td>
			
						<p>
						<img src="'.$sumber.'/filebox/selfie/'.$new_image_name.'" width="100" class="img-rounded">
						</p>
						
						</td>
						
						<td>';
						
						echo "<font color='green'><b>$yuk_postdate</b></font>
						<br>
						$yuk_lat_x, $yuk_lat_y 
						</p>
						
						</td>
						</tr>
						</table>
						<hr>";
						}
					while ($ryuk = mysqli_fetch_assoc($qku));
					}

	    	    echo '</div>
				</div>
				</div>
				</div>						

			
		</div>
	
	</div>
				


	</td>

	<td width="10">&nbsp;</td>
	</tr>
	</table>';


	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>