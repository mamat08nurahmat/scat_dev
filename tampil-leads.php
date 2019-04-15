<!DOCTYPE html>
<html>
<?php
include('include/config.php');
$kd_npp = $_POST['id'];
?>
<head>

  <meta charset="UTF-8">

  <title>AAA</title>
	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
	
</head>

<body>

<div class="wrapper">
<ul class="tabs clearfix" data-tabgroup="first-tab-group">
  <li><a href="#tab1" class="active"><img src="img/img-1.png"> Bucket</i></a></li>
  <li><a href="#tab3"><img src="img/img-2.png"> Leads</a></li>
</ul>
<section id="first-tab-group" class="tabgroup">
  <!-- tampilan data tab 1 -->
  <div id="tab1">
   <h2>
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">
				
			</h2>
   <div id="data-leads"></div>

</div>
<!-- tampilan data tab 2-->
<div id="tab3">
      <h2>
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">
				
			</h2>
   <div id="data-leads-2"></div> 
<!-- awal untuk modal dialog (ada di css dengan .modal)-->
<div id="dialog-leads" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Informasi Hasil Leads</h3>
	</div>
	<!-- tempat untuk menampilkan form mahasiswa -->

	<div class="modal-body">
	<!--<label class="control-label" for="id_vendor">AKSI</label>
		<div class="controls">
			<select class="input-medium" name="id_vendor">
				<option value="3">YA</option>
				<option value="2">TIDAK</option>
			</select> *
		</div>-->
	<label class="control-label" for="keterangan">keterangan</label>
		<div class="controls">
			<input type="hidden" name ="id_leads" id="id_leads" value="<?php echo $id_leads;?>">
			<textarea id="aksi" name="aksi"><?php echo $aksi ?></textarea>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
		<button id="simpan-leads" class="btn btn-success">Simpan</button>
	</div>
</div>
</div>

</section>
</div>


<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.leads.js"></script>
<script src='js/jquery-leads.js'></script>
<script src="js/index.js"></script>
</body>

</html>