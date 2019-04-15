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
				<input class="span2" id="prependedInput" type="text" name="cari_exps" placeholder="Pencarian All...">	
			</div>
				<div><a href="laporan_leads_expired.php"><img src="images/excel-pipeline.png" style=" width:10%; height:10%; vertical-align: bottom; float:right;"></a></div>		
		</h3>
		<!-- tempat untuk menampilkan data pipeline -->
	<div id="data_leads_expired"></div>
	</div >
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.leads.expired.js"></script>
</body>
</html>
