<?php
session_start();

//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");

nocache;

//nilai
$filenya = "$sumber/covid_android_satgas/i_mn_panic_korban.php";
$filenyax = "$sumber/covid_android_satgas/i_mn_panic_korban.php";
$judul = "Data KORBAN";
$juduli = $judul;



//nilai session
$sesiku = $_SESSION['sesiku'];
$sesinama = $_SESSION['sesinama'];





?>



	
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
    <link href='<?php echo $sumber;?>/template/DataTables/datatables.min.css' rel='stylesheet' type='text/css'>

    <!-- jQuery Library -->
    <script src="<?php echo $sumber;?>/template/js/jquery-3.3.1.min.js"></script>
    
    <!-- Datatable JS -->
    <script src="<?php echo $sumber;?>/template/DataTables/datatables.min.js"></script>
    

    <?php
    echo '<form action="'.$filenya.'" method="post" name="formx">

		<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
		<thead>
            <tr valign="top" bgcolor="'.$warnaheader.'">
                <th><strong><font color="'.$warnatext.'">NIK</font></strong></th>
				<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>
				<th><strong><font color="'.$warnatext.'">IMAGE</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JABATAN</font></strong></th>
				<th><strong><font color="'.$warnatext.'">TGL.LAHIR</font></strong></th>
				<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
				<th><strong><font color="'.$warnatext.'">TELP</font></strong></th>
				<th><strong><font color="'.$warnatext.'">EMAIL</font></strong></th>
				<th><strong><font color="'.$warnatext.'">LOKASI</font></strong></th>
				<th><strong><font color="'.$warnatext.'">KET</font></strong></th>
				<th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
            </tr>
            </thead>



			<tfoot>
                <tr valign="top" bgcolor="'.$warnaheader.'">
	                <th><strong><font color="'.$warnatext.'">NIK</font></strong></th>
					<th><strong><font color="'.$warnatext.'">NAMA</font></strong></th>
					<th><strong><font color="'.$warnatext.'">IMAGE</font></strong></th>
					<th><strong><font color="'.$warnatext.'">JABATAN</font></strong></th>
					<th><strong><font color="'.$warnatext.'">TGL.LAHIR</font></strong></th>
					<th><strong><font color="'.$warnatext.'">ALAMAT</font></strong></th>
					<th><strong><font color="'.$warnatext.'">TELP</font></strong></th>
					<th><strong><font color="'.$warnatext.'">EMAIL</font></strong></th>
					<th><strong><font color="'.$warnatext.'">LOKASI</font></strong></th>
					<th><strong><font color="'.$warnatext.'">KET</font></strong></th>
					<th><strong><font color="'.$warnatext.'">POSTDATE</font></strong></th>
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
			"lengthChange": false, 
			"pageLength": 10, 
			"columnDefs": [ 
				{ "width": "350px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }, 
				{ "width": "100px", "targets": 0 }
			  ], 
			"language": {
						"url": "<?php echo $sumber;?>/covid_android_satgas/Indonesian.json",
						"sEmptyTable": "Tidak ada data di database"
					}, 
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url':'<?php echo $sumber;?>/covid_android_satgas/i_mn_panic_korban_i_data.php'
            },
            'columns': [
                { data: 'nip' },
                { data: 'nama' },
                { data: 'image' },
                { data: 'jabatan' },
                { data: 'tgllahir' },
                { data: 'alamat' },
                { data: 'telp' },
                { data: 'email' },
                { data: 'lokasi' },
                { data: 'ket' },
                { data: 'postdate' }
            ]
        });
        
    
    });
    
    

    
	

    

    </script>
