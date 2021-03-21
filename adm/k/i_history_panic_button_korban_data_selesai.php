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
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($koneksi,cegah($_POST['search']['value'])); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (umum_kode like '%".$searchValue."%' or
		lat_x like '%".$searchValue."%' or
		lat_y like '%".$searchValue."%' or
		lat_alamat like '%".$searchValue."%' or
		umum_nama like '%".$searchValue."%' or
		umum_tipe_user like '%".$searchValue."%' or
		prank_ket like '%".$searchValue."%' or
		prank_postdate like '%".$searchValue."%' or
		satgas like '%".$searchValue."%' or  
        postdate like'%".$searchValue."%' ) ";
}


	

## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_panic ".
								"WHERE statusnya = 'true'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_panic ".
								"WHERE statusnya = 'true' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from umum_sesi_panic ".
				"WHERE statusnya = 'true' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);




$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$e_orang_kd = balikin($row['umum_kd']);
	$e_orang_kode = balikin($row['umum_kode']);
	$e_orang_nama = balikin($row['umum_nama']);
	$e_orang_tipe_user = balikin($row['umum_tipe_user']);
	$e_postdate = balikin($row['postdate']);
	 
	$e_lat_x = balikin($row['lat_x']);
	$e_lat_y = balikin($row['lat_y']);
	$e_lat_alamat = balikin($row['lat_alamat']);
	$e_gps = "$e_lat_x, $e_lat_y <br> $e_lat_alamat";


	$e_prank_ket = balikin($row['prank_ket']);
	$e_prank_postdate = balikin($row['prank_postdate']);
	
	//jika prank
	if (!empty($e_prank_ket))
		{
		$e_prank = "PRANK [$e_prank_postdate]";
		}
	else
		{
		$e_prank = "";
		}


	
	
	//isi *START
	ob_start();
	
		//list
		$qmboh = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
											"WHERE panic_kd = '$e_kd' ".
											"ORDER BY penolong_tipe ASC");
		$rmboh = mysqli_fetch_assoc($qmboh);
		$tmboh = mysqli_num_rows($qmboh);
		
		echo "[$tmboh] Penugasan.
		<hr width='300px'>";
		
		
		do
			{
			$mb_kd = nosql($rmboh['kd']);
			$e_penolong_kd = balikin($rmboh['penolong_kd']);
			$e_penolong_kode = balikin($rmboh['penolong_kode']);
			$e_penolong_nama = balikin($rmboh['penolong_nama']);
			$e_penolong_tipe = balikin($rmboh['penolong_tipe']);
			$e_kategori = balikin($rmboh['kategori']);
			$e_tugaskan = balikin($rmboh['tugaskan']);
			$e_tugaskan_postdate = balikin($rmboh['tugaskan_postdate']);
			$e_proses_postdate = balikin($rmboh['notif_postdate']);
			$e_proses = balikin($rmboh['notif']);
			$e_statusnya_postdate = balikin($rmboh['statusnya_postdate']);
			$e_statusnya = balikin($rmboh['statusnya']);
		
		
			//update kan
			mysqli_query($koneksi, "UPDATE umum_sesi_panic SET notif = '$e_proses', ".
										"tugaskan = '$e_tugaskan', ".
										"statusnya = '$e_statusnya' ".
										"WHERE kd = '$e_kd'");
		
		
			
			echo "[$e_penolong_tipe]. 
			<br>
			$e_penolong_nama [$e_penolong_kode]. 
			<br>
			Kategori Masalah : $e_kategori
			<br>
			Postdate Penugasan : $e_tugaskan_postdate
			<br>
			Postdate Proses : $e_proses_postdate
			<br>
			Postdate Selesai : $e_statusnya_postdate
			<hr width='300px'>
			<br>";
			}
		while ($rmboh = mysqli_fetch_assoc($qmboh));
		
		
		
		
	//isi
	$isi = ob_get_contents();
	ob_end_clean();





	//list
	$qmboh = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
										"WHERE panic_kd = '$e_kd' ".
										"ORDER BY penolong_tipe ASC");
	$rmboh = mysqli_fetch_assoc($qmboh);
	$tmboh = mysqli_num_rows($qmboh);



	//jika ada penugasan
	if (!empty($tmboh))
		{ 
		$isi2 = cegah($isi);
		}
	else
		{
		$isi2 = cegah("[$tmboh] Penugasan. <hr width='300px'>");
		}



	
	//update
	mysqli_query($koneksi, "UPDATE umum_sesi_panic SET satgas = '$isi2' ".
								"WHERE kd = '$e_kd'");
	




    $data[] = array(	
    		"postdate"=>"$e_postdate",    		    		
    		"umum_nama"=>"[$e_orang_tipe_user] $e_orang_kode . $e_orang_nama <br> <a href=\"panic_detail.php?panickd=$e_kd\" class=\"btn btn-success\">DETAIL >></a>", 	
    		"lat_x"=>"$e_gps", 
    		"satgas"=>"$isi",
    		"prank_postdate"=>"$e_prank",
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