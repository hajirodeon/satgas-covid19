<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");



nocache;

//nilai
$filenya = "kasus.php";
$judul = "Data Kasus";
$judulku = "[PERILAKU] $judul";
$judulx = $judul;
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


$limit = 10000;

$diload = "initialize();";





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}





//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?kunci=$kunci";
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
//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT * FROM e_perilaku_masyarakat ".
				"ORDER BY postdate DESC";
	
$sqlresult = $sqlcount;

$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);





//terpilih
$qku = mysqli_query($koneksi, "SELECT * FROM a_profil");
$rku = mysqli_fetch_assoc($qku);
$ku_judul = balikin($rku['judul']);
$ku_isi = balikin($rku['isi']);
$ku_web = balikin($rku['web']);
$ku_email = balikin($rku['email']);
$ku_alamat = balikin($rku['alamat']);
$ku_alamat2 = balikin($rku['alamat_googlemap']);
$ku_telp = balikin($rku['telp']);
$ku_fax = balikin($rku['fax']);
$ku_fb = balikin($rku['fb']);
$ku_twitter = balikin($rku['twitter']);
$ku_youtube = balikin($rku['youtube']);
$ku_wa = balikin($rku['wa']);
$ku_instagram = balikin($rku['instagram']);
$ku_latx = balikin($rku['lat_x']);
$ku_laty = balikin($rku['lat_y']);



$datax_lat = $ku_laty;
$datax_long = $ku_latx; 

?>








<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> 
<script type="text/javascript" src = "http://maps.google.com/maps/api/js?sensor=false&key=<?php echo $keyku;?>"></script>

</script>
<script type="text/javascript">
function initialize() {

var mapOptions = {
center: new google.maps.LatLng(<?php echo $datax_long;?>, <?php echo $datax_lat;?>),
zoom: 16,
mapTypeId: google.maps.MapTypeId.ROADMAP
};

var infoWindow = new google.maps.InfoWindow();
var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);





// execute once
pentol();

// set update
setInterval(pentol, 15000);
   
   
function pentol() 
	{

	  $.getJSON('i_lap_kasus_display.php', function(data) { 
	            $.each( data.points, function(i, value) {
	
	                var myLatlng = new google.maps.LatLng(value.lat, value.lon);
	                //alert(myLatlng);
	                var marker = new google.maps.Marker({
	                position: myLatlng,
	                map: map,
	                title: "NO : "+value.nama
	                });
	
	            });
		});
	}






}

</script>




<div id="map_canvas" style="width: 100%; height: 500px"></div>


	
<script>
$(document).ready(function() {
  		
	$.noConflict();
    
});
</script>
  



<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">


    
    








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
echo '<br>
<br>
<form action="'.$filenya.'" method="post" name="formx">

<table id="example" class="table table-striped table-bordered row-border hover order-column" style="width:100%">
<thead>

<tr valign="top" bgcolor="'.$warnaheader.'">
<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">FOTO_KEJADIAN</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
<td width="350"><strong><font color="'.$warnatext.'">NAMA_LOKASI/INSTANSI</font></strong></td>
<td width="350"><strong><font color="'.$warnatext.'">KOTA</font></strong></td>
<td width="350"><strong><font color="'.$warnatext.'">KECAMATAN</font></strong></td>
<td width="350"><strong><font color="'.$warnatext.'">KELURAHAN</font></strong></td>
<td width="350"><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">TEMPAT</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">JUMLAH_ORANG</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">MASKER_PAKAI</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">MASKER_TIDAK_PAKAI</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">JAGA_JARAK</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">JAGA_JARAK_TIDAK</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">INGATKAN</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">INGATKAN_TIDAK</font></strong></td>
<td width="250"><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></td>
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
		$i_nama_lokasi = balikin($data['nama_lokasi']);
		$i_kategori = balikin($data['kategori']);
		$i_ket = balikin($data['keterangan']);
		$i_kota = balikin($data['kota']);
		$i_kec = balikin($data['kecamatan']);
		$i_kelurahan = balikin($data['kelurahan']);
		$i_alamat = balikin($data['alamat']);
		$i_kategori_tempat = balikin($data['kategori_tempat']);
		$i_tipe_laporan = balikin($data['tipe_laporan']);
		$i_jml_orang = balikin($data['jumlah_orang']);
		$i_jml_masker_pake = balikin($data['jml_masker_pake']);
		$i_jml_masker_tidak_pake = balikin($data['jml_masker_tidak_pake']);
		$i_jml_jaga_jarak = balikin($data['jml_jaga_jarak']);
		$i_jml_jaga_jarak_tidak = balikin($data['jml_jaga_jarak_tidak']);
		$i_jml_ingatkan = balikin($data['jml_ingatkan']);
		$i_jml_ingatkan_tidak = balikin($data['jml_ingatkan_tidak']);
		$i_lat_x = balikin($data['lat_x']);
		$i_lat_y = balikin($data['lat_y']);
		$i_k_nik = balikin($data['kontributor_nik']);
		$i_k_nama = balikin($data['kontributor_nama']);
		$i_k_kontak = balikin($data['kontributor_kontak']);
		$i_k_ket = balikin($data['kontributor_ket']);
		$i_postdate = balikin($data['postdate']);
		
			
		$nil_foto1 = "$sumber/filebox/perilaku/$i_kd/$i_kd-1.jpg";


		
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$i_postdate.'</td>
		<td>
		<img src="'.$nil_foto1.'" width="150">
		</td>
		<td>'.$i_ket.'</td>
		<td>'.$i_nama_lokasi.'</td>
		<td>'.$i_kota.'</td>
		<td>'.$i_kec.'</td>
		<td>'.$i_kelurahan.'</td>

		<td>
		'.$i_alamat.' 
		<br>
		'.$i_lat_x.', '.$i_lat_y.'
		</td>
		
		
		<td>'.$i_kategori_tempat.'</td>
		<td>'.$i_tipe_laporan.'</td>
		<td>'.$i_jml_orang.'</td>
		<td>'.$i_jml_masker_pake.'</td>
		<td>'.$i_jml_masker_tidak_pake.'</td>
		<td>'.$i_jml_jaga_jarak.'</td>
		<td>'.$i_jml_jaga_jarak_tidak.'</td>
		<td>'.$i_jml_ingatkan.'</td>
		<td>'.$i_jml_ingatkan_tidak.'</td>
		<td>
		'.$i_k_nik.'. '.$i_k_nama.'. ['.$i_k_kontak.']. ['.$i_k_ket.'].   
		</td>

        </tr>';
		}
	while ($data = mysqli_fetch_assoc($result));
	}


echo '</tbody>

	<tfoot>

		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">FOTO_KEJADIAN</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
		<td width="350"><strong><font color="'.$warnatext.'">NAMA_LOKASI/INSTANSI</font></strong></td>
		<td width="350"><strong><font color="'.$warnatext.'">KOTA</font></strong></td>
		<td width="350"><strong><font color="'.$warnatext.'">KECAMATAN</font></strong></td>
		<td width="350"><strong><font color="'.$warnatext.'">KELURAHAN</font></strong></td>
		<td width="350"><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">TEMPAT</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">JUMLAH_ORANG</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">MASKER_PAKAI</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">MASKER_TIDAK_PAKAI</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">JAGA_JARAK</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">JAGA_JARAK_TIDAK</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">INGATKAN</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">INGATKAN_TIDAK</font></strong></td>
		<td width="250"><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></td>
		</tr>

	</tfoot>

  </table>




<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
<input name="jml" type="hidden" value="'.$count.'">
<input name="s" type="hidden" value="'.$s.'">
<input name="kd" type="hidden" value="'.$kdx.'">
<input name="page" type="hidden" value="'.$page.'">
</td>
</tr>
</table>
</form>';




require("../template_bawah.php");


//null-kan
xclose($koneksi);
exit();
?>