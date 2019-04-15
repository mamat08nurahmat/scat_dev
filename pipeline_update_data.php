<?php 
session_start();
include('include/config.php');
$id = $_GET['id'];
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
	$tgl_input		= $_POST['tgl_input'];
	
	$order = mssql_query("
	UPDATE pipeline_vendor SET 
	npp 			= '$npp',
	nama_pemproses	= '$_SESSION[namauser]',
	nama 			= '$nama',
	nominal			= '$nominal',
	produk			= '$produk',
	ktp 			= '$ktp',
	sk				= '$sk',
	kk				= '$kk',
	buku_tabungan	= '$buku_tabungan',
	rekening_koran	= '$rekening_koran',
	npwp			= '$npwp',
	form_aplikasi	= '$form_aplikasi',
	id_perusahaan	= '$_SESSION[id_perusahaan]',
	tgl_input		= SYSDATETIME()
	WHERE id_pipeline='$id' ");	
	if($order)
	{
	echo"
	<script> 
		alert('PIPELINE BERHASIL DI UPDATE');
		window.location.replace('index.php?page=16'); </script> ";
	}
	else
	{
	echo "PIPELINE GAGAL DI UPDATE".mssql_get_last_message();
	}	
}
?>

<?php
session_start();
include('include/config.php');
$id = $_GET['id'];								
?>
<?

$data = mssql_fetch_array(mssql_query("SELECT * FROM pipeline_vendor where id_pipeline=".$id ));
// jika kd_npp > 0 / form ubah data
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
	
}

?>
<body>
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>PIPELINE VENDOR</strong></p></div><br>
	<form id="form-data1" action="" method="post" enctype="multipart/form-data">
		<div class="span12" style="width:2%;">
			<input type="hidden" name="id_pipeline" value="<?php echo $id; ?>">
		</div>
	<table>
		<tr align="left"><th>Nama</th>
			<th><input name="nama" value="<?php echo $nama ?>" type="text"  ></th>
		</tr>
		<tr align="left"><th>Produk</th>
			<th><input name="produk" type="text" value="<?php echo $produk ?>"   ></th>
		</tr>
		<tr align="left"><th>Nominal</th>
			<th><input name="nominal" type="text" value="<?php echo $nominal ?>"  ></th>
		</tr>
		<tr align="left"><th>Syarat</th>
			<th><input type="checkbox" class="checkmark" name="ktp"  value="1" <? if($ktp=='1'){echo 'checked';}?>> COPY KTP</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="kk"  value="1" <? if($kk=='1'){echo 'checked';}?>> COPY KK</th>
		</tr>
		<tr align="left"><th></th>
			<th><input type="checkbox" class="checkmark" name="sk"  value="1" <? if($sk=='1'){echo 'checked';}?>> COPY SK</th>
		</tr>
		<tr align="left"><th></th>
			<th><input type="checkbox" class="checkmark" name="buku_tabungan"  value="1" <? if($buku_tabungan=='1'){echo 'checked';}?>> COPY BUKU TABUNGAN 3 BULAN TERAKHIR</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="rekening_koran"  value="1" <? if($rekening_koran=='1'){echo 'checked';}?> > COPY REKENING KORAN PINJAMAN</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="npwp"  value="1" <? if($npwp=='1'){echo 'checked';}?>> COPY NPWP</th>
		</tr>
		<tr align="left"><th></th>
				<th><input type="checkbox" class="checkmark" name="form_aplikasi"  value="1" <? if($form_aplikasi=='1'){echo 'checked';}?> > FORM APLIKASI KREDIK KONSUMER</th>
		</tr>
		<table align="center">
				<tr align="center"><th></th>
					<th><input type="submit" class="btn btn-primary" name="kirim" value="Submit">
						<input type="button" value="Back" class="btn btn-danger" onclick="goBack()">
					</th>
				</tr>
			</table>
	</table>
	
	</form>
	
</body>
<script>
function goBack() {
    window.history.back();
}
</script>
<script type="text/javascript">
  function AlphaNumCheck(e) {
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode == 8) return true;

        var keynum;
        var keychar;
        var charcheck = /[a-zA-Z0-9]/;
        if (window.event)
        {
            keynum = e.keyCode;
        }
        else {
            if (e.which)
            {
                keynum = e.which;
            }
            else return true;
        }

        keychar = String.fromCharCode(keynum);
        return charcheck.test(keychar);
    }
	
	$(document).ready(function() {
	$("#no_apl").keyup(function() {
   var strcari = $("#no_apl").val();
   if (strcari != "") 
   {
    $("#hasil").html 
    $.ajax({
     type:"post",
     url:"pipeline_cari.php",
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

