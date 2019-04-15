<?php
session_start();
include('include/config.php');
$id = $_POST['id'];
$level=$_SESSION['user_level'];
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
 <div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>DATA PERUSAHAAN</strong></p></div><br>
	<div class="row" style="width:98%;margin-left:10px;">	
		<h3>
			<div >
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">
			</div>
		</h3>
	<div id="data-bfp"></div>
		
	</div>
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.fronting.agent.js"></script>

</body>
</html>
