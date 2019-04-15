<?php 
include('include/config.php');
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="row" style="width:98%;margin-left:10px;">	
		<h3>
			<!-- textbox untuk pencarian -->
			<div class="input-prepend pull-right">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">
			</div>
			<a href="#dialog-berita" id="0" class="btn tambah" data-toggle="modal">
				<i class="icon-plus"></i> Tambah Berita
			</a>
		</h3>
		<!-- tempat untuk menampilkan data mahasiswa -->
		<div id="data-berita"></div>
</div>
	
<!-- awal untuk modal dialog (ada di css dengan .modal)-->
<div id="dialog-berita" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="fa fa-close pull-right " data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Tambah Berita</h3>
	</div>
	<div class="modal-body"></div>
</div>
<!-- akhir kode modal dialog -->
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.berita.js"></script>
</body>
</html>

	






	

