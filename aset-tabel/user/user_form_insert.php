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

<div class="container">


	
	<form action="aset-tabel/user/user_act_insert.php" method="post" id="form_insert" name="form_insert">
	<div class="pop-kiri">
	<div class="form_settings">
		<div class="control-group">
			<div class="span12">
			<span>npp  </span><span>&nbsp;</span>
				<input type="text" name="npp" id="npp" placeholder="npp" class="required" maxlength="20" style="width:250px; text-align:center;"/>
			</div>
		</div>
		
		<div class="control-group">
			<div class="span12">
			<span>type  </span><span>&nbsp;</span>
				<input type="text" name="sales_type" id="sales_type" placeholder="sales_type" class="required" maxlength="20" style="width:250px;text-align:center;"/>
				</div>
		</div>
		
		<div class="control-group">
		<div class="span12">
			<span>nama  </span><span>&nbsp;</span>
				<input type="text" name="nama" id="nama" placeholder="nama" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>
		
		<div class="control-group">
			<div class="span12">
			<span>status </span><span>&nbsp;</span>
				<input type="text" name="status" id="status" placeholder="status" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>

		<div class="control-group">
		<div class="span12">
			<span>upliner </span><span>&nbsp;</span>
				<input type="text" name="upliner" id="upliner" placeholder="upliner" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>
		
		<div class="control-group">
		<div class="span12">
			<span>keterangan </span><span>&nbsp;</span>
				<input type="text" name="keterangan" id="keterangan" placeholder="keterangan" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>
		
		<div class="control-group">
		<div class="span12">
			<span>alamat</span><span>&nbsp;</span>
				<input type="text" name="alamat" id="alamat" placeholder="alamat" class="required" maxlength="200" style="width:250px;text-align:center;"/>
			</div>
		</div>
		
		<div class="control-group">
		<div class="span12">
			<span>office</span><span>&nbsp;</span>
				<input type="text" name="officeID" id="officeID" placeholder="office" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>
	</div>
	</div>
	
	<div class="pop-kanan">	
	<div class="form_settings">
		<div class="control-group">
		<div class="span12">
			<span>phone </span><span>&nbsp;</span>
				<input type="text" name="phone" id="phone" placeholder="phone" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>
			<!--
		<div class="control-group">
		<div class="span12">
			<span>aktif </span><span>&nbsp;</span>
				<input type="text" name="tanggal_aktif" id="tanggal_aktif" placeholder="aktif" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>
		
	
		<div class="control-group">
		<div class="span12">
		<form method="POST" action="datapicker-proses.php">
			<span>aktif </span><span>&nbsp;</span>
				<input type="text" name="tanggal_aktif" id="tanggal_aktif"  placeholder="aktif" class="required" maxlength="20" style="width:250px;text-align:center;" />
				</form>
			</div>
		</div>
		-->
		
		<div class="control-group">
		<div class="span12">
			<span>resign </span><span>&nbsp;</span>
				<input type="text" name="tanggal_resign" id="tanggal_resign" placeholder="resign" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>
		
		<div class="control-group">
		<div class="span12">
			<span>Password </span><span>&nbsp;</span>
				<input type="password" name="password" id="password" placeholder="Password" class="required" maxlength="20" style="width:250px;text-align:center;"/>
			</div>
		</div>

		<?
		if (isset($_GET['konfirmasi'])) {
			echo "<div id='form_alert' style='color:#DD1144' class='alert alert-success'>";
			echo "<a class='close' data-dismiss='alert' href='#'>x</a>Data berhasil disimpan!";
			echo "</div>";
		}
		?>

	</div>
	</div>
	
	<div class="pop-bawah">
			<div class="control-group">
			<button type="submit" class="btn btn-primary">
				<i class="icon icon-plus"></i> Simpan
			</button>
			<button type="reset" class="btn btn-warning">
				<i class="icon icon-refresh"></i> Batal
			</button>
		</div>
		</div>
	</form>

</div>
</body>
</html>