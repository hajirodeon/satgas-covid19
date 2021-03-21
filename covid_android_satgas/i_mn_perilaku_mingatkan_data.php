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
	$searchQuery = " and (nama_lokasi like '%".$searchValue."%' or
		kategori_tempat like '%".$searchValue."%' or 
		tipe_laporan like '%".$searchValue."%' or  
        alamat like '%".$searchValue."%' or 
        alamat_googlemap like '%".$searchValue."%' or  
        kecamatan like '%".$searchValue."%' or 
        kelurahan like '%".$searchValue."%' or  
        kontributor_nik like '%".$searchValue."%' or 
        kontributor_nama like '%".$searchValue."%' or                                      
        postdate like'%".$searchValue."%' ) ";
}




	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select DISTINCT DATE(postdate) from e_perilaku_masyarakat");
$records = mysqli_fetch_assoc($sel);
$totalRecords = mysqli_num_rows($sel);



## Total number of records with filtering
$sel = mysqli_query($koneksi,"select DISTINCT DATE(postdate) from e_perilaku_masyarakat ".
								"WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = mysqli_num_rows($sel);

 
 
 
 
 
 

## Fetch records
$empQuery = "select DISTINCT(DATE(postdate)) AS tglku ".
				"from e_perilaku_masyarakat ".
				"WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;
	$i_tglku = balikin($row['tglku']);
	
	
	//hitung total
	$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_ingatkan) AS total_masker_pake, ".
										"SUM(jml_ingatkan_tidak) AS total_masker_tidak ".
										"FROM e_perilaku_masyarakat ".
										"WHERE postdate LIKE '$i_tglku%'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
	$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);



	
    $data[] = array(	
    		"postdate"=>"$i_tglku",    		    		 	
    		"jml_ingatkan"=>"<b>$yuk_masker_pake</b>",
    		"jml_ingatkan_tidak"=>"<b>$yuk_masker_tidak</b>"
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