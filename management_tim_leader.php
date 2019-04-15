<?php
session_start();
include('include/config.php');
$id 	= $_POST['id_report'];
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
			<div class="input-prepend pull-left ">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">	
			</div>
			<a href="laporan_management_tim_leader.php"><img src="images/excel-pipeline.png" style=" width:10%; height:10%; vertical-align: bottom; float:right;"></a>
		</h3>
		<!-- tempat untuk menampilkan data -->
		<div id="data-report"></div>
	</div>
<!-- awal untuk modal dialog (ada di css dengan .modal)-->
<div id="dialog-report" class="modal hide fade " style="width:60%" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form id="form-data1" action="data_tim_leader_input.php" method="post" enctype="multipart/form-data" >  
		<div class="modal-header">
			<button type="button" class="fa fa-close pull-right " data-dismiss="modal" aria-hidden="true"></button>
			<h3 id="myModalLabel">Tambah Data</h3>
		</div>
		<!-- tempat untuk menampilkan form mahasiswa -->
		<div class="modal-body"></div>
		<!--<div class="modal-footer"></div>-->
	</form>
</div>
<!-- akhir kode modal dialog -->

<!-- memanggil berkas javascript yang dibutuhkan -->
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.tl.js"></script>

</body>
</html>
