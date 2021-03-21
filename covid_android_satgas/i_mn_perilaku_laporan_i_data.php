<?php
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

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
	$searchQuery = " and (nip like '%".$searchValue."%' or 
        nama like '%".$searchValue."%' or  
        jabatan like '%".$searchValue."%' or 
        tgl_lahir like '%".$searchValue."%' or 
        alamat like '%".$searchValue."%' or 
        telp like '%".$searchValue."%' or 
        email like '%".$searchValue."%' or 
        ket like '%".$searchValue."%' or  
        lat_x like '%".$searchValue."%' or
        lat_y like '%".$searchValue."%' or    
        postdate like'%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from m_umum");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from m_umum WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from m_umum WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_nip = balikin($row['nip']);
	$e_nama = balikin($row['nama']);
	$e_filex = balikin($row['filex1']);
	$e_jabatan = balikin($row['jabatan']);
	$e_tgl_lahir = balikin($row['tgl_lahir']);
	$e_alamat = balikin($row['alamat']);
	$e_telp = balikin($row['telp']);
	$e_email = balikin($row['email']);
	$e_lat_x = balikin($row['lat_x']);
	$e_lat_y = balikin($row['lat_y']);
	$e_ket = balikin($row['ket']);
	$e_postdate = balikin($row['postdate']);
	    
	$nil_foto1 = "$sumber/filebox/perilaku/$e_kd/$e_kd-1.jpg";
	
	
    $data[] = array(
	
    		"nip"=>"$e_nip",
    		    		
    		"nama"=>"$e_nama",
    		
    		"image"=>"<img src=\"$nil_foto1\" width=\"150\">",
    		"jabatan"=>$e_jabatan,
    		"tgllahir"=>$e_tgl_lahir,
    		"alamat"=>$e_alamat,
    		"telp"=>$e_telp,
    		"email"=>$e_email,
    		"lokasi"=>"$e_lat_x, $e_lat_y",
    		"ket"=>$e_ket,
    		"postdate"=>$e_postdate
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