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
			<div class="input-prepend pull-left">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="cari_store" placeholder="Pencarian All...">
				<p></p>
			<?php 
				if($_SESSION['user_level']==8 || $_SESSION['user_level']==9 || $_SESSION['user_level']==11 || $_SESSION['user_level']==12 )
				{
			?>
				<div><a href="index.php?page=29c" class="btn tambah"><i class="icon-plus"></i>Tambah data</a></div>		
			<?php } ?>
			</div>
				<div><a href="laporan_leads_store.php"><img src="images/excel-pipeline.png" style=" width:10%; height:10%; vertical-align: bottom; float:right;"></a></div>		
		</h3>	
		<!-- tempat untuk menampilkan data -->
		<div id="data-leads"></div>
	</div>
<!-- memanggil berkas javascript yang dibutuhkan -->
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.leads.storee.js"></script>
</body>
</html>
