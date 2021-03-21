<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");


nocache;

//nilai
$filenya = "panggil_satgas.php";
$judul = "[PERILAKU] Panggil Satgas";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$pkd = nosql($_REQUEST['pkd']);
$kd = nosql($_REQUEST['kd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


$limit = 100;




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	$ke = "history_perilaku_masyarakat.php";
	xloc($ke);
	exit();
	}





/*
//jika simpan
if ($_POST['btnKRM'])
	{
	//ambil nilai
	$pkd = nosql($_POST['pkd']);
	$jml = nosql($_POST['jml']);
	$ke = $filenya;

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		
		//update, tugaskan
		mysqli_query($koneksi, "UPDATE perilaku_satgas SET tugaskan = 'true', ".
								"tugaskan_postdate = '$today' ".
								"WHERE perilaku_kd = '$pkd' ".
								"AND kd = '$kd'");
		}




	//re-direct
	$ke = "history_perilaku_masyarakat.php";
	$pesan = "Informasi Berhasil Diteruskan Kepada SATGAS Terdekat.";
	pekem($pesan,$ke);
	exit();
	}
	
	
	
	

//jika tambahkan
if ($_POST['btnTBH'])
	{
	//ambil nilai
	$pkd = nosql($_POST['pkd']);
	$nilkd = nosql($_POST['enilkd']);


	//detail orangnya
	$qmboh = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$nilkd'");
	$rmboh = mysqli_fetch_assoc($qmboh);
	$mb_kd = nosql($rmboh['kd']);
	$mb_nip = cegah($rmboh['nip']);
	$mb_nama = cegah($rmboh['nama']);
	$mb_tipe = cegah($rmboh['tipe_user']);
	$mb_kontak = cegah($rmboh['telp']);
	$xyz = "$mb_kd$pkd";


	//ketahui lokasi terakhir
	$qmboh2 = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
										"WHERE orang_kd = '$mb_kd' ".
										"AND lat_x <> '' ".
										"ORDER BY postdate DESC");
	$rmboh2 = mysqli_fetch_assoc($qmboh2);
	$tmboh2 = mysqli_num_rows($qmboh2);
	$mb2_lat_x = balikin($rmboh2['lat_x']);
	$mb2_lat_y = balikin($rmboh2['lat_y']);
	$mb2_alamat = cegah($rmboh2['alamat']);
		

	//masukin database
	mysqli_query($koneksi, "INSERT INTO perilaku_satgas (kd, perilaku_kd, orang_kd, ".
								"orang_kode, orang_nama, orang_tipe, ".
								"orang_kontak, lat_x, lat_y, ".
								"orang_alamat_googlemap, postdate) VALUES ".
								"('$xyz', '$pkd', '$mb_kd', ".
								"'$mb_nip', '$mb_nama', '$mb_tipe', ".
								"'$mb_kontak', '$mb2_lat_x', '$mb2_lat_y', ".
								"'$mb2_alamat', '$today');");
	 

	//re-direct
	$ke = "$filenya?pkd=$pkd#etambahku";
	xloc($ke);
	exit();
	}
 */

 
$pkd = nosql($_REQUEST['pkd']);
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnKIRIM'])
	{
	$pkd = cegah($_POST['pkd']);
	$e_satgas = cegah($_POST['e_satgas']);




	//detail orangnya
	$qmboh = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$e_satgas'");
	$rmboh = mysqli_fetch_assoc($qmboh);
	$mb_kd = nosql($rmboh['kd']);
	$mb_nip = cegah($rmboh['nip']);
	$mb_nama = cegah($rmboh['nama']);
	$mb_tipe = cegah($rmboh['tipe_user']);
	$mb_kontak = cegah($rmboh['telp']);
	$xyz = "$mb_kd$pkd";


	$mb2_lat_x = balikin($rmboh['lat_x']);
	$mb2_lat_y = balikin($rmboh['lat_y']);
	$mb2_alamat = cegah($rmboh['lat_alamat']);





	//detail perilaku
	$qx = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
						"WHERE kd = '$pkd'");
	$rowx = mysqli_fetch_assoc($qx);
	$i_nama_lokasi = cegah($rowx['nama_lokasi']);
	$i_kategori_tempat = cegah($rowx['kategori_tempat']);
	$i_tipe_laporan = cegah($rowx['tipe_laporan']);
	$i_alamat_googlemap = cegah($rowx['alamat_googlemap']);
		

	//masukin database
	mysqli_query($koneksi, "INSERT INTO perilaku_satgas (kd, perilaku_kd, perilaku_nama_lokasi, ".
								"perilaku_kategori_tempat, perilaku_tipe_laporan, ".
								"perilaku_alamat_googlemap, perilaku_kontributor, ".
								"orang_kd, orang_kode, orang_nama, orang_tipe, ".
								"orang_kontak, tugaskan, tugaskan_postdate, lat_x, lat_y, ".
								"orang_alamat_googlemap, postdate) VALUES ".
								"('$xyz', '$pkd', '$i_nama_lokasi', ".
								"'$i_kategori_tempat', '$i_tipe_laporan', ".
								"'$i_alamat_googlemap', '$i_perilaku_kontributor', ".
								"'$mb_kd', '$mb_nip', '$mb_nama', '$mb_tipe', ".
								"'$mb_kontak', 'true', '$today', '$mb2_lat_x', '$mb2_lat_y', ".
								"'$mb2_alamat', '$today');");




	//re-direct
	$ke = "$filenya?pkd=$pkd#satgasku";
	xloc($ke);
	exit();
	}





//jika prankan
if ($s == "prankan")
	{
	//update
	mysqli_query($koneksi, "UPDATE e_perilaku_masyarakat SET prank_ket = 'PRANK', ".
								"prank_postdate = '$today' ".
								"WHERE kd = '$pkd'");
								
								
	//re-direct
	$ke = "history_perilaku_masyarakat.php";
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
//detail
$qx = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
					"WHERE kd = '$pkd'");
$rowx = mysqli_fetch_assoc($qx);
$i_kd = balikin($rowx['kd']);
$i_nama_lokasi = balikin($rowx['nama_lokasi']);
$i_kategori = balikin($rowx['kategori']);
$i_ket = balikin($rowx['keterangan']);
$i_kota = balikin($rowx['kota']);
$i_kec = balikin($rowx['kecamatan']);
$i_kelurahan = balikin($rowx['kelurahan']);
$i_alamat = balikin($rowx['alamat']);
$i_alamat_googlemap = balikin($rowx['alamat_googlemap']);
$i_kategori_tempat = balikin($rowx['kategori_tempat']);
$i_tipe_laporan = balikin($rowx['tipe_laporan']);
$i_jml_orang = balikin($rowx['jumlah_orang']);
$i_jml_masker_pake = balikin($rowx['jml_masker_pake']);
$i_jml_masker_tidak_pake = balikin($rowx['jml_masker_tidak_pake']);
$i_jml_jaga_jarak = balikin($rowx['jml_jaga_jarak']);
$i_jml_jaga_jarak_tidak = balikin($rowx['jml_jaga_jarak_tidak']);
$i_jml_ingatkan = balikin($rowx['jml_ingatkan']);
$i_jml_ingatkan_tidak = balikin($rowx['jml_ingatkan_tidak']);
$i_lat_x = balikin($rowx['lat_x']);
$i_lat_y = balikin($rowx['lat_y']);
$i_k_kd = balikin($rowx['kontributor_kd']);
$i_k_nik = balikin($rowx['kontributor_nik']);
$i_k_nama = balikin($rowx['kontributor_nama']);
$i_k_kontak = balikin($rowx['kontributor_kontak']);
$i_k_tipe = balikin($rowx['kontributor_tipe']);
$i_k_ket = balikin($rowx['kontributor_ket']);
$i_postdate = balikin($rowx['postdate']);



$nil_foto1 = "$sumber/filebox/perilaku/$i_kd/$i_kd-1.jpg";




/*
//mencari satgas terdekat... 5km -> meter
$target_radius = "5000";//meter




//fungsi hitung jarak
function getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Km') 
	{ 
	$theta = $longitude1 - $longitude2; 
	$distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
	$distance = acos($distance); 
	$distance = rad2deg($distance); 
	$distance = $distance * 60 * 1.1515; 
	switch($unit) 
		{ 
		case 'Mi': break; 
		case 'Km' : $distance = $distance * 1.609344; 
		} 
	return (round($distance,2)); 
	}
		


//hitung jaraknya //////////////////////////////////////////////////////////////////////////
$ku_lat_x = $i_lat_x;
$ku_lat_y = $i_lat_y;
$awal_x = $ku_lat_x;
$awal_y = $ku_lat_y;



//baca table user, selain dirinya... . sekitar seratus seratus orang
$qmboh = mysqli_query($koneksi, "SELECT * FROM m_orang ".
									"WHERE kd <> '$i_k_kd' ".
									"ORDER BY nama ASC LIMIT 0,100");
$rmboh = mysqli_fetch_assoc($qmboh);

do
	{
	//nilai
	$mb_kd = nosql($rmboh['kd']);
	$mb_nip = cegah($rmboh['nip']);
	$mb_nama = cegah($rmboh['nama']);
	$mb_tipe = cegah($rmboh['tipe_user']);
	$mb_kontak = cegah($rmboh['telp']);
		
	
	$xyz = "$mb_kd$pkd";
	
	//ketahui lokasi terakhir
	$qmboh2 = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
										"WHERE orang_kd = '$mb_kd' ".
										"AND lat_x <> '' ".
										"ORDER BY postdate DESC");
	$rmboh2 = mysqli_fetch_assoc($qmboh2);
	$tmboh2 = mysqli_num_rows($qmboh2);
	
	//jika ada
	if (!empty($tmboh2))
		{
		$mb2_lat_x = balikin($rmboh2['lat_x']);
		$mb2_lat_y = balikin($rmboh2['lat_y']);
		$mb2_alamat = cegah($rmboh2['alamat']);
			
		$akhir_x = $mb2_lat_x;
		$akhir_y = $mb2_lat_y;
		
		
		
		//jaraknya		
		$jaraku = getDistanceBetween($awal_x, $awal_y, $akhir_x, $akhir_y);
		
		//jadikan mater
		$jarake = $jaraku * 1000;
		
		
		
		//jika dalam radius
		if ($target_radius >= $jarake)
			{
			//masukin database
			mysqli_query($koneksi, "INSERT INTO perilaku_satgas (kd, perilaku_kd, orang_kd, ".
										"orang_kode, orang_nama, orang_tipe, ".
										"orang_kontak, lat_x, lat_y, ".
										"orang_alamat_googlemap, postdate) VALUES ".
										"('$xyz', '$pkd', '$mb_kd', ".
										"'$mb_nip', '$mb_nama', '$mb_tipe', ".
										"'$mb_kontak', '$mb2_lat_x', '$mb2_lat_y', ".
										"'$mb2_alamat', '$today');");
			 
			//masukin ke table		
			}
		else 
			{
			//cuekin aja...
			//echo "[diluar area]";
			}
			
		//echo "<br>";
		}
	
		 
	}
while ($rmboh = mysqli_fetch_assoc($qmboh));
*/




















//jika null, kasi update
if (empty($i_k_tipe))
	{
	//query
	$qkuy = mysqli_query($koneksi, "SELECT * FROM m_orang ".
								"WHERE kd = '$i_k_kd'");
	$rkuy = mysqli_fetch_assoc($qkuy);
	$i_k_tipe = balikin($rkuy['tipe_user']);
	$i_k_tipe2 = balikin($rkuy['tipe_user']);
	
	
	//update	
	mysqli_query($koneksi, "UPDATE e_perilaku_masyarakat SET kontributor_tipe = '$i_k_tipe2' ".
								"WHERE kd = '$pkd'");
	}






echo '<a href="history_perilaku_masyarakat.php" class="btn btn-danger"><< DAFTAR LAINNYA</a>
<hr>

<form action="'.$filenya.'" method="post" name="formx2">

	<div class="row">

	<div class="col-md-4">
	

	<p>
		Nama Lokasi/Instansi : 
		<br>
		<b>'.$i_nama_lokasi.'</b>
	</p>
	<br>
	
	
	<p>
		Alamat : 
		<br>
		<b>'.$i_alamat.', Kelurahan '.$i_kelurahan.', Kecamatan '.$i_kec.', Kabupaten '.$i_kota.'</b>
	</p>
	<br>

	
	
	<p>
	Kategori Tempat : 
	<br>
				
	<b>'.$i_kategori_tempat.'</b>
	</p>
	<br>


	<p>
	Tipe Laporan : 
	<br>
	<b>'.$i_tipe_laporan.'</b>
	</p>
	<br>

	
	<p>
		Jumlah Orang : 
		<br>
		<b>'.$i_jml_orang.'</b>
	</p>
	<br>


	
	<p>
		Jumlah Memakai Masker : 
		<br>
		<b>'.$i_jml_masker_pake.'</b>
	</p>
	<br>
	
	<p>
		Jumlah Tidak Memakai Masker : 
		<br>
		<b>'.$i_jml_masker_tidak_pake.'</b>
	</p>
	<br>

	<p>
		Jumlah Jaga Jarak : 
		<br>
		<b>'.$i_jml_jaga_jarak.'</b>
	</p>
	<br>
	
	<p>
		Jumlah Tidak Jaga Jarak : 
		<br>
		<b>'.$i_jml_jaga_jarak.'</b>
	</p>
	<br>


	<p>
		Jumlah Diingatkan : 
		<br>
		<b>'.$i_jml_ingatkan.'</b>
	</p>
	<br>
	
	<p>
		Jumlah Tidak Diingatkan : 
		<br>
		<b>'.$i_jml_ingatkan_tidak.'</b>
	</p>
	<br>



	<p>
		Keterangan : 
		<br>
		<b>'.$i_ket.'</b>
	</p>
	<br>
	

	
	<p>
	POSTDATE LAPORAN :
	<br>
	<b>'.$i_postdate.'</b>
	</p>
	<br>
	
	<p>
	Oleh Kontributor :
	<br>
	<b>['.$i_k_nik.'. '.$i_k_nama.']. ['.$i_k_tipe.']. '.$i_k_kontak.'</b>
	</p>
	<br>
	
	</div>


	<div class="col-md-8">


		<img src="'.$nil_foto1.'" width="100%" height="100%">

	</div>


</div>




<div class="row">

	<div class="col-md-12">

	<hr>
	
	</div>

</div>



<div class="row">

	<div class="col-md-12">
		<p>
		Alamat Google MAP : 
		<br>
		<b>'.$i_lat_x.', '.$i_lat_y.'</b>
		<br>
		<b>'.$i_alamat_googlemap.'</b>
		<br>';
		?>
		
		
		
		
		

		

			<!-- jQuery -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
			 
			<!-- jQuery UI -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
			 
			<!-- Bootstrap CSS -->
			<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">




			<script src="//code.jquery.com/jquery-1.10.2.js"></script>


			<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
			    <script
			      src="https://maps.googleapis.com/maps/api/js?key=<?php echo $keyku;?>&callback=initMap&libraries=&v=weekly"
			      defer
			    ></script>


			
			<style type="text/css">
				#map_canvas 
				{ 
					height:300px; width:100%; 
				}
			</style>
			



			
			<script>
		      function initMap() {
		        const myLatLng = { lat: <?php echo $i_lat_x;?>, lng: <?php echo $i_lat_y;?> };
		        const map = new google.maps.Map(document.getElementById("map_canvas"), {
		          zoom: 18,
		          center: myLatLng,
		        });
		        new google.maps.Marker({
		          position: myLatLng,
		          map,
		          title: "TKP",
		        });
		      }
		    </script>
		



			
			 
			<script type="text/javascript">
			  $(function() {
			  	
			  	$.noConflict();

			     $( "#kunci" ).autocomplete({
			       source: 'i_cari_nama.php',
			       minLength: 3,
			       select: function (event, ui) {
					   // Set selection
					   $('#kunci').val(ui.item.label); 
					   $('#enilkd').val(ui.item.value1);
					   return false;
					  }
			     });
			
			    
			  });

			</script>




		
  			<div id="map_canvas"></div>


		
		
		<?php
		echo '</p>

	</div>

</div>

<hr>';
?>



		



<?php
/*
echo '<div class="row">

	<div class="col-md-12">
	<h3>
	PANGGIL SATGAS :
	</h3>
	
	<a name="etambahku"></a>
	<p>
	
	
				
	<input type="text" name="kunci" id="kunci" class="btn btn-default" placeholder="Cari Nama User" required>
	<input type="hidden" name="elatku" id="elatku">
	<input type="hidden" name="elatx" id="elatx">
	<input type="hidden" name="elaty" id="elaty">
	<input type="hidden" name="enilkd" id="enilkd">
	<input name="pkd" type="hidden" value="'.$pkd.'">
	
	<input name="btnTBH" type="submit" value="TAMBAHKAN >>" class="btn btn-danger">
	
	</form>';



	//list satgas
	$p = new Pager();
	$start = $p->findStart($limit);
	
	$sqlcount = "SELECT * FROM perilaku_satgas ".
					"WHERE perilaku_kd = '$pkd' ".
					"AND tugaskan = 'false' ".
					"ORDER BY orang_tipe ASC, ".
					"orang_nama ASC";
		
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);
	
	
	//require
	require("../../template/js/jumpmenu.js");
	require("../../template/js/checkall.js");
	require("../../template/js/swap.js");
	
	

	?>
	
	

	
	
	
	
	
	<style>
	table{
	    width:100%;
	}
	
	
	td.highlight {
	    background-color: whitesmoke !important;
	}
	</style>
	
	
	<script>
	
	$(document).ready(function() {
	
	$.noConflict();
			 
	    $('#example').DataTable( {
	        "scrollY": "100%",
	        "scrollX": true, 
			"language": {
						"url": "../Indonesian.json",
						"sEmptyTable": "Tidak ada data di database"
					}
	    } );
	    
	    
	    var table = $('#example').DataTable();
	     
	    $('#example tbody')
	        .on( 'mouseenter', 'td', function () {
	            var colIdx = table.cell(this).index().column;
	 
	            $( table.cells().nodes() ).removeClass( 'highlight' );
	            $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
	        } );
	
	
	
	} );
	
	
	
	</script>
	
	
	
	
	<?php
	echo '<form action="'.$filenya.'" method="post" name="formx3">
	
	<table id="example" class="table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="50"><strong><font color="'.$warnatext.'"></font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">TIPE_USER</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">FOTO</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">KONTAK</font></strong></td>
	<td><strong><font color="'.$warnatext.'">GPS</font></strong></td>
	</tr>
	</thead>
	<tbody>';
	
	if (!empty($count))
		{
		do 
			{
			if ($warna_set ==0)
				{
				$warna = $warna01;
				$warna_set = 1;
				}
			else
				{
				$warna = $warna02;
				$warna_set = 0;
				}
	
			$nomer = $nomer + 1;
			$i_kd = nosql($data['kd']);
			$i_orang_kd = balikin($data['orang_kd']);
			$i_orang_kode = balikin($data['orang_kode']);
			$i_orang_nama = balikin($data['orang_nama']);
			$i_orang_tipe = balikin($data['orang_tipe']);
			$i_orang_kontak = balikin($data['orang_kontak']);
	
	
			$markerku = "../../filebox/pegawai/$i_orang_kd/$i_orang_kode-1.jpg";
			
			
			
			
			//detail gps terakhir..
			$qku = mysqli_query($koneksi, "SELECT * FROM orang_lokasi ".
											"WHERE orang_kd = '$i_orang_kd' ".
											"ORDER BY postdate DESC LIMIT 0,1");
			$rku = mysqli_fetch_assoc($qku);
			$e_alamat = balikin($rku['alamat']);
			$e_lat_x = balikin($rku['lat_x']);
			$e_lat_y = balikin($rku['lat_y']);
			$e_ket = balikin($rku['status']);
			$e_postdate = balikin($rku['postdate']);
			
	
	
			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td><input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'" checked></td>
			<td>'.$i_orang_tipe.'</td>
			<td>
			<img src="'.$markerku.'" width="50" width="50">
			</td>
			<td>'.$i_orang_kode.'. '.$i_orang_nama.'</td>
			<td>'.$i_orang_kontak.'</td>
			<td>
			Online Terakhir : 
			<b>'.$e_postdate.'</b>
			<br>
			'.$e_lat_x.' , '.$e_lat_y.' 
			<br>
			'.$e_alamat.'
			</td>
			</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}
	
	
	echo '</tbody>
	
		<tfoot>
	
			<tr valign="top" bgcolor="'.$warnaheader.'">
				<td width="50"><strong><font color="'.$warnatext.'"></font></strong></td>
				<td width="50"><strong><font color="'.$warnatext.'">TIPE_USER</font></strong></td>
				<td width="50"><strong><font color="'.$warnatext.'">FOTO</font></strong></td>
				<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
				<td width="150"><strong><font color="'.$warnatext.'">KONTAK</font></strong></td>
				<td><strong><font color="'.$warnatext.'">GPS</font></strong></td>
			</tr>
	
		</tfoot>
	
	  </table>
	
	
	
	

	
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="jml" type="hidden" value="'.$count.'">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="pkd" type="hidden" value="'.$pkd.'">

	<input name="btnBTL" type="submit" value="BATAL" class="btn btn-success">
	<input name="btnKRM" type="submit" value="KIRIM FORWARD >>" class="btn btn-danger">
	</td>
	</tr>
	</table>';
	
	
	echo '</p>
	
	</div>
</div>
	
	


	
	
</form>';
 * 
 */

 
	echo '<div class="row">
		
		<div class="col-md-12">
		
			<hr>
			PRANK/FAKE..?
			<br>
			
			<a href="'.$filenya.'?s=prankan&pkd='.$pkd.'" class="btn btn-danger">SET PRANK/FAKE >></a>
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
			<input name="pkd" type="hidden" value="'.$pkd.'">
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
					<td><strong><font color="'.$warnatext.'">POSTDATE_PROSES</font></strong></td>
					<td><strong><font color="'.$warnatext.'">POSTDATE_SELESAI</font></strong></td>
					<td><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
	        </tr>
	        </thead>
	
	
	
			<tfoot>
	            <tr valign="top" bgcolor="'.$warnaheader.'">
					<td><strong><font color="'.$warnatext.'">POSTDATE_PENUGASAN</font></strong></td>
					<td><strong><font color="'.$warnatext.'">NIK</font></strong></td>
					<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
					<td><strong><font color="'.$warnatext.'">TIPE_USER</font></strong></td>
					<td><strong><font color="'.$warnatext.'">POSTDATE_PROSES</font></strong></td>
					<td><strong><font color="'.$warnatext.'">POSTDATE_SELESAI</font></strong></td>
					<td><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
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
	            'url':'i_perilaku_satgas_data.php?pkd=<?php echo $pkd;?>'
	        },
	        'columns': [
	            { data: 'tugaskan_postdate' },
	            { data: 'penolong_kode' },
	            { data: 'penolong_nama' },
	            { data: 'penolong_tipe' },
	            { data: 'notif_postdate' }, 
	            { data: 'statusnya_postdate' },
	            { data: 'ket' }
	        ]
	    });
	
	
	
	});
	
	
	
	
	
	
	
	
	</script>
	
	
 


<?php
require("../template_bawah.php");


//null-kan
xclose($koneksi);
exit();
?>