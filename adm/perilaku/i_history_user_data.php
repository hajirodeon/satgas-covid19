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
	$searchQuery = " and (nip like '%".$searchValue."%' or 
        nama like '%".$searchValue."%' or  
        tipe_user like '%".$searchValue."%' or 
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
	$e_tipe = balikin($row['tipe_user']);
	$e_jabatan = balikin($row['jabatan']);
	$e_tgl_lahir = balikin($row['tgl_lahir']);
	$e_alamat = balikin($row['alamat']);
	$e_telp = balikin($row['telp']);
	$e_email = balikin($row['email']);
	$e_lat_x = balikin($row['lat_x']);
	$e_lat_y = balikin($row['lat_y']);
	$e_ket = balikin($row['ket']);
	$e_postdate = balikin($row['postdate']);
	 


	//detail entrinya
	ob_start();
	

		//list 
		$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
											"WHERE kontributor_nik = '$e_nip' ".
											"ORDER BY postdate DESC");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);

		echo "[$tyuk] Kontribusi
		<hr width='200'>";



		
		//jika ada
		if (!empty($tyuk))
			{
			
			do
				{
				//nilai
				$yuk_kd = balikin($ryuk['kd']);
				$yuk_postdate = balikin($ryuk['postdate']);
	
	
				//cek, sudah forward atau belum...
				$qkuy = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
													"WHERE perilaku_kd = '$yuk_kd' ".
													"AND tugaskan = 'true'");
				$rkuy = mysqli_fetch_assoc($qkuy);
				$tkuy = mysqli_num_rows($qkuy);
				$i_tugaskan_postdate = balikin($rkuy['tugaskan_postdate']);
								
			
			  	//jika sudah forward, lihat status
			  	if (!empty($tkuy))
					{
					$kakak_era = '<p>
					Postdate Penugasan :
					<br>
					'.$i_tugaskan_postdate.'
					<br>
					<a href="panggil_satgas.php?pkd='.$yuk_kd.'" target="_parent" class="btn btn-warning" title="LIHAT STATUS">LIHAT STATUS >></a>
					</p>';
					}
					
				else
					{
					$kakak_era = '<a href="panggil_satgas.php?pkd='.$yuk_kd.'" class="btn btn-success" title="Panggil SATGAS">PANGGIL SATGAS >></a>';
					}
	
	
				echo "Postdate Entri : $yuk_postdate 
				<br>$kakak_era. 
				<hr width='200'>";
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
			}
	
	//isi
	$i_isinya = ob_get_contents();
	ob_end_clean();



	
	
	




	
	
    $data[] = array(
	 
    		"nip"=>"$e_nip",
    		    		
    		"nama"=>"$e_nama",
    		"tipe_user"=>$e_tipe,
    		"ketnya"=>$i_isinya
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