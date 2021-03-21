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
		$searchQuery = " and (orang_kode like '%".$searchValue."%' ".
							" OR postdate like '%".$searchValue."%' ".
							" OR orang_nama like '%".$searchValue."%' ".
							" OR orang_tipe like '%".$searchValue."%' ".
							" OR orang_kontak like '%".$searchValue."%' ".
							" OR orang_alamat_googlemap like '%".$searchValue."%') ";
	}
	
	
		
		
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from perilaku_satgas ".
									"WHERE tugaskan = 'true'");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from perilaku_satgas ".
									"WHERE WHERE tugaskan = 'true' ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select * from perilaku_satgas ".
					"WHERE WHERE tugaskan = 'true' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
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
		$searchQuery = " and (orang_kode like '%".$searchValue."%' ".
							" OR postdate like '%".$searchValue."%' ".
							" OR orang_nama like '%".$searchValue."%' ".
							" OR orang_tipe like '%".$searchValue."%' ".
							" OR orang_kontak like '%".$searchValue."%' ".
							" OR orang_alamat_googlemap like '%".$searchValue."%') ";
	}
	
	
		
		
	## Total number of records without filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from perilaku_satgas ".
									"WHERE tugaskan = 'true' ".
									"AND orang_tipe = '$ekat2'");
	$records = mysqli_fetch_assoc($sel);
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
	$sel = mysqli_query($koneksi,"select count(*) as allcount from perilaku_satgas ".
									"WHERE tugaskan = 'true' ".
									"AND orang_tipe = '$ekat2' ".$searchQuery);
	$records = mysqli_fetch_assoc($sel);
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
	$empQuery = "select * from perilaku_satgas ".
					"WHERE tugaskan = 'true' ".
					"AND orang_tipe = '$ekat2' ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
	$empRecords = mysqli_query($koneksi, $empQuery);
	}
	
	
	
	

$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
		
	//nilai
	$nomer = $nomer + 1;;
	$e_kd = balikin($row['kd']);
	$i_postdate = balikin($row['postdate']);
	$i_pkd = balikin($row['perilaku_kd']);
	$i_nip = balikin($row['orang_kode']);
	$i_nama = balikin($row['orang_nama']);
	$i_kontak = balikin($row['orang_kontak']);
	$i_alamat = balikin($row['orang_alamat_googlemap']);
	$i_tugaskan = balikin($row['tugaskan']);
	$i_tugaskan_postdate = balikin($row['tugaskan_postdate']);
								

	$i_satgas = "$i_nip. $i_nama [Telp.$i_kontak]. <br>$i_alamat";



	//isi *START
	ob_start();



		//list history perilaku masyarakat
		$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
											"WHERE kd = '$i_pkd' ".
											"ORDER BY postdate DESC");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
		
		//jika ada
		if (!empty($tyuk))
			{
			do
				{
				//nilai
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
				</p>";
				
				
				
				
			  	//jika sudah forward, lihat status
			  	if ($i_tugaskan == "true")
					{
					echo '<p>
					Postdate Tugaskan :
					<br>
					'.$i_tugaskan_postdate.'
					<br>
					<a href="status.php?pkd='.$i_pkd.'" target="_parent" class="btn btn-warning" title="LIHAT STATUS">LIHAT STATUS >></a>
					</p>';
					}
					
				else if ($i_tugaskan == "false")
					{
					echo '<a href="panggil_satgas.php?pkd='.$i_pkd.'" target="_parent" class="btn btn-success" title="Panggil SATGAS">PANGGIL SATGAS >></a>';
					}
				
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
			}

	
	//isi
	$i_rincian = ob_get_contents();
	ob_end_clean();
	






	
    $data[] = array(    		    		
    		"postdate"=>"$i_postdate",    		
    		"satgas"=>"$i_satgas", 
    		"rincian"=>"$i_rincian"
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