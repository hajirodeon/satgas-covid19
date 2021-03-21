<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = cegah($_POST['order'][0]['dir']); // asc or desc
$searchValue = mysqli_real_escape_string($koneksi,cegah($_POST['search']['value'])); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (orang_kode like '%".$searchValue."%' or 
        orang_nama like '%".$searchValue."%' or   
        penolong_kode like '%".$searchValue."%' or 
        penolong_nama like '%".$searchValue."%' or 
        korban_kode like '%".$searchValue."%' or 
        korban_nama like '%".$searchValue."%' or        
        postdate like'%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"SELECT count(*) as allcount FROM umum_sesi_penolong ".
								"WHERE tugaskan = 'true' ".
								"AND notif = 'false'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"SELECT count(*) as allcount FROM umum_sesi_penolong ".
								"WHERE tugaskan = 'true'  ".
								"AND notif = 'false' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from umum_sesi_penolong ".
				"WHERE tugaskan = 'true' ".
				"AND notif = 'false' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_postdate = balikin($row['tugaskan_postdate']);
	$e_orang_kd = balikin($row['penolong_kd']);
	$e_orang_kode = balikin($row['penolong_kode']);
	$e_orang_nama = balikin($row['penolong_nama']);
	$e_kategori = balikin($row['kategori']);
	$e_ket = balikin($row['ket']);
	$e_korban_kd = balikin($row['korban_kd']);
	$e_korban_kode = balikin($row['korban_kode']);
	$e_korban_nama = balikin($row['korban_nama']);


	$e_tugaskan = balikin($row['tugaskan']);
	$e_tugaskan_postdate = balikin($row['tugaskan_postdate']);
	$e_proses_postdate = balikin($row['notif_postdate']);
	$e_proses = balikin($row['notif']);
	$e_statusnya_postdate = balikin($row['statusnya_postdate']);
	$e_statusnya = balikin($row['statusnya']);
	 

	
	$e_lat_x = balikin($row['lat_x']);
	$e_lat_y = balikin($row['lat_y']);
	$e_alamat = balikin($row['alamat']);
	$e_gps = "$e_lat_x, $e_lat_y <br>$e_alamat";




	$ket_dampak_korban = balikin($row['ket_dampak_korban']);
	$ket_dampak_kerugian = balikin($row['ket_dampak_kerugian']);
	$ket_kronologi = balikin($row['ket_kronologi']);
	$ket_upaya_dilakukan = balikin($row['ket_upaya_dilakukan']);
	$ket_kendala = balikin($row['ket_kendala']);


	
	
	
							
    $data[] = array(	
    		"tugaskan_postdate"=>"$e_tugaskan_postdate",    		    		
    		"penolong_nama"=>"$e_orang_kode . $e_orang_nama",
    		"korban_nama"=>"$e_korban_kode. $e_korban_nama",
    		"postdate"=>"$e_postdate", 	
    		"lat_x"=>"$e_gps", 	
    		"kategori"=>"$e_kategori",	
    		"notif_postdate"=>"$e_proses_postdate",
    		"statusnya_postdate"=>"$e_statusnya_postdate",
    		"ket_dampak_korban"=>"$ket_dampak_korban",
    		"ket_dampak_kerugian"=>"$ket_dampak_kerugian",
    		"ket_kronologi"=>"$ket_kronologi",
    		"ket_upaya_dilakukan"=>"$ket_upaya_dilakukan",
    		"ket_kendala"=>"$ket_kendala" 		
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