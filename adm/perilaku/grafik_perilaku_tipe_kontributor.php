<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");

nocache;

//nilai
$filenya = "grafik_perilaku_tipe_kontributor.php";
$judul = "Per Kontributor";
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
$qku = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
								"ORDER BY postdate DESC");
$rku = mysqli_fetch_assoc($qku);

do 
	{
	//nilai
	$i_kd = balikin($rku['kd']);
	$i_kkd = balikin($rku['kontributor_kd']);

	//baca
	$qku2 = mysqli_query($koneksi, "SELECT * FROM m_orang ".
									"WHERE kd = '$i_kkd'");
	$rku2 = mysqli_fetch_assoc($qku2);
	$ku2_tipe = cegah($rku2['tipe_user']);
			
	//echo "$i_kkd. $ku2_tipe <hr>";
	
	
	//update kan...
	mysqli_query($koneksi, "UPDATE e_perilaku_masyarakat SET kontributor_tipe = '$ku2_tipe' ".
								"WHERE kd = '$i_kd' ".
								"AND kontributor_kd = '$i_kkd' LIMIT 0,1");
	}
while ($rku = mysqli_fetch_assoc($qku));























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

echo '<form action="'.$filenya.'" method="post" name="formx">';
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

	
	<!-- /.box-header -->
	<div class="box-body">
	  	
	  	
	  	
						
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
			<canvas id="demobar_perilaku2"></canvas>
	
	
	      	<script  type="text/javascript">
	
	    	  var ctx = document.getElementById("demobar_perilaku2").getContext("2d");
	    	  var data = {
	    	            labels: [
						<?php
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 0,9");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['no']);
							$i_nama = balikin($rku['nama']);
				
							echo "\"$i_nama\", ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 9,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['no']);
							$i_nama = balikin($rku['nama']);
				
							echo "\"$i_nama\"";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						?>
	
	
	    	            
	    	            ],
	    	            datasets: [
	    	            {
	    	              label: "GRAFIK TIPE USER",
	    	              data: [
	    	              
	    	            <?php  
						//query x-1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 0,9");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_nama = cegah($rku['nama']);
				
							//jml user e
							$qku2 = mysqli_query($koneksi, "SELECT DISTINCT(e_perilaku_masyarakat.kontributor_kd) AS total ".
															"FROM m_orang, e_perilaku_masyarakat ".
															"WHERE e_perilaku_masyarakat.kontributor_kd = m_orang.kd ".
															"AND m_orang.tipe_user = '$i_nama'");
							$rku2 = mysqli_fetch_assoc($qku2);
							$tku2 = mysqli_num_rows($qku2);
				
				
							echo "\"$tku2\", ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 9,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_nama = cegah($rku['nama']);
	
							//jml user e
							$qku2 = mysqli_query($koneksi, "SELECT DISTINCT(e_perilaku_masyarakat.kontributor_kd) AS total ".
															"FROM m_orang, e_perilaku_masyarakat ".
															"WHERE e_perilaku_masyarakat.kontributor_kd = m_orang.kd ".
															"AND m_orang.tipe_user = '$i_nama'");
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
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 0,9");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['no']);
							$i_nama = balikin($rku['warna']);
				
							echo "\"$i_nama\", ";
							}
						while ($rku = mysqli_fetch_assoc($qku));
						
						
						
						
						//query -1
						$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
														"ORDER BY round(no) ASC LIMIT 9,1");
						$rku = mysqli_fetch_assoc($qku);
						
						
						do 
							{
							$i_no = balikin($rku['no']);
							$i_nama = balikin($rku['warna']);
				
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
	
	    
    
    var url_base64 = document.getElementById('demobar_perilaku2').toDataURL('image/png');
    
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
<a id="link" download="grafik_perilaku_tipe_kontributor.png" class="btn btn-success">UNDUH GRAFIK IMAGE >></a>


<a href="grafik_perilaku_tipe_kontributor_xls.php" class="btn btn-danger">EXPORT EXCEL >></a>
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
	$qyuk21 = mysqli_query($koneksi, "SELECT * FROM e_perilaku_masyarakat ".
										"ORDER BY postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);
	}
else
	{
	//jumlah kontribusi
	$qyuk21 = mysqli_query($koneksi, "SELECT e_perilaku_masyarakat.* ".
										"FROM e_perilaku_masyarakat, m_orang ".
										"WHERE e_perilaku_masyarakat.kontributor_kd = m_orang.kd ".
										"AND m_orang.tipe_user = '$i_nama' ".
										"ORDER BY e_perilaku_masyarakat.postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);		
	}





echo '<select name="ekat" class="btn btn-warning" required>
<option value="'.$i_nama.'" selected>'.$i_nama2.' [<b>'.$tyuk21.'</b> Kontribusi]</option>';


//query
$qku = mysqli_query($koneksi, "SELECT * FROM m_tipe_user ".
								"ORDER BY nama ASC");
$rku = mysqli_fetch_assoc($qku);

do 
	{
	$i_kd = cegah($rku['kd']);
	$i_nama = cegah($rku['nama']);
	$i_nama2 = balikin($rku['nama']);


	//jumlah kontribusi
	$qyuk21 = mysqli_query($koneksi, "SELECT e_perilaku_masyarakat.* ".
										"FROM e_perilaku_masyarakat, m_orang ".
										"WHERE e_perilaku_masyarakat.kontributor_kd = m_orang.kd ".
										"AND m_orang.tipe_user = '$i_nama' ".
										"ORDER BY e_perilaku_masyarakat.postdate DESC");
	$ryuk21 = mysqli_fetch_assoc($qyuk21);
	$tyuk21 = mysqli_num_rows($qyuk21);
	
	
	echo '<option value="'.$i_kd.'">'.$i_nama2.' [<b>'.$tyuk21.'</b> Kontribusi]</option>';
	}
while ($rku = mysqli_fetch_assoc($qku));

echo '</select>

<input name="btnTPL" type="submit" value="TAMPILKAN >>" class="btn btn-danger">


	<table id="empTable" class="display dataTable table table-striped table-bordered row-border hover order-column" style="width:100%">
	<thead>
        <tr valign="top" bgcolor="'.$warnaheader.'">
		<th><strong><font color="'.$warnatext.'">POSTDATE_KEJADIAN</font></strong></th>
		<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
		<th><strong><font color="'.$warnatext.'">RINCIAN</font></strong></th>
		<th><strong><font color="'.$warnatext.'">JML ORANG</font></strong></th>
		<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER</font></strong></th>
		<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER</font></strong></th>
		<th><strong><font color="'.$warnatext.'">JML JAGA JARAK</font></strong></th>
		<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK</font></strong></th>
		<th><strong><font color="'.$warnatext.'">JML DIINGATKAN</font></strong></th>
		<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN</font></strong></th>
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
											"WHERE tipe_laporan = '$ekat_nama'");
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
				<th><strong><font color="'.$warnatext.'">POSTDATE_KEJADIAN</font></strong></th>
				<th><strong><font color="'.$warnatext.'">KONTRIBUTOR</font></strong></th>
				<th><strong><font color="'.$warnatext.'">RINCIAN</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML ORANG <br>'.$yuk_total_wong.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML MEMAKAI MASKER<br>'.$yuk_masker_pake.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML TIDAK MEMAKAI MASKER<br>'.$yuk_masker_tidak.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML JAGA JARAK<br>'.$yuk_jaga_jarak.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML TIDAK JAGA JARAK<br>'.$yuk_jaga_jarak_tidak.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML DIINGATKAN<br>'.$yuk_ingatkan.'</font></strong></th>
				<th><strong><font color="'.$warnatext.'">JML TIDAK DIINGATKAN<br>'.$yuk_ingatkan_tidak.'</font></strong></th>
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
		"pageLength": 10,  
		"language": {
					"url": "../Indonesian.json",
					"sEmptyTable": "Tidak ada data di database"
				}, 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url':'i_grafik_perilaku_tipe_kontributor_data.php?ekat=<?php echo $ekat;?>'
        },
        'columns': [
            { data: 'postdate' },
            { data: 'kontributor' },
            { data: 'rincian' },
            { data: 'jml_orang' },
            { data: 'jml_memakai_masker' },
            { data: 'jml_tidak_memakai_masker' },
            { data: 'jml_jaga_jarak' },
            { data: 'jml_tidak_jaga_jarak' },
            { data: 'jml_diingatkan' },
            { data: 'jml_tidak_diingatkan' }
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