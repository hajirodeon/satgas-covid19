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




//hapus sesi panic
$_SESSION['sesiku_panic'] = "";

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

			<img src="<?php echo $sumber;?>/img/logo-satgas-covid-19.png" height="100" />
			
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
	$ku_tipe_user = balikin($rku['tipe_user']);
	$ku_jabatan = balikin($rku['jabatan']);
	$ku_filex = balikin($rku['filex1']);
	$ku_filex1 = "$ku_nip-1.jpg";
	
	
	


	
	$foldernya = "../filebox/pegawai/$sesiku/";
	chmod($foldernya,0777);
				
				
	//buat folder...
	if (!file_exists('../filebox/pegawai/'.$sesiku.'')) {
	    mkdir('../filebox/pegawai/'.$sesiku.'', 0777, true);
		}
	
		
		
	
	
	
	
	
	
	
	
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
			<p>
			<img src="'.$sumber.'/filebox/pegawai/'.$sesiku.'/'.$ku_filex1.'" width="100" class="img-rounded">
			</p>

		</div>';
		}
		
		
		
		
	?>
        

		<div class="col-6" align="center">
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


  <br>
  
  <div class="row">

		<div class="col-12" align="center">
			<div class="box box-danger">
			<div class="box-header with-border">
              <h3 class="box-title">VIDEO</h3>
            </div>
            
			<div class="box-body">
			<div class="row">
			
			
				<div class="col-md-12">

				<?php
				//detail
				$qku = mysqli_query($koneksi, "SELECT * FROM cp_video ".
										"ORDER BY postdate DESC");
				$rku = mysqli_fetch_assoc($qku);
				$ku_judul = balikin($rku['judul']);
				$ku_filex = balikin($rku['filex']);
				$ku_postdate = balikin($rku['postdate']);
			
				//ambil kode untuk embed
				$pecahku = explode("=", $ku_filex);
				$i_kata1 = trim($pecahku[1]);
				
				//sebelum tanda &
				$pecahku2 = explode("&", $i_kata1);
				$i_filex2 = trim($pecahku2[0]);
				
				echo '<iframe width="100%" height="345" src="https://www.youtube.com/embed/'.$i_filex2.'">
						</iframe>';
				?>	
	    	    </div>
				</div>
				</div>
				</div>			

		
		</div>
	
	</div>


  <br>
  
  <div class="row">

		<div class="col-12" align="center">
			<div class="box box-danger">
			<div class="box-header with-border">
              <h3 class="box-title">INFO</h3>
            </div>
            
			<div class="box-body">
			<div class="row">
			
			
				<div class="col-md-12">
		
				<?php
				//terbaru
				$qyuk2 = mysqli_query($koneksi, "SELECT * FROM cp_artikel ".
										"ORDER BY postdate DESC LIMIT 0,15");
				$ryuk2 = mysqli_fetch_assoc($qyuk2);
				
				do
					{
					//nilai
					$yuk2_kd = nosql($ryuk2['kd']);
					$yuk2_filex = balikin($ryuk2['filex']);
					$yuk2_judul = balikin($ryuk2['judul']);
					$yuk2_isi = balikin($ryuk2['isi']);
					$yuk2_jml_dilihat = nosql($ryuk2['jml_dilihat']);
					$yuk2_jml_suka = nosql($ryuk2['jml_suka']);
					$yuk2_jml_komentar = nosql($ryuk2['jml_komentar']);
					
					$yuk2_postdate = balikin($ryuk2['postdate']);
					$yuk2_judul2 = seo_friendly_url($yuk2_judul);
					
		
				    echo '<table width="100%" border="0" cellpadding="3" cellspacing="3">
				    	<tr align="left">
				    		
				    		<td width="60">
				    		<a name="'.$yuk2_kd.'"></a>
				    		<a href="#'.$yuk2_kd.'" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=artikelbaca&kd='.$yuk2_kd.'\');"><img src="'.$sumber.'/filebox/artikel/'.$yuk2_kd.'/'.$yuk2_filex.'" width="50" height="50"></a>
							</td>
				
							<td>
							<b>
				    		<a href="#'.$yuk2_kd.'" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=artikelbaca&kd='.$yuk2_kd.'\');">'.$yuk2_judul.'</a>
							</b>
							<br>
							<i>'.$yuk2_postdate.'</i>
				    		<br>
							</td>
		
				    	</tr>
				    </table>
				    <hr>';
				
					}
				while ($ryuk2 = mysqli_fetch_assoc($qyuk2));
				?>

	    	    </div>
				</div>
				</div>
				</div>						



		</div>
	
	</div>


  <br>
  
  <div class="row">

		<div class="col-12" align="center">
			<div class="box box-danger">
			<div class="box-header with-border">
              <h3 class="box-title">GALERI FOTO</h3>
            </div>
            
			<div class="box-body">
			<div class="row">
			
			
				<div class="col-md-12">
					
					<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
					
					<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
					<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
					
					
					
					
					
					<style>
						#masonry {
					  column-count: 1;
					  column-gap: 1em;
					}
					
					@media(min-width: 30em) {
					  #masonry {
					    column-count: 1;
					    column-gap: 1em;
					  }
					}
					
					@media(min-width: 40em) {
					  #masonry {
					    column-count: 2;
					    column-gap: 1em;
					  }
					}
					
					@media(min-width: 60em) {
					  #masonry {
					    column-count: 3;
					    column-gap: 1em;
					  }
					}
					
					@media(min-width: 75em) {
					  #masonry {
					    column-count: 3;
					    column-gap: 1em;
					  }
					}
					
					.item {
					  background-color: none;
					  display: inline-block;
					  margin: 0 0 1em 0;
					  width: 100%;
					  cursor: pointer;
					}
					
					.item img {
					  max-width: 100%;
					  height: auto;
					  width: 100%;
					  margin-bottom: -4px;
					  
					  /*idk why but this fix stuff*/
					}
					
					.item.active {
					  animation-name: active-in;
					  animation-duration: 0.7s;
					  animation-fill-mode: forwards;
					  animation-direction: alternate;
					}
					
					.item.active:before {
					  content: "+";
					  transform: rotate(45deg);
					  font-size: 48px;
					  color: white;
					  position: absolute;
					  top: 20px;
					  right: 20px;
					  background-color:rgba(0,0,0,0.85);
					  border-radius: 50%;
					  width:48px;
					  height:48px;
					  text-align:center;
					  line-height:48px;
					  z-index:12;
					}
					
					.item.active img {
					  animation-name: active-in-img;
					  animation-duration: 0.7s;
					  animation-fill-mode: forwards;
					  animation-direction: alternate;
					}
					
					
					@keyframes active-in {
					  0% {
					    opacity:1;
					    background-color:white;
					  }
					  
					  50% {
					    opacity:0;
					    background-color:rgba(0,0,0,0.90);
					  }
					  
					  100% {
					    opacity: 1;
					    position:fixed;
					    top:0;
					    left:0;
					    right:0;
					    bottom:0;
					    background-color:rgba(0,0,0,0.90);
					  }
					}
					
					@keyframes active-in-img {
					  0% {
					    opacity:1;
					    transform:translate(0%, 0%);
					    top: 0;
					    left: 0;
					    max-width: 100%;
					  }
					  49% {
					    opacity:0;
					    transform: translate(0%, -50%);
					  }
					  50% {
					    position:absolute;
					    top: 50%;
					    left: 50%;
					    transform: translate(-50%, -100%);
					  }
					  100% {
					  display: block;
					  position: absolute;
					  top: 50%;
					  left: 50%;
					  transform: translate(-50%, -50%);
					  max-width: 90%;
					  width: auto;
					  max-height: 95vh;
					  opacity:1;
					  }
					}
					</style>
					
					
					
					
					<div class="container">
					  <div id="masonry">
					
					<?php
					//foto
					$qyuk2 = mysqli_query($koneksi, "SELECT * FROM cp_foto ".
											"ORDER BY postdate DESC LIMIT 0,50");
					$ryuk2 = mysqli_fetch_assoc($qyuk2);
					
					do
						{
						//nilai
						$yuk2_kd = nosql($ryuk2['kd']);
						$yuk2_nama = balikin($ryuk2['nama']);
						$yuk2_filex = balikin($ryuk2['filex']);
					
						
						$yuk2_postdate = balikin($ryuk2['postdate']);
						$yuk2_nama2 = seo_friendly_url($yuk2_nama);
						
					
					
					    echo '<div class="item">
					      <a data-fancybox="gallery" data-caption="'.$yuk2_nama.'" href="'.$sumber.'/filebox/foto/'.$yuk2_kd.'/'.$yuk2_filex.'"><img src="'.$sumber.'/filebox/foto/'.$yuk2_kd.'/'.$yuk2_filex.'" class="img-thumbnail" alt="'.$yuk2_nama.'"></a>
					    </div>';
					
						}
					while ($ryuk2 = mysqli_fetch_assoc($qyuk2));
					
					
					
					
					echo '</div>
					</div>';
					?>
		 

	    	    </div>
				</div>
				</div>
				</div>						

 
 			

		</div>
	
	</div>




  <br>
  
  <div class="row">

		<div class="col-12" align="center">
			<div class="box box-danger">
			<div class="box-header with-border">
              <h3 class="box-title">BUKU TAMU</h3>
            </div>
            
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
		
				<a href="cp_bukutamu.html" class="btn btn-danger">Tulis Saran/Masukan/Komentar >></a>

	    	    </div>
				</div>
				</div>
				</div>						

			
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