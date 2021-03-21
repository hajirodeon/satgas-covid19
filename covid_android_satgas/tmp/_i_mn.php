<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_mn.php";
$filenyax = "$sumber/covid_android_satgas/i_mn.php";
$judul = "Data";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika form
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

	<?php
	echo '<table width="100%" border="0" cellpadding="5" cellspacing="5">
	<tr align="top">

	<td width="10">&nbsp;</td>
	<td valign="top">
	<div class="row">

		<div class="col-12" align="left">
			<div class="box box-danger">
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
	
			<table width="100%" border="0" cellpadding="5" cellspacing="5">
			<tr align="top">
			<td width="10">&nbsp;</td>
			
			<td>
		
			<h3>USER SATGAS</h3>
			<p>
			<a href="mn_satgas.html" class="btn btn-success">LIHAT DAFTAR >></a>
			</p> 
			
			<p>
			<a href="mn_satgas_map.html" class="btn btn-success">PETA >></a>
			</p>
						
			<hr>
		
		
			<h3>USER PIMPINAN</h3>
			<p>
			<a href="mn_ketua.html" class="btn btn-success">LIHAT DAFTAR >></a>
			</p> 
			
			<p>
			<a href="mn_ketua_map.html" class="btn btn-success">PETA >></a>
			</p>
						
			<hr>
		
			<h3>USER MASYARAKAT</h3>
			<p>
			<a href="mn_umum.html" class="btn btn-success">LIHAT DAFTAR >></a>
			</p> 
			
			<p>
			<a href="mn_umum_map.html" class="btn btn-success">PETA >></a>
			</p>
						
			<hr>
		
			
			
			<h3>PANIC BUTTON</h3>
			<p>
			<a href="mn_panic.html" class="btn btn-danger">LIHAT DAFTAR >></a>
			</p> 
			
			<p>
			<a href="mn_panic_tolong.html" class="btn btn-danger">TOLONG SEKARANG >></a>
			</p>
			 
			<p>
			<a href="mn_panic_map.html" class="btn btn-danger">PETA >></a>
			</p>
			
			<p>
			<a href="mn_panic_korban.html" class="btn btn-danger">DAFTAR KORBAN >></a>
			</p>
			 
			<p>
			<a href="mn_panic_penolong.html" class="btn btn-danger">DAFTAR PENOLONG >></a>
			</p>
						
						
			<hr>
			
			
			<h3>PERILAKU MASYARAKAT</h3>
			<p>
			<a href="mn_perilaku.html" class="btn btn-danger">LIHAT DAFTAR >></a>
			</p> 
			
			<p>
			<a href="mn_perilaku_entri.html" class="btn btn-danger">ENTRI BARU >></a>
			</p>
			
			<p>
			<a href="mn_perilaku_laporan.html" class="btn btn-danger">LAPORAN >></a>
			</p>
			
			<p>
			<a href="mn_perilaku_map.html" class="btn btn-danger">PETA >></a>
			</p>
						
			<hr>
			
				
			
			
			<h3>BENCANA/MUSIBAH</h3>
			<p>
			<a href="mn_bencana.html" class="btn btn-danger">LIHAT DAFTAR >></a>
			</p> 
			
			<p>
			<a href="mn_bencana_entri.html" class="btn btn-danger">ENTRI BARU >></a>
			</p>
			
			<p>
			<a href="mn_bencana_laporan.html" class="btn btn-danger">LAPORAN >></a>
			</p>
			
			<p>
			<a href="mn_bencana_map.html" class="btn btn-danger">PETA >></a>
			</p>
						
			<hr>
			
			
			
			
			
			
			<h3>KETAHANAN PANGAN</h3>
			<p>
			<a href="mn_pangan.html" class="btn btn-danger">LIHAT DAFTAR >></a>
			</p> 
			
			<p>
			<a href="mn_pangan_entri.html" class="btn btn-danger">ENTRI BARU >></a>
			</p>
			 
			
			<p>
			<a href="mn_pangan_verifikasi.html" class="btn btn-danger">VERIFIKASI >></a>
			</p>
			
			<p>
			<a href="mn_pangan_laporan.html" class="btn btn-danger">LAPORAN >></a>
			</p>
			
			<p>
			<a href="mn_pangan_map.html" class="btn btn-danger">PETA >></a>
			</p>
						
						
			<hr>
			
			
			
			
			
			</td>
			
			<td width="10">&nbsp;</td>
			</tr>
			</table>

	    	    </div>
				</div>
				</div>
				</div>						

			
		</div>
	
	</div>
				


	</td>

	<td width="10">&nbsp;</td>
	</tr>
	</table>';

	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>