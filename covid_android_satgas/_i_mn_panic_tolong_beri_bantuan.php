<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_mn_panic_tolong_beri_bantuan.php";
$filenyax = "$sumber/covid_android_satgas/i_mn_panic_tolong_beri_bantuan.php";
$kd = nosql($_SESSION['kd']);
$kdx = $kd;





//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];



//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$kd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_kd = nosql($rku['kd']);
	$yuk2_umum_kd = nosql($rku['umum_kd']);
	$yuk2_umum_kode = balikin($rku['umum_kode']);
	$yuk2_umum_nama = balikin($rku['umum_nama']);
	$yuk2_filex = balikin($rku['filex_foto']);
	$yuk2_lat_x = balikin($rku['lat_x']);
	$yuk2_lat_y = balikin($rku['lat_y']);
	$yuk2_postdate = balikin($rku['postdate']);
	
	
	
	
	/*	
	//jadikan alamat
	$latitude = $yuk2_lat_y;
	$longitude = $yuk2_lat_x;
	$geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&sensor=false&key='.$keyku.'');
	$output= json_decode($geocode);
	$alamatku = @$output->results[0]->formatted_address;
	$alamatkux = balikin($alamatku);
	 * 
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
	<img src="'.$sumber.'/filebox/panic/'.$yuk2_umum_kd.'/'.$yuk2_kd.'/'.$yuk2_filex.'" width="100%" height="100%" class="img-thumbnail">
	</p>
	
	
	<p>
	Kejadian : 
	<br>
	<b>'.$yuk2_postdate.'</b>
	</p>
	
	<p>
	Korban : 
	<br>
	<b>'.$yuk2_umum_kode.'. '.$yuk2_umum_nama.'</b>
	</p>
	
	<hr>
	
	<div align="center" style="background-color: white">
	GPS Location :
	<br>';
	
	//jika ada
	if (!empty($yuk2_lat_x))
		{
		echo '<font color="green">
		<b>'.$yuk2_lat_x.' . '.$yuk2_lat_y.'</b>
		</font>';
		}
	else
		{
		echo '<font color="red">
		<b>Tidak Ada.</b>
		</font>';
		}
		
		
	echo '</div>
	<br>
	
	<div align="center" style="background-color: white">
	AUDIO :
	<br>';

	
	
	//ketahui audio yg terekam...
	$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_suara ".
							"WHERE panic_kd = '$kd' ".
							"ORDER BY postdate DESC");
	$rmboh2 = mysqli_fetch_assoc($qmboh2);
	$tmboh2 = mysqli_num_rows($qmboh2);
	
	//jika ada
	if (!empty($tmboh2))
		{
		echo '<p>
		<img src="'.$sumber.'/img/speaker.gif" width="100" height="100">
		</p>
		<br>
		
		<a href="mn_panic_tolong_beri_bantuan.html" class="btn btn-danger">PUTAR ULANG >></a>
		<br>';
		}
	else
		{
		echo '<font color="red">
		<b>Tidak Ada.</b>
		</font>';
		}
		
		
	echo '<br>
	</div>
	<br>
	<br>
		
	</td>
	
	<td width="10">
	&nbsp;
	</td>
	
	</tr>
	</table>    	
	
	<hr>';
	?>
	
	
	

	<iframe style="width: 100vw;height: 150vh;position: relative;" src="<?php echo $sumber;?>/covid_android_satgas/i_mn_panic_map.php?sesiku=<?php echo $sesiku;?>&kd=<?php echo $kd;?>" frameborder="0" allowfullscreen></iframe>


	
		
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
		echo '<br>
		<table width="100%" border="0" cellpadding="5" cellspacing="5">
		<tr align="center">
		
		<td width="10">&nbsp;</td>
		<td valign="top">
		
			<div class="row">
		
			<div class="col-12" align="left">
				<div class="box-body">
				<div class="row">
					<div class="col-md-12">
		
		
						<form name="formx2" id="formx2">
						<p>
						Kategori Masalah : 
						<br>
						<select name="e_tipe" id="e_tipe" class="btn btn-warning" required>
						<option value="" selected></option>';
						
						//list
						$qku = mysqli_query($koneksi, "SELECT * FROM m_kategori_masalah ".
														"ORDER BY nama ASC");
						$rku = mysqli_fetch_assoc($qku);
						
						do
							{
							//nilai
							$ku_nama = balikin($rku['nama']);
							$ku_nama2 = cegah($rku['nama']);
							
							
							echo '<option value="'.$ku_nama2.'">'.$ku_nama.'</option>';
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						echo '</select>
						</p>

					
						<p>
						Solusi : 
						<br>
						<input name="e_solusi" id="e_solusi" type="text" value="" class="btn btn-block btn-warning" required>
						</p>
						
						<p>
						<input name="e_kd" id="e_kd" type="hidden" value="'.$kd.'">
						<input type="submit" name="btnKRM" id="btnKRM" value="KIRIM >" class="btn btn-block btn-danger">
						</p>
						
						
						</form>
						
						<div id="ihasil"></div>
						
						
		    	    </div>
					</div>
					</div>
					</div>						
		
				
			</div>
		
		</div>
					
		
		</td>
		
		<td width="10">&nbsp;</td>
		</tr>
		</table>
		
		<br>
		<br>
		<br>';
		
	
	
	
	//hapus sesi dulu
	$_SESSION['pkd'] = '';
	}
	




//jika player...
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'playernya'))
	{
	//nilai
	$kd = balikin($_SESSION['kd']);
	$pkd = balikin($_SESSION['pkd']);

	


	//jika null
	if (empty($pkd))
		{
		//tampilkan satu per satu...
		$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_suara ".
								"WHERE panic_kd = '$kd' ".
								"ORDER BY postdate ASC");
		$rmboh2 = mysqli_fetch_assoc($qmboh2);
		$tmboh2 = mysqli_num_rows($qmboh2);
		}
		
	else
		{
		//tampilkan satu per satu...
		$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_suara ".
								"WHERE panic_kd = '$kd' ".
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
			echo "<font color='green'>$i_postdate -> $pkd</font>";
	
			exit();
			}
			
		else
			{
			//bikin sesi baru...
			$_SESSION['pkd'] = $i_postdate;	
	

			echo '<audio controls id="'.$i_no.'" autoplay="autoplay" style="display:none">
			  <source src="'.$sumber.'/filebox/panic/'.$i_umum_kd.'/'.$kd.'/'.$i_filex.'" type="audio/wav">
			Error....
			</audio>';
			}

		
		
		}
	}









//jika peta...
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'peta'))
	{
	//nilai
	$kd = balikin($_SESSION['kd']);
		

	echo "-> $kd";
	}








//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	//ambil nilai
	$e_kd = cegah($_GET['e_kd']);
	$e_tipe = cegah($_GET['e_tipe']);
	$e_solusi = cegah($_GET['e_solusi']);



	//detailnya
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);

	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
						"WHERE kd = '$kd'");
	$rku = mysqli_fetch_assoc($qku);
	$yuk2_kd = nosql($rku['kd']);
	$yuk2_umum_kd = nosql($rku['umum_kd']);
	$yuk21_umum_kode = cegah($rku['umum_kode']);
	$yuk21_umum_nama = cegah($rku['umum_nama']);
	


	$xyz = "$kd$sesiku";


	//masukin
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong (kd, penolong_kd, penolong_kode, penolong_nama, ".
							"panic_kd, korban_kd, korban_kode, korban_nama,  ".
							"postdate, alasan, kategori, ket, sukses, sukses_postdate) VALUES ".
							"('$xyz', '$sesiku', '$ku_nip', '$ku_nama', ".
							"'$kd', '$yuk2_umum_kd', '$yuk21_umum_kode', '$yuk21_umum_nama', ".
							"'$today', 'BISA TOLONG', '$e_tipe', '$e_solusi', 'true', '$today')");
						
	?>
	
		
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			alert("Berhasil Ditolong. Terima Kasih.");
			window.location.href = "main.html"; 
	
	});
	
	</script>

	<?php
	exit();
	}








//diskonek
exit();
?>