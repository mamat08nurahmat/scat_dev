<?php 
include('include/config.php');
if($_POST['kirim']){
	$id_user_atasan		= $_POST['id_user_atasan'];
	$npp 				= $_POST['npp'];
	$nama_sales			= $_POST['nama_sales'];
	$nama_prospek 		= $_POST['nama_prospek'];
	$nominal_pengajuan 	= $_POST['nominal_pengajuan'];
	$alamat 			= $_POST['alamat'];
	$no_telp 			= $_POST['no_telp'];
	$produk 			= $_POST['produk'];
	$id_cabang			= $_POST['id_cabang'];
	$alamat_perusahaan	= $_POST['alamat_perusahaan'];
//var_dump($_POST);die();
	$cart = mssql_query("INSERT INTO leads (
						id_user_atasan,
						npp,
						nama_sales,
						nama_prospek,
						nominal_pengajuan,
						alamat,
						no_telp,
						produk,
						id_cabang,
						alamat_perusahaan,
						sumber_data,
						ket,
						tgl_input,
						is_expired,
						upload,
						is_assign,
						nama_user)
			VALUES(
						'$id_user_atasan',
						'$_SESSION[npp]',
						'$_SESSION[namauser]',
						'$nama_prospek',
						'$nominal_pengajuan',
						'$alamat',
						'$no_telp',
						'$produk',
						'$id_cabang',
						'$alamat_perusahaan',
						'prospek',
						'1',
						 SYSDATETIME(),
						'0',
						'0',
						'',
						'$_SESSION[namauser]')");
	$history= mssql_query ("INSERT INTO history_leads(id,npp,ket,tgl,sumber_data,nama_pemproses)
							SELECT id,npp,ket,tgl_input,sumber_data,nama_user from leads where npp='$npp'");
	if($cart && $history)
	{
	echo"
	<script> 
		alert('LEADS SUKSES DITAMBAHKAN');
		window.location.replace('index.php?page=29a'); </script> ";
	}
	else
	{
	echo "Gagal di tambah ulangi lagi".mssql_get_last_message();
	}
}
?>

<?php
include('include/config.php');
$id=$_GET['id'];
$npp_session = $_SESSION['npp'];
$sql = mssql_query ("select npp,id_user_atasan from sales WHERE npp  ='$npp_session'");
$datax=mssql_fetch_array($sql);
/*-------------------combo wilayah-----------------------------------------*/
$query = mssql_query ("SELECT id_area, nama_area FROM area ORDER BY nama_area");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_area'] ] = $row['nama_area'];
}

if(isset($_GET['action']) && $_GET['action'] == "getKab") {
	$kode_prop = $_GET['kode_prop'];
	
/*-------------------combo cabang------------------------------------------*/
	$query = mssql_query ("SELECT kode_cabang kode, nama_cabang nama FROM cabang WHERE id_area='$kode_prop' and tipe_cabang in ('KCU') ORDER BY nama_cabang");

	$arrkab = array();
	while ($row = mssql_fetch_array($query)) {
		array_push($arrkab, $row);
	}
	echo json_encode($arrkab);
	exit;
}

$data = mssql_fetch_array(mssql_query("SELECT * FROM leads a
join cabang c on a.id_cabang=c.kode_cabang and c.tipe_cabang='KCU'
join area d on c.id_area=d.id_area 
WHERE a.id_leads=".$id));
// jika kd_npp > 0 / form ubah data
if($id> 0) {			
	
	$id_area			= $data['id_area'];
	$nama_area			= $data['nama_area'];
	$id_cabang			= $data['id_cabang'];
	$nama_cabang		= $data['nama_cabang'];	
} else {
	
	$id_area			= "";
	$nama_area			= "";
	$id_cabang			= "";
	$nama_cabang		= "";	
}

?>

<body>
<form id="form-data1" action="" method="post" enctype="multipart/form-data">
	<input name="id_user_atasan"  type="hidden" value="<?php echo $datax['id_user_atasan'] ?>">
	<table align="left">
		<tr><td width="100">NPP</td>
			<td><input name="npp" class="readonly" value="<?php echo $_SESSION['npp'] ?>" type="text" readonly /></td>
		</tr>
		<tr><td width="100">Nama sales</td>
			<td><input name="nama_sales" class="readonly" value="<?php echo $_SESSION['namauser'] ?>" type="text" readonly /></td>
		</tr>		
		<tr><td>Cabang</td>
			<td><select id="id_cabang" name="id_cabang" class="readonly" readonly >
				<option value="<?php echo $_SESSION['id_cabang'] ?>"><?php echo $_SESSION['nama_cabang'] ?></option>
				</select></td>
		</tr>
		<tr><td>Nama Prospek</td>
			<td><input name="nama_prospek" class="required" type="text" required /></td>
		</tr>
		<tr><td>Alamat</td>
			<td><textarea name="alamat" class="required" type="text" required /></textarea></td>
		</tr>
	</table>
	<table align="center">	
		<tr><td>Produk</td>
			<td><input name="produk" class="required" type="text" required /></td>
		</tr>
		<tr><td>Nominal Pengajuan</td>
			<td><input name="nominal_pengajuan" class="required" type="text" onkeypress="return hanyaAngka(event)" required /></td>
		</tr>
		<tr><td>Telp</td>
			<td><input name="no_telp" class="required" type="text" onkeypress="return hanyaAngka(event)"  required /></td>
		</tr>
		<tr><td>Alamat Perusahaan</td>
			<td><textarea name="alamat_perusahaan"  value="" class="required" type="text" required /></textarea></td>
		</tr>	
	</table><br>
	<table align="center">
		<tr><td><input type="submit" class="btn btn-primary" name="kirim" value="PILIH"></td>
			<td><a href="index.php?page=29g" class="btn btn-danger" >BACK</a>
			</td></tr>
	</table>
</form>
</body>

<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
  <script type="text/javascript">
		var j = jQuery.noConflict();
			$(document).ready(function(){
				$('#propinsi').change(function(){
					$.getJSON('input_leads.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
						$('#id_cabang').html('');
						$.each(json, function(index, row) {
							$('#id_cabang').append('<option value='+row.kode+'>'+row.nama+'</option>');
						});
					});
				});
			});
	</script>
	
	<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>
