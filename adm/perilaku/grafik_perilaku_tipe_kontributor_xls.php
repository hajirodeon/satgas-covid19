<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_tipe_kontributor.php";
$judul = "PER KONTRIBUTOR";
$judulku = "[PERILAKU MASYARAKAT] $judul";
$judulx = $judul;






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require '../../inc/class/phpspreadsheet/vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$excel = new Spreadsheet();
$sheet = $excel->getActiveSheet();
$sheet = $excel->getActiveSheet()->setTitle('lap_perilaku_per_kontributor');

// Set properties
$excel->getProperties()->setCreator("SatgasCovid19Kendal")
							->setLastModifiedBy("SatgasCovid19Kendal");


$sheet->getPageSetup()->setOrientation(PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);







// judul
$sheet->setCellValue('A1', 'LAPORAN PERILAKU MASYARAKAT');
$sheet->setCellValue('A2', 'PER TIPE KONTRIBUTOR');
$sheet->setCellValue('A3', 'Sumber : '.$sumber.'');
$sheet->setCellValue('C3', 'Postdate Download : '.$today.'');
$sheet->mergeCells("A1:D1");
$sheet->mergeCells("A2:D2");
$sheet->mergeCells("A3:B3");
$sheet->mergeCells("C3:D3");

$sheet->getStyle('A1:D1')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
    -> setWrapText (true);
		

$sheet->getStyle('A2:D2')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
    -> setWrapText (true);

$sheet->getStyle('A1:D1')
	->getFont()
	->setBold(true)
	->setName('Arial')
    -> SetSize (16); 


$sheet->getStyle('A2:D2')
	->getFont()
	->setBold(true)
	->setName('Arial')
    -> SetSize (16); 



$sheet->getStyle('A3:B3')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
    -> setWrapText (true);
	
$sheet->getStyle('C3:D3')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT)
    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
    -> setWrapText (true);

		
$sheet->getStyle('A3:D3')
	->getFont()
	->setBold(true)
	->setName('Arial')
    -> SetSize (10); 
		
$sheet->getRowDimension("1")->setRowHeight(25);
$sheet->getRowDimension("2")->setRowHeight(25);












// header Background color
    $excel->getActiveSheet()->getStyle('A4:O4')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('D3D3D3');
 



		
	
  // Set lebar kolom
  $sheet->getColumnDimension('A')->setWidth(20);
  $sheet->getColumnDimension('B')->setWidth(20);
  $sheet->getColumnDimension('C')->setWidth(20);
  $sheet->getColumnDimension('D')->setWidth(50);



  // set title kolom
  $sheet->setCellValue('A4', 'NIK');
  $sheet->setCellValue('B4', 'NAMA');
  $sheet->setCellValue('C4', 'TIPE_USER');
  $sheet->setCellValue('D4', 'RINCIAN');

  


  
  
	$sheet->getStyle('A4:O4')
			->getFont()
			->setBold(true)
			->setName('Arial')
            ->SetSize (12); 
	




	for ($k=1;$k<=4;$k++)
		{
		//jadikan kolom dan nilai		
		$kolomya = $arrrkoloma[$k];
		
		
		
		$excel->getActiveSheet()->getStyle(''.$kolomya.'4')
		    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
		$excel->getActiveSheet()->getStyle(''.$kolomya.'4')
		    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
		    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
		    -> setWrapText (true); 
		$excel->getActiveSheet()->getStyle(''.$kolomya.'4')
		    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$excel->getActiveSheet()->getStyle(''.$kolomya.'4')
		    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$excel->getActiveSheet()->getStyle(''.$kolomya.'4')
		    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$excel->getActiveSheet()->getStyle(''.$kolomya.'4')
		    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		}		


	//netralkan
	$k = 0;







  // menampilkan data 
  $sql = "SELECT * FROM m_orang ".
  			"ORDER BY nama ASC";
  $rs = mysqli_query($koneksi, $sql) or die ($sql);

  $i = 5;
  while ($row = mysqli_fetch_array($rs)) 
  	{
  	$e_no = $e_no + 1;
	$e_kd = balikin($row['kd']);
	$e_nip = balikin($row['nip']);
	$e_nama = balikin($row['nama']);
	$e_filex = balikin($row['filex1']);
	$e_tipe = balikin($row['tipe_user']);
	$e_jabatan = balikin($row['jabatan']);
	$e_tgl_lahir = balikin($row['tgl_lahir']);
	 

	//jika edit / baru
	$fotoku = "../../filebox/pegawai/$e_kd/$e_nip-1.jpg";
	
	//nek ada foto
	if (file_exists($fotoku))
		{
		$nil_foto1 = "../../filebox/pegawai/$e_kd/$e_nip-1.jpg";
		$nil_foto12 = "../../filebox/pegawai/$e_kd/thumb-$e_nip-1.jpg";
		$nil_foto13 = "../../filebox/pegawai/$e_kd/marker$e_nip-1.jpg";
		}
	else
		{
		$nil_foto1 = "../../img/foto_blank.png";
		}

	
	
	
	
	
	
	
	//jumlah kontribusi
	$qyuk21 = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
										"WHERE kontributor_kd = '$e_kd' ".
										"ORDER BY postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);

	
	
	
	

	//isi *START
	ob_start();


	echo "$tyuk21 KONTRIBUSI. 

";


		//list history perilaku masyarakat
		$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
											"WHERE kontributor_kd = '$e_kd' ".
											"ORDER BY postdate DESC");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
		
		//jika ada
		if (!empty($tyuk))
			{
			//hight
			$excel->getActiveSheet()->getRowDimension($i)->setRowHeight(300);

  
			
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
					$kakak_era = "PENUGASAN : 
$i_tugaskan_postdate";
					}
					
				else
					{
					$kakak_era = "BELUM ADA PENUGASAN";
					}
			
			
			
					
				echo "$i_no. Nama Tempat :
$i_nama_lokasi. 

Kejadian :
$i_postdate

Kategori Tempat :
$i_kategori_tempat

Tipe Laporan :
$i_tipe_laporan

Alamat : 
$i_alamat_googlemap

$kakak_era


";
				
				}
			while ($ryuk = mysqli_fetch_assoc($qyuk));
			
			
			//netralkan..
			$i_no = 0;
			}

	
	//isi
	$i_rincian = ob_get_contents();
	ob_end_clean();

	
	
	





  

    // buat baris dam kolom pada excel
    $sheet->setCellValue('A'.$i, $e_nip);
    $sheet->setCellValue('B'.$i, $e_nama);
    $sheet->setCellValue('C'.$i, $e_tipe);
    $sheet->setCellValue('D'.$i, $i_rincian);






	for ($k=1;$k<=4;$k++)
		{
		//jadikan kolom dan nilai		
		$kolomya = $arrrkoloma[$k];
		
		
		
		$excel->getActiveSheet()->getStyle("$kolomya$i")
		    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
		$excel->getActiveSheet()->getStyle("$kolomya$i")
		    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
		    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
		    -> setWrapText (true); 
		$excel->getActiveSheet()->getStyle("$kolomya$i")
		    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$excel->getActiveSheet()->getStyle("$kolomya$i")
		    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$excel->getActiveSheet()->getStyle("$kolomya$i")
		    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$excel->getActiveSheet()->getStyle("$kolomya$i")
		    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		}		


	

    $i++;
  	}









$ke = "lap_perilaku_per_kontributor.xlsx";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$ke.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($excel);
$writer->save('php://output');
exit();
?>