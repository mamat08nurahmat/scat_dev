<?php 
include('include/config.php');
if($_POST['pilih']){

	$id				= $_POST['id'];
	$nama_nasabah	= $_POST['nama_nasabah'];
	$pp				= $_POST['persetujuan_pengalihan'];
	$nominal		= str_replace ("Rp","",str_replace(".","",$_POST['nominal']));
	$no_perjanjian	= $_POST['no_perjanjian'];
	$no_rekening	= $_POST['no_rekening'];
	$npp			= $_POST['npp'];
	$keterangan		= $_POST['keterangan'];
	$ket			= $_POST['ket'];
	$tgl_update		= $_POST['tgl_update'];

	$order = mssql_query("UPDATE report_tl SET 
			nama_nasabah			= '$nama_nasabah',
			persetujuan_pengalihan 	= '$pp',
			nominal				 	= '$nominal',
			no_perjanjian	 		= '$no_perjanjian',
			no_rekening				= '$no_rekening',
			npp						= '$npp',
			keterangan			 	= '$keterangan',
			ket			 			= '2',
			tgl_update	 			= SYSDATETIME(),
			nama_pemproses			= '$_SESSION[namauser]'
			WHERE id_report ='$id'");
//var_dump($order);die():

		if($order)
		{
		echo"
			<script> 
				alert('LEADS SUDAH DI PROSES');
				window.location.replace('index.php?page=29g'); </script> ";
		}
		else
		{
		echo "LEADS GAGAL DPROSES ".mssql_get_last_message();
		}
  }

?>
<?php
session_start();
include('include/config.php');
$id = $_GET['id'];
?>
    
<?php
$data = mssql_fetch_array(mssql_query("SELECT * FROM report_tl a LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area WHERE id_report=".$id));
if($id> 0) { 
	$nama_nasabah	= $data['nama_nasabah'];
	$pp		 		= $data['persetujuan_pengalihan'];
	$nominal 		= $data['nominal'];
	$no_perjanjian	= $data['no_perjanjian'];
	$no_rekening	= $data['no_rekening'];
	$keterangan		= $data['keterangan'];

} else {
	$nama_nasabah	= "";
	$pp		 		= "";
	$nominal 		= "";
	$no_perjanjian	= "";
	$no_rekening	= "";
	$keterangan		= "";
	
}

?>

<form id="form-data1" action="" method="post" enctype="multipart/form-data">
<input type="hidden" id="id" class="input-xlarge" name="id" value="<?php echo $id ?>"> 
<input type="hidden" id="ket" class="input-xlarge" name="ket" value="2">
<div align="center" style="border:1px solid;background-color:#00BFFF"><strong>EDIT REPORT TIM LEADER</strong></div><br>		
	<div class="control-group">
		<label class="control-label" for="nama_nasabah">Nama Nasabah</label>
		<div class="controls">
			<input type="text" id="nama_nasabah" class="input-xlarge" name="nama_nasabah" value="<?php echo $nama_nasabah ?>"> *
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="persetujuan_pengalihan">Persetujuan Pengalihan Mutasi Bayar dan Pinjaman</label>
		<div class="controls">
			<td><input name="persetujuan_pengalihan" type="radio" value="1" <? if($pp=='1'){echo 'checked';}?>  class="required" required/>YA</td>
			<td><input name="persetujuan_pengalihan" type="radio" value="2" <? if($pp=='2'){echo 'checked';}?>  />TIDAK</td>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="nominal">Nominal Kredit</label>
		<div class="controls">
			<input type="text" id="nominal" class="input-xlarge" name="nominal" value="<?php echo $nominal ?>"> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="no_perjanjian">No Perjanjian Kredit</label>
		<div class="controls">
			<input type="text" id="no_perjanjian" class="input-xlarge" name="no_perjanjian" value="<?php echo $no_perjanjian ?>"> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="no_rekening">No Rekening Pinjaman</label>
		<div class="controls">
			<input type="text" id="no_rekening" class="input-xlarge" name="no_rekening" value="<?php echo $no_rekening ?>"> *
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="npp">NPP Sales</label>
		<div class="controls">
			<input type="text" id="npp" class="input-xlarge" name="npp" value="<?php echo $npp ?>"> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="keterangan">Keterangan (Diisi apabila Nasabah tidak setuju)</label>
		<div class="controls">
			<textarea id="keterangan" name="keterangan"><?php echo $keterangan ?></textarea>
		</div>
	</div>
	
	<table align="center">
		<tr><td><input type="submit" class="btn btn-primary" name="pilih" value="UPDATE"></td>
			<td><a href="index.php?page=29g" class="btn btn-danger" >BACK</a>
			</td></tr>
	</table>
</form>

    <link rel="stylesheet" type="text/css" href="../combobox/libs/bootstrap.css" media="screen" />
		<script type="text/javascript" src="../combobox/libs/jquery.min.js"></script>
		<script type="text/javascript">
		var j = jQuery.noConflict();
			$(document).ready(function(){
				$('#propinsi').change(function(){
					$.getJSON('mahasiswa.form.php',{action:'getKab', kode_prop:$(this).val()}, function(json){
						$('#id_cabang').html('');
						$.each(json, function(index, row) {
							$('#id_cabang').append('<option value='+row.kode+'>'+row.nama+'</option>');
						});
					});
				});
			});
	</script>
	<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.datepicker.js"></script>
	