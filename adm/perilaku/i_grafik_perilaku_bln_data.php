<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



//nilai
$ekat = cegah($_GET['ekat']);
$e_tgl1 = cegah($_GET['e_tgl1']);
$e_tgl2 = cegah($_GET['e_tgl2']);


//pecah tanggal
$tgl1_pecah = balikin($e_tgl1);
$tgl1_pecahku = explode("/", $tgl1_pecah);
$tgl1_bln = trim($tgl1_pecahku[0]);
$tgl1_thn = trim($tgl1_pecahku[1]);
$tgl1_postdate = "$tgl1_thn-$tgl1_bln-01";




//pecah tanggal
$tgl2_pecah = balikin($e_tgl2);
$tgl2_pecahku = explode("/", $tgl2_pecah);
$tgl2_bln = trim($tgl2_pecahku[0]);
$tgl2_thn = trim($tgl2_pecahku[1]);
$tgl2_postdate = "$tgl2_thn-$tgl2_bln-31";










## Read value
$draw = cegah($_POST['draw']);
$row = cegah($_POST['start']);
$rowperpage = cegah($_POST['length']); // Rows display per page
$columnIndex = cegah($_POST['order'][0]['column']); // Column index
$columnName = cegah($_POST['columns'][$columnIndex]['data']); // Column name
$columnSortOrder = cegah($_POST['order'][0]['dir']); // asc or desc
$searchValue = mysqli_real_escape_string($koneksi,cegah($_POST['search']['value'])); // Search value




## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (orang_kode like '%".$searchValue."%' or
		orang_nama like '%".$searchValue."%' or 
		orang_tipe like '%".$searchValue."%' or  
        orang_kontak '%".$searchValue."%' or 
        orang_alamat_googlemap like '%".$searchValue."%' or                                      
        postdate like'%".$searchValue."%' ) ";
}





//jika belum proses
if ($ekat == "pbp")
	{
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(DISTINCT(perilaku_satgas.perilaku_kd)) as allcount ".
									"from perilaku_satgas, e_perilaku_masyarakat ".
									"WHERE perilaku_satgas.perilaku_kd = e_perilaku_masyarakat.kd ".
									"AND perilaku_satgas.tugaskan = 'false' ".
									"AND perilaku_satgas.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(DISTINCT(perilaku_satgas.perilaku_kd)) as allcount ".
									"from perilaku_satgas, e_perilaku_masyarakat ".
									"WHERE perilaku_satgas.perilaku_kd = e_perilaku_masyarakat.kd ".
									"AND perilaku_satgas.tugaskan = 'false' ".
									"AND perilaku_satgas.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select DISTINCT(perilaku_satgas.perilaku_kd) AS kdku ".
					"from perilaku_satgas ".
					"WHERE perilaku_satgas.tugaskan = 'false' ".
					"AND postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
	$empRecords = mysqli_query($koneksi, $empQuery);
	}
	
//jika proses
else if ($ekat == "pp")
	{
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(DISTINCT(perilaku_satgas.perilaku_kd)) as allcount ".
									"from perilaku_satgas, e_perilaku_masyarakat ".
									"WHERE perilaku_satgas.perilaku_kd = e_perilaku_masyarakat.kd ".
									"AND perilaku_satgas.tugaskan = 'true' ".
									"AND perilaku_satgas.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(DISTINCT(perilaku_satgas.perilaku_kd)) as allcount ".
									"from perilaku_satgas, e_perilaku_masyarakat ".
									"WHERE perilaku_satgas.perilaku_kd = e_perilaku_masyarakat.kd ".
									"AND perilaku_satgas.tugaskan = 'true' ".
									"AND perilaku_satgas.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select DISTINCT(perilaku_satgas.perilaku_kd) AS kdku ".
					"from perilaku_satgas ".
					"WHERE perilaku_satgas.tugaskan = 'true' ".
					"AND postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
	$empRecords = mysqli_query($koneksi, $empQuery);
	}	

	
//jika berhasil
else if ($ekat == "pb")
	{
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(DISTINCT(perilaku_satgas.perilaku_kd)) as allcount ".
									"from perilaku_satgas, e_perilaku_masyarakat ".
									"WHERE perilaku_satgas.perilaku_kd = e_perilaku_masyarakat.kd ".
									"AND perilaku_satgas.tugaskan = 'true' ".
									"AND perilaku_satgas.notif = 'true' ".
									"AND perilaku_satgas.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(DISTINCT(perilaku_satgas.perilaku_kd)) as allcount ".
									"from perilaku_satgas, e_perilaku_masyarakat ".
									"WHERE perilaku_satgas.perilaku_kd = e_perilaku_masyarakat.kd ".
									"AND perilaku_satgas.tugaskan = 'true' ".
									"AND perilaku_satgas.notif = 'true' ".
									"AND perilaku_satgas.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select DISTINCT(perilaku_satgas.perilaku_kd) AS kdku ".
					"from perilaku_satgas ".
					"WHERE perilaku_satgas.tugaskan = 'true' ".
					"AND perilaku_satgas.notif = 'true' ".
					"AND postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
	$empRecords = mysqli_query($koneksi, $empQuery);
	}
	
	
	
	
	
	

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;
	$i_kd = balikin($row['kdku']);
	

	//detail
	$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
										"WHERE kd = '$i_kd' ".
										"ORDER BY postdate DESC");
	$ryuk = mysqli_fetch_assoc($qyuk);	
  	$i_nama_lokasi = balikin($ryuk['nama_lokasi']);
	$i_kategori = balikin($ryuk['kategori']);
	$i_ket = balikin($ryuk['keterangan']);
	$i_kota = balikin($ryuk['kota']);
	$i_kec = balikin($ryuk['kecamatan']);
	$i_kelurahan = balikin($ryuk['kelurahan']);
	$i_alamat = balikin($ryuk['alamat']);
	$i_alamat_googlemap = balikin($ryuk['alamat_googlemap']);
	$i_kategori_tempat = balikin($ryuk['kategori_tempat']);
	$i_tipe_laporan = balikin($ryuk['tipe_laporan']);
	$i_jml_orang = balikin($ryuk['jumlah_orang']);
	$i_jml_masker_pake = balikin($ryuk['jml_masker_pake']);
	$i_jml_masker_tidak_pake = balikin($ryuk['jml_masker_tidak_pake']);
	$i_jml_jaga_jarak = balikin($ryuk['jml_jaga_jarak']);
	$i_jml_jaga_jarak_tidak = balikin($ryuk['jml_jaga_jarak_tidak']);
	$i_jml_ingatkan = balikin($ryuk['jml_ingatkan']);
	$i_jml_ingatkan_tidak = balikin($ryuk['jml_ingatkan_tidak']);
	$i_lat_x = balikin($ryuk['lat_x']);
	$i_lat_y = balikin($ryuk['lat_y']);
	$i_k_kd = balikin($ryuk['kontributor_kd']);
	$i_k_nik = balikin($ryuk['kontributor_nik']);
	$i_k_nama = balikin($ryuk['kontributor_nama']);
	$i_k_ket = balikin($ryuk['kontributor_ket']);
	$i_postdate = balikin($ryuk['postdate']);
	


	$nil_foto1 = "<img src='$sumber/filebox/perilaku/$i_kd/$i_kd-1.jpg' width='100' height='100'>";

				


	//cek, sudah forward atau belum...
	$qkuy3 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
										"WHERE perilaku_kd = '$i_kd' ".
										"AND tugaskan = 'true'");
	$rkuy3 = mysqli_fetch_assoc($qkuy3);
	$tkuy3 = mysqli_num_rows($qkuy3);
	$i_tugaskan_postdate = balikin($rkuy3['tugaskan_postdate']);
					

  	//jika sudah forward, lihat status
  	if (!empty($tkuy3))
		{
		$kakak_era = '<p>
		Postdate Tugaskan :
		<br>
		'.$i_tugaskan_postdate.'
		<br>
		<a href="status.php?pkd='.$i_kd.'" target="_parent" class="btn btn-warning" title="LIHAT STATUS">LIHAT STATUS >></a>
		</p>';
		}
		
	else
		{
		$kakak_era = '<a href="panggil_satgas.php?pkd='.$i_kd.'" target="_parent" class="btn btn-success" title="Panggil SATGAS">PANGGIL SATGAS >></a>';
		}




	//detail orang
	$qkuy2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$i_k_kd'");
	$rkuy2 = mysqli_fetch_assoc($qkuy2);
	$i_k_tipe = balikin($rkuy2['tipe_user']);
	$i_k_kontak = balikin($rkuy2['telp']);
	




	
    $data[] = array(	
    		"postdate"=>"$i_postdate",    		    		 	
    		"foto"=>"$nil_foto1
	          	<br>
	          	$kakak_era",  
    		"kategori_tempat"=>"$i_kategori_tempat",
    		"tipe_laporan"=>"$i_tipe_laporan", 
    		"nama_lokasi"=>"$i_nama_lokasi", 
    		"alamat"=>"$i_alamat, Kelurahan $i_kelurahan, Kecamatan $i_kec<hr width='500'>", 	
    		"gps"=>"$i_lat_x, $i_lat_y <br>$i_alamat_googlemap<hr width='500'>",  	
    		"jml_orang"=>"$i_jml_orang",   	
    		"jml_memakai_masker"=>"<b>$i_jml_masker_pake</b>",
    		"jml_tidak_memakai_masker"=>"<b>$i_jml_masker_tidak_pake</b>",
    		"jml_jaga_jarak"=>"<b>$i_jml_jaga_jarak</b>",
    		"jml_tidak_jaga_jarak"=>"<b>$i_jml_jaga_jarak_tidak</b>",
	    	"jml_diingatkan"=>"<b>$i_jml_ingatkan</b>",
	    	"jml_tidak_diingatkan"=>"<b>$i_jml_ingatkan_tidak</b>",
    		"kontributor_nama"=>"$i_k_nik. $i_k_nama [$i_k_tipe][Telp.$i_k_kontak]<hr width='300'>"
    	);
}





## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);

?>