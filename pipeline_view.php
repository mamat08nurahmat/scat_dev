<?php
session_start();
include('include/config.php');
$id = $_GET['id'];								
?>
<?

$data = mssql_fetch_array(mssql_query("SELECT * FROM pipeline_vendor a join perusahaan b on  a.id_perusahaan=b.id_perusahaan where id_pipeline=".$id ));
if($id>0) {
	$nama			= $data['nama'];
	$produk			= $data['produk'];
	$nominal 		= number_format($data['nominal'],0,",",".");
	$ktp			= $data['ktp'];
	$sk				= $data['sk'];
	$kk				= $data['kk'];
	$buku_tabungan	= $data['buku_tabungan'];
	$rekening_koran	= $data['rekening_koran'];
	$npwp			= $data['npwp'];
	$form_aplikasi	= $data['form_aplikasi'];
	$nama_perusahaan= $data['nama_perusahaan'];
	$no_aplikasi	= $data['no_aplikasi'];
} else {
	$nama			= "";
	$produk			= "";
	$nominal 		= "";
	$ktp			= "";
	$sk				= "";
	$kk				= "";
	$buku_tabungan	= "";
	$rekening_koran	= "";
	$npwp			= "";
	$form_aplikasi	= "";
	$nama_perusahaan= "";
	$no_aplikasi	= "";	
}
?>
<body>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>PIPELINE VENDOR</strong></p></div><br>
	<div class="span12" style="width:2%;"></div>
	<table>
		<tr align="left"><th>Nama</th>
			<th><input name="nama" value="<?php echo $nama ?>" type="text" readonly></th>
		</tr>
		<tr align="left"><th>Produk</th>
			<th><input name="produk" type="text" value="<?php echo $produk ?>" readonly></th>
		</tr>
		<tr align="left"><th>Nominal</th>
			<th><input name="nominal" type="text" value="<?php echo $nominal ?>" readonly></th>
		</tr>
		<tr align="left"><th>Syarat</th>
			<th><input type="checkbox" class="checkmark" name="ktp"  value="1" <? if($ktp=='1'){echo 'checked';}?> readonly> COPY KTP</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="kk"  value="1" <? if($kk=='1'){echo 'checked';}?> readonly> COPY KK</th>
		</tr>
		<tr align="left"><th></th>
			<th><input type="checkbox" class="checkmark" name="sk"  value="1" <? if($sk=='1'){echo 'checked';}?> readonly> COPY SK</th>
		</tr>
		<tr align="left"><th></th>
			<th><input type="checkbox" class="checkmark" name="buku_tabungan"  value="1" <? if($buku_tabungan=='1'){echo 'checked';}?> readonly> COPY BUKU TABUNGAN 3 BULAN TERAKHIR</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="rekening_koran"  value="1" <? if($rekening_koran=='1'){echo 'checked';}?> readonly> COPY REKENING KORAN PINJAMAN</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="npwp"  value="1" <? if($npwp=='1'){echo 'checked';}?> readonly> COPY NPWP</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="form_aplikasi"  value="1" <? if($form_aplikasi=='1'){echo 'checked';}?> readonly> FORM APLIKASI KREDIK KONSUMER</th>
		</tr>
		<tr align="left"><th>Nama Perusahaan</th>
			<th><input name="nama_perusahaan" type="text" value="<?php echo $nama_perusahaan ?>" readonly></th>
		</tr>
		<tr align="left"><th>No Aplikasi</th>	
			<th><input name="no_aplikasi" type="text" value="<?php echo $no_aplikasi ?>" readonly  ><th>	
		</tr>
		<tr align="center"><th><a href="index.php?page=16a" class="btn btn-danger" >BACK</a></th></tr>
	</table>
</body>