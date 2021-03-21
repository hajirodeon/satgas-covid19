<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_mn_panic.php";
$filenyax = "$sumber/covid_android_satgas/i_mn_panic.php";
$judul = "Data Minta Bantuan PANIC BUTTON";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
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
<tr align="center">

<td width="10">&nbsp;</td>
<td valign="top">

	<div class="row">

	<div class="col-12" align="left">
		<div class="box box-danger">
		<div class="box-header with-border">
          <h3 class="box-title">PASTIKAN ANDA BISA MENOLONG...!!</h3>
        </div>
        
		<div class="box-body">
		<div class="row">
			<div class="col-md-12">';

			//terbaru
			$qyuk2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
									"WHERE umum_kd <> '$sesiku' ".
									"ORDER BY postdate DESC");
			$ryuk2 = mysqli_fetch_assoc($qyuk2);
			$tyuk2 = mysqli_num_rows($qyuk2);
			
			//jika null
			if (empty($tyuk2))
				{
				echo '<h3>
				<font color="red">
				BELUM ADA PERMINTAAN BANTUAN
				</font>
				</h3>';
				}
			else
				{
				
				do
					{
					//nilai
					$yuk2_kd = nosql($ryuk2['kd']);
					$yuk2_umum_kd = nosql($ryuk2['umum_kd']);
					$yuk2_umum_kode = balikin($ryuk2['umum_kode']);
					$yuk2_umum_nama = balikin($ryuk2['umum_nama']);
					$yuk2_filex = balikin($ryuk2['filex_foto']);
					$yuk2_lat_x = balikin($ryuk2['lat_x']);
					$yuk2_lat_y = balikin($ryuk2['lat_y']);
					$yuk2_postdate = balikin($ryuk2['postdate']);
				
				
					//jika null, kasi yg terakhir
					if (empty($yuk2_lat_x))
						{
						//kasi yang terakhir
						$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
												"WHERE orang_kd = '$yuk2_umum_kd' ".
												"AND lat_x <> '' ".
												"ORDER BY postdate DESC LIMIT 0,1");
						$rku = mysqli_fetch_assoc($qku);
						$ku_long = trim(balikin($rku['lat_x']));
						$ku_lat = trim(balikin($rku['lat_y']));
						$yuk2_lat_x = $ku_long;
						$yuk2_lat_y = $ku_lat;
						
						
						//update
						mysqli_query($koneksi, "UPDATE umum_sesi_panic ".
													"SET lat_x = '$ku_long', ".
													"lat_y = '$ku_lat' ".
													"WHERE umum_kd = '$yuk2_umum_kd' ".
													"AND kd = '$yuk2_kd'");						
						}
				
	
		
		
					//ketahui audio yg terekam...
					$qmboh2 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_suara ".
											"WHERE panic_kd = '$yuk2_kd' ".
											"ORDER BY postdate DESC");
					$rmboh2 = mysqli_fetch_assoc($qmboh2);
					$tmboh2 = mysqli_num_rows($qmboh2);
					
					
				
					//cari yg belum..
					$qku21 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
											"WHERE penolong_kd = '$sesiku' ".
											"AND panic_kd <> '$yuk2_kd' ".
											"ORDER BY postdate DESC");
					$rku21 = mysqli_fetch_assoc($qku21);
					$tku21 = mysqli_num_rows($qku21);
						
				
					if (!empty($tku21))
						{
					    echo '<table width="100%" border="0" cellpadding="3" cellspacing="3">
					    	<tr align="left" valign="top">
					    		
					    		<td width="100">
					    		<a name="'.$yuk2_kd.'"></a>
					    		<a href="#'.$yuk2_kd.'"><img src="'.$sumber.'/filebox/panic/'.$yuk2_umum_kd.'/'.$yuk2_kd.'/'.$yuk2_filex.'" width="100" height="100" class="img-thumbnail"></a>
					    		<br>
					    		<br>
								</td>
					
					    		<td width="10">
					    		&nbsp;
								</td>
					
								<td>
								<p>
								Kejadian : 
								<br>
								<b>'.$yuk2_postdate.'</b>
								</p>
								<br>
								
								<p>
					    		Korban : 
					    		<br>
					    		<b>'.$yuk2_umum_kode.'. '.$yuk2_umum_nama.'</b>
					    		</p>
		
								<p>
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
									
									
								echo '</p>
								
								
								<p>
								AUDIO :
								<br>';
								
								//jika ada
								if (!empty($tmboh2))
									{
									echo '<font color="green">
									<b>ADA.</b>
									</font>';
									}
								else
									{
									echo '<font color="red">
									<b>Tidak Ada.</b>
									</font>';
									}
									
									
								echo '</p>
								
								
					    		<br>
								</td>
					
					    	</tr>
					    </table>
					    
						<a href="#'.$yuk2_kd.'" onclick="$(\'#iredirect\').load(\''.$sumber.'/covid_android_satgas/i_redirect.php?sesikode=korban&kd='.$yuk2_kd.'\');" class="btn btn-block btn-danger">DETAIL >></a>
					    <hr>
					    <br>
					    <br>';
					    }

					else
						{
						echo ".";
						}
					}
				while ($ryuk2 = mysqli_fetch_assoc($qyuk2));
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
</table>

<br>
<br>
<br>';
?>