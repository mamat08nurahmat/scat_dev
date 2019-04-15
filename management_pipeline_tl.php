<?php
session_start();
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
</head>
<body>
	<div class="row" style="width:98%;margin-left:10px;">
		<h3>
			<!-- textbox untuk pencarian -->
			<div class="input-prepend">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">	
			</div>
		</h3>
		<a href="laporan_pipeline.php"><img src="images/excel-pipeline.png" style=" width:10%; height:10%; vertical-align: bottom; float:right;"></a>
		<!-- tempat untuk menampilkan data pipeline -->
		<div id="data_pipeline"></div>
</div >
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.pipeline.js"></script>
</body>
</html>
