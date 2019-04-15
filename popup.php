<head>
<link href="css/style-popup.css" rel="stylesheet">
</head>
<?php
require_once 'aset-tabel/template/header.php';
?>

<script>
	$(document).ready(function() {
		$("#form_insert").validate({
			rules : {
				password : "required",
				passwordc : {
					equalTo : "#password"
				}
			}
		});
	}); 
</script>
<body>
<div id="closed"></div>
<a href="#popup" class="popup-link">Klik untuk memunculkan Popup</a>
<div class="popup-wrapper" id="popup">
<div class="popup-container"><!-- Konten popup, silahkan ganti sesuai kebutuhan -->
<form action="http://www.syakirurohman.net/2015/01/tutorial-membuat-popup-tanpa-javascript-jquery.html#" method="post" class="popup-form">
<h2>Ikuti Update !!</h2>
<div class="input-group">
<div class="container">

	<a class="btn btn-success" href="../user/user_form_view.php"> <i class="icon icon-arrow-left"></i> Back</a>

	<br />
	<br />
	<form action="user_act_insert.php" method="post" id="form_insert" name="form_insert">
		<div class="control-group">
			<label for="npp">npp : </label>
			<div class="controls">
				<input type="text" name="npp" id="npp" placeholder="npp" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="sales_type">type : </label>
			<div class="controls">
				<input type="text" name="sales_type" id="sales_type" placeholder="sales_type" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="nama">nama : </label>
			<div class="controls">
				<input type="text" name="nama" id="nama" placeholder="nama" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="status">status : </label>
			<div class="controls">
				<input type="text" name="status" id="status" placeholder="status" class="required" maxlength="20"/>
			</div>
		</div>

		<div class="control-group">
			<label for="upliner">upliner : </label>
			<div class="controls">
				<input type="text" name="upliner" id="upliner" placeholder="upliner" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="keterangan">keterangan : </label>
			<div class="controls">
				<input type="text" name="keterangan" id="keterangan" placeholder="keterangan" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="alamat">alamat : </label>
			<div class="controls">
				<input type="text" name="alamat" id="alamat" placeholder="alamat" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="officeID">office : </label>
			<div class="controls">
				<input type="text" name="officeID" id="officeID" placeholder="officeID" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="phone">phone : </label>
			<div class="controls">
				<input type="text" name="phone" id="phone" placeholder="phone" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="tanggal_aktif">aktif : </label>
			<div class="controls">
				<input type="text" name="tanggal_aktif" id="tanggal_aktif" placeholder="tanggal_aktif" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="tanggal_resign">resign : </label>
			<div class="controls">
				<input type="text" name="tanggal_resign" id="tanggal_resign" placeholder="tanggal_resign" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="password">Password : </label>
			<div class="controls">
				<input type="password" name="password" id="password" placeholder="Password" class="required" maxlength="20"/>
			</div>
		</div>

		<?
		if (isset($_GET['konfirmasi'])) {
			echo "<div id='form_alert' style='color:#DD1144' class='alert alert-success'>";
			echo "<a class='close' data-dismiss='alert' href='#'>x</a>Data berhasil disimpan!";
			echo "</div>";
		}
		?>

		<div class="control-group">
			<button type="submit" class="btn btn-primary">
				<i class="icon icon-plus"></i> Simpan
			</button>
			<button type="reset" class="btn btn-warning">
				<i class="icon icon-refresh"></i> Batal
			</button>
		</div>
	</form>
</div>
</div>
</form>
<!-- Konten popup sampai disini--><a class="popup-close" href="#closed">X</a>
</div>
</div>
</body>