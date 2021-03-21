<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_notif_panic_detail.php";
$panickd = nosql($_SESSION['panickd']);
$panickdx = $panickd;





//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];






//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//nilai
	$panickd = nosql($_SESSION['panickd']);

	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$panickd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_kd = nosql($rku['kd']);
	$yuk2_umum_kd = nosql($rku['umum_kd']);
	$yuk2_umum_kode = balikin($rku['umum_kode']);
	$yuk21_umum_kode = cegah($rku['umum_kode']);
	$yuk2_umum_nama = balikin($rku['umum_nama']);
	$yuk21_umum_nama = cegah($rku['umum_nama']);
	$yuk2_umum_tipe = balikin($rku['umum_tipe']);
	$yuk2_lat_x = balikin($rku['lat_x']);
	$yuk2_lat_y = balikin($rku['lat_y']);
	$yuk2_lat_alamat = balikin($rku['lat_alamat']);
	$yuk2_postdate = balikin($rku['postdate']);
	
	
	
	
	
	//detail 
	$qrow = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
						"WHERE panic_kd = '$panickd' ".
						"AND penolong_kd = '$sesiku'");
	$row = mysqli_fetch_assoc($qrow);
	$i_pkd = cegah($row['penolong_kd']);
	$i_pkode = cegah($row['penolong_kode']);
	$i_pnama = cegah($row['penolong_nama']);
	$i_ptipe = cegah($row['penolong_tipe']);
	$i_platx = balikin($row['penolong_lat_x']);
	$i_platy = balikin($row['penolong_lat_y']);
	$i_kkd = cegah($row['korban_kd']);
	$i_tkp_postdate = balikin($row['tkp_postdate']);
	$i_kkode = balikin($row['korban_kode']);
	$i_knama = balikin($row['korban_nama']);
	$i_ktipe = balikin($row['korban_tipe']);
	$yuk2_umum_tipe = $i_ktipe;
	
	
	
	
	//update
	mysqli_query($koneksi, "UPDATE umum_sesi_penolong SET notif = 'true', ".
								"notif_postdate = '$today' ".
								"WHERE panic_kd = '$panickd' ".
								"AND penolong_kd = '$sesiku'");
	
	
	






	
	/*
	//bikin list //////////////////////////////////////////////////////////////////////////////////////////
	$kode_ruas = "../filebox/konversi/$panickd";
	chmod($kode_ruas, 0777);
	
	
	//baca list file video
	$qyuk = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
										"WHERE umum_kd = '$i_kkd' ".
										"AND panic_kd = '$panickd' ".
										"ORDER BY filex ASC");
	$ryuk = mysqli_fetch_assoc($qyuk);
	
	do
		{
		//nilai
		$yuk_file = balikin($ryuk['filex']);
	
		echo "file '/var/www/html/filebox/konversi/$panickd/$yuk_file' \n";
		} 
	while ($ryuk = mysqli_fetch_assoc($qyuk));
	
	
	
	//isi
	$isi = ob_get_contents();
	ob_end_clean();
	
	
	
	
	//bikin file
	$pathku = "../filebox/konversi/$panickd/list.txt";
	chmod($pathku, 0777);
	$myfile = fopen($pathku, "w") or die("Unable to open file!");
	fwrite($myfile, $isi);
	fclose($myfile);
	
	
	
	
	
	
	
	
	
	
	




	
	//gabungkan ///////////////////////////////////////////////////////////////////////////////////////////
	//mambaca list
	$kode_ruas = "../filebox/konversi/$panickd/list.txt";
	$target_ruas = "../filebox/videolive/$panickd.mp4";
	
	
	$folder1 = "../filebox/konversi";
	$folder2 = "../filebox/videolive";
	chmod($folder1, 0777);
	chmod($folder2, 0777);
	
	
	shell_exec("/usr/bin/ffmpeg -f concat -safe 0 -i $kode_ruas -c copy $target_ruas");
	//gabungkan ///////////////////////////////////////////////////////////////////////////////////////////
	*/
	
	
		
	
	
	//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	echo '<table width="100%" border="0" cellpadding="3" cellspacing="3">
	<tr valign="top" align="left">
				    	
	<td width="10">
	&nbsp;
	</td>
	
	<td>
	<a name="tolongku"></a>
	
	<p>
	Kejadian : 
	<br>
	<b>'.$yuk2_postdate.'</b>
	</p>


		
	<p>
	<font color="red">
	Korban : 
	<br>
	<b>['.$yuk2_umum_tipe.']. '.$yuk2_umum_kode.'. '.$yuk2_umum_nama.'</b>
	</font>
	</p>
	
	

		
	</td>
	
	<td width="10">
	&nbsp;
	</td>
	
	</tr>
	</table>';
	}
	

















//jika form2
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form2'))
	{
	//nilai
	$panickd = nosql($_SESSION['panickd']);
	
	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$panickd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_kd = nosql($rku['kd']);
	$yuk2_umum_kd = nosql($rku['umum_kd']);
	$yuk2_umum_kode = balikin($rku['umum_kode']);
	$yuk21_umum_kode = cegah($rku['umum_kode']);
	$yuk2_umum_nama = balikin($rku['umum_nama']);
	$yuk21_umum_nama = cegah($rku['umum_nama']);
	$yuk2_umum_tipe = balikin($rku['umum_tipe']);
	$yuk2_lat_x = balikin($rku['lat_x']);
	$yuk2_lat_y = balikin($rku['lat_y']);
	$yuk2_lat_alamat = balikin($rku['lat_alamat']);
	$yuk2_postdate = balikin($rku['postdate']);
	
	
	
	
	
	//detail 
	$qrow = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
						"WHERE panic_kd = '$panickd' ".
						"AND penolong_kd = '$sesiku'");
	$row = mysqli_fetch_assoc($qrow);
	$i_pkd = cegah($row['penolong_kd']);
	$i_pkode = cegah($row['penolong_kode']);
	$i_pnama = cegah($row['penolong_nama']);
	$i_ptipe = cegah($row['penolong_tipe']);
	$i_platx = balikin($row['penolong_lat_x']);
	$i_platy = balikin($row['penolong_lat_y']);
	$i_kkd = cegah($row['korban_kd']);
	$i_tkp_postdate = balikin($row['tkp_postdate']);
	$i_kkode = balikin($row['korban_kode']);
	$i_knama = balikin($row['korban_nama']);
	$i_ktipe = balikin($row['korban_tipe']);
	$yuk2_umum_tipe = $i_ktipe;
	
	
	
	
	//update
	mysqli_query($koneksi, "UPDATE umum_sesi_penolong SET notif = 'true', ".
								"notif_postdate = '$today' ".
								"WHERE panic_kd = '$panickd' ".
								"AND penolong_kd = '$sesiku'");
	
	
	
	
	
	
	//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	echo '<table width="100%" border="0" cellpadding="3" cellspacing="3">
	<tr valign="top" align="left">
				    	
	<td width="10">
	&nbsp;
	</td>
	
	<td>
	<a name="tolongku"></a>
		
	<p>
	<a href="#tolongku" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=tolong&kd='.$panickd.'\');" class="btn btn-block btn-success">BERI BANTUAN >></a>
	</p>
	
	<p>
	<a href="#tolongku" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=tidakmampu&kd='.$panickd.'\');"" class="btn btn-block btn-danger">SAYA TIDAK MAMPU >></a>
	</p>
	
	<p>
	<a href="#tolongku" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=sibuk&kd='.$panickd.'\');"" class="btn btn-block btn-danger">SAYA SIBUK >></a>
	</p>
	
	<p>
	<a href="#tolongku" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=diluararea&kd='.$panickd.'\');"" class="btn btn-block btn-danger">SAYA DILUAR AREA >></a>
	</p>';

	
	echo '<hr>
		
	</td>
	
	<td width="10">
	&nbsp;
	</td>
	
	</tr>
	</table>    	
	
	<hr>';
	}
	



















//jika gpsnya
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'gpsnya'))
	{
	$panickd = nosql($_SESSION['panickd']);
	

	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$panickd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_lat_x = balikin($rku['lat_x']);
	$yuk2_lat_y = balikin($rku['lat_y']);
	$yuk2_lat_alamat = balikin($rku['lat_alamat']);
	$yuk2_postdate = balikin($rku['postdate']);
	
	
	
	//log gps terakhir...

	
	
	
	
	//penolong
	$qrow = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
						"WHERE panic_kd = '$panickd' ".
						"AND penolong_kd = '$sesiku'");
	$row = mysqli_fetch_assoc($qrow);
	$i_pkd = cegah($row['penolong_kd']);
	$i_pkode = cegah($row['penolong_kode']);
	$i_pnama = cegah($row['penolong_nama']);
	$i_ptipe = cegah($row['penolong_tipe']);
	$i_platx = balikin($row['penolong_lat_x']);
	$i_platy = balikin($row['penolong_lat_y']);
		
	echo '<table width="100%" border="0" cellpadding="3" cellspacing="3">
	<tr valign="top" align="left">
				    	
	<td width="10">
	&nbsp;
	</td>
	
	<td>
	
	
	<p>
	
	<font color="red">
	GPS Korban :
	<br>';
	
	//jika ada
	if (!empty($yuk2_lat_x))
		{
		echo '<b>['.$yuk2_postdate.']. 
		'.$yuk2_lat_x.' . '.$yuk2_lat_y.'
		<br>
		'.$yuk2_lat_alamat.'</b>';
		}
	else
		{
		echo '<b>Tidak Ada.</b>';
		}
		
	echo '</font>
	</p>
	
	
	
	<p>
	<font color="green">
	GPS Penolong :
	<br>';
	
	//jika ada
	if (!empty($yuk2_lat_x))
		{
		echo "$i_platx . $i_platy";
		}
	else
		{
		echo "<b>Tidak Ada.</b>";
		}
		
	echo '</font>
	</p>
	
	</td>
	
	<td width="10">
	&nbsp;
	</td>
	
	</tr>
	</table>';
	
		
	exit();	
	}
	









/*

<input type="text" id="slectedLat" value="-6.9711431"></input>
<input type="text" id="slectedLon" value="110.1501243"></input>
 */










/*
//jika form aksi
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'formaksi'))
	{
	//nilai
	$panickd = nosql($_SESSION['panickd']);
	
	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$panickd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_lat_x = balikin($rku['lat_x']);
	$yuk2_lat_y = balikin($rku['lat_y']);
	$yuk2_lat_alamat = balikin($rku['lat_alamat']);
	$yuk2_postdate = balikin($rku['postdate']);



	//deteksi kecamatan
	$pecahku = explode("Kec. ", $yuk2_lat_alamat);
	$pecah1 = trim($pecahku[1]);
	
	$pecahku2 = explode(",", $pecah1);
	$pecah2 = trim($pecahku2[0]);
	
	$yuk2_kec = $pecah2;
	




	//penolong 
	$qrow = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
						"WHERE panic_kd = '$panickd' ".
						"AND penolong_kd = '$sesiku'");
	$row = mysqli_fetch_assoc($qrow);
	$i_kategori = balikin($row['kategori']);
	
	
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
	

		
		<script language='javascript'>
		
		$.noConflict();
		
		
		//membuat document jquery
		$(document).ready(function(){
		
			$("#btnKRMAKSI").on('click', function(){
				$("#formxaksi2").submit(function(){

					var str = $("#e_dampak_korban").val();
					

					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=simpanaksi",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
							//$("#ihasilaksi").html(data);
							
							alert(data);
							}
						});
					return false;


				});
			
			
			});	
		
		
		
		
		});
		
		</script>
		
		
		<?php
		echo '<br>
			<form name="formxaksi2" id="formxaksi2">

						<p>
						Kategori Masalah :
						<br>
						<b>'.$i_kategori.'</b>
						</p>
						<br>
						
						
						<p>
						Dampak Korban : 
						<br>
						<input name="e_dampak_korban" id="e_dampak_korban" type="text" value="" class="btn btn-block btn-warning" required>
						</p>
						<br>
					
						<p>
						Dampak Kerugian : 
						<br>
						<input name="e_dampak_rugi" id="e_dampak_rugi" type="text" value="" class="btn btn-block btn-warning" required>
						</p>
						<br>
					
						<p>
						Kronologi : 
						<br>
						<input name="e_kronologi" id="e_kronologi" type="text" value="" class="btn btn-block btn-warning" required>
						</p>
						<br>
					
						<p>
						Upaya Dilakukan : 
						<br>
						<input name="e_upaya" id="e_upaya" type="text" value="" class="btn btn-block btn-warning" required>
						</p>
						<br>
					
						<p>
						Kendala : 
						<br>
						<input name="e_kendala" id="e_kendala" type="text" value="" class="btn btn-block btn-warning" required>
						</p>
						<br>						

						
						<p>
						<input name="e_satgas" id="e_satgas" type="hidden" value="'.$sesiku.'">
						<input name="e_panickd" id="e_panickd" type="hidden" value="'.$panickd.'">
						<input name="e_kec" id="e_kec" type="hidden" value="'.$yuk2_kec.'">
						<input type="submit" name="btnKRMAKSI" id="btnKRMAKSI" value="KIRIM >>" class="btn btn-block btn-danger">
						</p>
						

			</form>
		
		<div id="ihasilaksi"></div>
		
		<br>
		<br>
		<br>';
		
	}
*/	

















//jika gpsnya penolong korban
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'gpspenolongkorban'))
	{
	//nilai
	$panickd = nosql($_SESSION['panickd']);
	
	
	//korban
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$panickd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_lat_x = balikin($rku['lat_x']);
	$yuk2_lat_y = balikin($rku['lat_y']);
	$yuk2_lat_alamat = balikin($rku['lat_alamat']);
	$yuk2_postdate = balikin($rku['postdate']);
	

	//penolong 
	$qrow = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
						"WHERE panic_kd = '$panickd' ".
						"AND penolong_kd = '$sesiku'");
	$row = mysqli_fetch_assoc($qrow);
	$i_pkode = cegah($row['penolong_kode']);
	$i_pnama = cegah($row['penolong_nama']);
	$i_ptipe = cegah($row['penolong_tipe']);
	$i_platx = balikin($row['penolong_lat_x']);
	$i_platy = balikin($row['penolong_lat_y']);



	echo "$yuk2_lat_x,$yuk2_lat_y,$i_platx,$i_platy";
	
		
	exit();	
	}
	













//jika player...
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'playernya'))
	{
	//nilai
	$panickd = balikin($_SESSION['panickd']);
	$pkd = balikin($_SESSION['pkd']);

	
	
	//ketahui batas akhir
	$qmboh21 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
							"WHERE panic_kd = '$panickd' ".
							"ORDER BY postdate DESC");
	$rmboh21 = mysqli_fetch_assoc($qmboh21);
	$i_postdate21 = balikin($rmboh21['postdate']);

	
	
	

	//jika null
	if (empty($pkd))
		{
		//tampilkan satu per satu...
		$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
								"WHERE panic_kd = '$panickd' ".
								"ORDER BY postdate ASC");
		$rmboh2 = mysqli_fetch_assoc($qmboh2);
		$tmboh2 = mysqli_num_rows($qmboh2);
		}
		
	else
		{
		//tampilkan satu per satu...
		$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
								"WHERE panic_kd = '$panickd' ".
								"AND postdate > '$pkd' ".
								"ORDER BY postdate ASC");
		$rmboh2 = mysqli_fetch_assoc($qmboh2);
		$tmboh2 = mysqli_num_rows($qmboh2);			
		}
	

	//jika ada
	if (!empty($tmboh2))
		{
		//nilai
		$i_no = 1;
		$i_umum_kd = nosql($rmboh2['umum_kd']);
		$i_kd = nosql($rmboh2['kd']);
		$i_filex = balikin($rmboh2['filex']);
		$i_postdate = balikin($rmboh2['postdate']);
	
	
		//jika sama, jangan bunyi, selesai...
		if ($pkd == $i_postdate)
			{
			//echo "<font color='green'>$i_postdate -> $pkd</font>";
	
			exit();
			}
			
		else
			{
			//bikin sesi baru...
			$_SESSION['pkd'] = $i_postdate;	


			echo "$sumber/filebox/panic/$i_umum_kd/$panickd/$i_filex";
			
			
			

			//jika sama dengan batas akhir, ulang dari awal
			if ($i_postdate21 == $i_postdate)
				{
				//netralkan
				$_SESSION['pkd'] = "";
				}

			}

		
		
		}
	}












//jika playlist
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'playlist'))
	{
	//nilai
	$panickd = balikin($_SESSION['panickd']);
	?>

	
	
			<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />



			
			

			<video
			    id="my-video"
			    autoplay= "play" 
			    class="video-js vjs-default-skin" 
			    style="width:100%;height:auto; position: relative;" 
			    controls
			    preload="auto"
			    height="264"
			    poster="img/logo.jpg"
			    data-setup="{}">
			    
			    <source src="http://satgascovid19.kendalkab.go.id/filebox/panic/3cec07e9ba5f5bb252d13f5f431e4bbb/3cec07e9ba5f5bb252d13f5f431e4bbb202101201612/mburi-20210209157-12312203132434203014003.mp4" type="video/mp4" />

						
				<?php
				/*
				//playlist
				$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_video ".
										//"WHERE panic_kd = '$panickd' ".
										"ORDER BY postdate ASC");
				$rmboh2 = mysqli_fetch_assoc($qmboh2);
				$tmboh2 = mysqli_num_rows($qmboh2);			
				
			
				//jika ada
				if (!empty($tmboh2))
					{
					do
						{	
						//nilai
						$i_no = 1;
						$i_kd = nosql($rmboh2['kd']);
						$i_filex = balikin($rmboh2['filex']);
						$i_postdate = balikin($rmboh2['postdate']);
						?>
						
						<source src="http://satgascovid19.kendalkab.go.id/filebox/panic/<?php echo $panickd;?>/<?php echo $i_kd;?>/<?php echo $i_filex;?>" type="video/mp4" />
				
						
						<?php	
						}
					while ($rmboh2 = mysqli_fetch_assoc($qmboh2));
					
					
					}
				 */ 
			    ?>
			    
			    
			    <p class="vjs-no-js">
			      To view this video please enable JavaScript, and consider upgrading to a
			      web browser that
			      <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
			    </p>
			    
			    
			  </video>

			  

			  <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>

			<?php
				
	}






















//jika kirim aksi
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpanaksi'))
	{
	//nilai
	$panickd = balikin($_SESSION['panickd']);
	$e_dampak_korban = cegah($_GET['e_dampak_korban']);
	$e_dampak_rugi = cegah($_GET['e_dampak_rugi']);
	$e_kronologi = cegah($_GET['e_kronologi']);
	$e_upaya = cegah($_GET['e_upaya']);
	$e_kendala = cegah($_GET['e_kendala']);
	$e_satgas = cegah($_GET['e_satgas']);
	$e_kec = cegah($_GET['e_kec']);


	//update
	mysqli_query($koneksi, "UPDATE umum_sesi_penolong SET kecamatan = '$e_kec', ".
								"ket_dampak_korban = '$e_dampak_korban', ".
								"ket_dampak_kerugian = '$e_dampak_rugi', ".
								"ket_kronologi = '$e_kronologi', ".
								"ket_upaya_dilakukan = '$e_upaya', ".
								"ket_kendala = '$e_kendala', ".
								"statusnya = 'true', ".
								"statusnya_postdate = '$today' ".
								"WHERE penolong_kd = '$sesiku' ".
								"AND panic_kd = '$panickd'");


		
	
	echo "<br>
	<br>
	<h3>
	<font color='green'>
	Verifikasi Berhasil Dilakukan. Terima Kasih.
	</font>
	</h3>";

	 
	  
	exit();
	}













/*
//jika beri bantuan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'beribantuan'))
	{
	//nilai
	$panickd = balikin($_SESSION['panickd']);


	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$panickd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_kd = nosql($rku['kd']);
	$yuk2_umum_kd = nosql($rku['umum_kd']);
	$yuk2_umum_kode = balikin($rku['umum_kode']);
	$yuk21_umum_kode = cegah($rku['umum_kode']);
	$yuk2_umum_nama = balikin($rku['umum_nama']);
	$yuk21_umum_nama = cegah($rku['umum_nama']);
	$yuk2_filex = balikin($rku['filex_foto']);
	$yuk2_lat_x = balikin($rku['lat_x']);
	$yuk2_lat_y = balikin($rku['lat_y']);
	$yuk2_postdate = balikin($rku['postdate']);


	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);


	//entri
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong(kd, orang_kd, orang_kode, orang_nama, ".
								"umum_kd, umum_kode, umum_nama, ".
								"panic_kd, postdate) VALUES ".
								"('$panickd', '$sesiku', '$ku_nip', '$ku_nama', ".
								"'$yuk2_kd', '$yuk21_umum_kode', '$yuk21_umum_nama', ".
								"'$panickd', '$today')");
								
								
	echo "<h3>
	<font color='green'>
	Silahkan Ikuti Petunjuk Rute Peta Menuju Lokasi...
	</font>
	</h3>";
	exit();
	}
*/













//jika foto
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'foto'))
	{
	//nilai
	$panickd = balikin($_SESSION['panickd']);
	$kd = $sesiku;
	
	
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
	
	
	
	
	
	$namabaru = "$sesiku-$panickd.jpg";
	
	//update
	mysqli_query($koneksi, "UPDATE umum_sesi_penolong SET filex_foto = '$namabaru' ".
								"WHERE panic_kd = '$panickd' ".
								"AND penolong_kd = '$sesiku'");
	


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
	$filepath = "$foldernya/$panickd/$namabaru"; // or image.jpg
	
	// Save the image in a defined path
	file_put_contents($filepath,$data);
	


					
    exit();
	}

	


?>