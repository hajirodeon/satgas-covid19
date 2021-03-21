<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");

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
        postdate like'%".$searchValue."%' ) ";
}


	
	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from m_orang");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from m_orang WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from m_orang WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
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
	    
	$nil_foto1 = "$sumber/filebox/pegawai/$e_kd/$e_filex";
	
	
    $data[] = array(
	
    		"nip"=>"$e_nip<br>
    		<a href=\"$filenya?s=edit&kd=$e_kd\" class=\"btn btn-success\">EDIT</a>
    		<a href=\"$filenya?s=hapus&kd=$e_kd\" class=\"btn btn-danger\">HAPUS</a>",
    		    		
    		"nama"=>"$e_nama <br>
    		<a href=\"$filenya?s=reset&kd=$e_kd\" class=\"btn btn-primary\">RESET PASSWORD >></a>

			<a href=\"$filenya?s=haid&kd=$e_kd\" class=\"btn btn-danger\">Hardware Kode : $i_haid. RESET >></a>

			<a href=\"$filenya?s=mapnya&kd=$e_kd\" class=\"btn btn-success\">LOKASI TERAKHIR >></a>",
    		
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