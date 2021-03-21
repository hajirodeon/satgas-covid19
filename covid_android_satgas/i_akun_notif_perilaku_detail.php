<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



$filenyax = "$sumber/covid_android_satgas/i_akun_notif_perilaku_detail.php";





//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//ambil session
	$kd = balikin($_SESSION['kd']);
	$pkd = balikin($_SESSION['pkd']);
	
	
	
	//update
	mysqli_query($koneksi, "UPDATE perilaku_satgas SET notif = 'true', ".
								"notif_postdate = '$today' ".
								"WHERE perilaku_kd = '$pkd' ".
								"AND orang_kd = '$sesiku'");
	
	
	

	

	//detail
	$qx = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
						"WHERE kd = '$pkd'");
	$rowx = mysqli_fetch_assoc($qx);
	$i_kd = balikin($rowx['kd']);
	$i_nama_lokasi = balikin($rowx['nama_lokasi']);
	$i_kategori = balikin($rowx['kategori']);
	$i_ket = balikin($rowx['keterangan']);
	$i_kota = balikin($rowx['kota']);
	$i_kec = balikin($rowx['kecamatan']);
	$i_kelurahan = balikin($rowx['kelurahan']);
	$i_alamat = balikin($rowx['alamat']);
	$i_alamat_googlemap = balikin($rowx['alamat_googlemap']);
	$i_kategori_tempat = balikin($rowx['kategori_tempat']);
	$i_tipe_laporan = balikin($rowx['tipe_laporan']);
	$i_jml_orang = balikin($rowx['jumlah_orang']);
	$i_jml_masker_pake = balikin($rowx['jml_masker_pake']);
	$i_jml_masker_tidak_pake = balikin($rowx['jml_masker_tidak_pake']);
	$i_jml_jaga_jarak = balikin($rowx['jml_jaga_jarak']);
	$i_jml_jaga_jarak_tidak = balikin($rowx['jml_jaga_jarak_tidak']);
	$i_jml_ingatkan = balikin($rowx['jml_ingatkan']);
	$i_jml_ingatkan_tidak = balikin($rowx['jml_ingatkan_tidak']);
	$i_lat_x = balikin($rowx['lat_x']);
	$i_lat_y = balikin($rowx['lat_y']);
	$i_k_kd = balikin($rowx['kontributor_kd']);
	$i_k_nik = balikin($rowx['kontributor_nik']);
	$i_k_nama = balikin($rowx['kontributor_nama']);
	$i_k_kontak = balikin($rowx['kontributor_kontak']);
	$i_k_tipe = balikin($rowx['kontributor_tipe']);
	$i_k_ket = balikin($rowx['kontributor_ket']);
	$i_postdate = balikin($rowx['postdate']);
	
	
	
	$nil_foto1 = "$sumber/filebox/perilaku/$i_kd/$i_kd-1.jpg";
	

	?>
	
	
			<script language='javascript'>
		//membuat document jquery
		$(document).ready(function(){
		
			$("#btnKRM").on('click', function(){
				$("#formx2").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpan",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
							$("#ihasil").html(data);
							}
						});
					return false;
				});
			
			
			});	
		
	
	
		
		});
		
		</script>
		


	<?php
	echo '<div class="row">
	
		<div class="col-md-12">
		
		<p>
			<img src="'.$nil_foto1.'" width="100%" height="100%">
		</p>
		
	
		<p>
			Nama Lokasi/Instansi : 
			<br>
			<b>'.$i_nama_lokasi.'</b>
		</p>
		<br>
		
		
		<p>
			Alamat : 
			<br>
			<b>'.$i_alamat.', Kelurahan '.$i_kelurahan.', Kecamatan '.$i_kec.', Kabupaten '.$i_kota.'</b>
		</p>
		<br>
	
		
		<p>
			Alamat Google MAP : 
			<br>
			<b>'.$i_lat_x.', '.$i_lat_y.'</b>
			<br>
			<b>'.$i_alamat_googlemap.'</b>
		</p>
		<br>
		
		
		<p>
		Kategori Tempat : 
		<br>
					
		<b>'.$i_kategori_tempat.'</b>
		</p>
		<br>
	
	
		<p>
		Tipe Laporan : 
		<br>
		<b>'.$i_tipe_laporan.'</b>
		</p>
		<br>
	
		
		<p>
			Jumlah Orang : 
			<br>
			<b>'.$i_jml_orang.'</b>
		</p>
		<br>
	
	
		
		<p>
			Jumlah Memakai Masker : 
			<br>
			<b>'.$i_jml_masker_pake.'</b>
		</p>
		<br>
		
		<p>
			Jumlah Tidak Memakai Masker : 
			<br>
			<b>'.$i_jml_masker_tidak_pake.'</b>
		</p>
		<br>
	
		<p>
			Jumlah Jaga Jarak : 
			<br>
			<b>'.$i_jml_jaga_jarak.'</b>
		</p>
		<br>
		
		<p>
			Jumlah Tidak Jaga Jarak : 
			<br>
			<b>'.$i_jml_jaga_jarak.'</b>
		</p>
		<br>
	
	
		<p>
			Jumlah Diingatkan : 
			<br>
			<b>'.$i_jml_ingatkan.'</b>
		</p>
		<br>
		
		<p>
			Jumlah Tidak Diingatkan : 
			<br>
			<b>'.$i_jml_ingatkan_tidak.'</b>
		</p>
		<br>
	
	
	
		<p>
			Keterangan : 
			<br>
			<b>'.$i_ket.'</b>
		</p>
		<br>
		
	
		
		<p>
		POSTDATE LAPORAN :
		<br>
		<b>'.$i_postdate.'</b>
		</p>
		<br>
		
		<p>
		Oleh Kontributor :
		<br>
		<b>['.$i_k_nik.'. '.$i_k_nama.']. ['.$i_k_tipe.']. '.$i_k_kontak.'</b>
		</p>
		<br>
		
		</div>
	

	</div>';



	exit();
	}













/*
//jika form2
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form2'))
	{
	//ambil session
	$kd = balikin($_SESSION['kd']);
	$pkd = balikin($_SESSION['pkd']);
	

	//detail
	$qx = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
						"WHERE kd = '$pkd'");
	$rowx = mysqli_fetch_assoc($qx);
	$i_kd = balikin($rowx['kd']);
	$i_nama_lokasi = balikin($rowx['nama_lokasi']);
	$i_kategori = balikin($rowx['kategori']);
	$i_ket = balikin($rowx['keterangan']);
	$i_kota = balikin($rowx['kota']);
	$i_kec = balikin($rowx['kecamatan']);
	$i_kelurahan = balikin($rowx['kelurahan']);
	$i_alamat = balikin($rowx['alamat']);
	$i_alamat_googlemap = balikin($rowx['alamat_googlemap']);
	$i_kategori_tempat = balikin($rowx['kategori_tempat']);
	$i_tipe_laporan = balikin($rowx['tipe_laporan']);
	$i_jml_orang = balikin($rowx['jumlah_orang']);
	$i_jml_masker_pake = balikin($rowx['jml_masker_pake']);
	$i_jml_masker_tidak_pake = balikin($rowx['jml_masker_tidak_pake']);
	$i_jml_jaga_jarak = balikin($rowx['jml_jaga_jarak']);
	$i_jml_jaga_jarak_tidak = balikin($rowx['jml_jaga_jarak_tidak']);
	$i_jml_ingatkan = balikin($rowx['jml_ingatkan']);
	$i_jml_ingatkan_tidak = balikin($rowx['jml_ingatkan_tidak']);
	$i_lat_x = balikin($rowx['lat_x']);
	$i_lat_y = balikin($rowx['lat_y']);
	$i_k_kd = balikin($rowx['kontributor_kd']);
	$i_k_nik = balikin($rowx['kontributor_nik']);
	$i_k_nama = balikin($rowx['kontributor_nama']);
	$i_k_kontak = balikin($rowx['kontributor_kontak']);
	$i_k_tipe = balikin($rowx['kontributor_tipe']);
	$i_k_ket = balikin($rowx['kontributor_ket']);
	$i_postdate = balikin($rowx['postdate']);
	
	
	
	$nil_foto1 = "$sumber/filebox/perilaku/$i_kd/$i_kd-1.jpg";
	

	?>
	
	
			<script language='javascript'>
		//membuat document jquery
		$(document).ready(function(){
		
			$("#btnKRM").on('click', function(){
				$("#formx2").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpan",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
							$("#ihasil").html(data);
							}
						});
					return false;
				});
			
			
			});	
		
	
	
		
		});
		
		</script>
		


	<?php
	echo '<div class="row">
	
		<div class="col-md-12">
	
		<h3>AKSI :</h3>
		
		
						<div id="ihasil">
									
							<form name="formx2" id="formx2">
							<p>
							AKSI : 
							<br>
	
							<select name="estatusnya" id="estatusnya" class="btn btn-block btn-warning" required>
								<option value="" selected>'.$e_statusnya.'</option>
								<option value="true">CEK LOKASI</option>
								<option value="false">ALASAN LAINNYA</option>
							</select> 
							</p>
							
							
							<p>
							Alasan / Keterangan :
							<br>
							<input name="eket" id="eket" value="" type="text" class="btn btn-block btn-warning" required>
							</p>
							
							
							<p>
							<input type="hidden" name="kd" id="kd" value="'.$kd.'">
							<input type="hidden" name="pkd" id="pkd" value="'.$pkd.'">
							<input type="submit" name="btnKRM" id="btnKRM" value="KIRIM >>" class="btn btn-danger">
							<input type="submit" name="btnBTL" id="btnBTL" value="BATAL" class="btn btn-info">
							</p>
							
							
							</form>
							
						</div>
		
		 
		
	
		</div>
	</div>';



	exit();
	}
*/



















//jika sesiku
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'sesiku'))
	{
	echo "$sesiku";


	exit();
	}













/*
//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$pkd = cegah($_GET['pkd']);
	$estatusnya = cegah($_GET['estatusnya']);
	$eket = cegah($_GET['eket']);



	//update
	mysqli_query($koneksi, "UPDATE perilaku_satgas SET notif = 'true', ".
								"notif_postdate = '$today', ".
								"aksi_ket = '$eket', ".
								"aksi_postdate = '$today', ".
								"statusnya = '$estatusnya', ".
								"statusnya_postdate = '$today' ".
								"WHERE perilaku_kd = '$pkd' ".
								"AND kd = '$kd'");


	echo "<h3>
	<font color='green'>
	VERIFIKASI BERHASIL DILAKUKAN. Terima Kasih.
	</font>
	</h3>";


	
	exit();
	}
*/







//jika gpsnya satgas ke lokasi
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'gpspenolongkorban'))
	{
	//nilai
	$pkd = nosql($_SESSION['pkd']);
	
	
	//korban
	$qku = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
						"WHERE kd = '$pkd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_lat_x = balikin($rku['lat_x']);
	$yuk2_lat_y = balikin($rku['lat_y']);
	$yuk2_lat_alamat = balikin($rku['alamat_google_map']);
	$yuk2_postdate = balikin($rku['postdate']);
	

	//penolong 
	$qrow = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
	$row = mysqli_fetch_assoc($qrow);
	$i_pkode = cegah($row['nip']);
	$i_pnama = cegah($row['nama']);
	$i_ptipe = cegah($row['tipe_user']);
	$i_platx = balikin($row['lat_x']);
	$i_platy = balikin($row['lat_y']);



	echo "$yuk2_lat_x,$yuk2_lat_y,$i_platx,$i_platy";
	
		
	exit();	
	}

	
	
	







//jika foto
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'foto'))
	{
	//nilai
	$pkd = balikin($_SESSION['pkd']);
	$kd = $sesiku;
	
	
	$foldernya = "../filebox/perilaku/$kd/";
	chmod($foldernya,0777);
				
				
	//buat folder...
	if (!file_exists('../filebox/perilaku/'.$kd.'')) {
	    mkdir('../filebox/perilaku/'.$kd.'', 0777, true);
		}
	
	
	
	
	$foldernya2 = "../filebox/perilaku/$kd/$pkd";
	chmod($foldernya2,0777);
				
				
	//buat folder...
	if (!file_exists('../filebox/perilaku/'.$kd.'/'.$pkd.'')) {
	    mkdir('../filebox/perilaku/'.$kd.'/'.$pkd.'', 0777, true);
		}
	
	
	
	
	
	$namabaru = "$sesiku-$pkd.jpg";
	
	//update
	mysqli_query($koneksi, "UPDATE perilaku_satgas SET filex_foto = '$namabaru' ".
								"WHERE perilaku_kd = '$pkd' ".
								"AND orang_kd = '$sesiku'");
	


	//echo "-> $namabaru";
	
	
	
	// baseFromJavascript will be the javascript base64 string retrieved of some way (async or post submited)
	$baseFromJavascript = balikin($_POST['base64']);//"data:image/png;base64,BBBFBfj42Pj4"; // $_POST['base64']; //your data in base64 'data:image/png....';
	
	
	// We need to remove the "data:image/png;base64,"
	$base_to_php = explode(',', $baseFromJavascript);
	
	
	// the 2nd item in the base_to_php array contains the content of the image
	//$data = base64_decode($base_to_php[1]);
	$data = base64_decode($baseFromJavascript);
	
	//echo "-> $data";
	
	
	// here you can detect if type is png or jpg if you want
	$filepath = "$foldernya/$pkd/$namabaru"; // or image.jpg
	
	// Save the image in a defined path
	file_put_contents($filepath,$data);
	


					
    exit();
	}

	
	
	
	
	
	
	
	
	
//jika kirim aksi
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpanaksi'))
	{
	//nilai
	$pkd = balikin($_SESSION['pkd']);
	$e_ket = cegah($_GET['e_ket']);


	//update
	mysqli_query($koneksi, "UPDATE perilaku_satgas SET ket = '$e_ket', ".
								"statusnya = 'true', ".
								"statusnya_postdate = '$today' ".
								"WHERE orang_kd = '$sesiku' ".
								"AND perilaku_kd = '$pkd'");


		
	
	echo "<br>
	<br>
	<h3>
	<font color='green'>
	Verifikasi Berhasil Dilakukan. Terima Kasih.
	</font>
	</h3>";

	 
	  
	exit();
	}


	
	
	
	
	


exit();
?>
