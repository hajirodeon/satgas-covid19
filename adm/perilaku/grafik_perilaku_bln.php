<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_bln.php";
$judul = "PER BULAN";
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


$e_tgl1 = balikin($_REQUEST['e_tgl1']);
$e_tgl2 = balikin($_REQUEST['e_tgl2']);

$e_tgl12 = cegah($_REQUEST['e_tgl1']);
$e_tgl22 = cegah($_REQUEST['e_tgl2']);





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







$ekat = cegah($_REQUEST['ekat']);


//jika belum
if ($ekat == "pbp")
	{
	$ekatket = "Belum Diproses";
	}
else if ($ekat == "pp")
	{
	$ekatket = "Proses";
	}
else if ($ekat == "pb")
	{
	$ekatket = "Berhasil";
	}
	








//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tampilkan
if ($_POST['btnTPL2'])
	{
	//ambil nilai
	$ekat = cegah($_POST['ekat']);
	$e_tgl1 = cegah($_POST['e_tgl1']);
	$e_tgl2 = cegah($_POST['e_tgl2']);

	
	//re-direct
	$ke = "$filenya?e_tgl1=$e_tgl1&e_tgl2=$e_tgl2&ekat=$ekat";
	xloc($ke);
	exit();
	}





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




//total
$qyuk1x = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat");
$tyuk1x = mysqli_num_rows($qyuk1x);





//belum diproses
$qyuk1 = mysqli_query($koneksi, "SELECT e_perilaku_masyarakat.* ".
									"FROM e_perilaku_masyarakat, perilaku_satgas ".
									"WHERE e_perilaku_masyarakat.kd = perilaku_satgas.perilaku_kd ".
									"AND perilaku_satgas.tugaskan = 'false' ".
									"AND e_perilaku_masyarakat.postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$tyuk1 = mysqli_num_rows($qyuk1);



//proses
$qyuk2 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
									"WHERE tugaskan = 'true' ".
									"AND tugaskan_postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$tyuk2 = mysqli_num_rows($qyuk2);




//berhasil
$qyuk3 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
									"WHERE tugaskan = 'true' ".
									"AND notif = 'true'  ".
									"AND notif_postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$tyuk3 = mysqli_num_rows($qyuk3);

//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






require("../template_atas.php");


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>	
	




<script src="../../template/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../template/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>






<script language='javascript'>
//membuat document jquery
$(document).ready(function(){

    
    
    $('#e_tgl1').datepicker({
        format: "mm/yyyy",
        weekStart: 1,
		startView: 1,
		maxViewMode: 1,
        autoclose: true,
    })
    

    $('#e_tgl2').datepicker({
        format: "mm/yyyy",
        weekStart: 1,
		startView: 1,
		maxViewMode: 1,
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
	$e_tgl1x = "$bulan/$tahun";
	}

//jika null
if (empty($e_tgl2))
	{
	$e_tgl2x = "$bulan/$tahun";
	}



echo '<form action="'.$filenya.'" method="post" name="formx3">


<input name="e_tgl1" id="e_tgl1" type="text" size="10" value="'.$e_tgl1x.'" class="btn btn-warning">

Sampai 

<input name="e_tgl2" id="e_tgl2" type="text" size="10" value="'.$e_tgl2x.'" class="btn btn-warning">


<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">


</form>';
?>





  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $sumber;?>/template/adminlte/dist/css/skins/skins-biasawae.css">








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






<div class="box box-success box-solid">

        	            	            

<?php
//total
$qyuk1x = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat");
$tyuk1x = mysqli_num_rows($qyuk1x);





//belum diproses
$qyuk1 = mysqli_query($koneksi, "SELECT DISTINCT(perilaku_kd) AS omegat ".
									"FROM perilaku_satgas ".
									"WHERE tugaskan = 'false' ".
									"AND postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$tyuk1 = mysqli_num_rows($qyuk1);



//proses
$qyuk2 = mysqli_query($koneksi, "SELECT DISTINCT(perilaku_kd) AS omegat ".
									"FROM perilaku_satgas ".
									"WHERE tugaskan = 'true' ".
									"AND tugaskan_postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$tyuk2 = mysqli_num_rows($qyuk2);




//berhasil
$qyuk3 = mysqli_query($koneksi, "SELECT DISTINCT(perilaku_kd) AS omegat ".
									"FROM perilaku_satgas ".
									"WHERE tugaskan = 'true' ".
									"AND notif = 'true'  ".
									"AND notif_postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
$tyuk3 = mysqli_num_rows($qyuk3);



?>


<!-- /.box-header -->
<div class="box-body">



<?php


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$e_tgl1x = $e_tgl1;
$e_tgl2x = $e_tgl2;


//jika null
if (empty($e_tgl1))
	{
	$e_tgl1x = "$bulan/$tahun";
	}

//jika null
if (empty($e_tgl2))
	{
	$e_tgl2x = "$bulan/$tahun";
	}



?>



	
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>





		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

		<canvas id="demobar_perilaku"></canvas>


      	<script  type="text/javascript">

    	  var ctx = document.getElementById("demobar_perilaku").getContext("2d");
    	  var data = {
    	            labels: ["Belum Diproses","Proses","Berhasil"],
    	            datasets: [
    	            {
    	              label: "Status",
    	              data: ["<?php echo $tyuk1;?>", "<?php echo $tyuk2;?>", "<?php echo $tyuk3;?>"],
                    backgroundColor: [
                      "rgba(59, 100, 222, 1)",
                      "rgba(203, 222, 225, 0.9)",
                      "rgba(102, 50, 179, 1)"]
    	            }
    	            ]
    	            };

    	  var myBarChart = new Chart(ctx, {
    	            type: 'pie',
    	            data: data,
    	            options: {
                    	responsive: true, 
                    	legend: {
				            display: true,
				            position:'left',
				            labels: {
				                fontColor: 'rgb(255, 99, 132)'
				            }
				        },
				        
						tooltips: {
						    enabled: true
						  },
						  plugins: {
						    datalabels: {
						      formatter: (value, ctx) => {
						
						        let sum = ctx.dataset._meta[0].total;
						        let percentage = (value * 100 / sum).toFixed(2) + "%";
						        return percentage;
						
						
						      },
						      color: '#fff',
						    }
					 	}
					 
    	          	}
    	        });
    	</script>




	</div>



</div>





<script>
$(document).ready(function() {
  		
	$.noConflict();
    
    
    
    var url_base64 = document.getElementById('demobar_perilaku').toDataURL('image/png');
    
    link.href = url_base64;
});
</script>
  

	
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




<?php
echo '<hr>
<form action="'.$filenya.'" method="post" name="formx2">
<a id="link" download="grafik_perilaku_bln-'.$e_tgl1.'-sampai-'.$e_tgl2.'.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>


<a href="grafik_perilaku_bln_xls.php?e_tgl1='.$e_tgl12.'&e_tgl2='.$e_tgl22.'" class="btn btn-danger">EXPORT EXCEL >></a>
<hr>



<select name="ekat" class="btn btn-warning" required>
<option value="'.$ekat.'" selected>'.$ekatket.'</option>
<option value="pbp">Belum Diproses ['.$tyuk1.' Laporan]</option>
<option value="pp">Proses ['.$tyuk2.' Laporan]</option>
<option value="pb">Berhasil ['.$tyuk3.' Laporan]</option>
</select>



<input name="e_tgl1" type="hidden" value="'.$e_tgl1x.'">
<input name="e_tgl2" type="hidden" value="'.$e_tgl2x.'">

<input name="btnTPL2" type="submit" value="TAMPILKAN >>" class="btn btn-danger">

</form>



<form action="'.$filenya.'" method="post" name="formx">



	<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
        <tr valign="top" bgcolor="'.$warnaheader.'">
            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
			<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
			<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
			<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
			<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
			<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
			<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
			<th><strong><font color="'.$warnatext.'">JML ORANG</font></strong></th>
			<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER</font></strong></th>
			<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER</font></strong></th>
			<th><strong><font color="'.$warnatext.'">JML JAGA JARAK</font></strong></th>
			<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK</font></strong></th>
			<th><strong><font color="'.$warnatext.'">JML DIINGATKAN</font></strong></th>
			<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN</font></strong></th>
			<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
        </tr>
        </thead>';

		//hitung total
		$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS total_masker_pake, ".
											"SUM(jml_masker_tidak_pake) AS total_masker_tidak, ".
											"SUM(jml_jaga_jarak) AS total_jaga_jarak, ".
											"SUM(jml_jaga_jarak_tidak) AS total_jaga_jarak_tidak, ".
											"SUM(jml_ingatkan) AS total_ingatkan, ".
											"SUM(jml_ingatkan_tidak) AS total_ingatkan_tidak ".
											"FROM e_perilaku_masyarakat ".
											"WHERE postdate between '$tgl1_postdate%' AND '$tgl2_postdate%'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
		$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
		$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
		$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
		$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
		$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
		$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      
		
		
		
		echo '<tfoot>
            <tr valign="top" bgcolor="'.$warnaheader.'">
	            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
				<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
				<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
				<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
				<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
				<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
				<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML ORANG <br>'.$yuk_total_wong.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER<br>'.$yuk_masker_pake.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER<br>'.$yuk_masker_tidak.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML JAGA JARAK<br>'.$yuk_jaga_jarak.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK<br>'.$yuk_jaga_jarak_tidak.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML DIINGATKAN<br>'.$yuk_ingatkan.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN<br>'.$yuk_ingatkan_tidak.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
            </tr>
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
        "order": [[ 0, "desc" ]],  
		"lengthChange": false, 
		"pageLength": 1,  
		"language": {
					"url": "../Indonesian.json",
					"sEmptyTable": "Tidak ada data di database"
				}, 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'i_grafik_perilaku_bln_data.php?ekat=<?php echo $ekat;?>&e_tgl1=<?php echo $e_tgl12;?>&e_tgl2=<?php echo $e_tgl22;?>'
        },
        'columns': [
            { data: 'postdate' },
            { data: 'foto' },
            { data: 'kategori_tempat' },
            { data: 'tipe_laporan' },
            { data: 'nama_lokasi' },
            { data: 'alamat' },
            { data: 'gps' },
            { data: 'jml_orang' },
            { data: 'jml_memakai_masker' },
            { data: 'jml_tidak_memakai_masker' },
            { data: 'jml_jaga_jarak' },
            { data: 'jml_tidak_jaga_jarak' },
            { data: 'jml_diingatkan' },
            { data: 'jml_tidak_diingatkan' },
            { data: 'kontributor_nama' }
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