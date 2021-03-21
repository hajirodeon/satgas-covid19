<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/adm/i_marker_user.php";
$filenyax = "$sumber/adm/i_marker_user.php";
$judul = "marker user";
$juduli = $judul;





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//nilai
	$userkd = nosql($_GET['userkd']);
	?>
	
	
	
	
	
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
	
	
	    
	
	
	
	  <!-- Theme style -->
	  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/AdminLTE.css">
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
	  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/skins/skins-biasawae.css">
	


	

	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#itemku1").hide();
		$("#itemku2").hide();
		$("#itemku3").hide();
			
			
		$("#menuku1").on('click', function(){
			$("#itemku1").show();
		});	
	
	
		$("#menuku1x").on('click', function(){
			$("#itemku1").hide();
		});	
	
	
	
	
		$("#menuku2").on('click', function(){
			$("#itemku2").show();
		});	
	
	
		$("#menuku2x").on('click', function(){
			$("#itemku2").hide();
		});	
	
	
	
		$("#menuku3").on('click', function(){
			$("#itemku3").show();
		});	
	
	
		$("#menuku3x").on('click', function(){
			$("#itemku3").hide();
		});	
	
	
	
		
		
	
	});
	
	</script>





	<?php
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$userkd'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = balikin($rku['nip']);
	$ku_nama = balikin($rku['nama']);
	$ku_tipe_user = balikin($rku['tipe_user']);
	$ku_jabatan = balikin($rku['jabatan']);
	$ku_tgl_lahir = balikin($rku['tgl_lahir']);
	$ku_alamat = balikin($rku['alamat']);
	$ku_telp = balikin($rku['telp']);
	$ku_email = balikin($rku['email']);
	$ku_filex = balikin($rku['filex1']);
	
	
	$ku_filex1 = "thumb-$ku_nip-1.jpg";


	echo '<div class="row">

		<div class="col-12" align="left">
			<div class="box-body">
			<div class="row">
				<div class="col-md-1">
				<p>
				<img src="'.$sumber.'/filebox/pegawai/'.$userkd.'/'.$ku_filex1.'" width="100">
				</p>
				
				</div>
				
				
				<div class="col-md-3">
				<p>
				NIK : <b>'.$ku_nip.'</b>
				
				</p>
				
				
				<p>
				Nama : <b>'.$ku_nama.'</b>
				</p>
				
				
				
				<p>
				Tipe User : <b>'.$ku_tipe_user.'</b>
				</p>
				
				<p>
				Jabatan : <b>'.$ku_jabatan.'</b>
				</p>
				
				
				</div>
				
				
				
				<div class="col-md-3">
				
				<p>
				Tgl. Lahir : <b>'.$ku_tgl_lahir.'</b>
				</p>
				
				
				
				<p>
				Telepon : <b>'.$ku_telp.'</b>
				</p>
				
				
				
				<p>
				E-Mail : <b>'.$ku_email.'</b>
				</p>
				
				</div>
				
				
				<div class="col-md-5">';

				//login terakhir
				$qyuk = mysqli_query($koneksi, "SELECT * FROM orang_login ".
													"WHERE orang_kd = '$userkd' ".
													"ORDER BY postdate DESC LIMIT 0,1");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_postdate = balikin($ryuk['postdate']);

				
				echo "<p>
				Login Terakhir : <b>$yuk_postdate</b>
				</p>";



				//lokasi terakhir
				$qyuk = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
													"WHERE orang_kd = '$userkd' ".
													"ORDER BY postdate DESC LIMIT 0,1");
				$ryuk = mysqli_fetch_assoc($qyuk);
				$yuk_postdate = balikin($ryuk['postdate']);
				$yuk_lat_x = balikin($ryuk['lat_x']);
				$yuk_lat_y = balikin($ryuk['lat_y']);


				
				$lat = $yuk_lat_x;
				$long = $yuk_lat_y;
				
				
				
				
				function geo2address($lat,$long,$keyku) {
					
				    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=$keyku&latlng=$lat,$long&sensor=false";
				    $curlData=file_get_contents(    $url);
				    $address = json_decode($curlData);
				    $a=$address->results[0];
				    return explode(",",$a->formatted_address);
				}
				
				
				$nilku = geo2address($lat,$long,$keyku);
				
				$nil1 = $nilku[0];
				$nil2 = $nilku[1];
				$nil3 = $nilku[2];
				$nil4 = $nilku[3];
				$nil5 = $nilku[4];
				$nil6 = $nilku[5];
				$nil7 = $nilku[6];
				
				$alamatku = "$nil1, $nil2, $nil3, $nil4, $nil5, $nil6, $nil7, ";
				
				
				
				

				
				echo "<p>
				Lokasi Terakhir : <b>$yuk_lat_x, $yuk_lat_y</b>
				<br>
				<b>$alamatku</b>
				</p>
				</div>";



				echo '<div class="col-md-12">
				<hr>
	    	    </div>';
	    	    
				/*				
				//presensi hadir
				echo '<div class="col-md-4">
				<p>
				PRESENSI KEHADIRAN
				<br>
				<a href="#" id="menuku1" class="btn btn-success">LIHAT >></a> 
				 
				<br>
				
				<div id="itemku1">';
					
					
				//history hadir ...
				$qku = mysqli_query($koneksi, "SELECT orang_lokasi.*, ".
										"DATE_FORMAT(postdate, '%d') AS tanggal, ".
										"DATE_FORMAT(postdate, '%m') AS bulan, ".
										"DATE_FORMAT(postdate, '%Y') AS tahun, ".
										"DATE_FORMAT(postdate, '%H') AS jam, ".
										"DATE_FORMAT(postdate, '%i') AS menit ".
										"FROM orang_lokasi ".
										"WHERE orang_kd = '$userkd' ".
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
				
				
						
	    	    echo '<p>
	    	    <a href="#" id="menuku1x" class="btn btn-warning"><< TUTUP</a>
				
				
				</div>
	    	    
	    	    </div>';
				
				






				//panic button
				echo '<div class="col-md-4">
				<p>
				PANIC BUTTON : 
				<br>
				<a href="#" id="menuku2" class="btn btn-success">LIHAT >></a> 
				 
				<br>
				
				<div id="itemku2">xx';
					
				//history hadir ...
				$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
										"WHERE umum_kd = '$userkd' ".
										"AND lat_x <> '' ".
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
						$yuk_kategori = balikin($ryuk['kategori_masalah']);
						$yuk_solusi = balikin($ryuk['solusi']);
						$yuk_pkode = balikin($ryuk['penolong_kode']);
						$yuk_pnama = balikin($ryuk['penolong_nama']);
						
						echo '<table width="100%" border="0" cellpadding="5" cellspacing="5">
						<tr align="top">
						<td>
						'.$yuk_postdate.'
						</td>
						
						<td>
						Masalah : <b>'.$yuk_kategori.'</b>
						<br>
						Solusi : <b>'.$yuk_solusi.'</b>
						</td>
						
						<td>
						Penolong : <b>'.$yuk_pkode.'. '.$yuk_pnama.'</b>
						</td>
						</tr>
						</table>
						<hr>';
						}
					while ($ryuk = mysqli_fetch_assoc($qku));
					}
				
				
						
	    	    echo '<p>
	    	    <a href="#" id="menuku2x" class="btn btn-warning"><< TUTUP</a>
				
	    	    
	    	    </div>
	    	    </div>';
				
				



				
				
				echo '<div class="col-md-4">
				
				<p>
				PERILAKU MASYARAKAT : 
				<br>
				<a href="#" id="menuku3" class="btn btn-success">LIHAT >></a> 
				 
				<br>
				
				<div id="itemku3">yyy';
					

				
				
						
	    	    echo '<p>
	    	    <a href="#" id="menuku3x" class="btn btn-warning"><< TUTUP</a>
				
	    	    
	    	    </div>
	    	    </div>';
	    	    */
				
				
				




				echo '<div class="col-md-12">
				<p>
				
				<hr>
				
				<button type="button" class="btn btn-danger" data-dismiss="modal">KELUAR >></button>
				
						
	    	    </div>
	    	    
				
				
				
				</div>
				</div>						

			
		</div>
	
	</div>';

	
	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>