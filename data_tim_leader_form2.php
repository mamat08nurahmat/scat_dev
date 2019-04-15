<?php
session_start();
include('include/config.php');
$id = $_POST['id'];
?>
    
<?php

$data = mssql_fetch_array(mssql_query("SELECT * FROM report_tl a LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area WHERE id_report=".$id));
//form ubah data
if($id> 0) { 
	$nama_nasabah	= $data['nama_nasabah'];
	$pp		 		= $data['persetujuan_pengalihan'];
	//$nominal 		= $data['nominal'];
	$tgl_outstanding= $data['tgl_outstanding'];
	$nominal=number_format($data['outstanding'],0,",",".");		
	$no_perjanjian	= $data['no_perjanjian'];
	$no_rekening	= $data['no_rekening'];
	$no_affiliasi	= $data['no_rekening_affiliasi'];
	$npp			= $data['npp'];
	$keterangan		= $data['keterangan'];

} else {
	$nama_nasabah	= "";
	$pp		 		= "";
	//$nominal 		= "";
	$tgl_outstanding= "";
	$nominal		= "";
	$no_perjanjian	= "";
	$no_rekening	= "";
	$no_affiliasi	= "";
	$npp			= "";
	$keterangan		= "";
	
}

?>
<script>
$(document).ready(function(){
	 $("#a").hide();
	 $("#b").hide();
     $("#keterangan").hide();
    $("#hide").click(function(){
		$("#a").hide();
		$("#b").show();
		$("#keterangan").hide();
		$("#keterangan").value("");
    });
    $("#show").click(function(){
		$("#a").show();
		$("#b").hide();
		$("#keterangan").show();
    });
});
</script>

<script>
$(document).ready(function(){
	 $("#c").hide();
	 $("#d").hide();
     $("#perusahaan").hide();
	 $("#npp").hide();
    $("#hide2").click(function(){
		$("#c").hide();
		$("#d").show();
		$('#perusahaan')[0].selectedIndex=0;
        $("#npp").show();
		$("#perusahaan").hide();
		
    });
    $("#show2").click(function(){
		$("#c").show();
		$("#d").hide();
		$("#npp1").val('0');
        $("#npp").hide();
		$("#perusahaan").show();
    });
});
</script>
<form id="form-horizontal" action="data_tim_leader_input.php" method="post" enctype="multipart/form-data" >  
<input type="hidden" id="id" class="input-xlarge" name="id" value="<?php echo $id ?>"> 
		
	<div class="control-group">
		<label class="control-label" for="nama_nasabah">Nama Nasabah</label>
		<div class="controls">
			<input type="text" id="nama_nasabah" class="input-xlarge" name="nama_nasabah" value="<?php echo $nama_nasabah ?>" readonly> 
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="no_rekening_affiliasi">Nomor Rekening Affiliasi</label>
		<div class="controls">
			<input type="text" id="no_rekening_affiliasi" class="input-xlarge" name="no_rekening_affiliasi" value="<?php echo $no_affiliasi ?>" readonly> 
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="outstanding">Nominal Outstanding</label>
		<div class="controls">
			<input type="text" id="outstanding" class="input-xlarge" name="outstanding" value="Rp. <?php echo $nominal ?>" readonly> 
		</div>
	</div>
	<div class="control-group" id="mySelect" onchange="myFunction()" >
		<label class="control-label" for="persetujuan_pengalihan">Persetujuan Pengalihan Mutasi Bayar dan Pinjaman</label>
		<div class="controls">
			<td><input name="persetujuan_pengalihan" type="radio" value="1" <? if($pp=='1'){echo 'checked';}?>  id="hide" required/>YA</td>
			<td><input name="persetujuan_pengalihan" type="radio" value="2" <? if($pp=='2'){echo 'checked';}?> id="show" />TIDAK</td>
		</div>
	</div>
	<!--
	<div class="control-group">
		<label class="control-label" for="nominal">Nominal Kredit(outstanding bukopin)</label>
		<div class="controls">
			<input type="text" id="tanpa-rupiah" class="input-xlarge" name="nominal" value="<?php echo $nominal ?>"   required/>
			<input type="hidden" id="nominal" class="input-xlarge" name="nominal" value="<?php echo $nominal ?>" >
			<input type="date" id="tgl_outstanding" class="input-xlarge" name="tgl_outstanding" value="<?php echo $tgl_outstanding?>" required/>*
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="no_perjanjian">No Perjanjian Kredit</label>
		<div class="controls">
			<input type="text" id="no_perjanjian" class="input-xlarge" name="no_perjanjian" value="<?php echo $no_perjanjian ?>" required/> *
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="no_rekening">No Rekening Pinjaman</label>
		<div class="controls">
			<input type="text" id="no_rekening" class="input-xlarge" name="no_rekening" value="<?php echo $no_rekening ?>" required/> *
		</div>
	</div>
	-->
	<div class="control-group" id="mySelect2" onchange="myFunction()2" >
		<div class="controls">
			<input name="check" type="radio" id="hide2" required/>  NPP Sales
			<input name="check" type="radio" id="show2" />  Fronting Agent
		</div>
	</div>		
	<div class="control-group">
		<div class="controls"  id="npp">
			<input type="text" id="npp1" class="input-medium" name="npp" onkeypress="return hanyaAngka(event)" maxlength="5" value="<?php echo $npp ?>" /> 
		</div>
	</div>
	
		<div class="control-group">
		<div class="controls">
			<select class="input-medium" name="perusahaan" id="perusahaan">
				<option value="">pilih</option>
				<option value="1">PT BSR</option>
				<option value="2">PT TAS</option>
				<option value="3">PT MKSA</option>
				<option value="4">PT ETS</option>
			</select>
		</div>
	</div>
	

	<div class="control-group" id="keterangan" >
		<label class="control-label" for="keterangan">Keterangan (Diisi apabila Nasabah tidak setuju)</label>
		<div class="controls">
			<textarea id="keterangan" name="keterangan" /><?php echo $keterangan ?></textarea>
		</div>
	</div>
	<input type="submit" class="btn btn-primary" name="pilih" value="SIMPAN" onclick="return validasi_input(form)">
	<input class="btn btn-danger" data-dismiss="modal" aria-hidden="true" style="width:50px;" value="BATAL">
</form>
	<script>
	function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		    return false;
		  return true;
	}

	
function validasi_input(form){
	if($('#hide2').is(':checked')){
	 var mincar = 5;
	  if (form.npp.value.length < mincar){
		alert("NPP Minimal 5 Karater!");
		form.npp.focus();
		return (false);
	  }
	   return (true);
		
	} 

		if($('#show2').is(':checked')){		

		 if ($('#perusahaan')[0].selectedIndex<=0) {
			  alert("Perusahaan Belum Dipilih!");
		  form.perusahaan.focus();
		  return false;
		}else
		{  
			
			return true;
		}
	}

}	
	var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        
		tanpa_rupiah.value = formatRupiah(this.value,'Rp. ');
		nominal.value = this.value;
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
	