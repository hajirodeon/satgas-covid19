<?php
session_start();

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");



nocache;

//nilai
$filenya = "map.php";
$judul = "[SETTING]. MAP Pusat Data";
$judulku = "$judul";




//akun cakmustofa
$keyku = "AIzaSyBZ73oHLqNFmGX6bs3qyyRAoCim-_WxdqQ";







//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP2'])
	{
	//re-direct
	xloc($filenya);
	}
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







//detail
$qku = mysqli_query($koneksi, "SELECT * FROM a_profil");
$rku = mysqli_fetch_assoc($qku);
$kdx = nosql($rku['kd']);
$ku_email = balikin($rku['email']);
$ku_alamat = balikin($rku['alamat']);
$ku_alamat2 = balikin($rku['alamat_googlemap']);
$ku_telp = balikin($rku['telp']);
$ku_lat_x = balikin($rku['lat_x']);
$ku_lat_y = balikin($rku['lat_y']);



//jika belum ada, berikan yang dari google map
if ((empty($ku_lat_x)) OR (empty($ku_lat_y)))
	{
	$e_lat_x = "-7.5488485";
	$e_lat_y = "111.6486598";
	}
else
	{
	$e_lat_x = $ku_lat_x;
	$e_lat_y = $ku_lat_y;
	}




$diload = "peta_awal(18);setpeta('$e_lat_x','$e_lat_y','$kdx',18)";






require("../template_atas.php");



     	

echo '<form action="'.$filenya.'" method="post" name="formx2">';
?>



	<script type="text/javascript" src="<?php echo $sumber;?>/inc/js/jquery.js"></script>

  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&&callback=initMap&key=<?php echo $keyku;?>"></script>

	<script type="text/javascript" src="<?php echo $sumber;?>/inc/js/gmap3.js"></script>
	<script type="text/javascript">
	
	$.noConflict();
	
	
	var peta;
	var dataku;

	function peta_awal(zoomnya){
	var indonesia = new google.maps.LatLng(<?php echo $e_lat_x;?>, <?php echo $e_lat_y;?>);
	var petaoption = {
		zoom: zoomnya,
		center: indonesia,
		mapTypeId: google.maps.MapTypeId.HYBRID
		};
	peta = new google.maps.Map(document.getElementById("petaku"),petaoption);
	google.maps.event.addListener(peta,'click',function(event){
		kasihtanda(event.latLng);
	});
	}

	function kasihtanda(lokasi, dataku){
	$("#cx").val(lokasi.lat());
	$("#cy").val(lokasi.lng());


	tanda.setMap(null);
	
        $.ajax({
            type : 'POST',
            url : 'i_xy.php',
            data: {
                nilx : $('#cx').val(),
                nily : $('#cy').val(),
                lokkd : $('#dataku').val()
            },
            success:function (data) {
                $("#testku").append(data);

            }
        });



	tanda = new google.maps.Marker({
		position: lokasi,
		map: peta
		});
		
	
	tanda.setMap(peta);
	}



	function setpeta(x,y,id,zoomnya){
	var lokasibaru = new google.maps.LatLng(x,y);
	var petaoption = {
		zoom: zoomnya,
		center: lokasibaru,
		mapTypeId: google.maps.MapTypeId.HYBRID
		};
	peta = new google.maps.Map(document.getElementById("petaku"),petaoption);
	tanda = new google.maps.Marker({
		position: lokasibaru,
		map: peta
	});
	var idnya = "#"+id;
	var isistring = "<?php echo $e_nama;?>";
	var infowindow = new google.maps.InfoWindow({
		content: isistring
	});






	google.maps.event.addListener(tanda, 'click', function() {
	infowindow.open(peta,tanda);
	});
	google.maps.event.addListener(peta,'click',function(event){
		kasihtanda(event.latLng);
	});




	var cluster1 = [

	<?php
	//data di database
	$qdt = mysqli_query($koneksi, "SELECT * FROM a_profil ".
							"ORDER BY postdate ASC");
	$rdt = mysqli_fetch_assoc($qdt);
	$tdt = mysqli_num_rows($qdt);


	//jika gak null
	if ($tdt != 0)
		{
		do
			{
			$dt_x = balikin($rdt['lat_x']);
			$dt_y = balikin($rdt['lat_y']);

			echo 'new google.maps.LatLng('.$dt_x.', '.$dt_y.'), ';
			}
		while ($rdt = mysqli_fetch_assoc($qdt));
		}
	?>
	];

	var p1 = new google.maps.Polygon({
	map: peta,
	path: cluster1,
	strokeColor: "#FF0000",
	strokeOpacity: 0.8,
	strokeWeight: 2,
	fillColor: "#FF0000",
	fillOpacity: 0.35
	});
	}


	</script>



	<div id="petaku" style="width:100%; height:600px"></div>

	<input type="hidden" name="lat_x" id="cx" size="25" value="<?php echo $e_lat_x;?>">
	<input type="hidden" name="lat_y" id="cy" size="25" value="<?php echo $e_lat_y;?>">
	<input name="dataku" id="dataku" type="hidden" value="<?php echo $kdx;?>">
	<div class="testku" id="testku"></div>


	<img src="<?php echo $sumber;?>/img/wait.gif" style="display:none" id="loading">


<br>
<p>
<input name="btnSMP2" type="submit" value="SIMPAN >>" class="btn btn-block btn-danger">
</p>


</form>




<?php

require("../template_bawah.php");




//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>