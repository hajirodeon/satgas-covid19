<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


//nilai
$e_tgl1 = cegah($_GET['e_tgl1']);
$e_tgl2 = cegah($_GET['e_tgl2']);


//pecah tanggal
$tgl1_pecah = balikin($e_tgl1);
$tgl1_pecahku = explode("/", $tgl1_pecah);
$tgl1_tgl = trim($tgl1_pecahku[0]);
$tgl1_bln = trim($tgl1_pecahku[1]);
$tgl1_thn = trim($tgl1_pecahku[2]);
$tgl1_postdate = "$tgl1_thn-$tgl1_bln-$tgl1_tgl";




//pecah tanggal
$tgl2_pecah = balikin($e_tgl2);
$tgl2_pecahku = explode("/", $tgl2_pecah);
$tgl2_tgl = trim($tgl2_pecahku[0]);
$tgl2_bln = trim($tgl2_pecahku[1]);
$tgl2_thn = trim($tgl2_pecahku[2]);
$tgl2_postdate = "$tgl2_thn-$tgl2_bln-$tgl2_tgl";







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
$sel = mysqli_query($koneksi,"select DISTINCT DATE(postdate) from e_perilaku_masyarakat ".
								"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = mysqli_num_rows($sel);



## Total number of records with filtering
$sel = mysqli_query($koneksi,"select DISTINCT DATE(postdate) from e_perilaku_masyarakat ".
								"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = mysqli_num_rows($sel);

 
 
 
 
 
 

## Fetch records
$empQuery = "select DISTINCT(DATE(postdate)) AS tglku ".
				"from e_perilaku_masyarakat ".
				"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;
	$i_tglku = balikin($row['tglku']);
	
	
	//hitung total
	$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_jaga_jarak) AS total_masker_pake, ".
										"SUM(jml_jaga_jarak_tidak) AS total_masker_tidak ".
										"FROM e_perilaku_masyarakat ".
										"WHERE postdate LIKE '$i_tglku%'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
	$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);



	
    $data[] = array(	
    		"postdate"=>"$i_tglku",    		    		 	
    		"jml_jaga_jarak"=>"<b>$yuk_masker_pake</b>",
    		"jml_jaga_jarak_tidak"=>"<b>$yuk_masker_tidak</b>"
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