<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_mn_perilaku_entri.php";
$filenyax = "$sumber/covid_android_satgas/i_mn_perilaku_entri.php";
$judul = "Entri Data";
$juduli = $judul;
$s = nosql($_REQUEST['s']);


//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];
$xyz_sesi = $_SESSION['xyz_sesi'];
	
//jika null
if (empty($xyz_sesi))
	{
	$xyz = md5("$sesiku$x");
	
	//bikin sesi
	$_SESSION['xyz_sesi'] = $xyz;
	$xyz_sesi = $_SESSION['xyz_sesi'];
	}

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
//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpan'))
	{
	//ambil nilai
	$e_ket = cegah($_GET["e_ket"]);
	$e_instansi = cegah($_GET["e_instansi"]);
	$e_kec = cegah($_GET["c_alamat_kec"]);
	$e_desa = cegah($_GET["c_alamat_desa"]);
	
	//ambil nilai session
	$latx_sesi = $_SESSION['latx_sesi'];
	$laty_sesi = $_SESSION['laty_sesi'];
	$xyz_sesi = $_SESSION['xyz_sesi'];
	$latx = balikin($latx_sesi);
	$laty = balikin($laty_sesi);

	
	$e_latx = cegah($latx);
	$e_laty = cegah($laty);
	$e_xyz = cegah($xyz_sesi);
	
	
	//detail kec ne
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
							"WHERE id_kecamatan = '$e_kec'");
	$rku = mysqli_fetch_assoc($qku);
	$e_kec2 = cegah($rku['nama_kecamatan']);
	

	
	//detail desa ne
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikelurahan ".
							"WHERE id_kecamatan = '$e_kec' ".
  							"AND id_kelurahan = '$e_desa'");
	$rku = mysqli_fetch_assoc($qku);
	$e_desa2 = cegah($rku['nama_kelurahan']);
	
	$e_kota = "KENDAL";
	
	$e_alamat = cegah($_GET["e_alamat"]);
	$e_kat_tempat = cegah($_GET["e_kat_tempat"]);
	$e_kat_lap = cegah($_GET["e_kat_lap"]);
	$e_jml_orang = cegah($_GET["e_jml_orang"]);
	$e_masker_pakai = cegah($_GET["e_masker_pakai"]);
	$e_masker_tidak = cegah($_GET["e_masker_tidak"]);
	$e_jaga_jarak = cegah($_GET["e_jaga_jarak"]);
	$e_jaga_jarak_tidak = cegah($_GET["e_jaga_jarak_tidak"]);
	$e_diingatkan = cegah($_GET["e_diingatkan"]);
	$e_diingatkan_tidak = cegah($_GET["e_diingatkan_tidak"]);

	
	//detail
	$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
							"WHERE kd = '$sesiku'");
	$rku = mysqli_fetch_assoc($qku);
	$ku_nip = cegah($rku['nip']);
	$ku_nama = cegah($rku['nama']);
	$ku_telp = cegah($rku['telp']);
	

  
	//insert
	mysqli_query($koneksi, "INSERT INTO e_perilaku_masyarakat(kd, lat_x, lat_y, nama_lokasi, keterangan, ".
							"kota, kecamatan, kelurahan, alamat, ". 
							"kategori_tempat, tipe_laporan, jumlah_orang, ". 
							"jml_masker_pake, jml_masker_tidak_pake, jml_jaga_jarak, ". 
							"jml_jaga_jarak_tidak, jml_ingatkan, jml_ingatkan_tidak, ".
							"kontributor_nik, kontributor_nama, kontributor_kontak, ". 
							"kontributor_ket, postdate) VALUES ".
							"('$e_xyz', '$e_latx', '$e_laty', '$e_instansi', '$e_ket', ".
							"'$e_kota', '$e_kec2', '$e_desa2', '$e_alamat', ".
							"'$e_kat_tempat', '$e_kat_lap', '$e_jml_orang', ".
							"'$e_masker_pakai', '$e_masker_tidak', '$e_jaga_jarak', ".
							"'$e_jaga_jarak_tidak', '$e_diingatkan', '$e_diingatkan_tidak', ".
							"'$ku_nip', '$ku_nama', '$ku_telp', ".
							"'SATGAS', '$today')");


	//hapus session
	$_SESSION['xyz_sesi'] = '';
	$_SESSION['latx_sesi'] = '';
	$_SESSION['laty_sesi'] = '';
	
	
				
	//pesan
	echo "<font color=red><b>LAPORAN BERHASIL DIKIRIMKAN. Terima Kasih.</b></font>";
	exit();
	}








//jika form
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//ambil nilai session
	$latx_sesi = $_SESSION['latx_sesi'];
	$laty_sesi = $_SESSION['laty_sesi'];
	
	$xyz_sesi = $_SESSION['xyz_sesi'];
	$latx = balikin($latx_sesi);
	$laty = balikin($laty_sesi);
	
	//echo "$xyz_sesi . $latx_sesi . $laty_sesi";
	?>


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
						//$("#ihasil2").html(data);
						alert("LAPORAN BERHASIL DIKIRIMKAN. Terima Kasih.");
						window.location.href = "mn.html";
						}
					});
				return false;
			});
		
		
		});	
	
	
	});
	
	</script>



	

  
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	
	$('#e_masker_pakai').on('change keyup',function(){
		  var niltotal = parseInt($('#e_jml_orang').val());
		  var nil1 = parseInt($('#e_masker_pakai').val());
		  
		  if (nil1 >= niltotal)
		  	{
		  	$('#e_masker_pakai').val(niltotal);
		  	}
		  	
		  	
		  var nil2 = niltotal - nil1; 
		  
		  $('#e_masker_tidak').val(nil2); 
		  })


	
	$('#e_masker_tidak').on('change keyup',function(){
		  var niltotal = parseInt($('#e_jml_orang').val());
		  var nil1 = parseInt($('#e_masker_tidak').val());
		  
		  if (nil1 >= niltotal)
		  	{
		  	$('#e_masker_tidak').val(niltotal);
		  	}
		  
		  var nil2 = niltotal - nil1; 
		  
		  $('#e_masker_pakai').val(nil2); 
		  })




	
	$('#e_jaga_jarak').on('change keyup',function(){
		  var niltotal = parseInt($('#e_jml_orang').val());
		  var nil1 = parseInt($('#e_jaga_jarak').val());
		  
		  
		  if (nil1 >= niltotal)
		  	{
		  	$('#e_jaga_jarak').val(niltotal);
		  	}
		  
		  var nil2 = niltotal - nil1; 
		  
		  $('#e_jaga_jarak_tidak').val(nil2); 
		  })


	
	$('#e_jaga_jarak_tidak').on('change keyup',function(){
		  var niltotal = parseInt($('#e_jml_orang').val());
		  var nil1 = parseInt($('#e_jaga_jarak_tidak').val());
		  
		  if (nil1 >= niltotal)
		  	{
		  	$('#e_jaga_jarak_tidak').val(niltotal);
		  	}
		  
		  var nil2 = niltotal - nil1; 
		  
		  $('#e_jaga_jarak').val(nil2); 
		  })








	
	$('#e_diingatkan').on('change keyup',function(){
		  var niltotal = parseInt($('#e_jml_orang').val());
		  var nil1 = parseInt($('#e_diingatkan').val());
		  
		  if (nil1 >= niltotal)
		  	{
		  	$('#e_diingatkan').val(niltotal);
		  	}
		  
		  var nil2 = niltotal - nil1; 
		  
		  $('#e_diingatkan_tidak').val(nil2); 
		  })


	
	$('#e_diingatkan_tidak').on('change keyup',function(){
		  var niltotal = parseInt($('#e_jml_orang').val());
		  var nil1 = parseInt($('#e_diingatkan_tidak').val());
		  
		  if (nil1 >= niltotal)
		  	{
		  	$('#e_diingatkan_tidak').val(niltotal);
		  	}
		  
		  var nil2 = niltotal - nil1; 
		  
		  $('#e_diingatkan').val(nil2); 
		  })











	
	
		  $('#e_jml_orang').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

	
		  $('#e_masker_pakai').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});
	
		  $('#e_masker_tidak').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

	
		  $('#e_jaga_jarak').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

	
		  $('#e_jaga_jarak_tidak').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});


		  $('#e_diingatkan').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});


		  $('#e_diingatkan_tidak').bind('keyup paste', function(){
	        this.value = this.value.replace(/[^0-9]/g, '');
	  		});

			
	});
	
	</script>
	
	
	
				
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$('#c_alamat_kec').change(function() { 
		     var keci = $(this).val(); 
		     $.ajax({
	            type: 'POST', 
	          	url: '<?php echo $sumber;?>/covid_android_satgas/i_alamat.php', 
		        data: 'iro_kec=' + keci, 
		        success: function(response) {
		              $('#c_alamat_desa').html(response);
		            }
		       });
	
		    });
		 
			
	});
	
	
	

	</script>
	




	
	<br>


	<table width="100%" border="0" cellpadding="5" cellspacing="5">
	<tr align="top">

	<td width="10">&nbsp;</td>
	<td valign="top">
			
	<div class="row">

		<div class="col-12" align="left">
			<div class="box box-danger">
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">

					<form name="formx2" id="formx2">
					
					<p>
						Nama Lokasi/Instansi : 
						<br>
						<input name="e_instansi" id="e_instansi" type="text" class="btn btn-block btn-warning" required>
					</p>
					
					<?php
					echo '<p>
					Kecamatan : 
					<br>';
								
					//list 
					$query = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
											"WHERE id_kabkota = '46' ".
											"ORDER BY nama_kecamatan ASC");
					$row = mysqli_fetch_assoc($query);
					
					echo '<select name="c_alamat_kec" id="c_alamat_kec" class="btn btn-warning" required>
					<option value="'.$ku_kec_kd.'" selected>'.$ku_kec_nama.'</option>';
					
					do
						{
						$r_idprov = nosql($row['id_kecamatan']);
						$r_nama = balikin($row['nama_kecamatan']);
						 
					    echo '<option value="'.$r_idprov.'">'.$r_nama.'</option>';
						}
					while ($row = mysqli_fetch_assoc($query));
					
					echo '</select>
					</p>
							
					<p>
					Kelurahan :
					<br>
					<select name="c_alamat_desa" id="c_alamat_desa" class="btn btn-warning" required>
					<option value="'.$ku_desa_kd.'" selected>'.$ku_desa_nama.'</option>
					</select>
					</p>';
					?>
					
					
					
					<p>
						Alamat : 
						<br>
						<input name="e_alamat" id="e_alamat" type="text" class="btn btn-block btn-warning" required>
					</p>

					

					<?php
					echo '<p>
					Kategori Tempat : 
					<br>';
								
					//list 
					$query = mysqli_query($koneksi, "SELECT * FROM e_m_kategori_tempat ".
											"ORDER BY nama ASC");
					$row = mysqli_fetch_assoc($query);
					
					echo '<select name="e_kat_tempat" id="e_kat_tempat" class="btn btn-warning" required>
					<option value="'.$ku_kec_kd.'" selected>'.$ku_kec_nama.'</option>';
					
					do
						{
						$r_idprov = nosql($row['kd']);
						$r_nama = balikin($row['nama']);
						 
					    echo '<option value="'.$r_nama.'">'.$r_nama.'</option>';
						}
					while ($row = mysqli_fetch_assoc($query));
					
					echo '</select>
					</p>




					<p>
					Tipe Laporan : 
					<br>';
								
					//list 
					$query = mysqli_query($koneksi, "SELECT * FROM e_m_tipe_laporan ".
											"ORDER BY nama ASC");
					$row = mysqli_fetch_assoc($query);
					
					do
						{
						$r_idprov = nosql($row['kd']);
						$r_nama = balikin($row['nama']);

						echo '<div class="radio">
							<label><input type="radio" name="e_kat_lap" value="'.$r_nama.'">'.$r_nama.'</label>
						</div>';
						}
					while ($row = mysqli_fetch_assoc($query));

					echo '</p>';
					?>


					
					<p>
						Jumlah Orang : 
						<br>
						<input name="e_jml_orang" id="e_jml_orang" type="text" class="btn btn-warning" size="5" required>
					</p>


					
					<p>
						Jumlah Memakai Masker : 
						<br>
						<input name="e_masker_pakai" id="e_masker_pakai" type="text" class="btn btn-warning" size="5" required>
					</p>
					
					<p>
						Jumlah Tidak Memakai Masker : 
						<br>
						<input name="e_masker_tidak" id="e_masker_tidak" type="text" class="btn btn-warning" size="5" required>
					</p>
					
					
					
					<p>
						Jumlah Jaga Jarak : 
						<br>
						<input name="e_jaga_jarak" id="e_jaga_jarak" type="text" class="btn btn-warning" size="5" required>
					</p>
					
					<p>
						Jumlah Tidak Jaga Jarak : 
						<br>
						<input name="e_jaga_jarak_tidak" id="e_jaga_jarak_tidak" type="text" class="btn btn-warning" size="5" required>
					</p>
					
					
					
					<p>
						Jumlah Diingatkan : 
						<br>
						<input name="e_diingatkan" id="e_diingatkan" type="text" class="btn btn-warning" size="5" required>
					</p>
					
					<p>
						Jumlah Tidak Diingatkan : 
						<br>
						<input name="e_diingatkan_tidak" id="e_diingatkan_tidak" type="text" class="btn btn-warning" size="5" required>
					</p>



					<p>
						Keterangan : 
						<br>
						<input name="e_ket" id="e_ket" type="text" class="btn btn-block btn-warning" required>
					</p>
					


					<p>
					<input name="xyz" id="xyz" type="hidden" value="<?php echo $xyz_sesi;?>">
					<input name="latx" id="latx" type="hidden" value="<?php echo $latx;?>">
					<input name="laty" id="laty" type="hidden" value="<?php echo $laty;?>">
					<input name="btnKRM" id="btnKRM" type="submit" value="KIRIM LAPORAN >>" class="btn btn-block btn-danger">
					</p>
					</form>
					
						
					<div id="ihasil2"></div>


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

	<?php
	
	exit();
	}








//jika foto
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'foto'))
	{
	//nilai
	$xyz_sesi = $_SESSION['xyz_sesi'];
	$kd = $xyz_sesi;
	
	
	
	$foldernya = "../filebox/perilaku/$kd/";
	chmod($foldernya,0777);
				
				
	//buat folder...
	if (!file_exists('../filebox/perilaku/'.$kd.'')) {
	    mkdir('../filebox/perilaku/'.$kd.'', 0777, true);
		}
	
	
	
	
	$namabaru = "$kd-1.jpg";
	
	
	
	
	//hapus dulu...
	unlink($foldernya.$namabaru);
	
	
	
	
	
	
	
	//nilai
	$new_image_name = "$kd-1.jpg";
	
	
	
	
	//hapus yg ada dulu...
	$pathku = "../filebox/perilaku/$kd/$new_image_name";
	chmod($pathku,0777);
	unlink($pathku);
	
	
	
	
	//copy...
	//move_uploaded_file($_FILES["file"]["tmp_name"], "../filebox/perilaku/$kd/".$new_image_name);
	
	
	
	
	

	
	// baseFromJavascript will be the javascript base64 string retrieved of some way (async or post submited)
	$baseFromJavascript = balikin($_POST['base64']);//"data:image/png;base64,BBBFBfj42Pj4"; // $_POST['base64']; //your data in base64 'data:image/png....';
	
	
	// We need to remove the "data:image/png;base64,"
	$base_to_php = explode(',', $baseFromJavascript);
	
	
	// the 2nd item in the base_to_php array contains the content of the image
	//$data = base64_decode($base_to_php[1]);
	$data = base64_decode($baseFromJavascript);
	
	//echo "-> $data";
	
	
	// here you can detect if type is png or jpg if you want
	$filepath = "../filebox/perilaku/$kd/$new_image_name"; // or image.jpg
	
	// Save the image in a defined path
	file_put_contents($filepath,$data);
	
	
		
	
	
	
	//chmod 755
	chmod($pathku, 0755);
	chmod($foldernya,0755);
	



					
    exit();
	}

	
	
	
	
	
	
	



//jika pmasuk
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'pmasuk'))
	{
	//ambil nilai
	$latx = balikin($_GET['latx']);
	$laty = balikin($_GET['laty']);


	$latx2 = cegah($_GET['latx']);
	$laty2 = cegah($_GET['laty']);
	
	//bikin sesi
	$_SESSION['latx_sesi'] = $latx;
	$_SESSION['laty_sesi'] = $laty;

	//echo "$latx2 $laty2";
	?>
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
			window.location.href = "mn_perilaku_entri.html"; 
	
	});
	
	</script>
	
	<?php
    exit();
	}

	

		
	
	
	
//jika error
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'errormap'))
	{
	?>

	<div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-map-pin"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ERROR</span>
              <span class="info-box-number">
              	PASTIKAN GPS LOCATION AKTIF DAHULU...
              	
              	<br>
              	<a href="mn.html" class="btn btn-danger">KEMBALI >></a>              	
              	</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
    <?php 
    exit();
	}

	




//jika peta
if ($s == "peta")
	{
	//ambil nilai session
	$latx_sesi = $_SESSION['latx_sesi'];
	$laty_sesi = $_SESSION['laty_sesi'];
	$latx = balikin($latx_sesi);
	$laty = balikin($laty_sesi);
	
	
	//menampilkan map-nya...
	?>
	
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=<?php echo $keyku;?>&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      #map {
        height: 200px;
      }

    </style>

	<script>
      function initMap() {
        const myLatLng = { lat: <?php echo $latx;?>, lng: <?php echo $laty;?> };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 8,
          center: myLatLng,
        });
        new google.maps.Marker({
          position: myLatLng,
          map,
          title: "LOKASI",
        });
      }
    </script>

    <div id="map"></div>

	<?php			
	}	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>