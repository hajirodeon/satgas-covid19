<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_panic_button_bln_xls.php";
$judul = "PER BULAN";
$judulku = "[PANIC BUTTON] $judul";
$judulx = $judul;


//nilai
$e_tgl1 = cegah($_REQUEST['e_tgl1']);
$e_tgl2 = cegah($_REQUEST['e_tgl2']);


//pecah tanggal
$tgl1_pecah = balikin($e_tgl1);
$tgl1_pecahku = explode("/", $tgl1_pecah);
$tgl1_bln = trim($tgl1_pecahku[0]);
$tgl1_thn = trim($tgl1_pecahku[1]);
$tgl1_postdate = "$tgl1_thn-$tgl1_bln-01";




//pecah tanggal
$tgl2_pecah = balikin($e_tgl2);
$tgl2_pecahku = explode("/", $tgl2_pecah);
$tgl2_bln = trim($tgl2_pecahku[0]);
$tgl2_thn = trim($tgl2_pecahku[1]);
$tgl2_postdate = "$tgl2_thn-$tgl2_bln-31";






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require '../../inc/class/phpspreadsheet/vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$excel = new Spreadsheet();
$sheet = $excel->getActiveSheet();
$sheet = $excel->getActiveSheet()->setTitle('lap_panic_button_per_bln');

// Set properties
$excel->getProperties()->setCreator("SatgasCovid19Kendal")
							->setLastModifiedBy("SatgasCovid19Kendal");


$sheet->getPageSetup()->setOrientation(PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);





// judul
$sheet->setCellValue('A1', 'LAPORAN PANIC BUTTON');
$sheet->setCellValue('A2', 'PER BULAN '.$tgl1_bln.' '.$tgl1_thn.' SAMPAI '.$tgl2_bln.' '.$tgl2_thn.'');
$sheet->setCellValue('A3', 'Sumber : '.$sumber.'');
$sheet->setCellValue('C3', 'Postdate Download : '.$today.'');
$sheet->mergeCells("A1:D1");
$sheet->mergeCells("A2:D2");
$sheet->mergeCells("A3:B3");
$sheet->mergeCells("C3:D3");

$sheet->getStyle('A1:C1')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
    -> setWrapText (true);
		

$sheet->getStyle('A2:C2')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
    -> setWrapText (true);

$sheet->getStyle('A1:C1')
	->getFont()
	->setBold(true)
	->setName('Arial')
    -> SetSize (16); 


$sheet->getStyle('A2:C2')
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

		
$sheet->getStyle('A3:C3')
	->getFont()
	->setBold(true)
	->setName('Arial')
    -> SetSize (10); 
		
$sheet->getRowDimension("1")->setRowHeight(25);
$sheet->getRowDimension("2")->setRowHeight(25);







// header Background color
    $excel->getActiveSheet()->getStyle('A4:H4')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('D3D3D3');
 




	
	
		
	
  // Set lebar kolom
  $sheet->getColumnDimension('A')->setWidth(20);
  $sheet->getColumnDimension('B')->setWidth(20);
  $sheet->getColumnDimension('C')->setWidth(30);
  $sheet->getColumnDimension('D')->setWidth(20);
  $sheet->getColumnDimension('E')->setWidth(50);
  $sheet->getColumnDimension('F')->setWidth(20);
  $sheet->getColumnDimension('G')->setWidth(20);
  $sheet->getColumnDimension('H')->setWidth(20);

	  
  
	$sheet->getStyle('A4:H4')
			->getFont()
			->setBold(true)
			->setName('Arial')
            -> SetSize (12); 
	
	
	
  // set title kolom
  $sheet->setCellValue('A4', 'POSTDATE');
  $sheet->setCellValue('B4', 'KORBAN');
  $sheet->setCellValue('C4', 'GPS');
  $sheet->setCellValue('D4', 'POSTDATE_DITOLONG');
  $sheet->setCellValue('E4', 'PENOLONG');
  $sheet->setCellValue('F4', 'KATEGORI_MASALAH');
  $sheet->setCellValue('G4', 'SOLUSI');
  $sheet->setCellValue('H4', 'KECAMATAN');






	for ($k=1;$k<=8;$k++)
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
  $sql = "SELECT * FROM umum_sesi_panic ".
  			"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
  			"ORDER BY postdate DESC";
  $rs = mysqli_query($koneksi, $sql) or die ($sql);

  $i = 5;
  while ($row = mysqli_fetch_array($rs)) 
  	{
  	$e_no = $e_no + 1;
	$i_kd = balikin($row['kd']);

	
	$i_postdate = balikin($row['postdate']);
	




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
		$kakak_era = $i_tugaskan_postdate;
		}
	else
		{		
		$kakak_era = 'Belum Ada SATGAS yang Ditugaskan';
		}



	//detail orang
	$qkuy2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
										"WHERE kd = '$i_k_kd'");
	$rkuy2 = mysqli_fetch_assoc($qkuy2);
	$i_k_tipe = balikin($rkuy2['tipe_user']);
	$i_k_kontak = balikin($rkuy2['telp']);
	

	//hight
	$excel->getActiveSheet()->getRowDimension($i)->setRowHeight(150);

    // buat baris dam kolom pada excel
    $sheet->setCellValue('A'.$i, $i_postdate);
    $sheet->setCellValue('B'.$i, $i_korban);
    $sheet->setCellValue('C'.$i, $i_gps);
    $sheet->setCellValue('D'.$i, $i_postdate_ditolong);
    $sheet->setCellValue('E'.$i, $i_penolong);
    $sheet->setCellValue('F'.$i, $i_kategori);
    $sheet->setCellValue('G'.$i, $i_solusi);
    $sheet->setCellValue('H'.$i, $i_kecamatan);





	for ($k=1;$k<=8;$k++)
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










$ke = "lap_panic_button-bln-$tgl1_thn-$tgl1_bln-sampai-$tgl2_thn-$tgl2_bln.xlsx";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$ke.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($excel);
$writer->save('php://output');
exit();
?>