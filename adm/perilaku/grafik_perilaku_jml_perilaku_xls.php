<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_jml_perilaku_xls.php";
$judul = "PER JML PERILAKU";
$judulku = "[PERILAKU MASYARAKAT] $judul";
$judulx = $judul;





//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require '../../inc/class/phpspreadsheet/vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$excel = new Spreadsheet();
$sheet = $excel->getActiveSheet();
$sheet = $excel->getActiveSheet()->setTitle('lap_perilaku_per_jml_perilaku');

// Set properties
$excel->getProperties()->setCreator("SatgasCovid19Kendal")
							->setLastModifiedBy("SatgasCovid19Kendal");


$sheet->getPageSetup()->setOrientation(PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);







// judul
$sheet->setCellValue('A1', 'LAPORAN PERILAKU MASYARAKAT');
$sheet->setCellValue('A2', 'PER JUMLAH PERILAKU MASYARAKAT');
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
    $excel->getActiveSheet()->getStyle('A4:N4')->getFill()
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
  $sheet->getColumnDimension('I')->setWidth(20);
  $sheet->getColumnDimension('J')->setWidth(20);
  $sheet->getColumnDimension('K')->setWidth(20);
  $sheet->getColumnDimension('L')->setWidth(20);
  $sheet->getColumnDimension('M')->setWidth(20);
  $sheet->getColumnDimension('N')->setWidth(50);
		


  // set title kolom
  $sheet->setCellValue('A4', 'POSTDATE');;
  $sheet->setCellValue('B4', 'KATEGORI_TEMPAT');
  $sheet->setCellValue('C4', 'TIPE_LAPORAN');
  $sheet->setCellValue('D4', 'NAMA_LOKASI');
  $sheet->setCellValue('E4', 'ALAMAT');
  $sheet->setCellValue('F4', 'GPS');
  $sheet->setCellValue('G4', 'JML_ORANG');
  $sheet->setCellValue('H4', 'JML_MEMAKAI_MASKER');
  $sheet->setCellValue('I4', 'JML_TIDAK_MEMAKAI_MASKER');
  $sheet->setCellValue('J4', 'JML_JAGA_JARAK');
  $sheet->setCellValue('K4', 'JML_TIDAK_JAGA_JARAK');
  $sheet->setCellValue('L4', 'JML_DIINGATKAN');
  $sheet->setCellValue('M4', 'JML_TIDAK_DIINGATKAN');
  $sheet->setCellValue('N4', 'KONTRIBUTOR');





	for ($k=1;$k<=14;$k++)
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
  $sql = "SELECT * FROM e_perilaku_masyarakat ".
  			"ORDER BY postdate DESC";
  $rs = mysqli_query($koneksi, $sql) or die ($sql);

  $i = 5;
  while ($row = mysqli_fetch_array($rs)) 
  	{
  	$e_no = $e_no + 1;
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
    $sheet->setCellValue('B'.$i, $i_kategori_tempat);
    $sheet->setCellValue('C'.$i, $i_tipe_laporan);
    $sheet->setCellValue('D'.$i, $i_nama_lokasi);
    $sheet->setCellValue('E'.$i, "$i_alamat, Kelurahan $i_kelurahan, Kecamatan $i_kec");
    $sheet->setCellValue('F'.$i, "$i_lat_x, $i_lat_y 
$i_alamat_googlemap");
    $sheet->setCellValue('G'.$i, "$i_jml_orang");
    $sheet->setCellValue('H'.$i, "$i_jml_masker_pake");
    $sheet->setCellValue('I'.$i, "$i_jml_masker_tidak_pake");
    $sheet->setCellValue('J'.$i, "$i_jml_jaga_jarak");
    $sheet->setCellValue('K'.$i, "$i_jml_jaga_jarak_tidak");
    $sheet->setCellValue('L'.$i, "$i_jml_ingatkan");
    $sheet->setCellValue('M'.$i, "$i_jml_ingatkan_tidak");
    $sheet->setCellValue('N'.$i, "$i_k_nik. $i_k_nama [$i_k_tipe][Telp.$i_k_kontak]");
	



	for ($k=1;$k<=14;$k++)
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






$ke = "lap_perilaku_per_jml_perilaku.xlsx";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$ke.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($excel);
$writer->save('php://output');
exit();
?>