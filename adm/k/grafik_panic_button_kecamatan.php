<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_panic_button_kecamatan.php";
$judul = "PER KECAMATAN";
$judulku = "[PANIC BUTTON] $judul";
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


$e_tgl1 = balikin($_REQUEST['e_tgl1']);
$e_tgl2 = balikin($_REQUEST['e_tgl2']);

$e_tgl12 = cegah($_REQUEST['e_tgl1']);
$e_tgl22 = cegah($_REQUEST['e_tgl2']);





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
/*
//bikin dua puluh kode kecamatan
for ($k=1;$k<=20;$k++)
	{
	$column = "nil$k";
	$sql = "ALTER TABLE perilaku_ingatkan_tidak ADD {$column} VARCHAR(10) NULL DEFAULT NULL; " ;
	mysqli_query($koneksi, $sql); 
	}
*/






//masukin semua ke database ///////////////////////////////////////////////////////////////////////////
//list
$empQuery2 = "SELECT DISTINCT(DATE(postdate)) AS tglku ".
				"FROM umum_sesi_penolong ".
				"ORDER BY postdate ASC";
$empRecords2 = mysqli_query($koneksi, $empQuery2);

while ($row2 = mysqli_fetch_assoc($empRecords2)) 
	{
	//nilai
	$i_tglku = balikin($row2['tglku']);


	//insert
	$xyz = md5("$i_tglku");
	mysqli_query($koneksi, "INSERT INTO panic_kec_korban(kd, tanggal, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");
								
	mysqli_query($koneksi, "INSERT INTO panic_kec_penolong(kd, tanggal, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");
								
	mysqli_query($koneksi, "INSERT INTO panic_kec_tolong(kd, tanggal, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");
								
	mysqli_query($koneksi, "INSERT INTO panic_kec_tolong_tidak(kd, tanggal, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");
								
								
	mysqli_query($koneksi, "INSERT INTO panic_kec_total(kd, tanggal, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");
	
	
	
	
	//membaca semua data, trus masukin ke satu table
	$empQuery = "SELECT * FROM m_ikecamatan ".
					"WHERE id_kabkota = '46' ". //kendal
					"ORDER by nama_kecamatan ASC";
	$empRecords = mysqli_query($koneksi, $empQuery);
	
	while ($row = mysqli_fetch_assoc($empRecords)) 
		{
		//nilai
		$nomer = $nomer + 1;
		$i_kec = cegah($row['nama_kecamatan']);


		//korban
		$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS total ".
											"FROM umum_sesi_penolong ".
											"WHERE postdate LIKE '$i_tglku%' ".
											"AND kecamatan = '$i_kec'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tjml_korban = mysqli_num_rows($qyuk);
		
		
		//penolong
		$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(penolong_kd) AS total ".
											"FROM umum_sesi_penolong ".
											"WHERE postdate LIKE '$i_tglku%' ".
											"AND kecamatan = '$i_kec'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tjml_penolong = mysqli_num_rows($qyuk);
		
		
		//ditolong
		$qyuk = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
											"WHERE notif = 'true' ".
											"AND postdate LIKE '$i_tglku%' ".
											"AND kecamatan = '$i_kec'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tjml_ditolong = mysqli_num_rows($qyuk);


		//ditolong tidak
		$qyuk = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
											"WHERE notif = 'false' ".
											"AND postdate LIKE '$i_tglku%' ".
											"AND kecamatan = '$i_kec'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tjml_ditolong_tidak = mysqli_num_rows($qyuk);


		//total kejadian
		$ttotal = $tjml_ditolong + $tjml_ditolong_tidak;


	

		
		//update
		mysqli_query($koneksi, "UPDATE panic_kec_tolong SET nil$nomer = '$tjml_ditolong' ".
									"WHERE kd = '$xyz'");
		
		//update
		mysqli_query($koneksi, "UPDATE panic_kec_tolong_tidak SET nil$nomer = '$tjml_ditolong_tidak' ".
									"WHERE kd = '$xyz'");
		
		//update
		mysqli_query($koneksi, "UPDATE panic_kec_penolong SET nil$nomer = '$tjml_penolong' ".
									"WHERE kd = '$xyz'");
		
		//update
		mysqli_query($koneksi, "UPDATE panic_kec_korban SET nil$nomer = '$tjml_korban' ".
									"WHERE kd = '$xyz'");
		
		//update
		mysqli_query($koneksi, "UPDATE panic_kec_total SET nil$nomer = '$ttotal' ".
									"WHERE kd = '$xyz'");
		}
		
		
	//netralkan
	$nomer = 0;
	}
//masukin semua ke database ///////////////////////////////////////////////////////////////////////////
	















//tampilkan
if ($_POST['btnTPL'])
	{
	//ambil nilai
	$e_tgl1 = cegah($_POST['e_tgl1']);
	$e_tgl2 = cegah($_POST['e_tgl2']);
	
	
	//re-direct
	$ke = "$filenya?e_tgl1=$e_tgl1&e_tgl2=$e_tgl2";
	xloc($ke);
	exit();
	}

//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






require("../template_atas.php");


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>






<!-- jQuery 3 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo $sumber;?>/template/adminlte/dist/js/adminlte.min.js"></script>




<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<!-- Bootstrap core CSS -->
<link href="<?php echo $sumber;?>/template/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">



<!-- ChartJS -->
<script src="<?php echo $sumber;?>/template/adminlte/bower_components/chart.js/Chart.js"></script>


    
  


<!-- Bootstrap core JavaScript -->
<script src="<?php echo $sumber;?>/template/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $sumber;?>/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>





<script language='javascript'>
//membuat document jquery
$(document).ready(function(){


    $('#e_tgl1').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
    })
    

    $('#e_tgl2').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
    })
    
		
});

</script>
	

<?php


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$e_tgl1x = $e_tgl1;
$e_tgl2x = $e_tgl2;


//jika null
if (empty($e_tgl1))
	{
	$e_tgl1x = "$tanggal/$bulan/$tahun";
	}

//jika null
if (empty($e_tgl2))
	{
	$e_tgl2x = "$tanggal/$bulan/$tahun";
	}



echo '<form action="'.$filenya.'" method="post" name="formx">


<input name="e_tgl1" id="e_tgl1" type="text" size="10" value="'.$e_tgl1x.'" class="btn btn-warning">

Sampai 

<input name="e_tgl2" id="e_tgl2" type="text" size="10" value="'.$e_tgl2x.'" class="btn btn-warning">


<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">
<br>
<br>';

?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>




<div style="width: 100%; height: 400px" >
	<canvas id="perilaku_kecamatan" width="400" height="300"></canvas>
</div>



<script>
//deklarasi chartjs untuk membuat grafik 2d di id mychart 
var ctx = document.getElementById('perilaku_kecamatan').getContext('2d');

var myChart = new Chart(ctx, {
 //chart akan ditampilkan sebagai bar chart
    type: 'bar',
    data: {
     //membuat label chart
        labels: [<?php
					//query
					$qkux = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
														"WHERE id_kabkota = '46' ". //kendal
														"ORDER by round(id_kecamatan) ASC");
					$rkux = mysqli_fetch_assoc($qkux);
					$tkux = mysqli_num_rows($qkux);
					$tkux2 = $tkux - 1;
					
					
					//query x-1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
														"WHERE id_kabkota = '46' ". //kendal
														"ORDER by round(id_kecamatan) ASC LIMIT 0,$tkux2");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = balikin($rku['nama_kecamatan']);
			
						echo "'$i_nama', ";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					
					
					
					
					//query -1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
														"WHERE id_kabkota = '46' ". //kendal
														"ORDER by round(id_kecamatan) DESC LIMIT 0,1");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = balikin($rku['nama_kecamatan']);
			
						echo "'$i_nama'";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					?>

],
        datasets: [{
            label: '',
            //isi chart
            data: [<?php
					//total
					$qyuu = mysqli_query($koneksi, "select SUM(nil1) AS tnil1, ".
													"SUM(nil2) AS tnil2, ".
													"SUM(nil3) AS tnil3, ".
													"SUM(nil4) AS tnil4, ".
													"SUM(nil5) AS tnil5, ".
													"SUM(nil6) AS tnil6, ".
													"SUM(nil7) AS tnil7, ".
													"SUM(nil8) AS tnil8, ".
													"SUM(nil9) AS tnil9, ".
													"SUM(nil10) AS tnil10, ".
													"SUM(nil11) AS tnil11, ".
													"SUM(nil12) AS tnil12, ".
													"SUM(nil13) AS tnil13, ".
													"SUM(nil14) AS tnil14, ".
													"SUM(nil15) AS tnil15, ".
													"SUM(nil16) AS tnil16, ".
													"SUM(nil17) AS tnil17, ".
													"SUM(nil18) AS tnil18, ".
													"SUM(nil19) AS tnil19, ".
													"SUM(nil20) AS tnil20 ".
													"from panic_kec_total ".
													"WHERE tanggal between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
													"ORDER BY tanggal DESC");
					$ryuu = mysqli_fetch_assoc($qyuu);
					$tyuu = mysqli_num_rows($qyuu);
					$i_tnil1 = intval(balikin($ryuu['tnil1']));
					$i_tnil2 = intval(balikin($ryuu['tnil2']));
					$i_tnil3 = intval(balikin($ryuu['tnil3']));
					$i_tnil4 = intval(balikin($ryuu['tnil4']));
					$i_tnil5 = intval(balikin($ryuu['tnil5']));
					$i_tnil6 = intval(balikin($ryuu['tnil6']));
					$i_tnil7 = intval(balikin($ryuu['tnil7']));
					$i_tnil8 = intval(balikin($ryuu['tnil8']));
					$i_tnil9 = intval(balikin($ryuu['tnil9']));
					$i_tnil10 = intval(balikin($ryuu['tnil10']));
					$i_tnil11 = intval(balikin($ryuu['tnil11']));
					$i_tnil12 = intval(balikin($ryuu['tnil12']));
					$i_tnil13 = intval(balikin($ryuu['tnil13']));
					$i_tnil14 = intval(balikin($ryuu['tnil14']));
					$i_tnil15 = intval(balikin($ryuu['tnil15']));
					$i_tnil16 = intval(balikin($ryuu['tnil16']));
					$i_tnil17 = intval(balikin($ryuu['tnil17']));
					$i_tnil18 = intval(balikin($ryuu['tnil18']));
					$i_tnil19 = intval(balikin($ryuu['tnil19']));
					$i_tnil20 = intval(balikin($ryuu['tnil20']));
					?>		
            
					<?php echo $i_tnil1;?>, 
					<?php echo $i_tnil2;?>, 
					<?php echo $i_tnil3;?>, 
					<?php echo $i_tnil4;?>, 
					<?php echo $i_tnil5;?>, 
					<?php echo $i_tnil6;?>, 
					<?php echo $i_tnil7;?>, 
					<?php echo $i_tnil8;?>, 
					<?php echo $i_tnil9;?>, 
					<?php echo $i_tnil10;?>, 
					<?php echo $i_tnil11;?>, 
					<?php echo $i_tnil12;?>, 
					<?php echo $i_tnil13;?>, 
					<?php echo $i_tnil14;?>, 
					<?php echo $i_tnil15;?>, 
					<?php echo $i_tnil16;?>, 
					<?php echo $i_tnil17;?>, 
					<?php echo $i_tnil18;?>, 
					<?php echo $i_tnil19;?>, 
					<?php echo $i_tnil20;?>],
					
            //membuat warna pada bar chart
            backgroundColor: ["red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red"],
            borderColor: ["red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red", "red"],
            borderWidth: 1, 
            
            
        }, 
        
        
        {
            label: '',
            //isi chart
            data: [<?php
					//total
					$qyuu = mysqli_query($koneksi, "select SUM(nil1) AS tnil1, ".
													"SUM(nil2) AS tnil2, ".
													"SUM(nil3) AS tnil3, ".
													"SUM(nil4) AS tnil4, ".
													"SUM(nil5) AS tnil5, ".
													"SUM(nil6) AS tnil6, ".
													"SUM(nil7) AS tnil7, ".
													"SUM(nil8) AS tnil8, ".
													"SUM(nil9) AS tnil9, ".
													"SUM(nil10) AS tnil10, ".
													"SUM(nil11) AS tnil11, ".
													"SUM(nil12) AS tnil12, ".
													"SUM(nil13) AS tnil13, ".
													"SUM(nil14) AS tnil14, ".
													"SUM(nil15) AS tnil15, ".
													"SUM(nil16) AS tnil16, ".
													"SUM(nil17) AS tnil17, ".
													"SUM(nil18) AS tnil18, ".
													"SUM(nil19) AS tnil19, ".
													"SUM(nil20) AS tnil20 ".
													"from panic_kec_tolong ".
													"WHERE tanggal between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
													"ORDER BY tanggal DESC");
					$ryuu = mysqli_fetch_assoc($qyuu);
					$tyuu = mysqli_num_rows($qyuu);
					$i_tnil1 = intval(balikin($ryuu['tnil1']));
					$i_tnil2 = intval(balikin($ryuu['tnil2']));
					$i_tnil3 = intval(balikin($ryuu['tnil3']));
					$i_tnil4 = intval(balikin($ryuu['tnil4']));
					$i_tnil5 = intval(balikin($ryuu['tnil5']));
					$i_tnil6 = intval(balikin($ryuu['tnil6']));
					$i_tnil7 = intval(balikin($ryuu['tnil7']));
					$i_tnil8 = intval(balikin($ryuu['tnil8']));
					$i_tnil9 = intval(balikin($ryuu['tnil9']));
					$i_tnil10 = intval(balikin($ryuu['tnil10']));
					$i_tnil11 = intval(balikin($ryuu['tnil11']));
					$i_tnil12 = intval(balikin($ryuu['tnil12']));
					$i_tnil13 = intval(balikin($ryuu['tnil13']));
					$i_tnil14 = intval(balikin($ryuu['tnil14']));
					$i_tnil15 = intval(balikin($ryuu['tnil15']));
					$i_tnil16 = intval(balikin($ryuu['tnil16']));
					$i_tnil17 = intval(balikin($ryuu['tnil17']));
					$i_tnil18 = intval(balikin($ryuu['tnil18']));
					$i_tnil19 = intval(balikin($ryuu['tnil19']));
					$i_tnil20 = intval(balikin($ryuu['tnil20']));
					?>		
            
					<?php echo $i_tnil1;?>, 
					<?php echo $i_tnil2;?>, 
					<?php echo $i_tnil3;?>, 
					<?php echo $i_tnil4;?>, 
					<?php echo $i_tnil5;?>, 
					<?php echo $i_tnil6;?>, 
					<?php echo $i_tnil7;?>, 
					<?php echo $i_tnil8;?>, 
					<?php echo $i_tnil9;?>, 
					<?php echo $i_tnil10;?>, 
					<?php echo $i_tnil11;?>, 
					<?php echo $i_tnil12;?>, 
					<?php echo $i_tnil13;?>, 
					<?php echo $i_tnil14;?>, 
					<?php echo $i_tnil15;?>, 
					<?php echo $i_tnil16;?>, 
					<?php echo $i_tnil17;?>, 
					<?php echo $i_tnil18;?>, 
					<?php echo $i_tnil19;?>, 
					<?php echo $i_tnil20;?>],
            //membuat warna pada bar chart
            backgroundColor: ["green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green"],
            borderColor: ["green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green", "green"],
            borderWidth: 1, 
            
            
        },
        
        
        {
            label: '',
            //isi chart
            data: [<?php
					//total
					$qyuu = mysqli_query($koneksi, "select SUM(nil1) AS tnil1, ".
													"SUM(nil2) AS tnil2, ".
													"SUM(nil3) AS tnil3, ".
													"SUM(nil4) AS tnil4, ".
													"SUM(nil5) AS tnil5, ".
													"SUM(nil6) AS tnil6, ".
													"SUM(nil7) AS tnil7, ".
													"SUM(nil8) AS tnil8, ".
													"SUM(nil9) AS tnil9, ".
													"SUM(nil10) AS tnil10, ".
													"SUM(nil11) AS tnil11, ".
													"SUM(nil12) AS tnil12, ".
													"SUM(nil13) AS tnil13, ".
													"SUM(nil14) AS tnil14, ".
													"SUM(nil15) AS tnil15, ".
													"SUM(nil16) AS tnil16, ".
													"SUM(nil17) AS tnil17, ".
													"SUM(nil18) AS tnil18, ".
													"SUM(nil19) AS tnil19, ".
													"SUM(nil20) AS tnil20 ".
													"from panic_kec_tolong_tidak ".
													"WHERE tanggal between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
													"ORDER BY tanggal DESC");
					$ryuu = mysqli_fetch_assoc($qyuu);
					$tyuu = mysqli_num_rows($qyuu);
					$i_tnil1 = intval(balikin($ryuu['tnil1']));
					$i_tnil2 = intval(balikin($ryuu['tnil2']));
					$i_tnil3 = intval(balikin($ryuu['tnil3']));
					$i_tnil4 = intval(balikin($ryuu['tnil4']));
					$i_tnil5 = intval(balikin($ryuu['tnil5']));
					$i_tnil6 = intval(balikin($ryuu['tnil6']));
					$i_tnil7 = intval(balikin($ryuu['tnil7']));
					$i_tnil8 = intval(balikin($ryuu['tnil8']));
					$i_tnil9 = intval(balikin($ryuu['tnil9']));
					$i_tnil10 = intval(balikin($ryuu['tnil10']));
					$i_tnil11 = intval(balikin($ryuu['tnil11']));
					$i_tnil12 = intval(balikin($ryuu['tnil12']));
					$i_tnil13 = intval(balikin($ryuu['tnil13']));
					$i_tnil14 = intval(balikin($ryuu['tnil14']));
					$i_tnil15 = intval(balikin($ryuu['tnil15']));
					$i_tnil16 = intval(balikin($ryuu['tnil16']));
					$i_tnil17 = intval(balikin($ryuu['tnil17']));
					$i_tnil18 = intval(balikin($ryuu['tnil18']));
					$i_tnil19 = intval(balikin($ryuu['tnil19']));
					$i_tnil20 = intval(balikin($ryuu['tnil20']));
					?>		
            
					<?php echo $i_tnil1;?>, 
					<?php echo $i_tnil2;?>, 
					<?php echo $i_tnil3;?>, 
					<?php echo $i_tnil4;?>, 
					<?php echo $i_tnil5;?>, 
					<?php echo $i_tnil6;?>, 
					<?php echo $i_tnil7;?>, 
					<?php echo $i_tnil8;?>, 
					<?php echo $i_tnil9;?>, 
					<?php echo $i_tnil10;?>, 
					<?php echo $i_tnil11;?>, 
					<?php echo $i_tnil12;?>, 
					<?php echo $i_tnil13;?>, 
					<?php echo $i_tnil14;?>, 
					<?php echo $i_tnil15;?>, 
					<?php echo $i_tnil16;?>, 
					<?php echo $i_tnil17;?>, 
					<?php echo $i_tnil18;?>, 
					<?php echo $i_tnil19;?>, 
					<?php echo $i_tnil20;?>],
            //membuat warna pada bar chart
            backgroundColor: ["orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange"],
            borderColor: ["orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange", "orange"],
            borderWidth: 1, 
            
            
        },
        
        
        {
            label: '',
            //isi chart
            data: [<?php
					//total
					$qyuu = mysqli_query($koneksi, "select SUM(nil1) AS tnil1, ".
													"SUM(nil2) AS tnil2, ".
													"SUM(nil3) AS tnil3, ".
													"SUM(nil4) AS tnil4, ".
													"SUM(nil5) AS tnil5, ".
													"SUM(nil6) AS tnil6, ".
													"SUM(nil7) AS tnil7, ".
													"SUM(nil8) AS tnil8, ".
													"SUM(nil9) AS tnil9, ".
													"SUM(nil10) AS tnil10, ".
													"SUM(nil11) AS tnil11, ".
													"SUM(nil12) AS tnil12, ".
													"SUM(nil13) AS tnil13, ".
													"SUM(nil14) AS tnil14, ".
													"SUM(nil15) AS tnil15, ".
													"SUM(nil16) AS tnil16, ".
													"SUM(nil17) AS tnil17, ".
													"SUM(nil18) AS tnil18, ".
													"SUM(nil19) AS tnil19, ".
													"SUM(nil20) AS tnil20 ".
													"from panic_kec_penolong ".
													"WHERE tanggal between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
													"ORDER BY tanggal DESC");
					$ryuu = mysqli_fetch_assoc($qyuu);
					$tyuu = mysqli_num_rows($qyuu);
					$i_tnil1 = intval(balikin($ryuu['tnil1']));
					$i_tnil2 = intval(balikin($ryuu['tnil2']));
					$i_tnil3 = intval(balikin($ryuu['tnil3']));
					$i_tnil4 = intval(balikin($ryuu['tnil4']));
					$i_tnil5 = intval(balikin($ryuu['tnil5']));
					$i_tnil6 = intval(balikin($ryuu['tnil6']));
					$i_tnil7 = intval(balikin($ryuu['tnil7']));
					$i_tnil8 = intval(balikin($ryuu['tnil8']));
					$i_tnil9 = intval(balikin($ryuu['tnil9']));
					$i_tnil10 = intval(balikin($ryuu['tnil10']));
					$i_tnil11 = intval(balikin($ryuu['tnil11']));
					$i_tnil12 = intval(balikin($ryuu['tnil12']));
					$i_tnil13 = intval(balikin($ryuu['tnil13']));
					$i_tnil14 = intval(balikin($ryuu['tnil14']));
					$i_tnil15 = intval(balikin($ryuu['tnil15']));
					$i_tnil16 = intval(balikin($ryuu['tnil16']));
					$i_tnil17 = intval(balikin($ryuu['tnil17']));
					$i_tnil18 = intval(balikin($ryuu['tnil18']));
					$i_tnil19 = intval(balikin($ryuu['tnil19']));
					$i_tnil20 = intval(balikin($ryuu['tnil20']));
					?>		
            
					<?php echo $i_tnil1;?>, 
					<?php echo $i_tnil2;?>, 
					<?php echo $i_tnil3;?>, 
					<?php echo $i_tnil4;?>, 
					<?php echo $i_tnil5;?>, 
					<?php echo $i_tnil6;?>, 
					<?php echo $i_tnil7;?>, 
					<?php echo $i_tnil8;?>, 
					<?php echo $i_tnil9;?>, 
					<?php echo $i_tnil10;?>, 
					<?php echo $i_tnil11;?>, 
					<?php echo $i_tnil12;?>, 
					<?php echo $i_tnil13;?>, 
					<?php echo $i_tnil14;?>, 
					<?php echo $i_tnil15;?>, 
					<?php echo $i_tnil16;?>, 
					<?php echo $i_tnil17;?>, 
					<?php echo $i_tnil18;?>, 
					<?php echo $i_tnil19;?>, 
					<?php echo $i_tnil20;?>],
            //membuat warna pada bar chart
            backgroundColor: ["purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple"],
            borderColor: ["purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple", "purple"],
            borderWidth: 1, 
            
            
        },
        
        
        {
            label: '',
            //isi chart
            data: [<?php
					//total
					$qyuu = mysqli_query($koneksi, "select SUM(nil1) AS tnil1, ".
													"SUM(nil2) AS tnil2, ".
													"SUM(nil3) AS tnil3, ".
													"SUM(nil4) AS tnil4, ".
													"SUM(nil5) AS tnil5, ".
													"SUM(nil6) AS tnil6, ".
													"SUM(nil7) AS tnil7, ".
													"SUM(nil8) AS tnil8, ".
													"SUM(nil9) AS tnil9, ".
													"SUM(nil10) AS tnil10, ".
													"SUM(nil11) AS tnil11, ".
													"SUM(nil12) AS tnil12, ".
													"SUM(nil13) AS tnil13, ".
													"SUM(nil14) AS tnil14, ".
													"SUM(nil15) AS tnil15, ".
													"SUM(nil16) AS tnil16, ".
													"SUM(nil17) AS tnil17, ".
													"SUM(nil18) AS tnil18, ".
													"SUM(nil19) AS tnil19, ".
													"SUM(nil20) AS tnil20 ".
													"from panic_kec_korban ".
													"WHERE tanggal between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
													"ORDER BY tanggal DESC");
					$ryuu = mysqli_fetch_assoc($qyuu);
					$tyuu = mysqli_num_rows($qyuu);
					$i_tnil1 = intval(balikin($ryuu['tnil1']));
					$i_tnil2 = intval(balikin($ryuu['tnil2']));
					$i_tnil3 = intval(balikin($ryuu['tnil3']));
					$i_tnil4 = intval(balikin($ryuu['tnil4']));
					$i_tnil5 = intval(balikin($ryuu['tnil5']));
					$i_tnil6 = intval(balikin($ryuu['tnil6']));
					$i_tnil7 = intval(balikin($ryuu['tnil7']));
					$i_tnil8 = intval(balikin($ryuu['tnil8']));
					$i_tnil9 = intval(balikin($ryuu['tnil9']));
					$i_tnil10 = intval(balikin($ryuu['tnil10']));
					$i_tnil11 = intval(balikin($ryuu['tnil11']));
					$i_tnil12 = intval(balikin($ryuu['tnil12']));
					$i_tnil13 = intval(balikin($ryuu['tnil13']));
					$i_tnil14 = intval(balikin($ryuu['tnil14']));
					$i_tnil15 = intval(balikin($ryuu['tnil15']));
					$i_tnil16 = intval(balikin($ryuu['tnil16']));
					$i_tnil17 = intval(balikin($ryuu['tnil17']));
					$i_tnil18 = intval(balikin($ryuu['tnil18']));
					$i_tnil19 = intval(balikin($ryuu['tnil19']));
					$i_tnil20 = intval(balikin($ryuu['tnil20']));
					?>		
            
					<?php echo $i_tnil1;?>, 
					<?php echo $i_tnil2;?>, 
					<?php echo $i_tnil3;?>, 
					<?php echo $i_tnil4;?>, 
					<?php echo $i_tnil5;?>, 
					<?php echo $i_tnil6;?>, 
					<?php echo $i_tnil7;?>, 
					<?php echo $i_tnil8;?>, 
					<?php echo $i_tnil9;?>, 
					<?php echo $i_tnil10;?>, 
					<?php echo $i_tnil11;?>, 
					<?php echo $i_tnil12;?>, 
					<?php echo $i_tnil13;?>, 
					<?php echo $i_tnil14;?>, 
					<?php echo $i_tnil15;?>, 
					<?php echo $i_tnil16;?>, 
					<?php echo $i_tnil17;?>, 
					<?php echo $i_tnil18;?>, 
					<?php echo $i_tnil19;?>, 
					<?php echo $i_tnil20;?>],
            //membuat warna pada bar chart
            backgroundColor: ["blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue"],
            borderColor: ["blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue", "blue"],
            borderWidth: 1, 
            
            
        }]
    },
    options: {
		legend: {
			display: false
			}, 
        
        tooltips: {
            enabled: true
			},
				
		responsive: true,
		maintainAspectRatio: false,
		scales: {
		            xAxes: [{
		                ticks: {
		                    autoSkip: false,
		                    maxRotation: 45,
		                    minRotation: 45
		                }
		            }]
		        }
		        
		      

		        
		
        
  }
  


    
    
});
</script>





	
<script>
$(document).ready(function() {
  		
	$.noConflict();
    		
    var url_base64 = document.getElementById('perilaku_kecamatan').toDataURL('image/png');
    
    link.href = url_base64;

});
</script>
  


<?php
//korban
$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS total ".
									"FROM umum_sesi_penolong ".
									"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
									"AND kecamatan = '$i_kec'");
$ryuk = mysqli_fetch_assoc($qyuk);
$tjml_korban = mysqli_num_rows($qyuk);


//penolong
$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(penolong_kd) AS total ".
									"FROM umum_sesi_penolong ".
									"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
									"AND kecamatan = '$i_kec'");
$ryuk = mysqli_fetch_assoc($qyuk);
$tjml_penolong = mysqli_num_rows($qyuk);


//ditolong
$qyuk = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
									"WHERE notif = 'true' ".
									"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
									"AND kecamatan = '$i_kec'");
$ryuk = mysqli_fetch_assoc($qyuk);
$tjml_ditolong = mysqli_num_rows($qyuk);


//ditolong tidak
$qyuk = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
									"WHERE notif = 'false' ".
									"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%' ".
									"AND kecamatan = '$i_kec'");
$ryuk = mysqli_fetch_assoc($qyuk);
$tjml_ditolong_tidak = mysqli_num_rows($qyuk);


//total kejadian
$ttotal = $tjml_ditolong + $tjml_ditolong_tidak;





echo '<p>
<font color="red"><b>'.$ttotal.'</b> Total Kejadian</font>.
</p>

<p>
<font color="green"><b>'.$tjml_korban.'</b> Orang Korban</font>.
</p>

<p>
<font color="orange"><b>'.$tjml_penolong.'</b> Orang Penolong</font>.
</p>

<p>
<font color="purple"><b>'.$tjml_ditolong.'</b> Orang Berhasil Ditolong</font>.
</p>

<p>
<font color="blue"><b>'.$tjml_ditolong_tidak.'</b> Orang Gagal Ditolong</font>.
</p>';


?>



	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>




<!-- Datatable CSS -->
<link href='../../template/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

<!-- jQuery Library -->
<script src="../../template/js/jquery-3.3.1.min.js"></script>

<!-- Datatable JS -->
<script src="../../template/DataTables/datatables.min.js"></script>



<script src="../../template/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../template/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>




<?php

echo '<hr>



<a id="link" download="grafik_panic_button_kecamatan-'.$e_tgl1.'-sampai-'.$e_tgl2.'.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>




<a href="grafik_panic_button_kecamatan_xls.php?e_tgl1='.$e_tgl12.'&e_tgl2='.$e_tgl22.'" class="btn btn-danger">EXPORT EXCEL >></a>
<hr>




	<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
        <tr valign="top" bgcolor="'.$warnaheader.'">
            <th><strong><font color="'.$warnatext.'">TANGGAL</font></strong></th>';
			
						
			//query 
			$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
												"WHERE id_kabkota = '46' ". //kendal
												"ORDER by nama_kecamatan ASC");
			$rku = mysqli_fetch_assoc($qku);
			
			
			do 
				{
				$i_nama = balikin($rku['nama_kecamatan']);
	
				echo '<th><strong><font color="'.$warnatext.'">'.$i_nama.'</font></strong></th>';
				}
			while ($rku = mysqli_fetch_assoc($qku));
	

        echo '</tr>
        </thead>';

		
		echo '<tfoot>
	        <tr valign="top" bgcolor="'.$warnaheader.'">
	            <th><strong><font color="'.$warnatext.'">TANGGAL</font></strong></th>';
				
							
				//query 
				$qku = mysqli_query($koneksi, "SELECT * FROM m_ikecamatan ".
													"WHERE id_kabkota = '46' ". //kendal
													"ORDER by nama_kecamatan ASC");
				$rku = mysqli_fetch_assoc($qku);
				
				
				do 
					{
					$i_nama = balikin($rku['nama_kecamatan']);
		
					echo '<th><strong><font color="'.$warnatext.'">'.$i_nama.'</font></strong></th>';
					}
				while ($rku = mysqli_fetch_assoc($qku));
		
	
	        echo '</tr>
		</tfoot>

    </table>
</form>';

?>


 
 
<script>
$(document).ready(function(){


    var table = $('#empTable').DataTable({
		"scrollY": "100%",
		"scrollX": true,
		"scrollCollapse": true,
        "autoWidth": true, 
        "order": [[ 0, "ASC" ]],
		"language": {
					"url": "../Indonesian.json",
					"sEmptyTable": "Tidak ada data di database"
				}, 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'i_grafik_panic_button_kecamatan_data.php?e_tgl1=<?php echo $e_tgl12;?>&e_tgl2=<?php echo $e_tgl22;?>'
        },
        'columns': [
            { data: 'postdate' },
            { data: 'nil1' },
            { data: 'nil2' },
            { data: 'nil3' },
            { data: 'nil4' },
            { data: 'nil5' },
            { data: 'nil6' },
            { data: 'nil7' },
            { data: 'nil8' },
            { data: 'nil9' },
            { data: 'nil10' },
            { data: 'nil11' },
            { data: 'nil12' },
            { data: 'nil13' },
            { data: 'nil14' },
            { data: 'nil15' },
            { data: 'nil16' },
            { data: 'nil17' },
            { data: 'nil18' },
            { data: 'nil19' },
            { data: 'nil20' }
        ]
    });
    
    

});








</script>






<?php






require("../template_bawah.php");



//null-kan
xclose($koneksi);
exit();
?>