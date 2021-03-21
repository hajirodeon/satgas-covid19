<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
		

nocache;

//nilai
$filenya = "history_panic_button_korban.php";
$judul = "HISTORY : KORBAN";
$judulku = "[PANIC BUTTON] $judul";
$judulx = $judul;
$panickd = nosql($_REQUEST['panickd']);
$kd = nosql($_REQUEST['kd']);
$s = nosql($_REQUEST['s']);
$k = nosql($_REQUEST['k']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



$limit = 100;



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






require("../template_atas.php");


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>		



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





<script>
$(document).ready(function() {
  		
	$.noConflict();


    
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
					echo '<form action="'.$filenya.'" method="post" name="formx">
					
						<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					        </tr>
					        </thead>
					
					
					
							<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
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
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_history_panic_button_korban_data.php'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'umum_nama' },
					            { data: 'lat_x' }, 
					            { data: 'satgas' },
					            { data: 'prank_postdate' }
					        ]
					    });
					    
					
								
								
					});
					
					
					
					</script>
					


    		</div>
        </div>
      <div class="tab-pane fade" id="belum" role="tabpanel">
          <div class="bs-callout bs-callout-info">
				

					
					<?php
					echo '<form action="'.$filenya.'" method="post" name="formx2">
					
						<table id="empTable2" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					        </tr>
					        </thead>
					
					
					
							<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable2').DataTable({
							"scrollY": "100%",
							"scrollX": true, 
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_history_panic_button_korban_data_belum.php'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'umum_nama' },
					            { data: 'lat_x' }, 
					            { data: 'satgas' },
					            { data: 'prank_postdate' }
					        ]
					    });
					    
					
								
								
					});
					
					
					
					</script>
					


			</div>
      </div>

      <div class="tab-pane fade" id="proses" role="tabpanel">
          <div class="bs-callout bs-callout-warning">


					<?php
					echo '<form action="'.$filenya.'" method="post" name="formx3">
					
						<table id="empTable3" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					        </tr>
					        </thead>
					
					
					
							<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable3').DataTable({
							"scrollY": "100%",
							"scrollX": true, 
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_history_panic_button_korban_data_proses.php'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'umum_nama' },
					            { data: 'lat_x' }, 
					            { data: 'satgas' },
					            { data: 'prank_postdate' }
					        ]
					    });
					    
					
								
								
					});
					
					
					
					</script>
					



			</div>
      </div>



      <div class="tab-pane fade" id="selesai" role="tabpanel">
          <div class="bs-callout bs-callout-success">


					<?php
					echo '<form action="'.$filenya.'" method="post" name="formx4">
					
						<table id="empTable4" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					        </tr>
					        </thead>
					
					
					
							<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable4').DataTable({
							"scrollY": "100%",
							"scrollX": true, 
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_history_panic_button_korban_data_selesai.php'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'umum_nama' },
					            { data: 'lat_x' }, 
					            { data: 'satgas' },
					            { data: 'prank_postdate' }
					        ]
					    });
					    
					
								
								
					});
					
					
					
					</script>
					



			</div>
      </div>


      <div class="tab-pane fade" id="prank" role="tabpanel">
          <div class="bs-callout bs-callout-danger">


					<?php
					echo '<form action="'.$filenya.'" method="post" name="formx5">
					
						<table id="empTable5" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
						<thead>
					        <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					        </tr>
					        </thead>
					
					
					
							<tfoot>
					            <tr valign="top" bgcolor="'.$warnaheader.'">
						            <th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
									<th><strong><font color="'.$warnatext.'">KORBAN</font></strong></th>
									<th><strong><font color="'.$warnatext.'">GPS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">SATGAS</font></strong></th>
									<th><strong><font color="'.$warnatext.'">PRANK</font></strong></th>
					            </tr>
							</tfoot>
					
					    </table>
					</form>';
					
					?>
					
					<script>
					$(document).ready(function(){
					
					
					    var table = $('#empTable5').DataTable({
							"scrollY": "100%",
							"scrollX": true, 
							"language": {
										"url": "../Indonesian.json",
										"sEmptyTable": "Tidak ada data di database"
									}, 
					        'processing': true,
					        'serverSide': true,
					        'serverMethod': 'post',
					        'ajax': {
					            'url':'i_history_panic_button_korban_data.php'
					        },
					        'columns': [
					            { data: 'postdate' },
					            { data: 'umum_nama' },
					            { data: 'lat_x' }, 
					            { data: 'satgas' },
					            { data: 'prank_postdate' }
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