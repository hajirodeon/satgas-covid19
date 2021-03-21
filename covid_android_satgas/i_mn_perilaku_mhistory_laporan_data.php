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
	$i_jml_orang = balikin($row['jumlah_orang']);
	$i_jml_masker_pake = balikin($row['jml_masker_pake']);
	$i_jml_masker_tidak_pake = balikin($row['jml_masker_tidak_pake']);
	$i_jml_jaga_jarak = balikin($row['jml_jaga_jarak']);
	$i_jml_jaga_jarak_tidak = balikin($row['jml_jaga_jarak_tidak']);
	$i_jml_ingatkan = balikin($row['jml_ingatkan']);
	$i_jml_ingatkan_tidak = balikin($row['jml_ingatkan_tidak']);
	$i_lat_x = balikin($row['lat_x']);
	$i_lat_y = balikin($row['lat_y']);
	$i_k_kd = balikin($row['kontributor_kd']);
	$i_k_nik = balikin($row['kontributor_nik']);
	$i_k_nama = balikin($row['kontributor_nama']);
	$i_k_ket = balikin($row['kontributor_ket']);
	$i_postdate = balikin($row['postdate']);
	


	$nil_foto1 = "<img src='$sumber/filebox/perilaku/$i_kd/$i_kd-1.jpg' width='100' height='100'>";

				


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
	




	//isi *START
	ob_start();
	

		//list satgas
		$qyuk = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
											"WHERE perilaku_kd = '$i_kd' ".
											"AND tugaskan = 'true' ".
											"ORDER BY orang_tipe ASC, ".
											"orang_nama ASC");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
		
		do
			{
			//nilai
			$yuk_orang_kd = balikin($ryuk['orang_kd']);
			$yuk_orang_kode = balikin($ryuk['orang_kode']);
			$yuk_orang_nama = balikin($ryuk['orang_nama']);
			$yuk_orang_tipe = balikin($ryuk['orang_tipe']);
			$yuk_orang_kontak = balikin($ryuk['orang_kontak']);
			$yuk_tugaskan_postdate = balikin($ryuk['tugaskan_postdate']);
			$yuk_statusnya_postdate = balikin($ryuk['statusnya_postdate']);
			$yuk_aksi_ket = balikin($ryuk['ket']);
			
			
			//jika null
			if (empty($yuk_aksi_ket))
				{
				$yuk_aksi_ketx = "<font color='red'>Belum Melakukan Apapun</font>";
				}
			else
				{
				$yuk_aksi_ketx = "<font color='green'>$yuk_statusnya_postdate. $yuk_aksi_ket</font>";					
				}
			
			
			echo "[$yuk_orang_tipe] 
			<br>$yuk_orang_kode. 
			<br>$yuk_orang_nama 
			<br>[Telp.$yuk_orang_kontak]
			<br>PENUGASAN : <b>$yuk_tugaskan_postdate</b>
			<br>AKSI LAPANGAN : <b>$yuk_aksi_ketx</b> 
			<hr width='400'>";
			}
		while ($ryuk = mysqli_fetch_assoc($qyuk));
	
	//isi
	$i_forward_nama = ob_get_contents();
	ob_end_clean();






	
    $data[] = array(	
    		"postdate"=>"$i_postdate",    		    		 	
    		"foto"=>"$nil_foto1",  
    		"kategori_tempat"=>"$i_kategori_tempat",
    		"tipe_laporan"=>"$i_tipe_laporan", 
    		"nama_lokasi"=>"$i_nama_lokasi", 
    		"alamat"=>"$i_alamat, Kelurahan $i_kelurahan, Kecamatan $i_kec<hr width='500'>", 	
    		"gps"=>"$i_lat_x, $i_lat_y <br>$i_alamat_googlemap<hr width='500'>",  	
    		"jml_orang"=>"$i_jml_orang",   	
    		"jml_memakai_masker"=>"<b>$i_jml_masker_pake</b>",
    		"jml_tidak_memakai_masker"=>"<b>$i_jml_masker_tidak_pake</b>",
    		"jml_jaga_jarak"=>"<b>$i_jml_jaga_jarak</b>",
    		"jml_tidak_jaga_jarak"=>"<b>$i_jml_jaga_jarak_tidak</b>",
	    	"jml_diingatkan"=>"<b>$i_jml_ingatkan</b>",
	    	"jml_tidak_diingatkan"=>"<b>$i_jml_ingatkan_tidak</b>",
    		"kontributor_nama"=>"$i_k_nik. $i_k_nama [$i_k_tipe][Telp.$i_k_kontak]<hr width='300'>",  	
    		"forward_nama"=>"$i_forward_nama"
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