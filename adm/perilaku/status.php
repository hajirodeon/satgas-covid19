<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");


nocache;

//nilai
$filenya = "status.php";
$judul = "[PERILAKU] Status";
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







echo '<form action="'.$filenya.'" method="post" name="formx2">

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
		Alamat Google MAP : 
		<br>
		<b>'.$i_lat_x.', '.$i_lat_y.'</b>
		<br>
		<b>'.$i_alamat_googlemap.'</b>
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
	
	<h1>
	<b>SATGAS Yang Ditugaskan :</b>
	</h1>';

	//list satgas
	$p = new Pager();
	$start = $p->findStart($limit);
	
	$sqlcount = "SELECT * FROM perilaku_satgas ".
					"WHERE perilaku_kd = '$pkd' ".
					"AND tugaskan = 'true' ".
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
	echo '<table id="example" class="table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="50"><strong><font color="'.$warnatext.'">POSTDATE TUGAS</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">TIPE_USER</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">FOTO</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">KONTAK</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">POSTDATE LAPANGAN</font></strong></td>
	<td width="250"><strong><font color="'.$warnatext.'">AKSI LAPANGAN</font></strong></td>
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
			$i_tugaskan_postdate = balikin($data['tugaskan_postdate']);
	
	
			$i_aksi_postdate = balikin($data['aksi_postdate']);
			$i_aksi_ket = balikin($data['aksi_ket']);
	
			$markerku = "../../filebox/pegawai/$i_orang_kd/$i_orang_kode-1.jpg";
			
	
	
			
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$i_tugaskan_postdate.'</td>
			<td>'.$i_orang_tipe.'</td>
			<td>
			<img src="'.$markerku.'" width="50" width="50">
			</td>
			<td>'.$i_orang_kode.'. '.$i_orang_nama.'</td>
			<td>'.$i_orang_kontak.'</td>
			<td>'.$i_aksi_postdate.'</td>
			<td>'.$i_aksi_ket.'</td>
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
				<td width="50"><strong><font color="'.$warnatext.'">POSTDATE LAPANGAN</font></strong></td>
				<td width="250"><strong><font color="'.$warnatext.'">AKSI LAPANGAN</font></strong></td>
			</tr>
	
		</tfoot>
	
	  </table>
	
	
	
	

	
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="jml" type="hidden" value="'.$count.'">
	<input name="page" type="hidden" value="'.$page.'">
	<input name="pkd" type="hidden" value="'.$pkd.'">

	<input name="btnBTL" type="submit" value="<< LIHAT LAPORAN LAINNYA" class="btn btn-success">
	</td>
	</tr>
	</table>
	
	

	</div>
</div>
	
	


	
	
</form>
';



require("../template_bawah.php");


//null-kan
xclose($koneksi);
exit();
?>