<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="favicon.png"/>
	<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<table>
	<div class="span12"><h2>Import Data Leads </h2></div>
		<div class="pull-right"><a href="uploads/leads.xls" class="btn " download>Download Template Upload Excel</a></div><br>
			<form action="upload_leads_proses.php" method="post" enctype="multipart/form-data">
				<div class="form_settings">
					<div class="span14">
						<p><span>Pilih File</span><span> *xls&nbsp;</span><input  type="file" name="fileexcel"  /></p>
					</div><br>
					<div class="span12">
						<p><span>&nbsp;</span><span>&nbsp;</span><input class="submit" type="submit" name="upload" value="Import" /></p>
					</div>
				</div>
			</form>	
</table>	
<table>	
		<h3>
			<!-- textbox untuk pencarian -->
			<br><br><div class="input-prepend pull-right">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="cari_data_upload" placeholder="Pencarian All...">
			</div>
			<a href="laporan_leads.php"><img src="images/excel-pipeline.png" style=" width:10%; height:10%; vertical-align: bottom; float:left;"></a>
		</h3>
</table>
	<div id="data-leads-upload"></div>	
	
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.leads.upload.js"></script>

</body>
</html>