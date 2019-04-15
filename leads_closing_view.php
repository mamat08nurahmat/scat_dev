<?php 
include('include/config.php');
if($_POST['pilih']){	
	$id					= $_POST['id'];
	$npp				= $_POST['npp'];
	$ket				= $_POST['ket'];
    $keterangan			= $_POST['keterangan'];
	$tgl				= date('d M Y H:i:s');
	$no_rekening		= $_POST['no_rekening'];	
$order = mssql_query("INSERT INTO history_leads(id,npp,ket,keterangan,tgl)
		VALUES('$id','$npp','$ket','$keterangan',SYSDATETIME())");
$cart = mssql_query("update cart set ket='$ket', tgl_update=SYSDATETIME(), no_rekening='$no_rekening' where id='$id'") ;
$leads = mssql_query("update leads set ket='$ket', tgl_update=SYSDATETIME() where id='$id'") ;
	
	if($order && $cart && $leads )
	{
	echo"
	<script> 
		alert('LEADS SUDAH DIPROSES');
		window.location.replace('index.php?page=29a'); </script> ";
	}
	else
	{
	echo "LEADS GAGAL DIPROSES".mssql_get_last_message();
	}
	
}
?>

<?php
include('include/config.php');
$id = $_GET['id'];
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
$data = mssql_fetch_array(mssql_query("SELECT * FROM cart a 
join cabang c on a.id_cabang=c.kode_cabang and c.tipe_cabang='KCU'
join area d on c.id_area=d.id_area 
WHERE a.id=".$id));
// jika kd_npp > 0 / form ubah data
if($id> 0) {			
	$npp 				= $data['npp'];
	$nama_nasabah 		= $data['nama_nasabah'];
	$alamat 			= $data['alamat'];
	$no_telp 			= $data['no_telp'];
	$produk 			= $data['produk'];
	$nominal_pengajuan 	= $data['nominal_pengajuan'];
	$id_area			= $data['id_area'];
	$nama_area			= $data['nama_area'];
	$id_cabang			= $data['id_cabang'];
	$nama_cabang		= $data['nama_cabang'];
	$alamat_perusahaan	= $data['alamat_perusahaan'];
	$ket				= $data['ket'];
	$tgl_input			= $data['tgl_input'];
	$no_apl				= $data['no_aplikasi'];		
} else {
	$npp 				= "";
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
	$no_apl				= "";	
}
?>

<body>
<form id="form-data1" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
	<table align="left">
		<tr><td width="100">NPP</td>
			<td><input name="npp" class="readonly" value="<?php echo $npp ?>" type="text" readonly /></td>
		</tr>
		<tr><td>Nama Prospek</td>
			<td><input name="nama_nasabah" value="<?php echo $nama_nasabah ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Alamat</td>
			<td><textarea name="alamat"  value="" class="readonly" type="text" readonly /><?php echo $alamat ?></textarea></td>
		</tr>
		<tr><td>Telp</td>
			<td><input name="no_telp"  value="<?php echo $no_telp ?>" class="readonly" type="text" readonly /></td>
		</tr>
		<tr><td>Produk</td>
			<td><select name="produk" class="readonly" readonly />
				<option <?php if ($produk=='fleksi'){echo "selected=\"selected\""; } ?> value="fleksi">Fleksi</option>
				<option <?php if ($produk=='griya'){echo "selected=\"selected\""; } ?>  value="griya">Griya</option>
				<option <?php if ($produk=='bkp'){echo "selected=\"selected\""; } ?>  value="bkp">BKP</option>
				</select></td>
		</tr>
</table>
	<table align="center">				
		<tr><td>Nominal Pengajuan</td>
			<td><input name="nominal_pengajuan" value="<?php echo $nominal_pengajuan ?>" class="readonly" type="text" readonly /></td>
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
		<tr><td>Alamat Perusahaan</td>
			<td><textarea name="alamat"  value="" class="readonly" type="text" readonly /><?php echo $alamat ?></textarea></td>
		</tr>
		<tr><td>Sumber Data</td>
			<td><textarea name="alamat"  value="" class="readonly" type="text" readonly /><?php echo $alamat ?></textarea></td>
		</tr>
		<tr><td>Nomor Aplikasi</td>
			<td><input name="no_aplikasi" value="<?php echo $no_apl ?>" class="readonly" type="text" readonly /></td>
		</tr>
	</table><br>
	
<table border="1" align="center">
	<tr align ="center">
        <td colspan=4">HISTORY</td>
		</tr>
		<tr align ="center">
		<td style="width:170px;">KETERANGAN</td>
		<td style="width:170px;">ALASAN</td>
		<td style="width:170px;">TANGGAL</td>
    </tr>
	<?php
	$id= $_GET['id'];
		$query_mssql = mssql_query("SELECT * FROM history_leads where id='$id' ORDER BY tgl ASC ");
		while($data = mssql_fetch_array($query_mssql)){
			if($data['ket']==0) {
               $ket = "Upload";
			}elseif($data['ket']==1) {
                $ket = "Masuk Ke Bukcet";	
            }elseif($data['ket']==2) {
                $ket = "Masuk Ke Cart";
            }elseif($data['ket']==3) {
                $ket = "Sudah Difollow up";
			}elseif($data['ket']==4) {
                $ket = "Tertarik";
			}elseif($data['ket']==5) {
                $ket = "Tidak Tertarik";
			}elseif($data['ket']==6) {
                $ket = "Expired";
			}elseif($data['ket']==7) {
                $ket = "Batal";
			}elseif($data['ket']==8) {
                $ket = "Sukses";
            }
	?>
		<?php $format=date('d-m-Y',strtotime($data['tgl'])); ?>
		<tr><td readonly="readonly"><?php echo $ket; ?></td>
			<td readonly="readonly"><?php echo $data['keterangan']; ?></td>
			<td readonly="readonly"><center><?php echo $format; ?></center></td>
		</tr>
		<?php } ?>
		</table><br>
	
	<table align="center">
	<input type="hidden" name="ket" value="8">
		<tr align="center"><td>NO REKENING PEMINJAMAN</td>
			<td><input name="no_rekening"  class="required" type="text" id="txtcari" required/></td>			
			<div id="hasil"></div>
		</tr>
	</table><br>
	
		<?php $date=date('Y/m/d H:i:s'); ?>
		<input type="hidden" name="tgl_input" value="<?php echo $date ?>"> 
	<table align="center">
		<tr><td>
		<div id="next" style="display:none">
		<input type="submit" class="btn btn-primary" name="pilih" value="LANJUT">
		</div>
		</td>
			<td><a href="index.php?page=29a" class="btn btn-danger" >BACK</a>
			</td></tr>
	</table>
</form>
</body>

<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
  <script type="text/javascript">
	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}

 $(document).ready(function() {
  <!-- event textbox keyup
  $("#txtcari").keyup(function() {
   var strcari = $("#txtcari").val(); <!-- mendapatkan nilai dari textbox -->
   if (strcari != "") <!-- jika value strcari tidak kosong-->
   {
    $("#hasil").html <!-- menampilkan animasi loading -->
    <!-- request data ke cari.php lalu menampilkan ke <div id="hasil"></div> -->
    $.ajax({
     type:"post",
     url:"cari.php",
     data:"q="+ strcari,
     success: function(data){
		 console.log(data);
      $("#hasil").html(data);
     }
    });
   }
  });
    });
	
	
</script>



