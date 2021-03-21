<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_panic_button_kategori.php";
$judul = "PER KATEGORI MASALAH";
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






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
	mysqli_query($koneksi, "INSERT INTO panic_kategori_masalah(kd, tanggal, postdate) VALUES 
								('$xyz', '$i_tglku', '$today')");

	
	
	//membaca semua data, trus masukin ke satu table
	$empQuery = "SELECT * FROM m_kategori_masalah ".
					"ORDER by nama ASC";
	$empRecords = mysqli_query($koneksi, $empQuery);
	
	while ($row = mysqli_fetch_assoc($empRecords)) 
		{
		//nilai
		$nomer = $nomer + 1;
		$i_kec = cegah($row['nama']);


		//korban
		$qyuk = mysqli_query($koneksi, "SELECT DISTINCT(korban_kd) AS total ".
											"FROM umum_sesi_penolong ".
											"WHERE postdate LIKE '$i_tglku%' ".
											"AND kategori_masalah = '$i_kec'");
		$ryuk = mysqli_fetch_assoc($qyuk);
		$tjml_korban = mysqli_num_rows($qyuk);
		
	

		
		//update
		mysqli_query($koneksi, "UPDATE panic_kategori_masalah SET nil$nomer = '$tjml_korban' ".
									"WHERE kd = '$xyz'");
		}
		
		
	//netralkan
	$nomer = 0;
	}
//masukin semua ke database ///////////////////////////////////////////////////////////////////////////
	















//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require("../template_atas.php");


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
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




<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>



          	
<div class="box box-success box-solid">
         	            


<!-- /.box-header -->
<div class="box-body">
  	
  	
		<canvas id="demobar_perilaku5"></canvas>


      	<script  type="text/javascript">

    	  var ctx = document.getElementById("demobar_perilaku5").getContext("2d");
    	  var data = {
    	            labels: [
					<?php
					//query x-1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_kategori_masalah ".
													"ORDER BY nama ASC");
					$rku = mysqli_fetch_assoc($qku);
					$tku = mysqli_num_rows($qku);
					$tku2 = $tku - 1;
					
					//tampilkan
					$qku = mysqli_query($koneksi, "SELECT * FROM m_kategori_masalah ".
													"ORDER BY nama ASC LIMIT 0,$tku2");
					$rku = mysqli_fetch_assoc($qku);
					$tku = mysqli_num_rows($qku);
					
					
					do 
						{
						$i_nama = balikin($rku['nama']);
			
						echo "\"$i_nama\", ";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					
					
					
					
					//query -1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_kategori_masalah ".
													"ORDER BY nama DESC LIMIT 0,1");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = balikin($rku['nama']);
			
						echo "\"$i_nama\"";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					?>


    	            
    	            ],
    	            datasets: [
    	            {
    	              label: "GRAFIK KATEGORI",
    	              data: [
    	              
    	            <?php  
					//query x-1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_kategori_masalah ".
													"ORDER BY nama ASC LIMIT 0,$tku2");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = cegah($rku['nama']);
			
						//jml user e
						$qku2 = mysqli_query($koneksi, "SELECT kd FROM umum_user_panic ".
														"WHERE kategori_masalah = '$i_nama'");
						$rku2 = mysqli_fetch_assoc($qku2);
						$tku2 = mysqli_num_rows($qku2);
			
			
						echo "\"$tku2\", ";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					
					
					
					
					//query -1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_kategori_masalah ".
													"ORDER BY nama DESC LIMIT 0,1");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = cegah($rku['nama']);

						//jml user e
						$qku2 = mysqli_query($koneksi, "SELECT kd FROM umum_user_panic ".
														"WHERE kategori_masalah = '$i_nama'");
						$rku2 = mysqli_fetch_assoc($qku2);
						$tku2 = mysqli_num_rows($qku2);
			
						echo "\"$tku2\"";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					?>

    	              
    	              ],
                    backgroundColor: [

					<?php
					//query x-1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_warna ".
													"ORDER BY round(kd) ASC");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_no = balikin($rku['kd']);
						$i_nama = balikin($rku['kode']);
			
						echo "\"$i_nama\", ";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					
					
					
					
					//query -1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_warna ".
													"ORDER BY round(kd) DESC LIMIT 0,1");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_no = balikin($rku['kd']);
						$i_nama = balikin($rku['kode']);
			
						echo "\"$i_nama\"";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					?>



						]
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
<!-- /.box-body -->




</div>


	
	
<script>
$(document).ready(function() {
  		
	$.noConflict();
    
    
    var url_base64 = document.getElementById('demobar_perilaku5').toDataURL('image/png');
    
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



<script src="../../template/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../template/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>




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

echo '<form action="'.$filenya.'" method="post" name="formx">


<input name="e_tgl1" id="e_tgl1" type="text" size="10" value="'.$e_tgl1x.'" class="btn btn-warning">

Sampai 

<input name="e_tgl2" id="e_tgl2" type="text" size="10" value="'.$e_tgl2x.'" class="btn btn-warning">


<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">
<hr>



<a id="link" download="grafik_panic_button_kategori_masalah-'.$e_tgl1.'-sampai-'.$e_tgl2.'.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>


<a href="grafik_panic_button_kategori_xls.php?e_tgl1='.$e_tgl12.'&e_tgl2='.$e_tgl22.'" class="btn btn-danger">EXPORT EXCEL >></a>
<hr>





	<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
        <tr valign="top" bgcolor="'.$warnaheader.'">
            <th><strong><font color="'.$warnatext.'">TANGGAL</font></strong></th>';
			
						
			//query 
			$qku = mysqli_query($koneksi, "SELECT * FROM m_kategori_masalah ".
												"ORDER by nama ASC");
			$rku = mysqli_fetch_assoc($qku);
			
			
			do 
				{
				$i_nama = balikin($rku['nama']);
	
				echo '<th><strong><font color="'.$warnatext.'">'.$i_nama.'</font></strong></th>';
				}
			while ($rku = mysqli_fetch_assoc($qku));
	

        echo '</tr>
        </thead>';

		
		echo '<tfoot>
	        <tr valign="top" bgcolor="'.$warnaheader.'">
	            <th><strong><font color="'.$warnatext.'">TANGGAL</font></strong></th>';
				
					//query 
					$qku = mysqli_query($koneksi, "SELECT * FROM m_kategori_masalah ".
														"ORDER by nama ASC");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = balikin($rku['nama']);
			
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
            'url':'i_grafik_panic_button_kategori_data.php?e_tgl1=<?php echo $e_tgl12;?>&e_tgl2=<?php echo $e_tgl22;?>'
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
            { data: 'nil13' }
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