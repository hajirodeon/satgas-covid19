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







//masukin semua ke database ///////////////////////////////////////////////////////////////////////////
//list
$empQuery2 = "SELECT DISTINCT(DATE_FORMAT(postdate,'%Y-%m')) AS tglku ".
				"FROM umum_sesi_penolong ".
				"ORDER BY postdate ASC";
$empRecords2 = mysqli_query($koneksi, $empQuery2);

while ($row2 = mysqli_fetch_assoc($empRecords2)) 
	{
	//nilai
	$i_tglku = balikin($row2['tglku']);


	//insert
	$xyz = md5("$i_tglku");
	mysqli_query($koneksi, "INSERT INTO panic_lap_bln(kd, bulan, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");



	//korban
	$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS totalku ".
										"FROM umum_sesi_penolong ".
										"WHERE postdate LIKE '$i_tglku%'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_jml_korban = mysqli_num_rows($qyuk);


	//penolong
	$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(penolong_kd) AS totalku ".
										"FROM umum_sesi_penolong ".
										"WHERE postdate LIKE '$i_tglku%'");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_jml_penolong = mysqli_num_rows($qyuk);





	
	//isi *START
	ob_start();
	
	
		//kategori masalah
		$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(kategori) AS totalku ".
											"FROM umum_sesi_penolong ".
											"WHERE postdate LIKE '$i_tglku%' ".
											"ORDER BY kategori ASC");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
		
		//jika ada..
		if (!empty($tyuk))
			{
			do
				{
				$i_ket = cegah($ryuk['totalku']);
				
				echo "$i_ket .";
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
			}
		else
			{
			echo "-";
			}
	
	
	//isi
	$isi_kategori = ob_get_contents();
	ob_end_clean();







	//isi *START
	ob_start();
	

		//kecamatan
		$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(kecamatan) AS totalku ".
											"FROM umum_sesi_penolong ".
											"WHERE postdate LIKE '$i_tglku%' ".
											"ORDER BY kecamatan ASC");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
		
		//jika ada..
		if (!empty($tyuk))
			{
			do
				{
				$i_ket = cegah($ryuk['totalku']);
				
				echo "$i_ket .";
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
			}
		else
			{
			echo "-";
			}
	
	
	//isi
	$isi_kecamatan = ob_get_contents();
	ob_end_clean();





	
	
	//update
	mysqli_query($koneksi, "UPDATE panic_lap_bln SET jml_korban = '$yuk_jml_korban', ".
								"jml_penolong = '$yuk_jml_penolong', ".
								"ket_kategori_masalah = '$isi_kategori', ".
								"ket_kecamatan = '$isi_kecamatan' ".
								"WHERE bulan = '$i_tglku' ".
								"AND kd = '$xyz'");

	}
//masukin semua ke database ///////////////////////////////////////////////////////////////////////////








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
	$searchQuery = " and (bulan like '%".$searchValue."%' or
		jml_korban like '%".$searchValue."%' or
		jml_penolong like '%".$searchValue."%' or
		ket_kategori_masalah like '%".$searchValue."%' or
		ket_kecamatan like '%".$searchValue."%' or
        postdate like'%".$searchValue."%' ) ";
}




	
## Total number of records without filtering
$sel = mysqli_query($koneksi,"select bulan from panic_lap_bln");
$records = mysqli_fetch_assoc($sel);
$totalRecords = mysqli_num_rows($sel);



## Total number of records with filtering
$sel = mysqli_query($koneksi,"select * from panic_lap_bln ".
								"WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = mysqli_num_rows($sel);

 
 
 
 
 
 

## Fetch records
$empQuery = "select * from panic_lap_bln ".
				"WHERE 1 ".$searchQuery." order by round(".$columnName.") ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;
	$i_tglku = balikin($row['bulan']);
	$i_nil1 = balikin($row['jml_korban']);
	$i_nil2 = balikin($row['jml_penolong']);
	$i_nil3 = balikin($row['ket_kategori_masalah']);
	$i_nil4 = balikin($row['ket_kecamatan']);

	
    $data[] = array(
    	"bulan"=>"$i_tglku", 
    	"jml_korban"=>"<font color='red'>$i_nil1</font>",
    	"jml_penolong"=>"<font color='red'>$i_nil2</font>",
    	"ket_kategori_masalah"=>"<font color='red'>$i_nil3</font>",
    	"ket_kecamatan"=>"<font color='red'>$i_nil4</font>"
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