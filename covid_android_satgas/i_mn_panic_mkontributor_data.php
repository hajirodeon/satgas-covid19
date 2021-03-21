<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;




//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];



$tgl1_postdate = "$tahun-$bulan-01";
$tgl2_postdate = "$tahun-$bulan-31";


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
	$searchQuery = " and (umum_kode like '%".$searchValue."%' or
		umum_nama like '%".$searchValue."%' or 
		alamat like '%".$searchValue."%' or  
        penolong_kode like '%".$searchValue."%' or 
        penolong_nama like '%".$searchValue."%' or  
        penolong_tipe_user like '%".$searchValue."%' or 
        kategori_masalah like '%".$searchValue."%' or  
        solusi like '%".$searchValue."%' or 
        kecamatan like '%".$searchValue."%' or                                      
        postdate like'%".$searchValue."%' ) ";
}




## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(DISTINCT(umum_sesi_penolong.panic_kd)) as allcount ".
								"from umum_sesi_penolong, umum_sesi_panic ".
								"WHERE umum_sesi_penolong.panic_kd = umum_sesi_panic.kd ".
								"AND umum_sesi_penolong.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(DISTINCT(umum_sesi_penolong.panic_kd)) as allcount ".
								"from umum_sesi_penolong, umum_sesi_panic ".
								"WHERE umum_sesi_penolong.panic_kd = umum_sesi_panic.kd ".
								"AND umum_sesi_penolong.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select DISTINCT(umum_sesi_penolong.panic_kd) AS kdku ".
				"from umum_sesi_penolong ".
				"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);
	
	
	

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;
	$i_kd = balikin($row['kdku']);
	

	//detail
	$qyuk = mysqli_query($koneksi, "SELECT * FROM umum_sesi_panic ".
										"WHERE kd = '$i_kd' ".
										"ORDER BY postdate DESC");
	$ryuk = mysqli_fetch_assoc($qyuk);	


	$i_postdate = balikin($ryuk['postdate']);
	


	$nil_foto1 = "<img src='$sumber/filebox/panic/$i_kd/$i_kd-1.jpg' width='100' height='100'>";

				


	//cek, sudah forward atau belum...
	$qkuy3 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
										"WHERE panic_kd = '$i_kd' ".
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
    		"korban"=>"$i_korban",
    		"gps"=>"$i_gps",
    		"postdate_ditolong"=>"$i_postdate_ditolong",
    		"penolong"=>"$i_penolong",
    		"kategori"=>"$i_kategori",
    		"solusi"=>"$i_solusi",
    		"kecamatan"=>"$i_kecamatan"
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