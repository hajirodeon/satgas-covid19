<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_jml_perilaku.php";
$judul = "PER JUMLAH PERILAKU";
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


$ekat = balikin($_REQUEST['ekat']);


//jika null, kasi default
if (empty($ekat))
	{
	$ekat = "m1";
	} 



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//tampilkan
if ($_POST['btnTPL'])
	{
	//ambil nilai
	$ekat = cegah($_POST['ekat']);
	
	//re-direct
	$ke = "$filenya?ekat=$ekat";
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
	


<script src="../../template/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../template/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>






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




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>




<div class="box box-success box-solid">


<?php
//masker
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS tmaskerpake ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_masker = balikin($ryuk1['tmaskerpake']);




//masker tidak
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_masker_tidak_pake) AS tmaskertidakpake ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_masker_tidak = balikin($ryuk1['tmaskertidakpake']);



//jagajarak
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_jaga_jarak) AS tjagajarak ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_jagajarak = balikin($ryuk1['tjagajarak']);



//jagajarak tidak
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_jaga_jarak_tidak) AS tjagajaraktidak ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_jagajarak_tidak = balikin($ryuk1['tjagajaraktidak']);



//diingatkan
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_diingatkan) AS tdiingatkan ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_diingatkan = balikin($ryuk1['tdiingatkan']);



//diingatkan tidak
$qyuk1 = mysqli_query($koneksi, "SELECT SUM(jml_diingatkan_tidak) AS tdiingatkantidak ".
									"FROM e_perilaku_masyarakat");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_diingatkan_tidak = balikin($ryuk1['tdiingatkantidak']);




//total orang
$total_orang = $yuk1_masker + $yuk1_masker_tidak + $yuk1_jagajarak + $yuk1_jagajarak_tidak + $yuk1_diingatkan + $yuk1_diingatkan_tidak;
?>


<!-- /.box-header -->
<div class="box-body">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

		<canvas id="demobar_jml_perilaku"></canvas>


      	<script  type="text/javascript">

    	  var ctx = document.getElementById("demobar_jml_perilaku").getContext("2d");
    	  var data = {
    	            labels: ["Memakai Masker","Tidak Memakai Masker","Jaga Jarak","Tidak Jaga Jarak","Diingatkan","Tidak Diingatkan"],
    	            datasets: [
    	            {
    	              label: "Status",
    	              data: ["<?php echo $yuk1_masker;?>", "<?php echo $yuk1_masker_tidak;?>", "<?php echo $yuk1_jagajarak;?>", "<?php echo $yuk1_jagajarak_tidak;?>", "<?php echo $yuk1_diingatkan;?>", "<?php echo $yuk1_diingatkan_tidak;?>"],
                    backgroundColor: [
                      "#E52B50",
                      "#FFBF00",
                      "#9966CC",
                      "#FBCEB1", 
                      "#7FFFD4", 
                      "#007FFF"]
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
    
    
    
    var url_base64 = document.getElementById('demobar_jml_perilaku').toDataURL('image/png');
    
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
//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';


if ($ekat == "m1")
	{
	$eraku = "Memakai Masker";
	}
	
else if ($ekat == "m2")
	{
	$eraku = "Tidak Memakai Masker";
	}
	
else if ($ekat == "j1")
	{
	$eraku = "Jaga Jarak";
	}
	
else if ($ekat == "j2")
	{
	$eraku = "Tidak Jaga Jarak";
	}
	
	
else if ($ekat == "d1")
	{
	$eraku = "Diingatkan";
	}
	
	
else if ($ekat == "d2")
	{
	$eraku = "Tidak Diingatkan";
	}







//hitung total
$qyuk = mysqli_query($koneksi, "SELECT SUM(jml_masker_pake) AS total_masker_pake, ".
									"SUM(jml_masker_tidak_pake) AS total_masker_tidak, ".
									"SUM(jml_jaga_jarak) AS total_jaga_jarak, ".
									"SUM(jml_jaga_jarak_tidak) AS total_jaga_jarak_tidak, ".
									"SUM(jml_ingatkan) AS total_ingatkan, ".
									"SUM(jml_ingatkan_tidak) AS total_ingatkan_tidak ".
									"FROM e_perilaku_masyarakat");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      




echo '<select name="ekat" class="btn btn-warning" required>
<option value="'.$ekat.'" selected>'.$eraku.'</option>
<option value="m1">Memakai Masker ['.$yuk_masker_pake.' Orang]</option>
<option value="m2">Tidak Memakai Masker ['.$yuk_masker_tidak.' Orang]</option>
<option value="j1">Jaga Jarak ['.$yuk_jaga_jarak.' Orang]</option>
<option value="j2">Tidak Jaga Jarak ['.$yuk_jaga_jarak_tidak.' Orang]</option>
<option value="d1">Diingatkan ['.$yuk_ingatkan.' Orang]</option>
<option value="d2">Tidak Diingatkan ['.$yuk_ingatkan_tidak.' Orang]</option>
</select>

<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">



<hr>


<a id="link" download="grafik_perilaku_jml_perilaku.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>


<a href="grafik_perilaku_jml_perilaku_xls.php" class="btn btn-danger">EXPORT EXCEL >></a>
<hr>




	<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
        <tr valign="top" bgcolor="'.$warnaheader.'">
            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
			<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
			<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
			<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
			<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
			<th><strong><font color="'.$warnatext.'">JUMLAH</font></strong></th>
			<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
			<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
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
											"FROM e_perilaku_masyarakat");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$yuk_masker_pake = balikin($ryuk['total_masker_pake']);
		$yuk_masker_tidak = balikin($ryuk['total_masker_tidak']);
		$yuk_jaga_jarak = balikin($ryuk['total_jaga_jarak']);
		$yuk_jaga_jarak_tidak = balikin($ryuk['total_jaga_jarak_tidak']);
		$yuk_ingatkan = balikin($ryuk['total_ingatkan']);
		$yuk_ingatkan_tidak = balikin($ryuk['total_ingatkan_tidak']);
		$yuk_total_wong = $yuk_masker_pake + $yuk_masker_tidak + $yuk_jaga_jarak + $yuk_jaga_jarak_tidak + $yuk_ingatkan + $yuk_ingatkan_tidak;      
		

				
		if ($ekat == "m1")
			{
			$etotal = $yuk_masker_pake;
			}
			
		else if ($ekat == "m2")
			{
			$etotal = $yuk_masker_tidak;
			}
			
		else if ($ekat == "j1")
			{
			$etotal = $yuk_jaga_jarak;
			}
			
		else if ($ekat == "j2")
			{
			$etotal = $yuk_jaga_jarak_tidak;
			}
			
			
		else if ($ekat == "d1")
			{
			$etotal = $yuk_ingatkan;
			}
			
			
		else if ($ekat == "d2")
			{
			$etotal = $yuk_ingatkan_tidak;
			}
		
		
				
				
		
		echo '<tfoot>
            <tr valign="top" bgcolor="'.$warnaheader.'">
	            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
				<th><strong><font color="'.$warnatext.'">FOTO</font></strong></th>
				<th><strong><font color="'.$warnatext.'">KATEGORI</font></strong></th>
				<th><strong><font color="'.$warnatext.'">TIPE_LAPORAN</font></strong></th>
				<th><strong><font color="'.$warnatext.'">NAMA_LOKASI</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JUMLAH<br>'.$etotal.' ORANG</font></strong></th>
				<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
				<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
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
		"pageLength": 5,  
		"language": {
					"url": "../Indonesian.json",
					"sEmptyTable": "Tidak ada data di database"
				}, 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'i_grafik_perilaku_jml_perilaku_data.php?ekat=<?php echo $ekat;?>'
        },
        'columns': [
            { data: 'postdate' },
            { data: 'foto' },
            { data: 'kategori_tempat' },
            { data: 'tipe_laporan' },
            { data: 'nama_lokasi' },
            { data: 'jumlah' },
            { data: 'alamat' },
            { data: 'gps' },
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