<?php
session_start();
include('include/config.php');
$id = $_POST['id'];
?>
    
<?php

$data = mssql_fetch_array(mssql_query("SELECT * FROM report_tl a LEFT JOIN (SELECT KODE_cabang,ID_AREA,nama_cabang FROM CABANG WHERE tipe_cabang =  'KCU') c on a.id_cabang=c.kode_cabang LEFT JOIN area d on c.id_area=d.id_area WHERE id_report=".$id));
//form ubah data
if($id> 0) { 
	$nama_nasabah			= $data['nama_nasabah'];
	$pp		 				= $data['persetujuan_pengalihan'];
	//$nominal 				= $data['nominal'];
	$tgl_outstanding		= $data['tgl_outstanding'];
	$nominal				=number_format($data['outstanding'],0,",",".");	
	$no_perjanjian			= $data['no_perjanjian'];
	$no_rekening			= $data['no_rekening'];
	$no_affiliasi			= $data['no_rekening_affiliasi'];
	$angsuran				= $data['angsuran'];
	$npp					= $data['npp'];
	$keterangan				= $data['keterangan'];
	$perusahaan				= $data['perusahaan'];

} else {
	$nama_nasabah			= "";
	$pp		 				= "";
	//$nominal 				= "";
	$tgl_outstanding		= "";
	$nominal 				= "";
	$no_perjanjian			= "";
	$no_rekening			= "";
	$no_affiliasi			= "";
	$angsuran				= "";
	$npp					= "";
	$keterangan				= "";
	$perusahaan				= "";
	
}

?>
<script>
$(document).ready(function(){
     $("#keterangan2").hide();
    $("#hide1").click(function(){
		$("#keterangan2").hide();
		$("#keterangan2").value("");
    });
    $("#show1").click(function(){
		$("#keterangan2").show();
    });
});
</script>
<form id="form-horizontal" action="data_tim_leader_input_followup.php" method="post" enctype="multipart/form-data" >  
<table>
		<input type="hidden" id="id" class="input-xlarge" name="id" value="<?php echo $id ?>">
		<tr align="left"><th>&nbsp;Nama Nasabah</th>
			<th><input type="text" id="nama_nasabah" class="input-xlarge" name="nama_nasabah" value="<?php echo $nama_nasabah ?>" readonly></th>
		</tr>
		<tr align="left"><th>&nbsp;No Rek Affiliasi</th>
			<th><input type="text" id="no_rekening_affiliasi" class="input-xlarge" name="no_rekening_affiliasi" value="<?php echo $no_affiliasi ?>" readonly> </th>
		</tr>	
		<tr  align="left"><th>Persetujuan Pengalihan Mutasi Bayar dan Pinjaman</th>
			<th id="mySelect1" onchange="myFunction()" ><input name="persetujuan_pengalihan" type="radio" value="1" <? if($pp=='1'){echo 'checked';}?>  id="hide1" required/>YA
				<input name="persetujuan_pengalihan" type="radio" value="2" <? if($pp=='2'){echo 'checked';}?> id="show1" />TIDAK
				<textarea id="keterangan2" name="keterangan" /><?php echo $keterangan ?></textarea></th>
		</tr>
		<tr align="left"><th>&nbsp;Nominal Kredit(outstanding bukopin)</th>
			<th><input type="text" id="outstanding" class="input-xlarge" name="outstanding" value="Rp. <?php echo $nominal ?>" readonly> 
				<input type="date" id="tgl_outstanding" class="input-xlarge" name="tgl_outstanding" required/>
			</th>
		</tr>
		<tr align="left"><th>&nbsp;No Perjanjian Kredit</th> 
			<th><input type="text" id="no_perjanjian" class="input-xlarge" name="no_perjanjian" required/></th>
		</tr>
	
		<tr align="left"><th>&nbsp;No Rekening Pinjaman</th>
			<th><input type="text" id="no_rekening" class="input-xlarge" name="no_rekening" onkeypress="return hanyaAngka(event)" required/></th>
		</tr>
		<tr align="left"><th>&nbsp;Angsuran ( Pokok + Bunga) </th>
			<th><input type="text" class="input-xlarge" name="angsuran" onkeypress="return hanyaAngka(event)"  required/>
				<!--<input type="hidden" id="angsuran" class="input-xlarge" name="angsuran"  onkeypress="return hanyaAngka(event)"   required>-->
			</th>
		</tr>
		<?php
		if($npp!="" || $npp > 0 ){
		?>
		<tr align="left"><th>&nbsp;NPP Sales</th>
			<th><input type="text" id="npp" class="input-medium" name="npp" onkeypress="return hanyaAngka(event)" maxlength="5" value="<?php echo $npp ?>" required/></th>
		</tr>
		<?php } ?>
		<?php
		if($perusahaan!=""){
		?>
		<tr align="left"><th>&nbsp;Fronting Agent</th>
			<th><select class="input-medium" name="perusahaan" id="Fronting">
				<option value="">pilih</option>
				<option <?php if ($perusahaan=='1'){echo "selected=\"selected\""; } ?>  value="1">PT BSR</option>
				<option <?php if ($perusahaan=='2'){echo "selected=\"selected\""; } ?>	value="2">PT TAS</option>
				<option <?php if ($perusahaan=='3'){echo "selected=\"selected\""; } ?> 	value="3">PT MKSA</option>
				<option <?php if ($perusahaan=='4'){echo "selected=\"selected\""; } ?>	value="4">PT ETS</option>
			</select>
			</th>
		</tr>
		<?php } ?>
	
</table>
	<center><input type="submit" class="btn btn-primary" name="pilih" value="SIMPAN">
	<input class="btn btn-danger" data-dismiss="modal" aria-hidden="true" style="width:50px;" value="BATAL"></center>
</form>
	<script>
	function hanyaAngka(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		    return false;
		  return true;
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
	
	var tanpa_rupiah1 = document.getElementById('tanpa-rupiah1');
    tanpa_rupiah1.addEventListener('keyup', function(e)
    {
        
		tanpa_rupiah1.value = formatRupiah1(this.value,'Rp. ');
		nominal.value = this.value;
    });
    
    /* Fungsi */
    function formatRupiah1(angka, prefix)
    {
        var number_string1 = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string1.split(','),
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
	