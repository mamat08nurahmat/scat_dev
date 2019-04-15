<?php 
include('include/config.php');
if($_POST['pilih']){
	$id					= $_POST['id'];	
	$id_user_atasan  	= $_POST['id_user_atasan'];	
	$npp				= $_POST['npp'];	
	$nama_sales			= $_POST['nama_sales'];	
	$nama_nasabah		= $_POST['nama_nasabah'];	
	$alamat				= $_POST['alamat'];	
	$no_telp			= $_POST['no_telp'];	
	$produk				= $_POST['produk'];	
	$nominal_pengajuan	= $_POST['nominal_pengajuan'];	
	$id_cabang			= $_POST['id_cabang'];	
	$alamat_perusahaan	= $_POST['alamat_perusahaan'];	
	$sumber_data		= $_POST['sumber_data'];	
	$ket				= $_POST['ket'];	
	$tgl_input			= $_POST['tgl_input'];	
	$tgl_exp			= $_POST['tgl_exp'];	
    $keterangan			= $_POST['keterangan'];
	$tgl				= date('d M Y H:i:s');
	$is_assign			= $_POST['is_assign'];	
	$nama_pemproses		= $_POST['nama_pemproses'];	
	
	$cart 				= mssql_query("SELECT COUNT(*) AS total1 FROM cart where npp=$_SESSION[npp] and ket=2");
	$ca 				= mssql_fetch_assoc($cart);
	$c					= $ca['total1'];
if($c>=5){
	echo"
	<script> 
		alert('TIDAK BISA DI PILIH KARENA CART LEBIH DARI 5');</script> ";	
}else{
	
	$order = mssql_query("INSERT INTO history_leads(id,npp,ket,keterangan,sumber_data,tgl,nama_pemproses)
					VALUES('$id','$npp','$ket','$keterangan','$sumber_data',SYSDATETIME(),'$_SESSION[namauser]')");
		
	$cart = mssql_query("INSERT INTO cart(id,id_user_atasan,npp,nama_sales,nama_nasabah,alamat,no_telp,produk,nominal_pengajuan,id_cabang,alamat_perusahaan,sumber_data,
					ket,tgl_input,tgl_update,is_expired,is_assign )
					VALUES('$id','$id_user_atasan','$npp','$nama_sales','$nama_nasabah','$alamat','$no_telp','$produk',
					'$nominal_pengajuan','$id_cabang','$alamat_perusahaan','$sumber_data','$ket',SYSDATETIME(),SYSDATETIME()'$is_expired','$is_assign')");
			
	$leads = mssql_query("update leads set npp='$npp',nama_sales='$nama_sales',id_user_atasan='$id_user_atasan', ket='$ket', tgl_update=SYSDATETIME(),is_assign='$is_assign' where id='$id'") ;	
	if($order && $cart && $leads)
	{
	echo"
	<script> 
		alert('LEADS SUKSES DIPILIH');
		window.location.replace('index.php?page=29a'); </script> ";
	}
	else
	{
	echo "LEADS GAGAL DIPILIH".mssql_get_last_message();
	}
	
}
	
}
?>

<?php
session_start();
include('include/config.php');
$id= $_GET['id'];
$npp_session = $_SESSION['npp'];
$sql = mssql_query ("select npp,id_user_atasan from sales WHERE npp  = '$npp_session'");
$datax=mssql_fetch_array($sql);

//-------------------combo wilayah-----------------------------------------
$query = mssql_query ("SELECT id_area, nama_area FROM area ORDER BY nama_area");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_area'] ] = $row['nama_area'];
}

if(isset($_GET['action']) && $_GET['action'] == "getKab") {
	$kode_prop = $_GET['kode_prop'];
	
//-------------------combo cabang------------------------------------------
	$query = mssql_query ("SELECT kode_cabang kode, nama_cabang nama FROM cabang WHERE id_area='$kode_prop' and tipe_cabang in ('KCU') ORDER BY nama_cabang");

	$arrkab = array();
	while ($row = mssql_fetch_array($query)) {
		array_push($arrkab, $row);
	}
	echo json_encode($arrkab);
	exit;
}

$data = mssql_fetch_array(mssql_query("SELECT * FROM leads a 
										left join cabang c on a.id_cabang=c.kode_cabang and c.tipe_cabang='KCU'
										left join area d on c.id_area=d.id_area
										WHERE a.id=".$id));
									
// jika kd_npp > 0 / form ubah data
if($id> 0) {
	$npp 				= $data['npp'];
	$id_user_atasan		= $data['id_user_atasan'];
	$nama_prospek 		= $data['nama_prospek'];
	$alamat 			= $data['alamat'];
	$no_telp 			= $data['no_telp'];
	$produk 			= $data['produk'];
	//$nominal_pengajuan	= $data['nominal_pengajuan'];
	$nominal			= number_format($data['nominal_pengajuan'],0,",",".");
	$id_area			= $data['id_area'];
	$nama_area			= $data['nama_area'];
	$id_cabang			= $data['kode_cabang'];
	$nama_cabang		= $data['nama_cabang'];
	$alamat_perusahaan	= $data['alamat_perusahaan'];
	$ket				= $data['ket'];
	$tgl_input			= $data['tgl_input'];
	$tgl_exp			= $data['tgl_expt'];
	$sumber_data		= $data['sumber_data'];
} else {
	$npp 				= "";
	$id_user_atasan		= "";
	$nama_nasabah 		= "";
	$alamat 			= "";
	$no_telp 			= "";
	$produk 			= "";
	$nominal_pengajuan 	= "";
	$id_area			= "";
	$nama_area			= "";
	$id_cabang			= "";
	$nama_cabang		= "";
	$alamat_perusahaan	= "";
	$ket				= "";
	$tgl_input			= "";
	$tgl_exp			= "";
	$sumber_data		= "";
}

//var_dump($_SESSION);die();
?>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
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
			$jq("#buka").click(function(){
				$jq("#kotakdialog").dialog('open');
			}
			);
		});
 </script>
<body>
<form id="form-data1" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id ?>">

	<?php
	if($_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11)
	{ 
	?>
	<table align="left">
	<input type="hidden" name="is_assign" value="0">	
	<input name="id_user_atasan"  type="hidden" value="<?php echo $datax['id_user_atasan'] ?>" >
		<tr><td>NPP</td>
			<td><input name="npp" class="readonly" value="<?php echo $_SESSION['npp'] ?>" type="text" readonly /></td>
		</tr>
		<tr><td>Nama Sales</td>
			<td><input name="nama_sales" value="<?php echo $_SESSION['namauser'] ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Wilayah</td>
			<td><select id="propinsi" name="propinsi" class="readonly" readonly >
				<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama) {
					echo "<option value='$kode'>$nama</option>";
				}
				?>
				</select></td>
		</tr>
		<tr><td>Cabang</td>
			<td><select id="id_cabang" name="id_cabang" class="readonly" readonly>
				<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
				</select></td>
		</tr>
		<tr><td>Nama Prospek</td>
			<td><input name="nama_nasabah" value="<?php echo $nama_prospek ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Alamat</td>
			<td><textarea name="alamat"  value="" class="readonly" type="text" readonly /><?php echo $alamat ?></textarea></td>
		</tr>
	</table>
	<table align="center">
		<tr><td>Produk</td>
			<td><input name="produk" value="<?php echo $produk ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Nominal Pengajuan</td>
			<td><input name="nominal_pengajuan" value="<?php echo $nominal ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Telp</td>
			<td><input name="no_telp"  value="<?php echo $no_telp ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Alamat Perusahaan</td>
			<td><textarea name="alamat_perusahaan"  value="" class="readonly" type="text" readonly /><?php echo $alamat_perusahaan ?></textarea></td>
		</tr>
		<tr>
			<td>Sumber Data</td>
			<td><textarea name="sumber_data" class="readonly" type="hidden" readonly /><?php echo $sumber_data ?></textarea></td>
		</tr>
		<input name="id_user_atasan"  type="hidden" value="<?php echo $datax['id_user_atasan'] ?>">
	</table><br>
	
	<?php 
	}
	elseif($_SESSION['user_level'] ==1|| $_SESSION['user_level'] ==2 || $_SESSION['user_level'] ==6 || $_SESSION['user_level'] ==7  )
	{
	?>
	<table align="left">
	<input type="hidden" name="id_user_atasan" value="<?php echo $_SESSION['npp'] ?>">	
	<input type="hidden" name="is_assign" value="1">	
		<tr><td>NPP</td>
			<td><a id="buka"><input type="text" style="width:105px; color: #f00; height:20px;" name="npp" id="npp" placeholder="Masukkan NPP"  required/></a></td>
		</tr>
		<tr><td>Nama Sales</td>
			<td><input name="nama_sales" id="nama" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Wilayah</td>
			<td><select id="propinsi" name="propinsi" class="readonly" readonly >
				<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama) {
					echo "<option value='$kode'>$nama</option>";
				}
				?>
				</select></td>
		</tr>
		<tr><td>Cabang</td>
			<td><select id="id_cabang" name="id_cabang" class="readonly" readonly>
				<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
				</select></td>
		</tr>
		<tr><td>Nama Prospek</td>
			<td><input name="nama_nasabah" value="<?php echo $nama_prospek ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Alamat</td>
			<td><textarea name="alamat"  value="" class="readonly" type="text" readonly /><?php echo $alamat ?></textarea></td>
		</tr>
	</table>
	<table align="center">
		<tr><td>Produk</td>
			<td><input name="produk" value="<?php echo $produk ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Nominal Pengajuan</td>
			<td><input name="nominal_pengajuan" value="<?php echo $nominal ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Telp</td>
			<td><input name="no_telp"  value="<?php echo $no_telp ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Alamat Perusahaan</td>
			<td><textarea name="alamat_perusahaan"  value="" class="readonly" type="text" readonly /><?php echo $alamat_perusahaan ?></textarea></td>
		</tr>
		<tr>
			<td>Sumber Data</td>
			<td><textarea name="sumber_data"  value="" class="readonly" type="text" readonly /><?php echo $sumber_data ?></textarea></td>
		</tr>	
	</table><br>
	<?php
	}
	?>
	
	<table border="1" align="center">
	<tr align ="center">
        <td colspan=4">HISTORY</td>
		</tr>
		<tr align ="center">
		<td style="width:170px;">KETERANGAN</td>
		<td style="width:170px;">ALASAN</td>
		<td style="width:170px;">TANGGAL</td>
		<td style="width:170px;">NAMA PEMPROSES</td>
    </tr>
	<?php
		$query_mssql = mssql_query("SELECT * FROM history_leads where id='$id' ORDER BY tgl ASC ");
		while($data = mssql_fetch_array($query_mssql)){
			if($data['ket']==0) {
               $ket = "Upload";
			}elseif($data['ket']==1) {
                $ket = "Masuk Ke Store";	
            }elseif($data['ket']==2) {
                $ket = "Masuk Ke Cart";
            }elseif($data['ket']==3) {
                $ket = "Sudah Difollow up";
			}elseif($data['ket']==4) {
                $ket = "Tertarik";
			}elseif($data['ket']==5) {
                $ket = "Tidak Tertarik";
			}elseif($data['ket']==6) {
                $ket = "Batal";
			}elseif($data['ket']==7) {
                $ket = "Expired";
			}elseif($data['ket']==8) {
                $ket = "Sukses";
            }
	?>
		<?php $format=date('d-m-Y',strtotime($data['tgl'])); ?>
		<tr><td readonly="readonly"><?php echo $ket; ?></td>
			<td readonly="readonly"><?php echo $data['keterangan']; ?></td>
			<td readonly="readonly"><center><?php echo $format; ?></center></td>
			<td readonly="readonly"><center><?php echo $data['nama_pemproses']; ?></center></td>
		</tr>
		<?php } ?>
		</table><br>
	
	<input type="hidden" name="ket" value="2">
		<?php $date=date('Y/m/d H:i:s'); ?>
	<input type="hidden" name="tgl_input" value="<?php echo $date ?>">
	<?php 
				if($_SESSION['user_level']==6 || $_SESSION['user_level']==7 || $_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11 )
				{
			?>	
	<table align="center">
		<tr><td><input type="submit" class="btn btn-primary" name="pilih" value="PILIH"></td>
			<td><a href="index.php?page=29a" class="btn btn-danger" >BACK</a>
			</td></tr>
	</table>
	<?php  ?>
	<?php }
			elseif($_SESSION['user_level']==1 || $_SESSION['user_level']==2)
				{
			?>	
	<table align="center">
		<tr>
			<td><a href="index.php?page=29a" class="btn btn-danger" >BACK</a>
			</td></tr>
	</table>
	<?php } ?>
</form>
</body>

<div id="kotakdialog" title="">
<?php
  include "kelolaan_atasan.php";
?>
</div>

<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>

