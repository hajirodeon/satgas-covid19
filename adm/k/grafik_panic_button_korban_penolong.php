<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_panic_button_korban_penolong.php";
$judul = "PER KORBAN & PENOLONG";
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
//korban
$qyuk1 = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS totalku ".
									"FROM umum_sesi_penolong");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_korban = mysqli_num_rows($qyuk1);



//penolong
$qyuk1 = mysqli_query($koneksi, "SELECT DISTINCT(penolong_kd) AS totalku ".
									"FROM umum_sesi_penolong");
$ryuk1 = mysqli_fetch_assoc($qyuk1);
$yuk1_penolong = mysqli_num_rows($qyuk1);




//total orang
$total_orang = $yuk1_korban + $yuk1_penolong;
?>


<!-- /.box-header -->
<div class="box-body">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

		<canvas id="demobar_jml_perilaku"></canvas>


      	<script  type="text/javascript">

    	  var ctx = document.getElementById("demobar_jml_perilaku").getContext("2d");
    	  var data = {
    	            labels: ["Orang Korban","Orang Penolong"],
    	            datasets: [
    	            {
    	              label: "Status",
    	              data: ["<?php echo $yuk1_korban;?>", "<?php echo $yuk1_penolong;?>"],
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
	$eraku = "Korban";
	}
	
else if ($ekat == "m2")
	{
	$eraku = "Penolong";
	}
	



//hitung korban
$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS total ".
									"FROM umum_sesi_penolong");
$ryuk = mysqli_fetch_assoc($qyuk);
$jml_korban = mysqli_num_rows($qyuk);


//hitung penolong
$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(penolong_kd) AS total ".
									"FROM umum_sesi_penolong");
$ryuk = mysqli_fetch_assoc($qyuk);
$jml_penolong = mysqli_num_rows($qyuk);



$yuk_total_wong = $jml_korban + $jml_penolong;      




echo '<select name="ekat" class="btn btn-warning" required>
<option value="'.$ekat.'" selected>'.$eraku.'</option>
<option value="m1">Korban ['.$jml_korban.' Orang]</option>
<option value="m2">Penolong ['.$jml_penolong.' Orang]</option>
</select>

<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">



<hr>


<a id="link" download="grafik_panic_button_korban_penolong.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>


<a href="grafik_panic_button_korban_penolong_xls.php" class="btn btn-danger">EXPORT EXCEL >></a>
<hr>




	<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
        <tr valign="top" bgcolor="'.$warnaheader.'">
            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
            <th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
            <th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
			<th><strong><font color="'.$warnatext.'">PENOLONG</font></strong></th>
        </tr>
        </thead>';

				
		
		echo '<tfoot>
            <tr valign="top" bgcolor="'.$warnaheader.'">
	            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
	            <th><strong><font color="'.$warnatext.'">KORBAN <br> '.$jml_korban.'</font></strong></th>
	            <th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
				<th><strong><font color="'.$warnatext.'">PENOLONG <br> '.$jml_penolong.'</font></strong></th>
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
		"language": {
					"url": "../Indonesian.json",
					"sEmptyTable": "Tidak ada data di database"
				}, 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'i_grafik_panic_button_korban_penolong_data.php?ekat=<?php echo $ekat;?>'
        },
        'columns': [
            { data: 'postdate' },
            { data: 'korban' },
            { data: 'gps' },
            { data: 'penolong' }
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