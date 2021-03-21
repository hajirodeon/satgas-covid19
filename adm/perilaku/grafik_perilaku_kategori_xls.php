<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_kategori.php";
$judul = "PER TIPE LAPORAN";
$judulku = "[PERILAKU MASYARAKAT] $judul";
$judulx = $judul;






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require '../../inc/class/phpspreadsheet/vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$excel = new Spreadsheet();
$sheet = $excel->getActiveSheet();
$sheet = $excel->getActiveSheet()->setTitle('lap_perilaku_per_tipe_laporan');

// Set properties
$excel->getProperties()->setCreator("SatgasCovid19Kendal")
							->setLastModifiedBy("SatgasCovid19Kendal");


$sheet->getPageSetup()->setOrientation(PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);



// judul
$sheet->setCellValue('A1', 'LAPORAN PERILAKU MASYARAKAT');
$sheet->setCellValue('A2', 'PER TIPE LAPORAN');
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
    $excel->getActiveSheet()->getStyle('A4:D4')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('D3D3D3');
 


		
	
  // Set lebar kolom
  $sheet->getColumnDimension('A')->setWidth(20);
  $sheet->getColumnDimension('B')->setWidth(20);
  $sheet->getColumnDimension('C')->setWidth(20);
  $sheet->getColumnDimension('D')->setWidth(20);



  // set title kolom
  $sheet->setCellValue('A4', 'NAMA');
  $sheet->setCellValue('C4', 'RINCIAN');
	
  $sheet->mergeCells("A4:B4");
  $sheet->mergeCells("C4:D4");


  
  
	$sheet->getStyle('A4:D4')
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
  $sql = "SELECT * FROM e_m_tipe_laporan ".
  			"ORDER BY nama ASC";
  $rs = mysqli_query($koneksi, $sql) or die ($sql);

  $i = 5;
  while ($row = mysqli_fetch_array($rs)) 
  	{
  	$e_no = $e_no + 1;
	$e_kd = balikin($row['kd']);
	$e_nama = balikin($row['nama']);
	$e_nama2 = cegah($row['nama']);

	
	
	
	
	//jumlah kontribusi
	$qyuk21 = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
										"WHERE tipe_laporan = '$e_nama2' ".
										"ORDER BY postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);

	
	
	
	

	//isi *START
	ob_start();


	echo "$tyuk21 KONTRIBUSI. 

";


		//list history perilaku masyarakat
		$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
											"WHERE tipe_laporan = '$e_nama2' ".
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
				
				
				//detail orang
				$qkuy2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
													"WHERE kd = '$i_k_kd'");
				$rkuy2 = mysqli_fetch_assoc($qkuy2);
				$i_k_tipe = balikin($rkuy2['tipe_user']);
				$i_k_kontak = balikin($rkuy2['telp']);
				
							
			
			
					
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

Kontributor :
[$i_k_tipe]. $i_k_nik. $i_k_nama. [Telp.$i_k_kontak]


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
    $sheet->setCellValue('A'.$i, $e_nama);
    $sheet->setCellValue('C'.$i, $i_rincian);
	$sheet->mergeCells("A$i:B$i");
	$sheet->mergeCells("C$i:D$i");
  



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






$ke = "lap_perilaku_per_tipe_laporan.xlsx";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$ke.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($excel);
$writer->save('php://output');
exit();
?>