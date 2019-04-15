<?php 
session_start();
include('include/config.php');
if($_POST['kirim']){
	$npp 			= $_POST['npp'];
	$nama_pemproses = $_POST['nama_pemproses'];
	$ket			= $_POST['ket'];
	$nama 			= $_POST['nama'];
	$nominal		= str_replace(".","",$_POST['nominal']);
	//$nominal		= $_POST['nominal'];
	$produk			= $_POST['produk'];
	$ktp 			= $_POST['ktp'];
	$sk				= $_POST['sk'];
	$kk				= $_POST['kk'];
	$buku_tabungan	= $_POST['buku_tabungan'];
	$rekening_koran	= $_POST['rekening_koran'];
	$npwp			= $_POST['npwp'];
	$form_aplikasi	= $_POST['form_aplikasi'];
	$id_perusahaan	= $_POST['id_perusahaan'];
	$id_cabang		= $_POST['id_cabang'];
	$tgl_input		= $_POST['tgl_input'];
	$order =  mssql_query("INSERT INTO pipeline_vendor 
						(npp,
						 nama_pemproses,
						 ket,
						 nama,
						 nominal,
						 produk,
						 ktp,
						 sk,
						 kk,
						 buku_tabungan,
						 rekening_koran,
						 npwp,
						 form_aplikasi,
						 tgl_input,
						 id_perusahaan,
						 id_cabang)
							VALUES('$npp',
									'$nama_pemproses',
									'$ket',
									upper('$nama'),
									'$nominal',
									'$produk',
									'$ktp',
									'$sk',
									'$kk',
									'$buku_tabungan',
									'$rekening_koran',
									'$npwp',
									'$form_aplikasi'
									,SYSDATETIME(),
									'$id_perusahaan',
									'$id_cabang')") ;
	if($order)
		{
		echo"
		<script> 
			alert('PIPELINE DITAMBAHKAN');
				window.location.replace('index.php?page=16'); </script> ";
		}
		else
		{
		echo "PIPELINE GAGAL DITAMBAHKAN".mssql_get_last_message();
		}	
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>scat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="favicon.png"/>
	<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<form id="form-data1" action="" method="post" enctype="multipart/form-data">
  <div class="span12" style="width:2%;">
	<input name="npp" value="<?php echo $_SESSION['npp'] ?>" type="hidden"/>
	<input name="nama_pemproses" value="<?php echo $_SESSION['namauser'] ?>" type="hidden"/>	
	<input name="ket" value="1" type="hidden"/>
	<input name="id_perusahaan" value="<?php echo $_SESSION['id_perusahaan'] ?>" type="hidden"/>
	<input name="id_cabang" value="<?php echo $_SESSION['id_cabang'] ?>" type="hidden"/>
	
  </div>		
		<table>
		<tr align="left"><th>Nama</th>
			<th><input name="nama" class="required" type="text" onkeypress="return huruf(event)" required /></th>
		</tr>
		<tr align="left"><th>Nominal</th>
			<th><input name="nominal" class="required" type="text" id="tanpa-rupiah" required /></th>
		</tr>
		<tr align="left"><th>Produk</th>
			<th><select name="produk" class="required" required />
					<option value="">---Pilih---</option>
					<!--<option value="Fleksi">Fleksi</option>
					<option value="Griya">Griya</option>-->
					<option value="BFP">BFP</option>
				</select>
			</th>
		</tr>
		<tr align="left"><th>Syarat</th>
			<th><input type="checkbox" class="checkmark" name="ktp" value="1"> COPY KTP</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="kk" value="1" > COPY KK</th>
		</tr>
		<tr align="left"><th></th>
			<th><input type="checkbox" class="checkmark" name="sk"value="1"> COPY SK</th>
		</tr>
		<tr align="left"><th></th>
			<th><input type="checkbox" class="checkmark" name="buku_tabungan"value="1"> COPY BUKU TABUNGAN 3 BULAN TERAKHIR</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="rekening_koran" value="1" > COPY REKENING KORAN PINJAMAN</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="npwp" value="1" > COPY NPWP</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="form_aplikasi" value="1" > FORM APLIKASI KREDIK KONSUMER</th>
		</tr>
		</table><br>
			<table align="center">
				<tr align="center"><th></th>
					<th><input type="submit" class="btn btn-primary" name="kirim" value="Submit">
						<input type="button" value="Back" class="btn btn-danger" onclick="goBack()">
					</th>
				</tr>
			</table>
		<a href="laporan_pipeline.php"><img src="images/excel-pipeline.png" style=" width:10%; height:10%; vertical-align: bottom; float:right;"></a>
</form>
<div class="row" style="width:98%;margin-left:10px;">
		<h3>
			<!-- textbox untuk pencarian -->
			<div class="input-prepend">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">
				
			</div>
		</h3>
		<!-- tempat untuk menampilkan data pipeline -->
		<div id="data_pipeline"></div>
</div >

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
    
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.pipeline.js"></script>
</body>
</html>




