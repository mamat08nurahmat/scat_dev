<?php 
include('include/config.php');
if($_POST['pilih']){

	$id					= $_POST['id'];
	$npp				= $_POST['npp'];
	$nama_sales			= $_POST['nama_sales'];
	$ket				= $_POST['ket'];
    $keterangan			= $_POST['keterangan'];
	$tgl				= date('d M Y H:i:s');
	$nama_pemproses		= $_POST['nama_pemproses'];
	
	$cart 				= mssql_query("SELECT COUNT(*) AS total1 FROM history_leads where npp is not null and ket=1 and id='$id'");
	$ca 				= mssql_fetch_assoc($cart);
	$c					= $ca['total1'];
	
//print_r($id);die();
/*
if($c > 0){
	$or = mssql_query("INSERT INTO history_leads(id,npp,ket,keterangan,tgl,nama_pemproses)
			VALUES('$id','$npp','5','$keterangan',SYSDATETIME(),'$_SESSION[namauser]')");
	$car = mssql_query("update cart set ket='5', tgl_input=SYSDATETIME() where id='$id'") ;
	$le = mssql_query("update leads set ket='5', tgl_input=SYSDATETIME(),nama_user='$_SESSION[namauser]' where id='$id'") ;
			if($car && $le )
				{
				echo"
				<script> 
					alert('LEADS TIDAK DAPAT DIPROSES KEMBALI KARENA SUDAH LEBIH DARI 2X TIDAK TERTARIK');
					window.location.replace('index.php?page=29g'); </script> ";
				}
				else
				{
				echo "LEADS GAGAL PROSES UNTUK DIFOLLOW UP".mssql_get_last_message();
				}

}elseif($ket==1){
	$hi = mssql_query("INSERT INTO history_leads(id,npp,ket,keterangan,tgl,nama_pemproses)
			VALUES('$id','$npp','$ket','$keterangan',SYSDATETIME(),'$_SESSION[namauser]')");		
	$de = mssql_query("delete from cart where id='$id'") ;
	$up = mssql_query("update leads set id_user_atasan=null, nama_sales=null, npp=null, ket=1, tgl_input=SYSDATETIME(),nama_user='$_SESSION[namauser]' where id='$id'") ;
			if($hi && $de && $up )
				{
				echo"
				<script> 
					alert('LEADS TIDAK TERTARIK');
					window.location.replace('index.php?page=29g'); </script> ";
				}
				else
				{
				echo "LEADS GAGAL PROSES UNTUK DIFOLLOW UP".mssql_get_last_message();
				}



}else{	
*/
	$order = mssql_query("INSERT INTO history_leads(id,npp,ket,keterangan,tgl,nama_pemproses)
			VALUES('$id','$npp','$ket','$keterangan',SYSDATETIME(),'$_SESSION[namauser]')");
	$cart = mssql_query("update cart set ket='$ket', tgl_update=SYSDATETIME() where id='$id'") ;
	$leads = mssql_query("update leads set ket='$ket', tgl_update=SYSDATETIME(),nama_user='$_SESSION[namauser]' where id='$id'") ;
		if($order && $cart && $leads )
		{
		echo"
			<script> 
				alert('LEADS SUDAH DI PROSES');
				window.location.replace('index.php?page=29a'); </script> ";
		}
		else
		{
		echo "LEADS GAGAL DPROSES ".mssql_get_last_message();
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
	$nama_sales			= $data['nama_sales'];
	$nama_nasabah		= $data['nama_nasabah'];
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
	$sumber_data		= $data['sumber_data'];
} else {
	$npp 				= "";
	$nama_sales			= "";
	$nama_nasabah		= "";
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
	$sumber_data		= "";	
}


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
     $("p").hide();
    $("#hide").click(function(){
        $("p").hide();
    });
    $("#show").click(function(){
        $("p").show();
    });
});
</script>
<body>
<form id="form-data1" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
	<table align="left">
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
			<td><input name="nama_nasabah" value="<?php echo $nama_nasabah ?>" class="readonly" type="text" readonly /></td>
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
			<td><input name="nominal_pengajuan" value="<?php echo $nominal_pengajuan ?>" class="readonly" type="text" readonly /></td>
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
	
	<table align="center">
		<tr align="center"><td>Action</td>
			<td><select name="action" class="required" required/>
				 <option value="">---Pilih---</option>
				 <option value="call">CALL</option>
				 <option value="visit">VISIT</option>
				</select>
			</td>
		</tr>
		
		<tr align="center"><td>Respon</td>
			<td><select id="mySelect" onchange="myFunction()" name="ket">
				<option value="">--PILIH--
				<option value="3" id="hide">TERTARIK
				<option value="5" id="show">TIDAK TERTARIK
				</select>
			</td>
			<td><p>Alasan<textarea name="keterangan" type="text" ></textarea></p><td>
		</tr>
	</table><br>
	
		<?php
		$date=date('Y/m/d H:i:s');
		?>
		<input type="hidden" name="tgl_input" value="<?php echo $date ?>">
		
	<table align="center">
		<?php
		if($_SESSION['user_level'] == 8 || $_SESSION['user_level'] == 9 || $_SESSION['user_level'] == 11 || $_SESSION['user_level'] == 12 )
				{
		?>		
			<tr><td><input type="submit" class="btn btn-primary" name="pilih" value="LANJUT"></td>
				<td><a href="index.php?page=29a" class="btn btn-danger" >BACK</a></td>
			</tr>
			<?php
				}else if($_SESSION['user_level'] ==1 || $_SESSION['user_level'] == 2 || $_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7)
				{
					?>
			<tr><td><a href="index.php?page=29a" class="btn btn-danger" >BACK</a></td></tr>
			<?php
				}
			?>
	</table>
</form>
</body>

