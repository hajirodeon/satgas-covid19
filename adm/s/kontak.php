<?php
session_start();

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");




nocache;

//nilai
$filenya = "kontak.php";
$judul = "[SETTING]. Kontak";
$judulku = "$judul";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$e_telp = cegah($_POST["e_telp"]);
	$e_email = cegah($_POST["e_email"]);
	$e_alamat = cegah($_POST["e_alamat"]);
	$c_alamat_prov = cegah($_POST["c_alamat_prov"]);
	$c_alamat_kota = cegah($_POST["c_alamat_kota"]);
	$c_alamat_kec = cegah($_POST["c_alamat_kec"]);
	$c_alamat_desa = cegah($_POST["c_alamat_desa"]);



	//prop
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ipropinsi ".
							"WHERE id_propinsi = '$c_alamat_prov'");
	$rku = mysqli_fetch_assoc($qku);
	$c_prov = cegah($rku['nama_propinsi']);



	//kota
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikabkota ".
							"WHERE id_kabkota = '$c_alamat_kota'");
	$rku = mysqli_fetch_assoc($qku);
	$c_kota = cegah($rku['nama_kabkota']);

	
	//kec
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
							"WHERE id_kecamatan = '$c_alamat_kec'");
	$rku = mysqli_fetch_assoc($qku);
	$c_kec = cegah($rku['nama_kecamatan']);

	
	//desa
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikelurahan ".
							"WHERE id_kelurahan = '$c_alamat_desa'");
	$rku = mysqli_fetch_assoc($qku);
	$c_desa = cegah($rku['nama_kelurahan']);



			


	//cek
	//nek null
	if ((empty($e_telp)) OR (empty($e_email)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}

	else
		{
		//perintah SQL
		mysqli_query($koneksi, "UPDATE a_profil SET telp = '$e_telp', ".
									"email = '$e_email', ".
									"alamat = '$e_alamat', ".
									"prop_kd = '$c_alamat_prov', ".
									"prop_nama = '$c_prov', ".
									"kota_kd = '$c_alamat_kota', ".
									"kota_nama = '$c_kota', ".
									"kec_kd = '$c_alamat_kec', ".
									"kec_nama = '$c_kec', ".
									"desa_kd = '$c_alamat_desa', ".
									"desa_nama = '$c_desa'");


		//auto-kembali
		xloc($filenya);
		exit();
		}
	}
	
	
	
	
	
	
	
	
	




	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





require("../template_atas.php");


?>




<!-- jQuery 3 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $sumber;?>/template/adminlte/dist/js/adminlte.min.js"></script>



<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Bootstrap core CSS -->
<link href="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">



<!-- ChartJS -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/chart.js/Chart.js"></script>


    



  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/skins/skins-biasawae.css">




			
<script language='javascript'>
//membuat document jquery
$(document).ready(function(){

$.noConflict();


	$('#c_alamat_prov').change(function() { 
	     var provinsi = $(this).val(); 
	     $.ajax({
            type: 'POST', 
          	url: 'i_alamat.php', 
	        data: 'iro_propinsi=' + provinsi, 
	        success: function(response) { 
	              $('#c_alamat_kota').html(response);
	            }
	       });

	    });
	 
	
	
	
	$('#c_alamat_kota').change(function() { 
	     var kabupaten = $(this).val(); 
	     $.ajax({
	            type: 'POST', 
	          url: 'i_alamat.php', 
	         data: 'iro_kota=' + kabupaten, 
	         success: function(response) { 
	              $('#c_alamat_kec').html(response);
	            }
	       });

	    });



	
	$('#c_alamat_kec').change(function() { 
	     var kec = $(this).val(); 
	     $.ajax({
	            type: 'POST', 
	          url: 'i_alamat.php', 
	         data: 'iro_kec=' + kec, 
	         success: function(response) { 
	              $('#c_alamat_desa').html(response);
	            }
	       });



	    });




});





	$.ajaxPrefilter( function (options) {
	  if (options.crossDomain && jQuery.support.cors) {
	    var http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
	    options.url = http + '//cors-anywhere.herokuapp.com/' + options.url;
	    //options.url = "http://cors.corsproxy.io/url=" + options.url;
	  }
	});



</script>


<?php
//detail
$qku = mysqli_query($koneksi, "SELECT * FROM a_profil");
$rku = mysqli_fetch_assoc($qku);
$ku_telp = balikin($rku['telp']);
$ku_email = balikin($rku['email']);
$ku_prop_kd = balikin($rku['prop_kd']);
$ku_prop_nama = balikin($rku['prop_nama']);
$ku_kota_kd = balikin($rku['kota_kd']);
$ku_kota_nama = balikin($rku['kota_nama']);
$ku_kec_kd = balikin($rku['kec_kd']);
$ku_kec_nama = balikin($rku['kec_nama']);
$ku_desa_kd = balikin($rku['desa_kd']);
$ku_desa_nama = balikin($rku['desa_nama']);
$ku_alamat = balikin($rku['alamat']);




     	
echo '<form action="'.$filenya.'" method="post" name="formx">
<div class="row">

	<div class="col-md-6">
	
	
		<p>
		Telepon : 
		<br>
		<input name="e_telp" type="text" size="30" value="'.$ku_telp.'" class="btn btn-warning">
		</p>
		<br>
		
		
	
		<p>
		E-Mail : 
		<br>
		<input name="e_email" type="text" size="30" value="'.$ku_email.'" class="btn btn-warning">
		</p>
		<hr>
		
		
		<p>
		Propinsi : 
		<br>';
					
		//Dapatkan semua 
		$query = mysqli_query($koneksi, "SELECT * FROM m_ipropinsi ".
								"ORDER BY nama_propinsi ASC");
		$row = mysqli_fetch_assoc($query);
		
		echo '<select name="c_alamat_prov" id="c_alamat_prov" class="btn btn-warning" required>
		<option value="'.$ku_prop_kd.'" selected>'.$ku_prop_nama.'</option>';
		
		do
			{
			$r_idprov = nosql($row['id_propinsi']);
			$r_nama = balikin($row['nama_propinsi']);
			 
		    echo '<option value="'.$r_idprov.'">'.$r_nama.'</option>';
			}
		while ($row = mysqli_fetch_assoc($query));
		
		echo '</select>
		</p>
		<br>
		
		
		<p>
		Kabupaten / Kota :
		<br>
		<select name="c_alamat_kota" id="c_alamat_kota" class="btn btn-warning" required>
		<option value="'.$ku_kota_kd.'" selected>'.$ku_kota_nama.'</option>
		</select>
		</p>
		<br>
				
		<p>
		Kecamatan :
		<br>
		<select name="c_alamat_kec" id="c_alamat_kec" class="btn btn-warning" required>
		<option value="'.$ku_kec_kd.'" selected>'.$ku_kec_nama.'</option>
		</select>
		</p>
		<br>
		

		<p>
		Desa / Kelurahan :
		<br>
		<select name="c_alamat_desa" id="c_alamat_desa" class="btn btn-warning" required>
		<option value="'.$ku_desa_kd.'" selected>'.$ku_desa_nama.'</option>
		</select>
		</p>
		<br>
		
	
		<p>
		Alamat : 
		<br>
		<input name="e_alamat" type="text" size="30" value="'.$ku_alamat.'" class="btn btn-warning">
		</p>
		<br>
		
		
		
		<p>
		<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
		</p>
	
	</div>

</div>

</form>

<hr>';





require("../template_bawah.php");



//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>