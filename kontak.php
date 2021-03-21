<?php
//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
$tpl = LoadTpl("template/cp_kontak.html");


nocache;

//nilai
$filenya = "kontak.php";
$judul = "Kontak Kami";




//isi *START
ob_start();



?>
		
		
		


	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){


		$("#btnKRM").on('click', function(){
			
			$("#formx2").submit(function(){

				$.ajax({
					url: "i_index.php?artkd=<?php echo $artkd;?>&aksi=bukutamu",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#ihasilnya").html(data);
						}
					});
				return false;
			});
		
		
		});	

	
				
	});
	
	</script>
		


<?php
$nil1 = rand(1,9);
$nil2 = rand(1,9);


echo '<p>
Silahkan Isi Form Buku Tamu/Saran/Masukan :  
</p>
<div id="iformnya">

    <form id="formx2">
        <div class="row">
            <div class="col-12 col-lg-6">
                <input type="text" class="form-control" id="e_nama" name="e_nama" placeholder="Nama Kamu..." required>
            </div>
            <div class="col-12 col-lg-6">
                <input type="text" class="form-control" id="e_alamat" name="e_alamat" placeholder="Alamat..." required>
            </div>
            <div class="col-12 col-lg-6">
                <input type="text" class="form-control" id="e_telp" name="e_telp" placeholder="Telepon..." required>
            </div>
            <div class="col-12 col-lg-6">
                <input type="email" class="form-control" id="e_email" name="e_email" placeholder="E-Mail..." required>
            </div>
            <div class="col-12 col-lg-6">
                <input type="text" class="form-control" id="e_situs" name="e_situs" placeholder="Situs/Web..." required>
            </div>
            <div class="col-12">
                <textarea class="form-control" id="e_isi" name="e_isi" cols="30" rows="10" placeholder="Isi Buku Tamu" required></textarea>
            </div>
            
			
            <div class="col-12">
            	'.$nil1.' + '.$nil2.' = 
            	
				
                <input type="hidden" id="e_nil1" name="e_nil1" value="'.$nil1.'">
                <input type="hidden" id="e_nil2" name="e_nil2" value="'.$nil2.'">
            </div>
            
            <div class="col-12 col-lg-2">            
                <input type="text" class="form-control" id="e_ongko" name="e_ongko" placeholder="" required>
            </div>
            
			
            <div class="col-12">

                <button class="btn btn-danger" type="submit" id="btnKRM">KIRIM >></button>
            </div>
        </div>
    </form>

</div>

<div id="ihasilnya"></div>';



//isi
$isi = ob_get_contents();
ob_end_clean();









require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>