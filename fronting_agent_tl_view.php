<?php 
include('include/config.php');
$id = $_GET['id'];	
if($_POST['pilih']){
	$id					= $_POST['id'];
	$net_booking		= $_POST['net_booking'];
	$nama_perusahaan	= $_POST['nama_perusahaan'];
	$nama_pemproses		= $_POST['nama_pemproses'];

	$order = mssql_query("update data_booking set net_booking='$net_booking' , nama_perusahaan='$nama_perusahaan', nama_pemproses='$nama_pemproses' where id='$id'") ;
	$order2 = mssql_query("INSERT INTO history_data_booking(id,net_booking,nama_perusahaan,nama_pemproses,tgl_update)
							VALUES('$id','$net_booking','$nama_perusahaan','$_SESSION[namauser]',SYSDATETIME())") ;
			
		if($order && $order2)
		{
		echo"
			<script> 
				alert('DATA BOOKING SUDAH DI SIMPAN');
				window.location.replace('index.php?page=30a'); </script> ";
		}
		else
		{
	echo "DATA BOOKING GAGAL DI SIMPAN ".mssql_get_last_message();
	}
  }

?>

<?php
session_start();
include('include/config.php');
$id = $_GET['id'];	
?>

<?php
$query = mssql_query ("SELECT id_perusahaan,nama_perusahaan FROM perusahaan ");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_perusahaan'] ] = $row['nama_perusahaan'];
}


$data = mssql_fetch_array(mssql_query("SELECT * FROM data_booking a LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang = 'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area where a.id=".$id ));
	
// jika kd_npp > 0 / form ubah data
if($id>0) {
	$no_aplikasi		= $data['no_aplikasi'];
	$nama_nasabah 		= $data['nama_nasabah'];
	$tanggal 			= date('d-m-Y', strtotime($data['tanggal_booking']));
	$nama_produk 		= $data['nama_produk'];
	$nama_area			= $data['nama_area'];
	$nama_cabang		= $data['nama_cabang'];
	$nominal 			= $data['nominal'];
	$net_booking		= $data['net_booking'];
	$npp				= $data['npp'];
	$bulan 				= $data['bulan'];
	$tahun				= $data['tahun'];
	$nama_perusahaan 	= $data['nama_perusahaan'];
	$id_cabang 			= $data['id_cabang'];
} else {
	$no_aplikasi		= "";
	$nama_nasabah 		= "";
	$tanggal_booking 	= "";
	$nominal 			= "";
	$nama_produk 		= "";
	$nama_area			= "";
	$nama_cabang		= "";
	$npp				= "";
	$bulan 				= "";
	$tahun				= "";
	$nama_perusahaan 	= "";
	$id_cabang 			= "";
}

?>

<script language="JavaScript" type="text/JavaScript">
        counter=0;
        function action(){
            counterNext=counter+1;
            document.getElementById("input"+counter).innerHTML = "<p><input name='net_booking' maxlength='10' style='width:100px;'  onkeypress='return hanyaAngka(event)'  type='text' />  (Dalam bentuk Juta)</p><div id=\"input"+counterNext+"\"></div>";
           
        }
    </script>
<body>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>DATA BOOKING</strong></p></div><br>
   <?php
	  if($_SESSION['user_level']==7||$_SESSION['user_level']==1) /*----- menu tim leader  -----*/
	  {
	  ?>
<form id="form-data1" action="" method="post" enctype="multipart/form-data" onsubmit="return cekTinggi()">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="nama_pemproses" value="<?php echo $_SESSION['namauser']; ?>">
	<table align="left">
		<tr align="left"><th>No Aplikasi</th>
			<th><input name="no_aplikasi" value="<?php echo $no_aplikasi?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Nama Nasabah</th>
			<th><input name="nama_nasabah" value="<?php echo $nama_nasabah ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Tanggal Booking</th>
			<th><input name="tanggal_booking" value="<?php echo $tanggal ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Nama Produk</th>
			<th><textarea name="nama_produk" type="text" readonly><?php echo $nama_produk ?></textarea></th>
		</tr>
		<tr align="left"><th>Nama Area</th>
			<th><input name="nama_area" value="<?php echo $nama_area ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Nama Cabang</th>
			<th><input name="nama_cabang" value="<?php echo $nama_cabang ?>" type="text" readonly></th>
		</tr>
	</table>		
	<table align="center">
		<tr align="left"><th>Nominal</th>
			<th><input value="Rp. <?php echo  $nom =number_format($nominal,2); ?>" style="width:100px;" type="text" readonly>  (Dalam bentuk Juta)
			</th>
		</tr>
		<tr align="left"><th>Net Booking</th>
			<th id="input0"><input name="net_booking" id="net_booking" value="<?php echo $net_booking ?>" type="text" readonly><a href="JavaScript:action();">edit</a></th>
		</tr>
		<tr><td></td>
			<td><font align="center" color="red">*) Plafon Akhir - Plafon Awal</font></td>
		</tr>
		<tr></tr>
		<tr align="left"><th>NPP</th>
			<th><input name="npp" value="<?php echo $npp ?>" type="text" readonly></th>
		</tr align="left">
		<tr align="left"><th>Bulan</th>
			<th><input name="bulan" value="<?php echo $bulan ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Tahun</th>
			<th><input name="tahun" value="<?php echo $tahun ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Nama Perusahaan</th>
			<th><select id="propinsi" class="required" name="nama_perusahaan" required/>
				<option value="<?php echo $nama_perusahaan ?>"><?php echo $nama_perusahaan ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama_perusahaan) {
					echo "<option value='$nama_perusahaan'>$nama_perusahaan</option>";
				}
				?>
		</select></th>
		</tr>
	</table>
	
	<table align="center">
		<tr><th><input type="submit" class="btn btn-primary" name="pilih" value="SIMPAN"></th>
			<th><a href="index.php?page=30c" class="btn btn-danger" >BACK</a>
			</th></tr>
	</table>
	</form>
	<?php
	}
	elseif($_SESSION['user_level']==11)
	{
	?>
	<table align="left">
		<tr align="left"><th>No Aplikasi</th>
			<th><input name="no_aplikasi" value="<?php echo $no_aplikasi?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Nama Nasabah</th>
			<th><input name="nama_nasabah" value="<?php echo $nama_nasabah ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Tanggal Booking</th>
			<th><input name="tanggal_booking" value="<?php echo $tanggal ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Nama Produk</th>
			<th><textarea name="nama_produk" type="text" readonly><?php echo $nama_produk ?></textarea></th>
		</tr>
	</table>		
	<table align="center">
		<tr align="left"><th>Nominal</th>
			<th><input value="Rp. <?php echo  $nom =number_format($nominal,2); ?>" style="width:100px;" type="text" readonly>  (Dalam bentuk Juta)
			</th>
		</tr>
		<tr align="left"><th>Net Booking</th>
			<th id="input0"><input name="net_booking" id="net_booking" value="<?php echo $net_booking ?>" type="text" readonly><a href="JavaScript:action();">edit</a></th>
		</tr>
		<tr><td></td>
			<td><font align="center" color="red">*) Plafon Akhir - Plafon Awal</font></td>
		</tr>
		<tr></tr>
		<tr align="left"><th>NPP</th>
			<th><input name="npp" value="<?php echo $npp ?>" type="text" readonly></th>
		</tr align="left">
		<tr align="left"><th>Bulan</th>
			<th><input name="bulan" value="<?php echo $bulan ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Tahun</th>
			<th><input name="tahun" value="<?php echo $tahun ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Nama Perusahaan</th>
			<th><select id="propinsi" class="required" name="nama_perusahaan" required/>
				<option value="<?php echo $nama_perusahaan ?>"><?php echo $nama_perusahaan ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama_perusahaan) {
					echo "<option value='$nama_perusahaan'>$nama_perusahaan</option>";
				}
				?>
		</select></th>
		</tr>
	</table>
	<table align="center">
		<tr>
			<th><a href="index.php?page=30a" class="btn btn-danger" >BACK</a>
			</th></tr>
	</table>
	
	<?php	
	}
	?>
</body>

<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>
