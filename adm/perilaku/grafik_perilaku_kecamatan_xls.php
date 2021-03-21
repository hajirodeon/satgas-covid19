<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_kecamatan_xls.php";
$judul = "PER KECAMATAN";
$judulku = "[PERILAKU MASYARAKAT] $judul";
$judulx = $judul;





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
$tgl2_tgl = trim($tgl2_pecahku[0]);
$tgl2_bln = trim($tgl2_pecahku[1]);
$tgl2_thn = trim($tgl2_pecahku[2]);
$tgl2_postdate = "$tgl2_thn-$tgl2_bln-$tgl2_tgl";









//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require '../../inc/class/phpspreadsheet/vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$excel = new Spreadsheet();
$sheet = $excel->getActiveSheet();
$sheet = $excel->getActiveSheet()->setTitle('lap_perilaku_per_kecamatan');

// Set properties
$excel->getProperties()->setCreator("SatgasCovid19Kendal")
							->setLastModifiedBy("SatgasCovid19Kendal");


$sheet->getPageSetup()->setOrientation(PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);






// judul
$sheet->setCellValue('A1', 'LAPORAN PERILAKU MASYARAKAT');
$sheet->setCellValue('A2', 'PER KECAMATAN');
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
	
$sheet->getStyle('C3:C3')
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
    $excel->getActiveSheet()->getStyle('A4:U4')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('D3D3D3');
 


	for ($k=1;$k<=21;$k++)
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




		
		
	
  // Set lebar kolom
  $sheet->getColumnDimension('A')->setWidth(20);



  // set title kolom
  $sheet->setCellValue('A4', 'TANGGAL');;
  
  
  //list kecamatan
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
										"WHERE id_kabkota = '46' ". //kendal
										"ORDER by nama_kecamatan ASC");
	$rku = mysqli_fetch_assoc($qku);
	
	
	do 
		{
		$i_kecno = $i_kecno + 1;
		$i_nama = balikin($rku['nama_kecamatan']);
		
		//jadikan kolom
		$i_kolku = $i_kecno + 1;
		$kolomya = $arrrkoloma[$i_kolku];

		$sheet->setCellValue(''.$kolomya.'4', ''.$i_nama.'');
		$sheet->getColumnDimension($kolomya)->setWidth(20);
		}
	while ($rku = mysqli_fetch_assoc($qku));
	

  
  
  	//netralkan
  	$i_kecno = 0;



  
  //wrap
  $excel->getDefaultStyle()->getAlignment()->setWrapText(true);


  // menampilkan data 
  $sql = "select DISTINCT(DATE(postdate)) AS tglku ".
			"from e_perilaku_masyarakat ".
			"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'  ".
  			"ORDER BY postdate DESC";
  $rs = mysqli_query($koneksi, $sql) or die ($sql);

  $i = 5;
  while ($row = mysqli_fetch_array($rs)) 
  	{
  	$e_no = $e_no + 1;
	$i_tglku = balikin($row['tglku']);



	//hight
	$excel->getActiveSheet()->getRowDimension($i)->setRowHeight(120);




	$sheet->setCellValue("A$i", "$i_tglku
TOTAL
PAKAI_MASKER
TIDAK_PAKAI_MASKER
JAGAJARAK
TIDAK_JAGAJARAK
DIINGATKAN
TIDAK_DIINGATKAN");




  //list kecamatan
	$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
										"WHERE id_kabkota = '46' ". //kendal
										"ORDER by nama_kecamatan ASC");
	$rku = mysqli_fetch_assoc($qku);
	
	
	do 
		{
		$i_kecno = $i_kecno + 1;
		$i_nama = balikin($rku['nama_kecamatan']);
		
		//kolom mulai B
		$i_kecno2 = $i_kecno + 1;
		
		
		


		//total
		$qyuu = mysqli_query($koneksi, "select * from perilaku_total ".
										"WHERE tanggal = '$i_tglku' ".
										"ORDER BY postdate DESC");
		$ryuu = mysqli_fetch_assoc($qyuu);
		$tyuu = mysqli_num_rows($qyuu);
		$i_tnil1 = intval(balikin($ryuu['nil1']));		
		$i_nixkode = "nil$i_kecno";
		$i_tnilku = intval(balikin($ryuu[$i_nixkode]));





		//masker
		$qyuu = mysqli_query($koneksi, "select * from perilaku_masker ".
										"WHERE tanggal = '$i_tglku' ".
										"ORDER BY postdate DESC");
		$ryuu = mysqli_fetch_assoc($qyuu);
		$tyuu = mysqli_num_rows($qyuu);
		$i_mnil1 = intval(balikin($ryuu['nil1']));		
		$i_nixkode = "nil$i_kecno";
		$i_mnilku = intval(balikin($ryuu[$i_nixkode]));


		//masker tidak
		$qyuu = mysqli_query($koneksi, "select * from perilaku_masker_tidak ".
										"WHERE tanggal = '$i_tglku' ".
										"ORDER BY postdate DESC");
		$ryuu = mysqli_fetch_assoc($qyuu);
		$tyuu = mysqli_num_rows($qyuu);
		$i_mtnil1 = intval(balikin($ryuu['nil1']));
		$i_nixkode = "nil$i_kecno";
		$i_mtnilku = intval(balikin($ryuu[$i_nixkode]));



	
		//jagajarak
		$qyuu = mysqli_query($koneksi, "select * from perilaku_jagajarak ".
										"WHERE tanggal = '$i_tglku' ".
										"ORDER BY postdate DESC");
		$ryuu = mysqli_fetch_assoc($qyuu);
		$tyuu = mysqli_num_rows($qyuu);
		$i_jjnil1 = intval(balikin($ryuu['nil1']));
		$i_nixkode = "nil$i_kecno";
		$i_jjnilku = intval(balikin($ryuu[$i_nixkode]));


	
		//jagajarak tidak
		$qyuu = mysqli_query($koneksi, "select * from perilaku_jagajarak_tidak ".
										"WHERE tanggal = '$i_tglku' ".
										"ORDER BY postdate DESC");
		$ryuu = mysqli_fetch_assoc($qyuu);
		$tyuu = mysqli_num_rows($qyuu);
		$i_jtnil1 = intval(balikin($ryuu['nil1']));
		$i_nixkode = "nil$i_kecno";
		$i_jtnilku = intval(balikin($ryuu[$i_nixkode]));


	
		//ingatkan
		$qyuu = mysqli_query($koneksi, "select * from perilaku_ingatkan ".
										"WHERE tanggal = '$i_tglku' ".
										"ORDER BY postdate DESC");
		$ryuu = mysqli_fetch_assoc($qyuu);
		$tyuu = mysqli_num_rows($qyuu);
		$i_innil1 = intval(balikin($ryuu['nil1']));
		$i_nixkode = "nil$i_kecno";
		$i_innilku = intval(balikin($ryuu[$i_nixkode]));
	



	
		//ingatkan tidak
		$qyuu = mysqli_query($koneksi, "select * from perilaku_ingatkan_tidak ".
										"WHERE tanggal = '$i_tglku' ".
										"ORDER BY postdate DESC");
		$ryuu = mysqli_fetch_assoc($qyuu);
		$tyuu = mysqli_num_rows($qyuu);
		$i_itnil1 = intval(balikin($ryuu['nil1']));
		$i_nixkode = "nil$i_kecno";
		$i_itnilku = intval(balikin($ryuu[$i_nixkode]));
	






		//jadikan kolom dan nilai		
		$kolomya = $arrrkoloma[$i_kecno2];		
		$sheet->setCellValue("$kolomya$i", "$i_tglku 
$i_tnilku
$i_mnilku
$i_mtnilku
$i_jjnilku
$i_jtnilku
$i_innilku
$i_itnilku");
	
		





	
		for ($k=1;$k<=21;$k++)
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


		}
	while ($rku = mysqli_fetch_assoc($qku));
	
	
	
	

	//netralkan
	$i_kecno = 0;



    $i++;
  	}







$ke = "lap_perilaku_per_kecamatan.xlsx";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$ke.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($excel);
$writer->save('php://output');
exit();
?>