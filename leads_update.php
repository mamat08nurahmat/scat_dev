<?php 
session_start();
include('include/config.php');
if($_POST['pilih']){
	$id		 			= $_POST['id'];
	$nama_prospek		= $_POST['nama_prospek'];	
	$alamat				= $_POST['alamat'];	
	$no_telp			= $_POST['no_telp'];	
	$produk				= $_POST['produk'];	
	$nominal_pengajuan	= $_POST['nominal_pengajuan'];	
	$id_cabang			= $_POST['id_cabang'];	
	$alamat_perusahaan	= $_POST['alamat_perusahaan'];		
	$nama_user			= $_POST['nama_user'];	
		
	$order= mssql_query("
	UPDATE leads SET 
	nama_prospek		='$nama_prospek',
	alamat				='$alamat',
	no_telp				='$no_telp',
	produk				='$produk',
	nominal_pengajuan	='$nominal_pengajuan',
	id_cabang			='$id_cabang',
	alamat_perusahaan	='$alamat_perusahaan',
	tgl_input 			= SYSDATETIME(),
	nama_user			='$nama_user'
	WHERE id ='$id' ");	
	
	if($order )
	{	
	echo"
	<script> 
		alert('DATA SUKSES DIUBAH');
		window.location.replace('index.php?page=29b');
	</script>";
	}
	else
	{
		echo "    ERROR   ".mssql_get_last_message();
	}
}
?>

<?php
session_start();
include('include/config.php');
$id= $_GET['id'];
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
if($id> 0) {
	$nama_prospek 		= $data['nama_prospek'];
	$alamat 			= $data['alamat'];
	$no_telp 			= $data['no_telp'];
	$produk 			= $data['produk'];
	$nominal_pengajuan	= $data['nominal_pengajuan'];
	$id_area			= $data['id_area'];
	$nama_area			= $data['nama_area'];
	$id_cabang			= $data['kode_cabang'];
	$nama_cabang		= $data['nama_cabang'];
	$alamat_perusahaan	= $data['alamat_perusahaan'];
} else {
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
}
?>
<body>
<form id="form-data1" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="nama_user" value="<?php echo $_SESSION['namauser'] ?>">
	<table align="left">	
		<tr><td>Wilayah</td>
			<td><select id="propinsi" name="propinsi" class=" "   >
				<option value="<?php echo $id_area ?>"><?php echo $nama_area ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama) {
					echo "<option value='$kode'>$nama</option>";
				}
				?>
				</select></td>
		</tr>
		<tr><td>Cabang</td>
			<td><select id="id_cabang" name="id_cabang" class=" "  >
				<option value="<?php echo $id_cabang ?>"><?php echo $nama_cabang ?></option>
				</select></td>
		</tr>
		<tr><td>Nama Prospek</td>
			<td><input name="nama_prospek" value="<?php echo $nama_prospek ?>"type="text"   /></td>
		</tr>
		<tr><td>Alamat</td>
			<td><textarea name="alamat" type="text" /><?php echo $alamat ?></textarea></td>
		</tr>
	</table>
	<table align="center">
		<tr><td>Produk</td>
			<td><input name="produk" value="<?php echo $produk ?>" type="text"/></td>
		</tr>
		<tr><td>Nominal Pengajuan</td>
			<td><input name="nominal_pengajuan" value="<?php echo $nominal_pengajuan ?>" onkeypress="return hanyaAngka(event)" type="text"/></td>
		</tr>
		<tr><td>Telp</td>
			<td><input name="no_telp"  value="<?php echo $no_telp ?>"type="text" onkeypress="return hanyaAngka(event)"   /></td>
		</tr>
		<tr><td>Alamat Perusahaan</td>
			<td><textarea name="alamat_perusahaan" type="text"/><?php echo $alamat_perusahaan ?></textarea></td>
		</tr>
	</table><br>
	
	<?php $date=date('Y/m/d H:i:s'); ?>
	<input type="hidden" name="tgl_input" value="<?php echo $date ?>">
		
	<table align="center">
		<tr><td><input type="submit" class="btn btn-primary" name="pilih" value="SIMPAN"></td>
			<td><a href="index.php?page=29b" class="btn btn-danger" >BACK</a>
			</td></tr>
	</table>
</form>
</body>
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../combobox/libs/bootstrap.css" media="screen" />
		<script type="text/javascript" src="../combobox/libs/jquery.min.js"></script>
		<script type="text/javascript">
		var j = jQuery.noConflict();
			$(document).ready(function(){
				$('#propinsi').change(function(){
					$.getJSON('leads_update.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
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

	function huruf(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
		if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
            return false;
        return true;
	}

	function goBack() {
		window.history.back()
	}	

 /* Tanpa Rupiah */
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
    });
    
    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    
    </script>
    
