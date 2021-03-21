<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_instansi.php";
$judul = "FORWARD INSTANSI";
$judulku = "[PERILAKU MASYARAKAT] $judul";
$judulx = $judul;
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require '../../inc/class/phpspreadsheet/vendor/autoload.php';



use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$excel = new Spreadsheet();
$sheet = $excel->getActiveSheet();
$sheet = $excel->getActiveSheet()->setTitle('lap_perilaku_forward_instansi');

// Set properties
$excel->getProperties()->setCreator("SatgasCovid19Kendal")
							->setLastModifiedBy("SatgasCovid19Kendal");


$sheet->getPageSetup()->setOrientation(PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);



// judul
$sheet->setCellValue('A1', 'LAPORAN PERILAKU MASYARAKAT');
$sheet->setCellValue('A2', 'PER FORWARD INSTANSI');
$sheet->setCellValue('A3', 'Sumber : '.$sumber.'');
$sheet->setCellValue('D3', 'Postdate Download : '.$today.'');
$sheet->mergeCells("A1:D1");
$sheet->mergeCells("A2:D2");
$sheet->mergeCells("A3:B3");
//$sheet->mergeCells("C3:D3");

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
  $sheet->getColumnDimension('B')->setWidth(30);
  $sheet->getColumnDimension('C')->setWidth(20);
  $sheet->getColumnDimension('D')->setWidth(50);



  // set title kolom
  $sheet->setCellValue('A4', 'NIK');
  $sheet->setCellValue('B4', 'NAMA');
  $sheet->setCellValue('C4', 'TIPE_USER');
  $sheet->setCellValue('D4', 'RINCIAN');
  
  
  
	$sheet->getStyle('A4:D4')
			->getFont()
			->setBold(true)
			->setName('Arial')
            -> SetSize (12); 
            
            


		
	$excel->getActiveSheet()->getStyle('A4')
	    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
	$excel->getActiveSheet()->getStyle('A4')
	    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
	    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
	    -> setWrapText (true); 
	$excel->getActiveSheet()->getStyle('A4')
	    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('A4')
	    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('A4')
	    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('A4')
	    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		


		
	$excel->getActiveSheet()->getStyle('B4')
	    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
	$excel->getActiveSheet()->getStyle('B4')
	    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
	    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
	    -> setWrapText (true); 
	$excel->getActiveSheet()->getStyle('B4')
	    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('B4')
	    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('B4')
	    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('B4')
	    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);



		
	$excel->getActiveSheet()->getStyle('C4')
	    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
	$excel->getActiveSheet()->getStyle('C4')
	    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
	    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
	    -> setWrapText (true); 
	$excel->getActiveSheet()->getStyle('C4')
	    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('C4')
	    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('C4')
	    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('C4')
	    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);




		
	$excel->getActiveSheet()->getStyle('D4')
	    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
	$excel->getActiveSheet()->getStyle('D4')
	    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
	    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
	    -> setWrapText (true); 
	$excel->getActiveSheet()->getStyle('D4')
	    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('D4')
	    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('D4')
	    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('D4')
	    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);









  // menampilkan data users
  $sql = "SELECT * FROM m_orang ".
  			"ORDER BY nama ASC";
  $rs = mysqli_query($koneksi, $sql) or die ($sql);

  $i = 5;
  while ($row = mysqli_fetch_array($rs)) 
  	{
  	$e_no = $e_no + 1;
    $e_kd = balikin($row['kd']);
    $e_nik = balikin($row['nip']);
    $e_nama = balikin($row['nama']);
    $e_tipe = balikin($row['tipe_user']);
	






	//isi *START
	ob_start();

		//ketahui jumlahnya
		$qyuk21 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
											"WHERE perilaku_kd <> '' ".
											"AND orang_kd = '$e_kd' ".
											"AND tugaskan = 'true' ".
											"ORDER BY tugaskan_postdate DESC");
		$ryuk21 = mysqli_fetch_assoc($qyuk21);
		$tyuk21 = mysqli_num_rows($qyuk21);


		echo "$tyuk21 PENUGASAN

";


		//list history perilaku masyarakat
		$qyuk = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
											"ORDER BY postdate DESC");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tyuk = mysqli_num_rows($qyuk);
	

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
			
			
			//list detail status
			$qyuk2 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
												"WHERE perilaku_kd = '$i_kd' ".
												"AND orang_kd = '$e_kd' ".
												"AND tugaskan = 'true' ".
												"ORDER BY tugaskan_postdate DESC");
			$ryuk2 = mysqli_fetch_assoc($qyuk2);
			$tyuk2 = mysqli_num_rows($qyuk2);
			$yuk_tugaskan_postdate = balikin($ryuk2['tugaskan_postdate']);
			$yuk_aksi_postdate = balikin($ryuk2['aksi_postdate']);
			$yuk_aksi_ket = balikin($ryuk2['aksi_ket']);
			


			//echo "$i_nama_lokasi [$tyuk2]<br>";
	
	
	
	
		
			//jika ada tugas, munculkan
			if (!empty($tyuk2))
				{
				//hight
				$sheet->getRowDimension($i)->setRowHeight(300);
	
		
				
				$i_no = $i_no + 1;


echo ''.$i_no.'. Nama Tempat : 
'.$i_nama_lokasi.'

Kejadian : 
<b>'.$i_postdate.'</b>

Kategori Tempat :
<b>'.$i_kategori_tempat.'</b>

Tipe Laporan :
<b>'.$i_tipe_laporan.'</b>

Alamat :
'.$i_alamat_googlemap.'


';
				
//jika null
if (empty($yuk_aksi_ket))
	{
	$yuk_aksi_ketx = "<font color='red'>Belum Melakukan Apapun</font>";
	
	echo "BENTUK AKSI LAPANGAN : 
<b>$yuk_aksi_ketx</b>";					
	}
else
	{
	$yuk_aksi_ketx = "<font color='green'>$yuk_aksi_postdate. $yuk_aksi_ket</font>";
	
	
	echo "POSTDATE RESPON AKSI :
<b>$yuk_tugaskan_postdate</b>

BENTUK AKSI LAPANGAN : 
<b>$yuk_aksi_ketx</b>";										
	}

	
	
	
echo '



';
	
		
	
				}
			
			}
		while ($ryuk = mysqli_fetch_assoc($qyuk));



		//netralkan
		$i_no = 0;
	
	//isi
	$e_rincian = strip_tags(trim(ob_get_contents()));
	
	//$e_rincian = trim(ob_get_contents());
	ob_end_clean();



    // buat baris dam kolom pada excel
    $sheet->setCellValue('A'.$i, $e_nik);
    $sheet->setCellValue('B'.$i, $e_nama);
    $sheet->setCellValue('C'.$i, $e_tipe);
    $sheet->setCellValue('D'.$i, $e_rincian);





					
		
	$excel->getActiveSheet()->getStyle('A'.$i)
	    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
	$excel->getActiveSheet()->getStyle('A'.$i)
	    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
	    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
	    -> setWrapText (true); 
	$excel->getActiveSheet()->getStyle('A'.$i)
	    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('A'.$i)
	    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('A'.$i)
	    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('A'.$i)
	    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		


		
	$excel->getActiveSheet()->getStyle('B'.$i)
	    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
	$excel->getActiveSheet()->getStyle('B'.$i)
	    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
	    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
	    -> setWrapText (true); 
	$excel->getActiveSheet()->getStyle('B'.$i)
	    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('B'.$i)
	    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('B'.$i)
	    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('B'.$i)
	    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		




		
	$excel->getActiveSheet()->getStyle('C'.$i)
	    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
	$excel->getActiveSheet()->getStyle('C'.$i)
	    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
	    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
	    -> setWrapText (true); 
	$excel->getActiveSheet()->getStyle('C'.$i)
	    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('C'.$i)
	    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('C'.$i)
	    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('C'.$i)
	    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		






		
	$excel->getActiveSheet()->getStyle('D'.$i)
	    ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
	$excel->getActiveSheet()->getStyle('D'.$i)
	    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT)
	    -> SetVertical (\PhpOffice\PhpSpreadsheet\Style\Alignment:: VERTICAL_TOP)
	    -> setWrapText (true); 
	$excel->getActiveSheet()->getStyle('D'.$i)
	    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('D'.$i)
	    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('D'.$i)
	    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	$excel->getActiveSheet()->getStyle('D'.$i)
	    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		















    $i++;
  	}




$ke = "lap_perilaku_forward_instansi.xlsx";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$ke.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($excel);
$writer->save('php://output');
exit();
?>