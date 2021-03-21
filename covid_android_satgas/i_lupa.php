<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");



$filenyax = "$sumber/covid_android_satgas/i_lupa.php";






//form
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
			<div class="box box-danger">
            
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">

	
					<div id="ihasil"></div>
					
					<form name="formx2" id="formx2">
					<p>
					NIK : 
					<br>
					<input name="inik" id="inik" value="" type="text" class="btn btn-block btn-warning" required>
					</p>
					
					
					<p>
					Nama : 
					<br>
					<input name="inama" id="inama" value="" type="text" class="btn btn-block btn-warning" required>
					</p>

					<p>
					Tipe User : 
					<br>
					<input name="itipe" id="itipe" value="" type="text" class="btn btn-block btn-warning" required>
					</p>
					

					<p>
					E-Mail : 
					<br>
					<input name="iemail" id="iemail" value="" type="text" class="btn btn-block btn-warning" required>
					</p>
					
					<p>
					<input type="submit" name="btnKRM" id="btnKRM" value="KIRIM >>" class="btn btn-block btn-danger">
					</p>
					
					
					</form>
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
	$enik = cegah($_GET['inik']);
	$enama = cegah($_GET['inama']);
	$etipe = cegah($_GET['itipe']);
	$eemail = cegah($_GET['iemail']);

	
	//empty
	if ((empty($enik)) OR (empty($enama)) OR (empty($etipe)) OR (empty($eemail)))
		{
		echo '<b>
		<font color="red">GAGAL. SILAHKAN ULANGI LAGI...!!</font>
		</b>';	
		} 
	else
		{
		//cek
		$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
								"WHERE nik = '$enik' ".
								"AND nama = '$enama' ".
								"AND tipe_user = '$etipe' ".
								"AND email = '$eemail'");
		$rku = mysqli_fetch_assoc($qku);
		$tku = mysqli_num_rows($qku);
		
		//jika null
		if (empty($tku))
			{
			echo '<b>
			<font color="red">
			TIDAK DITEMUKAN. <br>SILAHKAN ULANGI LAGI...!!
			</font>
			</b>';
			}
		else
			{
			//berikan password baru
			$xku = substr($x,0,5);
			$xku2 = md5($xku);
			
			
			//perintah SQL
			mysqli_query($koneksi, "UPDATE m_orang SET passwordx = '$xku2' ".
								"WHERE nik = '$enik' ".
								"AND nama = '$enama' ".
								"AND tipe_user = '$etipe' ".
								"AND email = '$eemail'");


			//pesan
			echo "<p>
			<font color=red>PASSWORD BARU : <b>'.$xku.'</b></font>
			</p>
			
			<p>
			Silahkan Catat dan Simpan dengan Baik.
			</p>";
			}
								
								
		}	

	
	exit();
	}





exit();
?>
