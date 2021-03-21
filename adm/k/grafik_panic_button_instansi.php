<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_panic_button_instansi.php";
$judul = "FORWARD INSTANSI";
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







$ekat = cegah($_REQUEST['ekat']);






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
	


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>


	
	<div style="width: 100%; height: 400px" >
	<canvas id="perilaku_instansi" width="400" height="300"></canvas>
	</div>
	
	<script>
	//deklarasi chartjs untuk membuat grafik 2d di id mychart 
	var ctx = document.getElementById('perilaku_instansi').getContext('2d');
	
	var myChart = new Chart(ctx, {
	 //chart akan ditampilkan sebagai bar chart
	type: 'bar',
	data: {
	 //membuat label chart
	    labels: [<?php
					//query x-1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"WHERE no <= 9 ".
														"ORDER by round(no) ASC");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = balikin($rku['nama']);
			
						echo "'$i_nama', ";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					
					
					
					
					//query -1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"WHERE no <= 9 ".
														"ORDER by round(no) DESC LIMIT 0,1");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = balikin($rku['nama']);
			
						echo "'$i_nama'";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					?>
	
	],
	        datasets: [{
	            label: '',
	        //isi chart
	        data: [<?php
					//query x-1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"WHERE no <= 9 ".
														"ORDER by round(no) ASC");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = cegah($rku['nama']);
	
	
						//jml
						$qyuk41 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
															"WHERE tugaskan = 'true' ".
															"AND penolong_tipe = '$i_nama'");
						$tyuk41 = mysqli_num_rows($qyuk41);
			
						echo "'$tyuk41', ";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					
					
					
					
					//query -1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"WHERE no <= 9 ".
														"ORDER by round(no) DESC LIMIT 0,1");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_nama = cegah($rku['nama']);
			
	
	
						//jml
						$qyuk41 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
															"WHERE tugaskan = 'true' ".
															"AND penolong_tipe = '$i_nama'");
						$tyuk41 = mysqli_num_rows($qyuk41);
			
						echo "'$tyuk41', ";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					?>
					],
	        //membuat warna pada bar chart
	        backgroundColor: [<?php
					//query x-1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_warna ".
													"ORDER BY round(kd) ASC");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_no = balikin($rku['kd']);
						$i_nama = balikin($rku['kode']);
			
						echo "'$i_nama', ";
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
			
						echo "'$i_nama'";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					?>
	        ],
	        borderColor: [<?php
					//query x-1
					$qku = mysqli_query($koneksi, "SELECT * FROM m_warna ".
													"ORDER BY round(kd) ASC");
					$rku = mysqli_fetch_assoc($qku);
					
					
					do 
						{
						$i_no = balikin($rku['kd']);
						$i_nama = balikin($rku['kode']);
			
						echo "'$i_nama', ";
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
			
						echo "'$i_nama'";
						}
					while ($rku = mysqli_fetch_assoc($qku));
					?>
	        ],
	        borderWidth: 1, 
	        
	        
	    }]
	},
	options: {
	    title: {
	        display: true,
	        text: 'Grafik PANIC BUTTON : Forward Instansi'
	    	},
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
		        }, 
		        
		      
	
	    hover: {
	        animationDuration: 1
	        }
			        
			
	        
	  }
	  
	
	
	   
	    
	});
	</script>
	
	



	
<script>
$(document).ready(function() {
  		
	$.noConflict();
    
    
    var url_base64 = document.getElementById('perilaku_instansi').toDataURL('image/png');
    
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




	
<script>
$(document).ready(function() {
  		
	$.noConflict();
    

});
</script>
  


<?php
echo '<form action="'.$filenya.'" method="post" name="formx">

<p>
<a id="link" download="grafik_panic_button_forward_instansi.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>


<a href="grafik_panic_button_instansi_xls.php" target="_blank" class="btn btn-danger">EXPORT EXCEL >></a>
</p>

<hr>';



//query
$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
								"WHERE kd = '$ekat'");
$rku = mysqli_fetch_assoc($qku);
$ekat_nama = cegah($rku['nama']);
$i_nama = cegah($rku['nama']);
$i_nama2 = balikin($rku['nama']);


if (empty($ekat))
	{
	//jumlah kontribusi
	$qyuk21 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
										"WHERE tugaskan = 'true' ".
										"ORDER BY postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);
	}
else
	{
	//jumlah kontribusi
	$qyuk21 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
										"WHERE tugaskan = 'true' ".
										"AND penolong_tipe = '$i_nama' ".
										"ORDER BY postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);		
	}





echo '<select name="ekat" class="btn btn-warning" required>
<option value="'.$i_nama.'" selected>'.$i_nama2.' [<b>'.$tyuk21.'</b> Penugasan]</option>';


//query
$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
								"WHERE no <= 9 ".
								"ORDER BY nama ASC");
$rku = mysqli_fetch_assoc($qku);

do 
	{
	$i_kd = cegah($rku['kd']);
	$i_nama = cegah($rku['nama']);
	$i_nama2 = balikin($rku['nama']);


	//jumlah kontribusi
	$qyuk21 = mysqli_query($koneksi, "SELECT * FROM umum_sesi_penolong ".
										"WHERE tugaskan = 'true' ".
										"AND penolong_tipe = '$i_nama' ".
										"ORDER BY postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);
	
	
	echo '<option value="'.$i_kd.'">'.$i_nama2.' [<b>'.$tyuk21.'</b> Penugasan]</option>';
	}
while ($rku = mysqli_fetch_assoc($qku));

echo '</select>

<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">
<hr>

	<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
        <tr valign="top" bgcolor="'.$warnaheader.'">
        <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
        <th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
		<th><strong><font color="'.$warnatext.'">RINCIAN</font></strong></th>
        </tr>
        </thead>';

		
		
		echo '<tfoot>
            <tr valign="top" bgcolor="'.$warnaheader.'">
	            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
				<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
				<th><strong><font color="'.$warnatext.'">RINCIAN</font></strong></th>
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
        "autoWidth": false,
        "columnDefs": [
			    { "width": "50%", "targets": 0 }
			  ],
        "order": [[ 0, "desc" ]],
		"language": {
					"url": "../Indonesian.json",
					"sEmptyTable": "Tidak ada data di database"
				}, 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'i_grafik_panic_button_instansi_data.php?ekat=<?php echo $ekat;?>'
        },
        'columns': [
            { data: 'postdate' },
            { data: 'satgas' },
            { data: 'rincian' }
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