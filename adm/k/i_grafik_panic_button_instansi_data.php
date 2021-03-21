<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



//nilai
$ekat = cegah($_REQUEST['ekat']);



//jika null, semua
if (empty($ekat))
	{
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
		$searchQuery = " and (penolong_kode like '%".$searchValue."%' ".
							" OR postdate like '%".$searchValue."%' ".
							" OR penolong_nama like '%".$searchValue."%' ".
							" OR penolong_tipe like '%".$searchValue."%') ";
	}
	
	
		
		
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_penolong ".
									"WHERE tugaskan = 'true'");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_penolong ".
									"WHERE WHERE tugaskan = 'true' ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select * from umum_sesi_penolong ".
					"WHERE WHERE tugaskan = 'true' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
	$empRecords = mysqli_query($koneksi, $empQuery);
	}
	
else
	{
	//detailnya
	$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
									"WHERE kd = '$ekat'");
	$rku = mysqli_fetch_assoc($qku);
	$ekat2 = cegah($rku['nama']);
	
	
	
	
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
		$searchQuery = " and (penolong_kode like '%".$searchValue."%' ".
							" OR postdate like '%".$searchValue."%' ".
							" OR penolong_nama like '%".$searchValue."%' ".
							" OR penolong_tipe like '%".$searchValue."%') ";
	}
	
	
		
		
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_penolong ".
									"WHERE tugaskan = 'true' ".
									"AND penolong_tipe = '$ekat2'");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_penolong ".
									"WHERE tugaskan = 'true' ".
									"AND penolong_tipe = '$ekat2' ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select * from umum_sesi_penolong ".
					"WHERE tugaskan = 'true' ".
					"AND penolong_tipe = '$ekat2' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
	$empRecords = mysqli_query($koneksi, $empQuery);
	}
	
	
	
	

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$i_postdate = balikin($row['postdate']);
	$i_pkd = balikin($row['panic_kd']);
	$i_nip = balikin($row['penolong_kode']);
	$i_nama = balikin($row['penolong_nama']);
	$i_tugaskan = balikin($row['tugaskan']);
	$i_tugaskan_postdate = balikin($row['tugaskan_postdate']);
								

	$i_satgas = "$i_nip. $i_nama [Telp.$i_kontak]. <br>$i_alamat";






	
    $data[] = array(    		    		
    		"postdate"=>"$i_postdate",    		
    		"satgas"=>"$i_satgas", 
    		"rincian"=>"$i_rincian"
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