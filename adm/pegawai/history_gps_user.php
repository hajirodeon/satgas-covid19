<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "history_gps_user.php";
$judul = "HISTORY GPS USER";
$judulku = "[USER] $judul";
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






require("../template_atas.php");


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    
		
	<script>
	$(document).ready(function() {
	  		
		$.noConflict();
	    
	});
	</script>
	  
	    
	    
	    
<?php
echo '<form action="'.$filenya.'" method="post" name="formx">

	<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
        <tr valign="top" bgcolor="'.$warnaheader.'">
            <th><strong><font color="'.$warnatext.'">NIK</font></strong></th>
			<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>
			<th><strong><font color="'.$warnatext.'">IMAGE</font></strong></th>
			<th><strong><font color="'.$warnatext.'">TIPE</font></strong></th>
			<th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
			<th><strong><font color="'.$warnatext.'">KET</font></strong></th>
			<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
        </tr>
        </thead>



		<tfoot>
            <tr valign="top" bgcolor="'.$warnaheader.'">
                <th><strong><font color="'.$warnatext.'">NIK</font></strong></th>
				<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>
				<th><strong><font color="'.$warnatext.'">IMAGE</font></strong></th>
				<th><strong><font color="'.$warnatext.'">TIPE</font></strong></th>
				<th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
				<th><strong><font color="'.$warnatext.'">KET</font></strong></th>
				<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
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
            'url':'i_history_gps_user_data.php'
        },
        'columns': [
            { data: 'nip' },
            { data: 'nama' },
            { data: 'image' },
            { data: 'tipe_user' },
            { data: 'postdate' }, 
            { data: 'ket' },
            { data: 'alamat' }
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