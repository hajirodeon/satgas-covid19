<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



$filenyax = "$sumber/covid_android_satgas/i_akun_gantiprofil.php";




//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];




//form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
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
	
	
	$ku_filex1 = "$ku_nip-1.jpg";


	$e_kd = $sesiku;  
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
					NIK : 
					<br>
					<b>'.$ku_nip.'</b>
					</p>
					
					
					
					<p>
					Nama : 
					<br>
					<input name="e_nama" id="e_nama" type="text" value="'.$ku_nama.'" class="btn btn-warning" required>
					</p>
					
					<p>
					Tgl. Lahir : 
					<br>
					
					<select name="e_tgl" id="e_tgl" class="btn btn-warning" required>
					<option value="" selected></option>';
					
					for ($itgl=1;$itgl<=31;$itgl++)
						{
						echo '<option value="'.$itgl.'">'.$itgl.'</option>';
						}
					echo '</select>
					
					<select name="e_bln" id="e_bln" class="btn btn-warning" required>
					<option value="" selected></option>';
					
					for ($i=1;$i<=12;$i++)
						{
						$ibln = $i;
					
						echo '<option value="'.$ibln.'">'.$arrbln[$ibln].'</option>';
						}

					echo '</select>
					
					<select name="e_thn" id="e_thn" class="btn btn-warning" required>
					<option value="" selected></option>';
					
					for ($itgl=1920;$itgl<=2020;$itgl++)
						{
						echo '<option value="'.$itgl.'">'.$itgl.'</option>';
						}
					echo '</select>
					</p>
					
					
					<p>
					Tipe User : 
					<br>
					<select name="e_tipe" id="e_tipe" class="btn btn-warning" required>
					<option value="'.$ku_tipe_user.'" selected>'.$ku_tipe_user.'</option>';
					
					//list
					$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
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
					Jabatan : 
					<br>
					<input name="e_jabatan" id="e_jabatan" type="text" value="'.$ku_jabatan.'" class="btn btn-warning" required>
					</p>
					
					
					<p>
					Alamat : 
					<br>
					<input name="e_alamat" id="e_alamat" type="text" value="'.$ku_alamat.'" class="btn btn-block btn-warning" required>
					</p>
					
					
					<p>
					Telepon : 
					<br>
					<input name="e_telp" id="e_telp" type="text" value="'.$ku_telp.'" class="btn btn-warning" required>
					</p>
					
					
					<p>
					E-Mail : 
					<br>
					<input name="e_email" id="e_email" type="text" value="'.$ku_email.'" class="btn btn-block btn-warning" required>
					</p>
					
					
					<p>
					<input name="e_kd" id="e_kd" type="hidden" value="'.$e_kd.'">
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


	exit();
	}













//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	//ambil nilai
	$e_kd = cegah($_GET['e_kd']);
	$e_nip = cegah($_GET['e_nip']);
	$e_nama = cegah($_GET['e_nama']);
	$e_tipe = cegah($_GET['e_tipe']);
	$e_jabatan = cegah($_GET['e_jabatan']);
	$e_tgl_lahir = cegah($_GET['e_tgl_lahir']);
	$e_email = cegah($_GET['e_email']);
	$e_telp = cegah($_GET['e_telp']);
	$e_alamat = cegah($_GET['e_alamat']);



	//update
	mysqli_query($koneksi, "UPDATE m_orang SET nama = '$e_nama', ".
								"tipe_user = '$e_tipe', ".
								"jabatan = '$e_jabatan', ".
								"tgl_lahir = '$e_tgl_lahir', ".
								"alamat = '$e_alamat', ".
								"telp = '$e_telp', ".
								"email = '$e_email' ".
								"WHERE kd = '$e_kd'");
						

	echo '<b>
	<font color="green">
	UPDATE PROFIL BERHASIL.
	</font>
	</b>';

	
	exit();
	}








exit();
?>
