<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_akun_profil.php";
$filenyax = "$sumber/covid_android_satgas/i_akun_profil.php";
$judul = "Profil Diri";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika form
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
	echo '<div class="row">

		<div class="col-12" align="left">
			<div class="box box-danger">
			<div class="box-header with-border">
              <h3 class="box-title">PROFIL DIRI</h3>
            </div>
            
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
				<p>
				<img src="'.$sumber.'/filebox/pegawai/'.$sesiku.'/'.$ku_filex1.'" width="100">
				</p>
				
				<p>
				NIK : 
				<br>
				<b>'.$ku_nip.'</b>
				
				</p>
				
				
				<p>
				Nama : 
				<br>
				<b>'.$ku_nama.'</b>
				</p>
				
				
				
				<p>
				Tipe User : 
				<br>
				<b>'.$ku_tipe_user.'</b>
				</p>
				
				
				<p>
				Jabatan : 
				<br>
				<b>'.$ku_jabatan.'</b>
				</p>
				
				
				<p>
				Tgl. Lahir : 
				<br>
				<b>'.$ku_tgl_lahir.'</b>
				</p>
				
				
				
				<p>
				Telepon : 
				<br>
				<b>'.$ku_telp.'</b>
				</p>
				
				
				
				<p>
				E-Mail : 
				<br>
				<b>'.$ku_email.'</b>
				</p>
				
				
				<hr>
				
				<a href="akun_foto.html" class="btn btn-block btn-danger"><i class="fa fa-user"></i> GANTI FOTO DIRI >></a>

				<hr>
				
				<a href="akun_gantiprofil.html" class="btn btn-block btn-danger"><i class="fa fa-users"></i> GANTI PROFIL DIRI >></a>
				
								
				<hr>
				
				<a href="akun_pass.html" class="btn btn-block btn-danger"><i class="fa fa-user-secret"></i> GANTI PASSWORD >></a>
				<hr>
				
				<a href="akun_history.html" class="btn btn-block btn-danger"><i class="fa fa-bookmark"></i> HISTORY PRESENSI >></a>
				
				<hr>
				
				<a href="akun_logout.html" class="btn btn-block btn-danger"><i class="fa fa-sign-out"></i> KELUAR >></a>
				
						
	    	    </div>
				</div>
				</div>
				</div>						

			
		</div>
	
	</div>';

	exit();
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>