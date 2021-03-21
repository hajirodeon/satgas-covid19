<?php
session_start();

//fungsi - fungsi
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;



$filenyax = "$sumber/covid_android_satgas/i_cp_bukutamu.php";
$warnaheader = "green";



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];


//detail rincian...
$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
						"WHERE kd = '$sesiku'");
$rku = mysqli_fetch_assoc($qku);
$ku_nik = cegah($rku['nik']);
$ku_nama = cegah($rku['nama']);
$ku_alamat = cegah($rku['alamat']);
$ku_telp = cegah($rku['telp']);
$ku_email = cegah($rku['email']);
$ku_situs = cegah($rku['situs']);




//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	//ambil nilai
	$namaku = $ku_nama;
	$emailku = $ku_email;
	$alamatku = $ku_asal;
	$telpku = $ku_telp;
	$isiku = cegah($_GET['e_isi']);
	$xyz = md5("$namaku$emailku$isiku");

	
	
	//jika gak null
	if (!empty($isiku))
		{
		//insert
		mysqli_query($koneksi, "INSERT INTO cp_bukutamu(kd, nama, alamat, telp, email, situs, isi, postdate) VALUES ".
						"('$xyz', '$namaku', '$alamatku', '$telpku', '$emailku', '$situsku', '$isiku', '$today')");
	
		?>
		
			
		<script language='javascript'>
		//membuat document jquery
		$(document).ready(function(){
	
			$("#iformnya").hide();
					
		});
		
		</script>
			
	
	
		<?php
		echo '<h3>
		<font color="green">
		<strong>Terima Kasih Telah Mengisi Buku Tamu....</strong>
		</font>
		</h3>';
		}


	exit();
	}

	

exit();
?>
