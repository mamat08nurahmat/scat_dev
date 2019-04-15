<?php 
session_start();
include('include/config.php');
if($_POST['kirim']){
	$npp = $_POST['npp'];
	$nama_prospek = $_POST['nama_prospek'];
	$periode = $_POST['periode'];
	$no_telp = $_POST['no_telp'];
	$produk = $_POST['produk'];
	$nominal = $_POST['nominal'];
	$developer = $_POST['developer'];
	$keterangan = $_POST['keterangan'];
	$tgl_input	= date('d M Y H:i');
	
	if (empty($npp) || empty($nama_prospek) || empty($periode) || empty($no_telp) || empty($produk) || empty($nominal) || empty($developer) || empty($keterangan)) {
		echo "<strong>data harus di isi.</strong>";
	} else {
		//proses
	}
	$order = "INSERT INTO pipeline VALUES ('$npp',upper('$nama_prospek'),'$periode',$no_telp,'$produk',$nominal,'$developer','$keterangan','$tgl_input')";

	//declare in the order variable
	$result = mssql_query($order);	//order executes	
	if($result)
	{
	echo"
	<script> 
		alert('PIPELINE SUKSES DITAMBAHKAN');
		window.location.replace('index.php?page=28'); </script> ";
	}
	else
	{
	echo("<script> 
		alert('PIPELINE GAGAL DITAMBAHKAN');
		window.location.replace('index.php?page=28'); </script>");
}
	
}
?>
<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.berita.js"></script>
<script type="text/javascript">
function get_excel4(){
var status_sales=document.getElementById('status_sales').value;
window.location.assign("get-laporan-pipeline.php?status_sales="+status_sales);
}

</script>
<body>
<form id="form-data1" action="" method="post" name="frmBerita" enctype="multipart/form-data">
	<table style="width:96%; float:right;margin-right:1%;">
	<?php
	if($_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11)
	{
	?>
	<div class="span12" style="width:2%;">
		<tr>
			<td width="100">NPP</td>
			<td>
				<input name="npp" class="required" value="<?php echo $_SESSION['username'] ?>" readonly="readonly" title="NIM harus diisi" placeholder="Input nama prospek" size="30" type="text" required />
			</td>
		</tr>
		</div>
		<tr>
			<td>Nama Prospek</td>
			<td>
				<input name="nama_prospek" class="required" title="Nama harus diisi" size="40" type="text" required />
			</td>
		</tr>
		<tr>
			<td>Periode</td>
			<td>
				<select name="periode" class="required" title="Program Studi harus dipilih" required />
					<option value="">---Pilih---</option>
					<option value="minggu 1">minggu 1</option>
					<option value="minggu 2">minggu 2</option>
					<option value="minggu 3">minggu 3</option>
					<option value="minggu 4">minggu 4</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Telp</td>
			<td>
				<input name="no_telp" class="required" title="Tempat lahir harus diisi" size="40" type="text" required />
			</td>
		</tr>
		<tr>
			<td>Produk</td>
			<td>
				<select name="produk" class="required" title="Program Studi harus dipilih" required />
					<option value="">---Pilih---</option>
					<option value="1">Fleksi</option>
					<option value="2">Griya</option>
					<option value="3">BKP</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nominal</td>
			<td>
				<input name="nominal" class="required" title="No. HP harus diisi" size="30" type="text" required />
			</td>
		</tr>
		<tr>
			<td>Developer</td>
			<td>
				<input name="developer" class="required" title="No. HP harus diisi" size="30" type="text" required />
			</td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>
				<select name="keterangan" class="required" title="Program Studi harus dipilih" required />
					<option value="">---pilih---</option>
					<option value="BI Checking">BI Checking</option>
					<option value="Collect Data">Collect Data</option>
					<option value="Akan Input Elo">Akan Input Elo</option>
				</select>
			</td>
		</tr>
		<?php
				}
				elseif($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 10 || $_SESSION['user_level'] == 5 || $_SESSION['user_level'] == 4 || $_SESSION['user_level'] == 6)
				{
				?>
				<div class="span12" style="width:2%;">
		<tr>
			<td width="100">NPP</td>
			<td>
				<input name="npp" class="required" title="NIM harus diisi" placeholder="Input nama prospek" size="30" type="text" required />
			</td>
		</tr>
		</div>
		<tr>
			<td>Nama Prospek</td>
			<td>
				<input name="nama_prospek" class="required" title="Nama harus diisi" size="40" type="text" required />
			</td>
		</tr>
		<tr>
			<td>Periode</td>
			<td>
				<select name="periode" class="required" title="Program Studi harus dipilih" required />
					<option value="">---Pilih---</option>
					<option value="minggu 1">minggu 1</option>
					<option value="minggu 2">minggu 2</option>
					<option value="minggu 3">minggu 3</option>
					<option value="minggu 4">minggu 4</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Telp</td>
			<td>
				<input name="no_telp" class="required" title="Tempat lahir harus diisi" size="40" type="text" required />
			</td>
		</tr>
		<tr>
			<td>Produk</td>
			<td>
				<select name="produk" class="required" title="Program Studi harus dipilih" required />
					<option value="">---Pilih---</option>
					<option value="1">Fleksi</option>
					<option value="2">Griya</option>
					<option value="3">BKP</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nominal</td>
			<td>
				<input name="nominal" class="required" title="No. HP harus diisi" size="30" type="text" required />
			</td>
		</tr>
		<tr>
			<td>Developer</td>
			<td>
				<input name="developer" class="required" title="No. HP harus diisi" size="30" type="text" required />
			</td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>
				<select name="keterangan" class="required" title="Program Studi harus dipilih" required />
					<option value="">---pilih---</option>
					<option value="BI Checking">BI Checking</option>
					<option value="Collect Data">Collect Data</option>
					<option value="Akan Input Elo">Akan Input Elo</option>
				</select>
			</td>
		</tr>
				<?php
				}
				?>
		<tr>
			<td></td>
			<td>
				<input type="submit" class="btn btn-primary" name="kirim" value="Submit">
				<input type="reset" class="btn btn-inverse" value="Reset">
					<a href="get-laporan-pipeline.php"><img src="images/excel-pipeline.png" style=" width:10%; height:10%; vertical-align: bottom; float:right;"></a>
			</td>
		</tr>
	</table><br>
</form>
<div id="data-pipeline"></div>
</body>


