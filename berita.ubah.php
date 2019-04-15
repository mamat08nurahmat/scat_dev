<?php
include('include/config.php');
$id = $_POST['id'];
$data = mssql_fetch_array(mssql_query("SELECT * FROM berita WHERE id_berita=".$id));

if($id> 0) { 
	$judul       = $data['judul'];
	$isi       	 = $data['isi'];
	$tanggal     = $data['tanggal'];
	$aksi   	 = $data['aksi'];
	$id_berita 	 = $data['id_berita'];
	
} else {
	$judul       = "";
	$isi       	 = "";
	$tanggal     = "";
	$aksi		 = "";
	
}
?>
<form id="form-horizontal" action="berita.ubah.proses.php" method="post" enctype="multipart/form-data" >  
	<table>
		<div class="control-group">
			<input type="hidden"  name="id_berita" style="width:60%;" value="<?php echo $id_berita ?>">
			<label class="control-label">JUDUL</label>
			<div class="controls">
				<input type="text" placeholder="Judul Berita" name="judul" style="width:60%;" value="<?php echo $judul ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">BERITA</label>
				<div class="controls">
				<textarea name="isi" required style="width:60%;"><?php echo $isi ?></textarea>
				</div>
		</div>
		<div class="control-group">
			<label class="control-label">STATUS</label>
				<div class="controls">
					<select name="aksi" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 20%;" >
						<option <?php if ($aksi=='1'){echo "selected=\"selected\""; } ?>  value='1'>Aktif</option>
						<option <?php if ($aksi=='2') {echo "selected=\"selected\""; } ?> value='2'>Non-Aktif</option>
					</select>
				</div>
		</div>
	</table>
	<input type="submit" class="btn btn-primary" name="pilih" value="SIMPAN">
	<input class="btn btn-danger" data-dismiss="modal" aria-hidden="true" style="width:50px;" value="BATAL">
</form>