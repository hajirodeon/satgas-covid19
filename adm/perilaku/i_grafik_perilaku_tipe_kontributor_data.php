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
		$searchQuery = " and (nama_lokasi like '%".$searchValue."%' ".
							" OR postdate like '%".$searchValue."%' ".
							" OR kontributor_nik like '%".$searchValue."%' ".
							" OR kontributor_nama like '%".$searchValue."%' ".
							" OR kontributor_kontak like '%".$searchValue."%' ".
							" OR alamat_googlemap like '%".$searchValue."%') ";
	}
	
	
		
		
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat ".
									"WHERE 1 ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select * from e_perilaku_masyarakat ".
					"WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
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
		$searchQuery = " and (nama_lokasi like '%".$searchValue."%' ".
							" OR postdate like '%".$searchValue."%' ".
							" OR kontributor_nik like '%".$searchValue."%' ".
							" OR kontributor_nama like '%".$searchValue."%' ".
							" OR kontributor_kontak like '%".$searchValue."%' ".
							" OR alamat_googlemap like '%".$searchValue."%') ";
	}
	
	
		
		
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat ".
									"WHERE kontributor_tipe = '$ekat2'");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from e_perilaku_masyarakat ".
									"WHERE kontributor_tipe = '$ekat2' ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select * from e_perilaku_masyarakat ".
					"WHERE kontributor_tipe = '$ekat2' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
	$empRecords = mysqli_query($koneksi, $empQuery);
	}
	
	
	
	

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$i_jml_orang = balikin($row['jumlah_orang']);
	$i_jml_masker_pake = balikin($row['jml_masker_pake']);
	$i_jml_masker_tidak_pake = balikin($row['jml_masker_tidak_pake']);
	$i_jml_jaga_jarak = balikin($row['jml_jaga_jarak']);
	$i_jml_jaga_jarak_tidak = balikin($row['jml_jaga_jarak_tidak']);
	$i_jml_ingatkan = balikin($row['jml_ingatkan']);
	$i_jml_ingatkan_tidak = balikin($row['jml_ingatkan_tidak']);



	//list history perilaku masyarakat
	$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
										"WHERE kd = '$e_kd' ".
										"ORDER BY postdate DESC");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$tyuk = mysqli_num_rows($qyuk);
  	$i_kd = balikin($ryuk['kd']);
  	$i_nama_lokasi = balikin($ryuk['nama_lokasi']);
	
	$i_k_kd = balikin($ryuk['kontributor_kd']);
	$i_k_nik = balikin($ryuk['kontributor_nik']);
	$i_k_nama = balikin($ryuk['kontributor_nama']);
	$i_k_kontak = balikin($ryuk['kontributor_kontak']);
	$i_k_ket = balikin($ryuk['kontributor_ket']);
	$i_postdate = balikin($ryuk['postdate']);


	
	//detail orang
	$qkuy2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$i_k_kd'");
	$rkuy2 = mysqli_fetch_assoc($qkuy2);
	$i_k_tipe = balikin($rkuy2['tipe_user']);
	$i_k_kontak = balikin($rkuy2['telp']);
		


	//isi *START
	ob_start();



		//list history perilaku masyarakat
		$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
											"WHERE kd = '$e_kd' ".
											"ORDER BY postdate DESC");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
		
		//jika ada
		if (!empty($tyuk))
			{
			do
				{
				//nilai
				$i_no = $i_no + 1;			
			  	$i_kd = balikin($ryuk['kd']);
			  	$i_nama_lokasi = balikin($ryuk['nama_lokasi']);
				$i_kategori = balikin($ryuk['kategori']);
				$i_ket = balikin($ryuk['keterangan']);
				$i_kota = balikin($ryuk['kota']);
				$i_kec = balikin($ryuk['kecamatan']);
				$i_kelurahan = balikin($ryuk['kelurahan']);
				$i_alamat = balikin($ryuk['alamat']);
				$i_alamat_googlemap = balikin($ryuk['alamat_googlemap']);
				$i_kontributor_tipe = balikin($ryuk['kontributor_tipe']);
				$i_kategori_tempat = balikin($ryuk['kategori_tempat']);
				$i_tipe_laporan = balikin($ryuk['tipe_laporan']);
				$i_jml_orang = balikin($ryuk['jumlah_orang']);
				$i_jml_masker_pake = balikin($ryuk['jml_masker_pake']);
				$i_jml_masker_tidak_pake = balikin($ryuk['jml_masker_tidak_pake']);
				$i_jml_jaga_jarak = balikin($ryuk['jml_jaga_jarak']);
				$i_jml_jaga_jarak_tidak = balikin($ryuk['jml_jaga_jarak_tidak']);
				$i_jml_ingatkan = balikin($ryuk['jml_ingatkan']);
				$i_jml_ingatkan_tidak = balikin($ryuk['jml_ingatkan_tidak']);
				$i_lat_x = balikin($ryuk['lat_x']);
				$i_lat_y = balikin($ryuk['lat_y']);
				$i_k_kd = balikin($ryuk['kontributor_kd']);
				$i_k_nik = balikin($ryuk['kontributor_nik']);
				$i_k_nama = balikin($ryuk['kontributor_nama']);
				$i_k_kontak = balikin($ryuk['kontributor_kontak']);
				$i_k_ket = balikin($ryuk['kontributor_ket']);
				$i_postdate = balikin($ryuk['postdate']);
				
				
				
				
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
			
			
			
					
				echo "<p>
				Tipe Laporan : 
				<br>
				$i_tipe_laporan
				</p>
				<br>
				
				<p>
				Kategori Tempat : 
				<br>
				$i_kategori_tempat
				</p>
				<br>
				
				<p>
				Alamat : 
				<br>
				$i_alamat_googlemap
				</p>
				<br>

				
				<p>
				$kakak_era
				</p>
				<hr width='500'>
				<br>";
				
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
			}

	
	//isi
	$i_rincian = ob_get_contents();
	ob_end_clean();

	
	
	
    $data[] = array(    		    		
    		"postdate"=>"$i_postdate",    		
    		"kontributor"=>"$i_k_nik. $i_k_nama [Telp.$i_k_kontak]",
    		"rincian"=>"$i_rincian",   	
    		"jml_orang"=>"$i_jml_orang",   	
    		"jml_memakai_masker"=>"<b>$i_jml_masker_pake</b>",
    		"jml_tidak_memakai_masker"=>"<b>$i_jml_masker_tidak_pake</b>",
    		"jml_jaga_jarak"=>"<b>$i_jml_jaga_jarak</b>",
    		"jml_tidak_jaga_jarak"=>"<b>$i_jml_jaga_jarak_tidak</b>",
	    	"jml_diingatkan"=>"<b>$i_jml_ingatkan</b>",
	    	"jml_tidak_diingatkan"=>"<b>$i_jml_ingatkan_tidak</b>",
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