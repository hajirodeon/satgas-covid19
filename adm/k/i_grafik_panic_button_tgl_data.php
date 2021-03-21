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
$tgl2_tglx = trim($tgl2_pecahku[0]);
$tgl2_tgl = $tgl2_tglx + 1;
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
	$searchQuery = " and (umum_kode like '%".$searchValue."%' or
		umum_nama like '%".$searchValue."%' or 
		alamat like '%".$searchValue."%' or  
        penolong_kode like '%".$searchValue."%' or 
        penolong_nama like '%".$searchValue."%' or  
        penolong_tipe_user like '%".$searchValue."%' or 
        kategori_masalah like '%".$searchValue."%' or  
        kecamatan like '%".$searchValue."%' or                                      
        postdate like'%".$searchValue."%' ) ";
}





	

## Total number of records without filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_panic ".
								"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from umum_sesi_panic ".
								"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from umum_sesi_panic ".
				"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);




$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$i_kd = balikin($row['kd']);
  	$i_korban_kd = balikin($row['umum_kd']);
  	$i_korban_kode = balikin($row['umum_kode']);
  	$i_korban_nama = balikin($row['umum_nama']);
  	$i_korban_tipe = balikin($row['umum_tipe_user']);
	$i_korban = "$i_korban_tipe <br> $i_korban_nama [$i_korban_kode]";


	$i_postdate = balikin($row['postdate']);
	
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
											"WHERE panic_kd = '$i_kd' ".
											"ORDER BY penolong_tipe ASC");
		$rmboh = mysqli_fetch_assoc($qmboh);
		$tmboh = mysqli_num_rows($qmboh);
		
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






	$nil_foto1 = "<img src='$sumber/filebox/panic/$i_kd/$i_kd-1.jpg' width='100' height='100'>";

				


	//cek, sudah forward atau belum...
	$qkuy = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
										"WHERE panic_kd = '$i_kd' ".
										"AND tugaskan = 'true'");
	$rkuy = mysqli_fetch_assoc($qkuy);
	$tkuy = mysqli_num_rows($qkuy);
	$i_tugaskan_postdate = balikin($rkuy['tugaskan_postdate']);
					

  	//jika sudah forward, lihat status
  	if (!empty($tkuy))
		{
		$kakak_era = '<p>
		Penugasan :
		<br>
		'.$i_tugaskan_postdate.'
		</p>';
		}
		
	else
		{
		$kakak_era = '';
		}


	
    $data[] = array(	
    		"postdate"=>"$i_postdate", 
    		"korban"=>"$i_korban",
    		"gps"=>"$e_gps",
    		"postdate_ditolong"=>"$i_postdate_ditolong",
    		"penolong"=>"$i_penolong",
    		"kategori"=>"$i_kategori",
    		"kecamatan"=>"$i_kecamatan",     
    		"postdate"=>"$i_postdate"
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