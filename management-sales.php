<?php
session_start();
include('include/config.php');
$kd_npp = $_POST['id'];
$level=$_SESSION['user_level'];
if($level==1)
	{
	$tombol='';
	$tombol .='<a href="#dialog-mahasiswa" id="0" class="btn tambah" data-toggle="modal">
				<i class="icon-plus"></i> Tambah Data
			</a>';
}
elseif($level==2)
	{
	$tombol='';
	$tombol .='<a href="#dialog-mahasiswa" id="0" class="btn tambah" data-toggle="modal">
				<i class="icon-plus"></i> Tambah Data
			</a>';
}

else
{
	$tombol='';
	$tombol .='';
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


	<div class="row" style="width:98%;margin-left:10px;">
		
		<h3>
			<!-- textbox untuk pencarian -->
			<div class="input-prepend pull-right">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">
				
			</div>
			<!--<a href="#dialog-mahasiswa" id="0" class="btn tambah" data-toggle="modal">
				<i class="icon-plus"></i> Tambah Data
			</a>--->
			<?=$tombol;?>
		</h3>

		<!-- tempat untuk menampilkan data mahasiswa -->
		<div id="data-mahasiswa"></div>
	</div>


<!-- awal untuk modal dialog (ada di css dengan .modal)-->
<div id="dialog-mahasiswa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Tambah Data Sales</h3>
	</div>
	<!-- tempat untuk menampilkan form mahasiswa -->
	<div class="modal-body"></div>
	<div class="modal-footer">
		<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
		<button id="simpan-mahasiswa" class="btn btn-success">Simpan</button>
	</div>
</div>
<!-- akhir kode modal dialog -->

<!-- memanggil berkas javascript yang dibutuhkan -->
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.js"></script>

</body>
</html>
