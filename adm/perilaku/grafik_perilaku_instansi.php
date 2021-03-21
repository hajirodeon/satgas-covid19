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
						$qyuk41 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
															"WHERE tugaskan = 'true' ".
															"AND orang_tipe = '$i_nama'");
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
						$qyuk41 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
															"WHERE tugaskan = 'true' ".
															"AND orang_tipe = '$i_nama'");
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
	        text: 'Grafik Perilaku Masyarakat : Forward Instansi'
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
  






<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script>
	$(document).ready(function()
{
    $("[rel='tooltip']").tooltip();
});
</script>

<style>
	/* Global Styles */
@import 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
*, *:  before, *:after {
    -webkit-box-sizing: border-box !important;
    -moz-box-sizing: border-box !important;
    box-sizing: border-box !important;
}


a:hover{
    text-decoration:none;
}
/*page styling*/
.bs-callout {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #eee;
    border-image: none;
    border-radius: 3px;
    border-style: solid;
    border-width: 1px 1px 1px 5px;
    margin-bottom: 5px;
    padding: 20px;
}
.bs-right-panel{
	padding: 10px;
	width:100%;
	float:none;
	text-align:center;
	margin:0 auto;
}
.bs-right-panel img{
	width:100%;
	margin:0;
	padding:0;
	
}
.bs-callout:last-child {
    margin-bottom: 0px;
}
.bs-callout h4,
.bs-callout h5 {
    margin-bottom: 10px;
    margin-top: 5px;
    font-weight: 600;
}


.bs-callout-danger {
    border-left-color: #d9534f;
}

.bs-callout-danger h4,
.bs-callout-danger h5{
    color: #d9534f;
}



.bs-callout-info {
    border-left-color: cyan;
}

.bs-callout-info h4,
.bs-callout-info h5{
    color: cyan;
}






.bs-callout-primary {
    border-left-color: blue;
}

.bs-callout-primary h4,
.bs-callout-primary h5{
    color: blue;
}






.bs-callout-warning {
    border-left-color: orange;
}

.bs-callout-warning h4,
.bs-callout-warning h5{
    color: orange;
}







.bs-callout-success {
    border-left-color: green;
}

.bs-callout-success h4,
.bs-callout-success h5{
    color: green;
}




.header-title {
    color: #fff;
}
.title-thin {
	font-weight: 300;
}
.service-item {
	margin-bottom: 30px;
}
</style>








	
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
echo '<form action="'.$filenya.'" method="post" name="formx">

<p>
<a id="link" download="grafik_perilaku_forward_instansi.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>


<a href="grafik_perilaku_instansi_xls.php" target="_blank" class="btn btn-danger">EXPORT EXCEL >></a>
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
	$qyuk21 = mysqli_query($koneksi, "SELECT * FROM perilaku_satgas ".
										"WHERE tugaskan = 'true' ".
										"ORDER BY postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);
	}
else
	{
	//jumlah kontribusi
	$qyuk21 = mysqli_query($koneksi, "SELECT perilaku_satgas.* ".
										"FROM perilaku_satgas, m_orang ".
										"WHERE perilaku_satgas.orang_kd = m_orang.kd ".
										"AND perilaku_satgas.tugaskan = 'true' ".
										"AND m_orang.tipe_user = '$i_nama' ".
										"ORDER BY perilaku_satgas.postdate DESC");
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
	$qyuk21 = mysqli_query($koneksi, "SELECT perilaku_satgas.* ".
										"FROM perilaku_satgas, m_orang ".
										"WHERE perilaku_satgas.orang_kd = m_orang.kd ".
										"AND perilaku_satgas.tugaskan = 'true' ".
										"AND m_orang.tipe_user = '$i_nama' ".
										"ORDER BY perilaku_satgas.postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);
	
	
	echo '<option value="'.$i_kd.'">'.$i_nama2.' [<b>'.$tyuk21.'</b> Penugasan]</option>';
	}
while ($rku = mysqli_fetch_assoc($qku));

echo '</select>

<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">
<hr>';
?>







<div id="navbar-example">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#semua" role="tab">SEMUA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#belum" role="tab">BELUM PROSES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#proses" role="tab">PROSES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#selesai" role="tab">SELESAI</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#prank" role="tab">PRANK/FAKE</a>
        </li>
    </ul>

    <!-- Tab panes {Fade}  -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="semua" name="semua" role="tabpanel">
            <div class="bs-callout bs-callout-primary">
					

					<?php
					echo '<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
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
					
					    </table>';
					
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
					            'url':'i_grafik_perilaku_instansi_data.php?ekat=<?php echo $ekat;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'satgas' },
					            { data: 'rincian' }
					        ]
					    });
					    
					    
					
					});
					
					
					</script>
					
					


    		</div>
        </div>
      <div class="tab-pane fade" id="belum" role="tabpanel">
          <div class="bs-callout bs-callout-info">
				


					<?php
					echo '<table id="empTable2" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
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
					
					    </table>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable2').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": false,
					        "columnDefs": [
								    { "width": "50%", "targets": 0 }
								  ],
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
					            'url':'i_grafik_perilaku_instansi_data.php?ekat=<?php echo $ekat;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'satgas' },
					            { data: 'rincian' }
					        ]
					    });
					    
					    
					
					});
					
					
					</script>
					



			</div>
      </div>

      <div class="tab-pane fade" id="proses" role="tabpanel">
          <div class="bs-callout bs-callout-warning">



					<?php
					echo '<table id="empTable3" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
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
					
					    </table>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable3').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": false,
					        "columnDefs": [
								    { "width": "50%", "targets": 0 }
								  ],
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
					            'url':'i_grafik_perilaku_instansi_data.php?ekat=<?php echo $ekat;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'satgas' },
					            { data: 'rincian' }
					        ]
					    });
					    
					    
					
					});
					
					
					</script>
					




			</div>
      </div>



      <div class="tab-pane fade" id="selesai" role="tabpanel">
          <div class="bs-callout bs-callout-success">




					<?php
					echo '<table id="empTable4" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
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
					
					    </table>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable4').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": false,
					        "columnDefs": [
								    { "width": "50%", "targets": 0 }
								  ],
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
					            'url':'i_grafik_perilaku_instansi_data.php?ekat=<?php echo $ekat;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'satgas' },
					            { data: 'rincian' }
					        ]
					    });
					    
					    
					
					});
					
					
					</script>
					




			</div>
      </div>


      <div class="tab-pane fade" id="prank" role="tabpanel">
          <div class="bs-callout bs-callout-danger">



					<?php
					echo '<table id="empTable5" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
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
					
					    </table>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable5').DataTable({
							"scrollY": "100%",
							"scrollX": true,
							"scrollCollapse": true,
					        "autoWidth": false,
					        "columnDefs": [
								    { "width": "50%", "targets": 0 }
								  ],
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
					            'url':'i_grafik_perilaku_instansi_data.php?ekat=<?php echo $ekat;?>'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'satgas' },
					            { data: 'rincian' }
					        ]
					    });
					    
					    
					
					});
					
					
					</script>
					



			</div>
      </div>


    </div>
</div>



















<?php





require("../template_bawah.php");



//null-kan
xclose($koneksi);
exit();
?>