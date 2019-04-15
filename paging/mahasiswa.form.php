<?php
// panggil file koneksi.php
require 'koneksi.php';

// buat koneksi ke database mssql
//koneksi_buka();
include('koneksi.php');
// tangkap variabel kd_mhs
$npp = $_POST['id'];

// query untuk menampilkan mahasiswa berdasarkan kd_mhs
//$tampil = "SELECT * FROM sales WHERE npp=".$npp";
//$tampil ="SELECT * FROM sales WHERE npp='$npp'";

$data = mssql_fetch_array(mssql_query("SELECT * FROM sales WHERE npp='$npp'"));

// jika kd_mhs > 0 / form ubah data
if($npp==0) { 

	$npp			= $data['npp'];
	$id_grup		= $data['id_grup'];
	$id_vendor		= $data['id_vendor'];
	$id_cabang		= $data['id_cabang'];
	$nama			= $data['nama'];
	$tanggal_lahir 	= $data['tanggal_lahir'];
	$status 		= $data['status'];
	$id_user_atasan	= $data['id_user_atasan'];
	$id_user_leader	= $data['id_user_leader'];
	$grade			= $data['grade'];
	$alamat			= $data['alamat'];
	$telepon		= $data['telepon'];
	$keterangan		= $data['keterangan'];
	$tanggal_aktif	= $data['tanggal_aktif'];
	$tanggal_resign	= $data['tanggal_resign'];
	$tanggal_buat	= $data['tanggal_buat'];

//form tambah data
} else {
	$npp			= "";
	$id_grup		= "";
	$id_vendor		= "";
	$id_cabang		= "";
	$nama			= "";
	$tanggal_lahir 	= "";
	$status 		= "";
	$id_user_atasan	= "";
	$id_user_leader	= "";
	$grade			= "";
	$alamat			= "";
	$telepon		= "";
	$keterangan		= "";
	$tanggal_aktif	= "";
	$tanggal_resign	= "";
	$tanggal_buat	= "";
}

?>
<form class="form-horizontal" id="form-mahasiswa">
	<div class="control-group">
		<label class="control-label" for="npp">NPP</label>
		<div class="controls">
			<input type="text" id="npp" class="input-medium" name="npp" value="<?php echo $npp ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="id_grup">id_group</label>
		<div class="controls">
			<input type="text" id="id_grup" class="input-xlarge" name="id_grup" value="<?php echo $id_grup ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="id_vendor">id_vendor</label>
		<div class="controls">
			<input type="text" id="id_vendor" name="id_vendor"><?php echo $id_vendor ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="id_cabang">id_cabang</label>
		<div class="controls">
			<input type="text" id="id_cabang" name="id_cabang"><?php echo $id_cabang ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="nama">nama</label>
		<div class="controls">
			<input type="text" id="nama" name="nama"><?php echo $nama ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="tanggal_lahir">tanggal_lahir</label>
		<div class="controls">
			<input type="text" id="tanggal_lahir" name="tanggal_lahir"><?php echo $tanggal_lahir ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="status">status</label>
		<div class="controls">
			<input type="text" id="status" name="status"><?php echo $status ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="id_user_atasan">id_user_atasan</label>
		<div class="controls">
			<input type="text" id="id_user_atasan" name="id_user_atasan"><?php echo $id_user_atasan ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="id_user_leader">id_user_leader</label>
		<div class="controls">
			<input type="text" id="id_user_leader" name="id_user_leader"><?php echo $id_user_leader ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="grade">grade</label>
		<div class="controls">
			<input type="text" id="grade" name="grade"><?php echo $grade ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="alamat">alamat</label>
		<div class="controls">
			<textarea id="alamat" name="alamat"><?php echo $alamat ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="telepon">telepon</label>
		<div class="controls">
			<input type="text" id="telepon" name="telepon"><?php echo $telepon ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="keterangan">keterangan</label>
		<div class="controls">
			<textarea id="keterangan" name="keterangan"><?php echo $keterangan ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="tanggal_aktif">tanggal_aktif</label>
		<div class="controls">
			<input type="text" id="tanggal_aktif" name="tanggal_aktif"><?php echo $tanggal_aktif ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="tanggal_resign">tanggal_resign</label>
		<div class="controls">
			<input type="text" id="tanggal_resign" name="tanggal_resign"><?php echo $tanggal_resign ?></textarea>
		</div>
	</div>
		<div class="control-group">
		<label class="control-label" for="tanggal_buat">tanggal_buat</label>
		<div class="controls">
			<input type="text" id="tanggal_buat" name="tanggal_buat"><?php echo $tanggal_buat ?></textarea>
		</div>
	</div>

</form>

