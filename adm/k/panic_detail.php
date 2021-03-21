<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
		

nocache;

//nilai
$filenya = "panic_detail.php";
$judul = "DETAIL KORBAN";
$judulku = "[PANIC BUTTON] $judul";
$judulx = $judul;
$panickd = nosql($_REQUEST['panickd']);
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnKIRIM'])
	{
	$panickd = cegah($_POST['panickd']);
	$e_satgas = cegah($_POST['e_satgas']);
	$e_kategori = cegah($_POST['e_kategori']);



	//detail orangnya
	$qmboh3 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$e_satgas'");
	$rmboh3 = mysqli_fetch_assoc($qmboh3);
	$mb3_kd = nosql($rmboh3['kd']);
	$mb3_nip = cegah($rmboh3['nip']);
	$mb3_nama = cegah($rmboh3['nama']);
	$mb3_tipe = cegah($rmboh3['tipe_user']);
	$mb3_kontak = cegah($rmboh3['telp']);
	$mb3_lat_x = balikin($rmboh3['lat_x']);
	$mb3_lat_y = balikin($rmboh3['lat_y']);
	$mb3_alamat = cegah($rmboh3['lat_alamat']);
		




	//masukin database
	$qmboh = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
										"WHERE kd = '$panickd'");
	$rmboh = mysqli_fetch_assoc($qmboh);
	$mb_kd = nosql($rmboh['kd']);
	$mb_ukd = cegah($rmboh['umum_kd']);
	$mb_ukode = cegah($rmboh['umum_kode']);
	$mb_unama = cegah($rmboh['umum_nama']);
	$mb_utipe = cegah($rmboh['umum_tipe_user']);
	$mb_lat_x = balikin($rmboh['lat_x']);
	$mb_lat_y = balikin($rmboh['lat_y']);
	$mb_lat_alamat = cegah($rmboh['lat_alamat']);
	$mb_postdate = balikin($rmboh['postdate']);
	


	$xyz = "$panickd$today";

	//masukin database
	mysqli_query($koneksi, "INSERT INTO umum_sesi_penolong (kd, panic_kd, penolong_kd, penolong_kode, ".
								"penolong_nama, penolong_tipe, penolong_lat_x, ".
								"penolong_lat_y, penolong_alamat, ".
								"korban_kd, korban_kode, korban_nama, korban_tipe, ".
								"kategori, alamat, lat_x, lat_y, ".
								"tugaskan, tugaskan_postdate, postdate) VALUES ".
								"('$xyz', '$mb_kd', '$e_satgas', '$mb3_nip', ".
								"'$mb3_nama', '$mb3_tipe', '$mb3_lat_x', ".
								"'$mb3_lat_y', '$mb3_alamat', ".
								"'$mb_ukd', '$mb_ukode', '$mb_unama', '$mb_utipe', ".
								"'$e_kategori', '$mb_lat_alamat', '$mb_lat_x', '$mb_lat_y', ".
								"'true', '$today', '$today')");



	//re-direct
	$ke = "$filenya?panickd=$panickd#satgasku";
	xloc($ke);
	exit();
	}





//jika prankan
if ($s == "prankan")
	{
	//update
	mysqli_query($koneksi, "UPDATE umum_sesi_panic SET prank_ket = 'PRANK', ".
								"prank_postdate = '$today' ".
								"WHERE kd = '$panickd'");
								
								
	//re-direct
	$ke = "history_panic_button_korban.php";
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////












require("../template_atas.php");


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//detail rincian
$qku = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
								"WHERE kd = '$panickd'");
$rku = mysqli_fetch_assoc($qku);
$ku_postdate = balikin($rku['postdate']);
$ku_umum_kd = balikin($rku['umum_kd']);
$ku_umum_kode = balikin($rku['umum_kode']);
$ku_umum_nama = balikin($rku['umum_nama']);
$ku_umum_tipe_user = balikin($rku['umum_tipe_user']);

$ku_lat_x = balikin($rku['lat_x']);
$ku_lat_y = balikin($rku['lat_y']);
$ku_lat_alamat = balikin($rku['lat_alamat']);

$ku_kategori = balikin($rku['kategori_masalah']);
$ku_kecamatan = balikin($rku['kecamatan']);


$ku_prank_ket = balikin($rku['prank_ket']);
$ku_prank_postdate = balikin($rku['prank_postdate']);






echo '<a href="history_panic_button_korban.php" class="btn btn-danger"><< DAFTAR LAINNYA</a>
<hr>
<div class="row">
	
	<div class="col-md-5">
		
		<p>
		Waktu Kejadian :
		<br>
		<b>'.$ku_postdate.'</b>
		</p>
		<br>	
		
		<p>
		Korban :
		<br>
		<b>'.$ku_umum_kode.'. '.$ku_umum_nama.'
		<br>
		['.$ku_umum_tipe_user.']</b>
		</p>
		<br>	
		
		<p>
		GPS :
		<br>
		<b>
		'.$ku_lat_x.', '.$ku_lat_y.'
		<br>
		'.$ku_lat_alamat.'
		</b>  
		</p>
		
		
	</div>


	<div class="col-md-7">';

	?>
		
				<h3 align="center">VIDEO KEJADIAN</h3>
			<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />

					<video
					    id="my-video"
					    autoplay= "play" 
					    class="video-js vjs-default-skin" 
					    style="width:100%;height:300px; position: relative;background:black" 
					    controls
					    preload="auto"
					    data-setup="{}"
					    id="the_id_of_your_video_here">
					  
					  
					  <source src="http://satgascovid19.kendalkab.go.id/img/opening.mp4" type="video/mp4" />
					  	
					  Your browser does not support HTML video.
					</video>
					


			  <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>



	<?php
	echo '</div>

	
</div>';





//deteksi, jika prank
if (!empty($ku_prank_ket))
	{
	echo '<div class="row">
		
		<div class="col-md-12">
		
			<font color=red>
				<h3>PRANK/FAKE</h3>
				SET POSTDATE : '.$ku_prank_postdate.'
			</font>
			<br>
			
		</div>
	</div>';
	}

else
	{
	echo '<div class="row">
		
		<div class="col-md-12">
		
			<hr>
			PRANK/FAKE..?
			<br>
			
			<a href="'.$filenya.'?s=prankan&panickd='.$panickd.'" class="btn btn-danger">SET PRANK/FAKE >></a>
			<br>
			<hr>
			<br>
		</div>
	</div>
	


	<a name="satgasku"></a>
	<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">
	
	<div class="row">
	
		<div class="col-md-12">
		
			<p>
			Penugasan SATGAS :
			<br>
			
			
				<select name="e_satgas" id="e_satgas" class="btn btn-warning" required>
				<option value="" selected></option>';
				
				//list
				$qku = mysqli_query($koneksi, "SELECT * FROM m_orang ".
												"WHERE tipe_user <> 'Masyarakat' ".
												"ORDER BY nama ASC");
				$rku = mysqli_fetch_assoc($qku);
				
				do
					{
					//nilai
					$ku_kd = cegah($rku['kd']);
					$ku_nip = balikin($rku['nip']);
					$ku_nama = balikin($rku['nama']);
					$ku_tipe_user = balikin($rku['tipe_user']);
					
					
					echo '<option value="'.$ku_kd.'">'.$ku_nama.' ['.$ku_nip.']. ['.$ku_tipe_user.']</option>';
					}
				while ($rku = mysqli_fetch_assoc($qku));
				
				
				echo '</select>
			
			</p>
			<br>
			
			<p>
			Kategori Masalah : 
			<br>
			
			<select name="e_kategori" id="e_kategori" class="btn btn-warning" required>
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
			<br>
			
			
			<p>
			<input name="panickd" type="hidden" value="'.$panickd.'">
			<input name="btnKIRIM" type="submit" value="KIRIM >>" class="btn btn-danger">
			</p>
	
	
		</div>
	</div>
	
	
	</form>';
	?> 
		 
				
	<script>
	$(document).ready(function() {
	  		
		$.noConflict();
	    
	});
	</script>
	  
	
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	
	
	
	<!-- Datatable CSS -->
	<link href='../../template/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>
	
	<!-- jQuery Library -->
	<script src="../../template/js/jquery-3.3.1.min.js"></script>
	
	<!-- Datatable JS -->
	<script src="../../template/DataTables/datatables.min.js"></script>
	
	
	<?php
	echo '<form action="'.$filenya.'" method="post" name="formx">
	
		<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
		<thead>
	        <tr valign="top" bgcolor="'.$warnaheader.'">
					<td><strong><font color="'.$warnatext.'">POSTDATE_PENUGASAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">NIK</font></strong></td>
					<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
					<td><strong><font color="'.$warnatext.'">TIPE_USER</font></strong></td>
					<td><strong><font color="'.$warnatext.'">KATEGORI_MASALAH</font></strong></td>
					<td><strong><font color="'.$warnatext.'">POSTDATE_PROSES</font></strong></td>
					<td><strong><font color="'.$warnatext.'">POSTDATE_SELESAI</font></strong></td>
					<td><strong><font color="'.$warnatext.'">DAMPAK_KORBAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">DAMPAK_KERUGIAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">KRONOLOGI</font></strong></td>
					<td><strong><font color="'.$warnatext.'">UPAYA_DILAKUKAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">KENDALA</font></strong></td>
	        </tr>
	        </thead>
	
	
	
			<tfoot>
	            <tr valign="top" bgcolor="'.$warnaheader.'">
					<td><strong><font color="'.$warnatext.'">POSTDATE_PENUGASAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">NIK</font></strong></td>
					<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
					<td><strong><font color="'.$warnatext.'">TIPE_USER</font></strong></td>
					<td><strong><font color="'.$warnatext.'">KATEGORI_MASALAH</font></strong></td>
					<td><strong><font color="'.$warnatext.'">POSTDATE_PROSES</font></strong></td>
					<td><strong><font color="'.$warnatext.'">POSTDATE_SELESAI</font></strong></td>
					<td><strong><font color="'.$warnatext.'">DAMPAK_KORBAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">DAMPAK_KERUGIAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">KRONOLOGI</font></strong></td>
					<td><strong><font color="'.$warnatext.'">UPAYA_DILAKUKAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">KENDALA</font></strong></td>
	            </tr>
			</tfoot>
	
	    </table>
	</form>';
	?>
	
	
	<script>
	$(document).ready(function(){
	
	
	    var table = $('#empTable').DataTable({
			"scrollY": "100%",
			"scrollX": true,
			"lengthChange": false, 
			"pageLength": 1, 
			"language": {
						"url": "../Indonesian.json",
						"sEmptyTable": "Tidak ada data di database"
					}, 
	        'processing': true,
	        'serverSide': true,
	        'serverMethod': 'post',
	        'ajax': {
	            'url':'i_panic_satgas_data.php?panickd=<?php echo $panickd;?>'
	        },
	        'columns': [
	            { data: 'tugaskan_postdate' },
	            { data: 'penolong_kode' },
	            { data: 'penolong_nama' },
	            { data: 'penolong_tipe' }, 
	            { data: 'kategori' },
	            { data: 'notif_postdate' }, 
	            { data: 'statusnya_postdate' },
	            { data: 'ket_dampak_korban' }, 
	            { data: 'ket_dampak_kerugian' },
	            { data: 'ket_kronologi' },
	            { data: 'ket_upaya_dilakukan' },
	            { data: 'ket_kendala' }
	        ]
	    });
	
	
	
	});
	
	
	
	
	
	
	
	
	</script>
	
	
		
	<?php
	}
?>



			
				
				<script>
				$(document).ready(function(){
				
				
				$.noConflict();
				
				
				
				
					$.ajax({
						url: "<?php echo $sumber;?>/adm/k/i_panic_video.php?panickd=<?php echo $panickd;?>&aksi=playernya",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){					
				
								var video =  document.getElementById("the_id_of_your_video_here");
								video.src = data;
								video.load();
				
							}
						});
				
				
					setInterval(poll,2000);
				
					function poll(){
				
						$.ajax({
							url: "<?php echo $sumber;?>/adm/k/i_panic_video.php?panickd=<?php echo $panickd;?>&aksi=playernya",
							type:$(this).attr("method"),
							data:$(this).serialize(),
							success:function(data){		
				
								    $('#my-video source').attr('src', data);
								    videojs("my-video", {}, function(){
								        this.load();
								    });
						
				
								}
							});
				
						}
				
				
				
				
				
				
				
				
							
				});
					
				</script>
				
	
	
	
<?php
require("../template_bawah.php");



//null-kan
xclose($koneksi);
exit();
?>