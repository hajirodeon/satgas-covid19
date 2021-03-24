<?php
session_start();

//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");


nocache;








class Pager
{	
var $target;
var $curpage;


//batas
function findStart($limit)
   	{
   	if ((!isset($_GET['page6'])) || ($_GET['page6'] == "1"))
   		{
   		$start = 0;
   		$_GET['page6'] = 1;
   		}
     else
      	{
       	$start = ($_GET['page6']-1) * $limit;
      	}

     return $start;
    }
		
//total halaman
function findPages($count, $limit)
    {
     $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;

     return $pages;
   	}
		
//penanda daftar halaman
function pageList($limitku, $curpage, $pages, $target)
	{
    $page_list  = "";
		
	//jika $target kosong
	if ($target == "")
		{
		$xpage = "?limitku6=$limitku&page6";
		}
	else
		{
		$xpage = "&limitku6=$limitku&page6";
		}
			
	?>
	
	
	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){


		$("#idku16").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=1",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});





		$("#idku26").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});






		$("#idku36").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});








		$("#idku46").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo $pages;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});






		$("#idku56").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage-1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});





		$("#idku66").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $target;?><?php echo $xpage;?>=<?php echo ($curpage+1);?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});






		} );
	  </script>

			
	<?php			
    //awal-sebelumnya
   	if (($curpage != 1) && ($curpage))
		{
   		$page_list .= "&nbsp; <a id=\"idku16\" class=\"btn btn-warning\" title=\"<<\"><i class=\"fa fa-fast-backward\"></i></a> ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku16x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a> ";
		}

   	if (($curpage-1) > 0)
   		{
   		$page_list .= "&nbsp; <a id=\"idku26\" class=\"btn btn-warning\" title=\"<\"><i class=\"fa fa-backward\"></i></a> &nbsp; ";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku26x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-backward\"></i></font></a> &nbsp; ";
		}


   	//selanjutnya-akhir
   	if (($curpage+1) <= $pages)
   		{
		$page_list .= " <a id=\"idku36\" class=\"btn btn-warning\" title=\">\"><i class=\"fa fa-forward\"></i></a> ";
   		}
	else
		{
		$page_list .= " <a id=\"idku36x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-forward\"></i></font></a> ";
		}

   	if (($curpage != $pages) && ($pages != 0))
   		{
   		$page_list .= "&nbsp; <a id=\"idku46\" class=\"btn btn-warning\" title=\">>\"><i class=\"fa fa-fast-forward\"></i></a> &nbsp;";
   		}
	else
		{
		$page_list .= "&nbsp; <a id=\"idku46x\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a> &nbsp;";
		}
     	
	$page_list .= "\n";

   	return $page_list;
   	}
		
//sebelumnya-selanjutnya
function nextPrev($curpage, $pages)
   	{
     $next_prev  = "";

     if (($curpage-1) <= 0)
   		{
   		$next_prev .= "<a id=\"idku56\" class=\"btn btn-warning\"><i class=\"fa fa-fast-backward\"></i></a>";
   		}
     else
   		{
   		$next_prev .= "<a id=\"idku56\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-backward\"></i></font></a>";
   		}

   	$next_prev .= " &nbsp; ";

   	if (($curpage+1) > $pages)
   		{
   		$next_prev .= "<a id=\"idku66\" class=\"btn btn-warning\"><i class=\"fa fa-fast-forward\"></i></a>";
  		}
   	else
   		{
   		$next_prev .= "<a id=\"idku66\" class=\"btn btn-warning\"><font color='#CCCCCC'><i class=\"fa fa-fast-forward\"></i></font></a>";
   		}

   	return $next_prev;
   	}
}












$filenyax = "i_tabel6.php";
$tabel2 = "orang_lokasi";



//jika detail data
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'form'))
	{
	//ambil nilai
	$kunci = cegah($_GET['cariku6']);
	$sort = cegah($_GET['sort6']);
	$pageke = cegah($_GET['pageke6']);
	$sortx = cegah($_SESSION['sortx6']);
	$sortnya = cegah($_SESSION['sortnya']);
	$page = nosql($_GET['page6']);
	$limitku = cegah($_GET['limitku6']);
	$limitku2 = cegah($_SESSION['limitku6']);
	
	
	//jika null, kasi default 10
	if (empty($limitku))
		{
		$limit = 10;
		}
	else
		{
		$limit = $limitku;				
		}
		
		
		
		
	
	//jika null 
	if (empty($sort)) 
		{
		$sortkolom = $_SESSION['sortkolom'];
		}
	else
		{
		$_SESSION['sortkolom'] = $sort;
		$sortkolom = $_SESSION['sortkolom'];
		}
	
	
	
	

	
	
	//jika ada klik
	if (!empty($sort))
		{
		//jika null ato ASC
		if (empty($sortx)) 
			{
			$_SESSION['sortx6'] = "ASC";
			$_SESSION['sortnya'] = "ASC";
			}
			
	
		else if ($sortx == "ASC")
			{
			$_SESSION['sortx6'] = "DESC";
			$_SESSION['sortnya'] = "ASC";
			}
			
		else if ($sortx == "DESC")
			{
			$_SESSION['sortx6'] = "ASC";
			$_SESSION['sortnya'] = "DESC";
			}
		}
		
	else
		{			
		$sortnya = cegah($_SESSION['sortnya']);
		}
	?>
	




	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
		$("#pageke6").on('change', function(){
		    	var pageke = $("#pageke6").val();
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku6=<?php echo $limitku;?>&sort6=<?php echo $sort;?>&cariku6=<?php echo $kunci;?>&page6="+pageke,
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});				
			});
	



		 $("#checkAll").click(function () {
		     $('input:checkbox').not(this).prop('checked', this.checked);
		 });
		 




		$("#btnHPS6").on('click', function(){
		    	var limitya6 = $("#limitya6").val();
			
				$("#formx6").submit(function(){
					$.ajax({
						url: "<?php echo $filenyax;?>?aksi=hapusya",
						type:$(this).attr("method"),
						data:$(this).serialize(),
						success:function(data){				
							$("#iproses6").html(data);
							
							
							
							var pageku = $("#pagesetnya6").val();
							
							
							$.ajax({
								url: "<?php echo $filenyax;?>?aksi=form&pageku="+pageku,
								type:$(this).attr("method"),
								data:$(this).serialize(),
								success:function(data){					
									$("#idetailtable6").html(data);
									}
								});
							
							
							
							
							
							
							
							$.ajax({
								url: "<?php echo $filenyax;?>?aksi=jmldatanya",
								type:$(this).attr("method"),
								data:$(this).serialize(),
								success:function(data){					
									$("#ijmldatanya6").html(data);
									}
								});
							
	
	


							}
						});
					return false;
					});
								    	
									
			});
	







		$("#ia6").on('click', function(){
		    	
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku6=<?php echo $limitku;?>&sort6=ia6&cariku6=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});


		$("#ib6").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku6=<?php echo $limitku;?>&sort6=ib6&cariku6=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});


		$("#ic6").on('click', function(){
				$.ajax({
					url: "<?php echo $filenyax;?>?aksi=form&limitku6=<?php echo $limitku;?>&sort6=ic6&cariku6=<?php echo $kunci;?>",
					type:$(this).attr("method"),
					data:$(this).serialize(),
					success:function(data){					
						$("#idetailtable6").html(data);
						}
					});
			});
		

	    $('#table-responsive6').dataTable( {
	        "scrollX": true
	    } );
	} );
	  </script>
	  
	<?php
	$sortx = cegah($_SESSION['sortx6']);
	$sortnya = cegah($_SESSION['sortnya']);
	$sort = cegah($_SESSION['sortkolom']);
	
	
	//jika ada sort
	if ($sort == "ia6")
		{
		$q6 = "ORDER BY orang_kode $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a6 = "asc";
			$nilsort1b6 = "desc";
			$nilsort1c6 = "desc";
			}
		else 
			{
			$nilsort1a6 = "desc";
			$nilsort1b6 = "asc";
			$nilsort1c6 = "asc";
			}
		
		}
		
	//jika ada sort
	else if ($sort == "ib6")
		{
		$q6 = "ORDER BY orang_nama $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a6 = "desc";
			$nilsort1b6 = "asc";
			$nilsort1c6 = "desc";
			}
		else 
			{
			$nilsort1a6 = "asc";
			$nilsort1b6 = "desc";
			$nilsort1c6 = "asc";
			}
		}
		

	//jika ada sort
	else if ($sort == "ic6")
		{
		$q6 = "ORDER BY postdate $sortx";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a6 = "desc";
			$nilsort1b6 = "desc";
			$nilsort1c6 = "asc";
			}
		else 
			{
			$nilsort1a6 = "asc";
			$nilsort1b6 = "asc";
			$nilsort1c6 = "desc";
			}
		}
		
		
	else
		{
		$q6 = "ORDER BY postdate DESC";
		
		//jika null ato ASC
		if ($sortx == "ASC") 
			{
			$nilsort1a6 = "asc";
			$nilsort1b6 = "asc";
			$nilsort1c6 = "desc";
			}
		else 
			{
			$nilsort1a6 = "asc";
			$nilsort1b6 = "asc";
			$nilsort1c6 = "desc";
			}
		}
		
		
		
	//jika cari
	if (!empty($kunci))
		{
		//daftar 
		$qyuk = "SELECT * FROM $tabel2 ".
						"WHERE orang_kode LIKE '%$kunci%' ".
						"OR orang_nama LIKE '%$kunci%' ".
						"OR postdate LIKE '%$kunci%'";
		}
	else
		{
		//daftar 
		$qyuk = "SELECT * FROM $tabel2";
		}

		
		

	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlku = "$qyuk $q6";
	
	$sqlcount = $sqlku;
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenyax?aksi=form&cariku6=$kunci";
	$pagelist = $p->pageList($limitku, $page, $pages, $target);
	$data = mysqli_fetch_array($result);
	

	
	do
		{
		//nilai
		$i_kd = nosql($data['kd']);
		?>
	
			<script language='javascript'>
			//membuat document jquery
			$(document).ready(function(){
			
		
		
				$("#kd<?php echo $i_kd;?>").on('click', function(){

					<?php
					$inilku = "$i_kd <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>xx";
					?>		

					$(".modal-title").html("COBA");
					$(".modal-body").html("<?php echo $inilku;?>");
					$("#myModal").modal('show');
				
					});
		
		

				});
			  </script>
			  
	  	<?php
		}
	while ($data = mysqli_fetch_assoc($result));
	
	
	
	
	
	







		

	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlku = "$qyuk $q6";
	
	$sqlcount = $sqlku;
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenyax?aksi=form&cariku6=$kunci";
	$pagelist = $p->pageList($limitku, $page, $pages, $target);
	$data = mysqli_fetch_array($result);
	
				
	
	//require
	require("../../template/js/jumpmenu.js");
	require("../../template/js/checkall.js");
	require("../../template/js/swap.js");
		
		
	
	echo '<form name="formx6" id="formx6">
	<div class="table-responsive6">          
		  <table class="table" border="1">
		    <tbody>
		    
		    <tr bgcolor="'.$warnaheader.'">
		    	<th id="ehapus" width="10">
		    		&nbsp;
	              </th>
		    	<th id="eedit" width="10">
		    		&nbsp;
	              </th>
		    	<th id="ia6" width="150">
		    		<span><font color="white">KODE</font></span> <i class="fa fa-sort-amount-'.$nilsort1a6.'"></i>
	              </th>
		        <th id="ib6">
		        	<span><font color="white">NAMA</font></span> <i class="fa fa-sort-amount-'.$nilsort1b6.'"></i>
		        	</th>
		        <th id="ic6" width="150">
		        	<span><font color="white">POSTDATE</font></span> <i class="fa fa-sort-amount-'.$nilsort1c6.'"></i>
		        	</th>
	        </tr>';
		
			
			
	
		do
			{
			if ($warna_set ==0)
				{
				$warna = $warna01;
				$warna_set = 1;
				}
			else
				{
				$warna = $warna02;
				$warna_set = 0;
				}

	
			//nilai
			$nomer = $nomer + 1;
			$i_kd = nosql($data['kd']);
			$i_kode = balikin($data['orang_kode']);
			$i_nama = balikin($data['orang_nama']);
			$i_postdate = balikin($data['postdate']);


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" id="item'.$nomer.'" value="'.$i_kd.'" class="btn btn-warning">
			</td>
			<td>
				<a name="kd'.$i_kd.'" id="kd'.$i_kd.'" class="btn btn-warning"><i class="fa fa-edit"></i></a>
			</td>
			<td>'.$i_kode.'</td>
			<td>'.$i_nama.'</td>
			<td>'.$i_postdate.'</td>
	    	</tr>';
			}
		while ($data = mysqli_fetch_assoc($result));


			echo '<tr bgcolor="'.$warnaheader.'">
	    	<th id="ehapus" width="10">
	    		<input type="checkbox" id="checkAll">
              </th>
	    	<th id="eedit" width="10">
	    		&nbsp;
              </th>
	    	<th id="ia6">
	    		<span><font color="white">KODE</font></span>
              </th>
	        <th id="ib6">
	        	<span><font color="white">NAMA</font></span>
	        	</th>
	        <th id="ic6">
	        	<span><font color="white">POSTDATE</font></span>
	        	</th>
	        </tr>';
		

		
		echo '</tbody>
		  </table>
		  </div>



		<div class="row">
			
			<div class="col-md-8">
			
				<button id="btnHPS6" class="btn btn-danger"><i class="fa fa-trash"></i> HAPUS</button>
				<input name="limitya6" id="limitya6" type="hidden" value="'.$limit.'">
				
	
			    [<strong><font color="#FF0000">'.$count.'</font></strong> Data]. ';
				
				
				//urutan data
				if (empty($page))
					{
					$urut1 = "1";
					$urut2 = $limit;
					}
					
				else if ($page == "1")
					{
					$urut1 = "1";
					$urut2 = $limit;
					}
					
				else
					{
					$urut1 = (($page - 1) * $limit) + 1;
					$urut2 = ($urut1 + $limit) - 1;
					}

				
				echo '[#'.$urut1.' sampai #'.$urut2.']. 
			</div>
			
			
			
			<div class="col-md-4" align="right">

				<select name="pageke6" id="pageke6" class="btn btn-warning">
				<option value="'.$page.'" selected>'.$page.'</option>';
		
				
				//loop jumlah page
				for ($k=1;$k<=$pages;$k++)
					{
					echo '<option value="'.$k.'">Ke-'.$k.'</option>';
					}
				
				
				echo '</select>';
		
		
				
				echo ' '.$pagelist.'		
			</div>
		</div>';
	
	echo '</form>';
	

	exit();
	}

	












//jika jml data
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'jmldatanya'))
	{
	//totalnya
	$qyuk = mysqli_query($koneksi, "SELECT kd FROM $tabel2");
	$tyuk = mysqli_num_rows($qyuk);

	echo "<p>
	Total : <font color='red'><b>$tyuk</b></font> Data
	</p>";

	exit();
	}

	






//jika hapus
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'hapusya'))
	{
	//ambil nilai
	$limitya6 = cegah($_GET['limitya6']);
	
	for ($k=1;$k<=$limitya6;$k++)
		{
		//nilai
		$kodeku = "item$k";
		$nilku = cegah($_GET[$kodeku]);

		//hapus datanya
		mysqli_query($koneksi, "DELETE FROM $tabel2 ".
									"WHERE kd = '$nilku'");
	
		
		//echo "$k = $nilku<br>";
		
		}
	
	exit();
	}




	
	

exit();
?>