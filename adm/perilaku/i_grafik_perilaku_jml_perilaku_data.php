<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


//nilai
$ekat = cegah($_GET['ekat']);

	

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
$sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from e_perilaku_masyarakat WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($koneksi, $empQuery);

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$i_kd = balikin($row['kd']);
  	$i_nama_lokasi = balikin($row['nama_lokasi']);
	$i_kategori = balikin($row['kategori']);
	$i_ket = balikin($row['keterangan']);
	$i_kota = balikin($row['kota']);
	$i_kec = balikin($row['kecamatan']);
	$i_kelurahan = balikin($row['kelurahan']);
	$i_alamat = balikin($row['alamat']);
	$i_alamat_googlemap = balikin($row['alamat_googlemap']);
	$i_kategori_tempat = balikin($row['kategori_tempat']);
	$i_tipe_laporan = balikin($row['tipe_laporan']);

	$i_lat_x = balikin($row['lat_x']);
	$i_lat_y = balikin($row['lat_y']);
	$i_k_kd = balikin($row['kontributor_kd']);
	$i_k_nik = balikin($row['kontributor_nik']);
	$i_k_nama = balikin($row['kontributor_nama']);
	$i_k_ket = balikin($row['kontributor_ket']);
	$i_postdate = balikin($row['postdate']);
	


	$nil_foto1 = "<img src='$sumber/filebox/perilaku/$i_kd/$i_kd-1.jpg' width='100' height='100'>";





	
	if ($ekat == "m1")
		{
		$i_jmlku = balikin($row['jml_masker_pake']);
		}
		
	else if ($ekat == "m2")
		{
		$i_jmlku = balikin($row['jml_masker_tidak_pake']);
		}
		
	else if ($ekat == "j1")
		{
		$i_jmlku = balikin($row['jml_jaga_jarak']);
		}
		
	else if ($ekat == "j2")
		{
		$i_jmlku = balikin($row['jml_jaga_jarak_tidak']);
		}
		
		
	else if ($ekat == "d1")
		{
		$i_jmlku = balikin($row['jml_ingatkan']);			
		}
		
		
	else if ($ekat == "d2")
		{
		$i_jmlku = balikin($row['jml_ingatkan_tidak']);
		}
	
	
		
		


				


	//cek, sudah forward atau belum...
	$qkuy = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
										"WHERE perilaku_kd = '$i_kd' ".
										"AND tugaskan = 'true'");
	$rkuy = mysqli_fetch_assoc($qkuy);
	$tkuy = mysqli_num_rows($qkuy);
	$i_tugaskan_postdate = balikin($rkuy['tugaskan_postdate']);
					

  	//jika sudah forward, lihat status
  	if (!empty($tkuy))
		{
		$kakak_era = '<p>
		Postdate Tugaskan :
		<br>
		'.$i_tugaskan_postdate.'
		<br>
		<a href="status.php?pkd='.$i_kd.'" target="_parent" class="btn btn-warning" title="LIHAT STATUS">LIHAT STATUS >></a>
		</p>';
		}
		
	else
		{
		$kakak_era = '<a href="panggil_satgas.php?pkd='.$i_kd.'" target="_parent" class="btn btn-success" title="Panggil SATGAS">PANGGIL SATGAS >></a>';
		}




	//detail orang
	$qkuy2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$i_k_kd'");
	$rkuy2 = mysqli_fetch_assoc($qkuy2);
	$i_k_tipe = balikin($rkuy2['tipe_user']);
	$i_k_kontak = balikin($rkuy2['telp']);
	


	
    $data[] = array(	
    		"postdate"=>"$i_postdate $i_jmlku",    		    		 	
    		"foto"=>"$nil_foto1
	          	<br>
	          	$kakak_era",  
    		"kategori_tempat"=>"$i_kategori_tempat",
    		"tipe_laporan"=>"$i_tipe_laporan", 
    		"nama_lokasi"=>"$i_nama_lokasi",   
    		"jumlah"=>"$i_jmlku", 
    		"alamat"=>"$i_alamat, Kelurahan $i_kelurahan, Kecamatan $i_kec<hr width='500'>", 	
    		"gps"=>"$i_lat_x, $i_lat_y <br>$i_alamat_googlemap<hr width='500'>",
    		"kontributor_nama"=>"$i_k_nik. $i_k_nama [$i_k_tipe][Telp.$i_k_kontak]<hr width='300'>"
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