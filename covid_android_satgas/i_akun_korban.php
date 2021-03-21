<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_korban.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_korban.php";
$judul = "korban";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$kd = cegah($sesiku);




//jika null, login dulu
if (empty($sesiku))
	{			
	?>
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "login.html"; 
	
	});
	
	</script>
	
	<?php
	}

else
	{	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);
	$ku_tipe_user = cegah($rku['tipe_user']);
	$ku_jabatan = cegah($rku['jabatan']);
	$ku_lat_x = balikin($rku['lat_x']);
	$ku_lat_y = balikin($rku['lat_y']);
	$ku_lat_alamat = balikin($rku['lat_alamat']);
	
	
	
	
	//ambil sesi
	$panickd = $_SESSION['sesiku_panic'];
	
	
	
	//jika null, bikin sesi
	if (empty($panickd))
		{
		//bikin sesi
		$_SESSION['sesiku_panic'] = "$sesiku$tahun$bulan$tanggal$jam$menit";
		
	
		//ambil sesi
		$panickd = $_SESSION['sesiku_panic'];
		
	
	
		
		//masukin
		mysqli_query($koneksi, "INSERT INTO umum_sesi_panic (kd, umum_kd, umum_kode, ".
									"umum_nama, umum_tipe_user, ".
									"lat_x, lat_y, lat_alamat, postdate) VALUES ".
									"('$panickd', '$sesiku', '$ku_nip', ".
									"'$ku_nama', '$ku_tipe_user', ".
									"'$ku_lat_x', '$ku_lat_y', '$ku_lat_alamat', '$today')");		
		
		
		
		$foldernya = "../filebox/panic/$kd/";
		chmod($foldernya,0777);
					
					
		//buat folder...
		if (!file_exists('../filebox/panic/'.$kd.'')) {
		    mkdir('../filebox/panic/'.$kd.'', 0777, true);
			}
		
		
		
		
		$foldernya2 = "../filebox/panic/$kd/$panickd";
		chmod($foldernya2,0777);
					
					
		//buat folder...
		if (!file_exists('../filebox/panic/'.$kd.'/'.$panickd.'')) {
		    mkdir('../filebox/panic/'.$kd.'/'.$panickd.'', 0777, true);
			}
		
		
		}
	
	
	exit();
	}









//jika realtime pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'psimpan'))
	{
	//baca
	$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
										"WHERE orang_kd = '$sesiku' LIMIT 0,1");
	$rku = mysqli_fetch_assoc($qku);
	$i_latx = balikin($rku['lat_x']);
	$i_laty = balikin($rku['lat_y']);
	$i_alamat = balikin($rku['alamat']);
	$i_alamatx = cegah($rku['alamat']);
	$e_lokasi = "[$i_latx]. [$i_laty]. $i_alamat";
						

	//jika ada usernya
	if (!empty($sesiku))
		{
		//update
		mysqli_query($koneksi, "UPDATE umum_sesi_panic SET lat_x = '$i_latx', ".
									"lat_y = '$laty2', ".
									"alamat = '$i_alamatx', ".
									"umum_tipe_user = '$ku_tipe_user' ".
									"WHERE umum_kd = '$sesiku' ".
									"ORDER BY postdate DESC LIMIT 0,1");
									
									
									
		//update lokasi terakhir
		mysqli_query($koneksi, "UPDATE m_orang SET lat_x = '$i_latx', ".
									"lat_y = '$i_laty', ".
									"lat_alamat = '$i_alamatx' ".
									"WHERE kd = '$sesiku' ".
									"AND nip = '$ku_nip'");
		}


    exit();
	}

	


	

exit();	
?>