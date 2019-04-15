<?php
session_start();
include('include/config.php');
$query 	= mssql_query("SELECT count(*)as jumlah FROM cart where npp='$_SESSION[npp]' and ket='2' ");
$buc 	= mssql_fetch_assoc($query);
$b 		= $buc['jumlah'];		
?>

<script type="text/javascript">
	<!--
	//initial checkCount of zero
	var checkCount=0
	var jc = <?php echo $b?>;
	//maximum number of allowed checked boxes
	var maxChecks=5 - jc
	function setChecks(obj){
	//increment/decrement checkCount
	if(obj.checked){
	checkCount=checkCount+1
	}else{
	checkCount=checkCount-1
	}
	//if they checked a 4th box, uncheck the box, then decrement checkcount and pop alert
	if (checkCount>maxChecks){
	obj.checked=false
	checkCount=checkCount-1
	alert('Anda hanya bisa mengambil leads maksimum '+maxChecks+' data karena anda sebelumnya sudah memiliki '+jc+ ' data di cart')
	}
	}
</script>

<script type="text/javascript">
function chkcontrol(j) {
    var total=0;
    for(var i=0; i < document.form1.ckb.length; i++){
        if(document.form1.ckb[i].checked){
            total =total +1;
        }
        if(total > 4){
            alert("Please Select only four!")
            document.form1.ckb[j].checked = false ;
            return false;
        }
    }
}
function just2cat()
        { 
			var allInp = document.getElementsById('single-checkbox');
			alert(allInp);
            const MAX_CHECK_ = 2; /*How many checkbox could be checked*/
            var nbChk =0;
            for(var i= 0; i<allInp.length; i++)
            {
                if(allInp[i].type.toLowerCase()=='checkbox' && allInp[i].checked) /*OR
                if(allInp[i].type.toLowerCase()=='checkbox' && allInp[i].checked===true)*/
                {
                    nbChk++;
                    if(nbChk > MAX_CHECK_) 
                    {
                        alert("At most 2 categories can be chosen");
                        allInp[i].checked=false; /* try to Unchek the current checkbox :'(  */
                    }

                }
            }
        };
</script>

<script>
var $jq = jQuery.noConflict();
</script>
<script type="text/javascript">
		$jq(document).ready(function() {
			$jq("#kotakdialog").dialog({
				modal:true, 
			
				height:600,
				width:600,
				autoOpen:false
			});
			$jq("#lihat").click(function(){
				$jq("#kotakdialog").dialog('open');
			}
			);
		});
 </script>
<?php
		$i = 1;
        $jml_per_halaman = 20;
        $jml_data = mssql_num_rows(mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket FROM leads where ket=1) AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
												"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
				if($_SESSION['user_level']==1 || $_SESSION['user_level']==2 )
				{
						if(isset($_POST['cari_store'])) {
						$kunci = $_POST['cari_store'];
						echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
						$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket FROM leads where ket=1) AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
							WHERE a.nama_prospek LIKE '%$kunci%'
							OR a.npp LIKE '%$kunci%'
							OR c.nama_cabang LIKE '%$kunci%'
							OR a.nominal_pengajuan LIKE '%$kunci%'
							OR a.produk LIKE '%$kunci%'
							OR a.tgl_input LIKE '%$kunci%'
						");
						}elseif(isset($_POST['halaman'])) {
						$halaman = $_POST['halaman'];
						$i = ($halaman - 1) * $jml_per_halaman  + 1;
						$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket FROM leads where ket=1) AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY ISNULL(a.npp,9999999) asc");
					
						} else {  
						$halaman = 1;
						$i = ($halaman - 1) * $jml_per_halaman  + 1;
						$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket FROM leads where ket=1) AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY ISNULL(a.npp,9999999) asc");
						}
				}elseif($_SESSION['user_level'] == 6||$_SESSION['user_level']==7)
				{
						if(isset($_POST['cari_store'])) {
						$kunci = $_POST['cari_store'];
						echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
						$query = mssql_query(" select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket,sumber_data FROM leads where ket=1 and id_cabang='$_SESSION[id_cabang]'  and sumber_data='upload') AS a 
																LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
																LEFT JOIN area d on c.id_area=d.id_area 
											WHERE a.nama_prospek LIKE '%$kunci%'
											OR a.npp LIKE '%$kunci%'
											OR c.nama_cabang LIKE '%$kunci%'
											OR a.nominal_pengajuan LIKE '%$kunci%'
											OR a.produk LIKE '%$kunci%'
											OR a.tgl_input LIKE '%$kunci%'
											");
						}elseif(isset($_POST['halaman'])) {
						$halaman = $_POST['halaman'];
						$i = ($halaman - 1) * $jml_per_halaman  + 1;
						$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket,sumber_data FROM leads where ket=1 and id_cabang='$_SESSION[id_cabang]'  and sumber_data='upload') AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY ISNULL(a.npp,9999999) asc");
        
	
						} else {  
						$halaman = 1;
						$i = ($halaman - 1) * $jml_per_halaman  + 1;
						$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket,sumber_data FROM leads where npp is null and ket=1 and id_cabang='$_SESSION[id_cabang]' and sumber_data='upload') AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY ISNULL(a.npp,9999999) asc");
						}
				}elseif($_SESSION['user_level'] == 8 || $_SESSION['user_level'] == 9 || $_SESSION['user_level'] == 11 || $_SESSION['user_level'] == 12)
				{
						if(isset($_POST['cari_store'])) {
						$kunci = $_POST['cari_store'];
						echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
						$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY id) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket FROM leads where ket=1 and id_cabang='$_SESSION[id_cabang]) AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
											WHERE a.nama_prospek LIKE '%$kunci%'
											OR a.npp LIKE '%$kunci%'
											OR c.nama_cabang LIKE '%$kunci%'
											OR a.nominal_pengajuan LIKE '%$kunci%'
											OR a.produk LIKE '%$kunci%'
											OR a.tgl_input LIKE '%$kunci%'
											");
						}elseif(isset($_POST['halaman'])) {
						$halaman = $_POST['halaman'];
						$i = ($halaman - 1) * $jml_per_halaman  + 1;
						$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket FROM leads where ket=1 and id_cabang='$_SESSION[id_cabang]') AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY ISNULL(npp,9999999) asc");
        
	
						} else {  
						$halaman = 1;
						$i = ($halaman - 1) * $jml_per_halaman  + 1;
						$query = mssql_query("select * from( SELECT id,ROW_NUMBER() OVER (ORDER BY ISNULL(npp,99999)) AS ROWNUM,npp,id_cabang,nama_prospek,produk,nominal_pengajuan,tgl_input,ket FROM leads where ket=1 and id_cabang='$_SESSION[id_cabang]') AS a 
												LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang 
												LEFT JOIN area d on c.id_area=d.id_area 
												WHERE a.ROWNUM BETWEEN (($halaman - 1) * $jml_per_halaman)+1 AND ($jml_per_halaman*$halaman) ORDER BY ISNULL(npp,9999999) asc");
						}
						$halaman = 1; 
				}
				
?>
<?php
if($_SESSION['user_level'] == 6||$_SESSION['user_level']==7)
{
?>	
	<form method="post" action="leads_masuk_kecart_spv.php">	
		<div class="pull-right">
			<a id="lihat"><input type="text" style="width:105px; color: #f00; height:20px;" name="npp" id="npp" placeholder="Masukkan NPP"  required/></a>
			<input name="cart" id="cart" class="readonly" type="hidden" readonly />
			<input name="nama_sales" id="nama" class="readonly" type="hidden" readonly />
			<input type="submit" name="PILIH" value="PILIH"><br><br>
		</div>


<?php
}elseif($_SESSION['user_level'] == 8||$_SESSION['user_level']==9)
{
?>	
	<form method="post" action="leads_masuk_kecart.php">		
	<div class="pull-right">
		<input type="submit" name="PILIH" value="PILIH"><br><br>
	</div>
<?php
}
?>	
	<table class="table table-condensed table-bordered table-hover" cellpadding="0" cellspacing="0">
	<thead>
		<tr>	
			<th><center>NO</center></th>
			<th><center>CABANG</center></th>
			<th><center>NPP</center></th>
			<th><center>NAMA PROSPEK</center></th>
			<th><center>PRODUK</center></th>
			<th><center>NOMINAL PENGAJUAN</center></th>
			<th><center>AKSI</center></th>	
		</tr>
	</thead>
	<body>
        <?php
            $no = 1;
            while($data = mssql_fetch_array($query)){
				$nominal=number_format($data['nominal_pengajuan'],0,",",".");
        ?>
        <tr bgcolor="<?php echo $color ; ?>">
			<td><?php echo $no ?></td>
            <td><?php echo $data['nama_cabang'];?></td>
			<td><?php echo $data['npp'];?></td>
			<td><?php echo $data['nama_prospek'];?></td>
			<td><?php echo $data['produk'];?></td>
			<td>Rp.<?php echo  $nominal;?></td>
            <td><a href="index.php?page=29d&id=<?php echo $data['id']; ?>" class="btn">view</a></td>
			<?php
			if($_SESSION['user_level'] == 6||$_SESSION['user_level']==7)
			{
			?>
			<td><center><input type="checkbox" onClick="setChecks(this)" name="pilih[]" value="<?php echo $data['id']; ?>" disabled ></center><td>
			<?php
			}elseif($_SESSION['user_level'] == 8||$_SESSION['user_level']==9)
			{
			?>
			<td><center><input type="checkbox" onClick="setChecks(this)" id="ckb" name="pilih[]" value="<?php echo $data['id']; ?>"></center><td>
			<?php
			}
			?>
	  </tr>
        <?php $no++; } ?>
    </table>

<?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
<div class="pagination pagination-right">
  <ul>
    <?php
    $no_hal_tampil = 10; 

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 2;
        $mod = $halaman % $val;
        $kelipatan = ceil($halaman/$val);
        $kelipatan2 = floor($halaman/$val);

        if($halaman < $no_hal_tampil) {
            $no_hal_awal = 1;
            $no_hal_akhir = $no_hal_tampil;
        } elseif ($mod == 2) {
            $no_hal_awal = $halaman - 1;
            $no_hal_akhir = $kelipatan * $val + 2;
        } else {
            $no_hal_awal = ($kelipatan2 - 1) * $val + 1;
            $no_hal_akhir = $kelipatan2 * $val + 2;
        }

        if($jml_halaman <= $no_hal_akhir) {
            $no_hal_akhir = $jml_halaman;
        }
    }

    for($i = $no_hal_awal; $i <= $no_hal_akhir; $i++) {
        $aktif = $i == $halaman ? ' active' : '';
    ?>
    <li class="halaman<?php echo $aktif ?>" id="<?php echo $i ?>"><a href="#"><?php echo $i ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
 
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<div id="kotakdialog" title="">
<?php
  include "kelolaan_cart.php";
?>
</div>