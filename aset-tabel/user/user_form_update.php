<?php
require_once 'aset-tabel/inc/config.php';

// $username = $_GET['username'];

$npp = isset($_GET['npp']) ? $_GET['npp'] : null;
//atau:
//$page = isset($_GET['page']) ? $_GET['page'] : false;
//atau bisa juga dengan:
//$page = isset($_GET['page']) ? $_GET['page'] : "";

$query = "SELECT * FROM sales WHERE npp='$npp'";
$result = mssql_query($query) or die(mysql_error());
$data = mssql_fetch_array($result) or die(mysql_error());
?>

<?php
require_once 'aset-tabel/template/header.php';
?>

<script>
	$(document).ready(function() {
		$("#form_update").validate({
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

	<a class="btn btn-success" href="user_form_view.php"> <i class="icon icon-arrow-left"></i> Back</a>

	<br />
	<br />

	<form action="aset-tabel/user/user_act_update.php" method="post" id="form_update" name="form_update">
		<input type="hidden" name="npp" value="<?php echo $npp; ?>" />
		
		<div class="control-group">
			<label for="npp">npp : </label>
			<div class="controls">
				<input value="<?php echo $data['npp']; ?>" type="text" name="npp" id="npp" placeholder="npp" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="sales_type">type : </label>
			<div class="controls">
				<input value="<?php echo $data['sales_type']; ?>" type="text" name="sales_type" id="sales_type" placeholder="sales_type" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="nama">nama : </label>
			<div class="controls">
				<input value="<?php echo $data['nama']; ?>" type="text" name="nama" id="nama" placeholder="nama" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="status">status : </label>
			<div class="controls">
				<input value="<?php echo $data['status']; ?>" type="text" name="status" id="status" placeholder="status" class="required" maxlength="20"/>
			</div>
		</div>

		<div class="control-group">
			<label for="upliner">upliner : </label>
			<div class="controls">
				<input value="<?php echo $data['upliner']; ?>" type="text" name="upliner" id="upliner" placeholder="upliner" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="keterangan">keterangan : </label>
			<div class="controls">
				<input value="<?php echo $data['keterangan']; ?>" type="text" name="keterangan" id="keterangan" placeholder="keterangan" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="alamat">alamat : </label>
			<div class="controls">
				<input value="<?php echo $data['alamat']; ?>" type="text" name="alamat" id="alamat" placeholder="alamat" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="officeID">office : </label>
			<div class="controls">
				<input value="<?php echo $data['officeID']; ?>" type="text" name="officeID" id="officeID" placeholder="officeID" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="phone">phone : </label>
			<div class="controls">
				<input value="<?php echo $data['phone']; ?>" type="phone" name="phone" id="phone" placeholder="phone" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="tanggal_aktif">aktif : </label>
			<div class="controls">
				<input value="<?php echo $data['tanggal_aktif']; ?>" type="tanggal_aktif" name="tanggal_aktif" id="tanggal_aktif" placeholder="tanggal_aktif" class="required" maxlength="20"/>
			</div>
		</div>
		
		<div class="control-group">
			<label for="tanggal_resign">resign : </label>
			<div class="controls">
				<input value="<?php echo $data['tanggal_resign']; ?>" type="tanggal_resign" name="tanggal_resign"  placeholder="tanggal_resign" class="required" maxlength="20"/>
			</div>
		</div>

		<div class="control-group">
			<label for="password">Password : </label>
			<div class="controls">
				<input value="<?php echo $data['password']; ?>" type="password" name="password" placeholder="Password"  class="required"/>
			</div>
		</div>

		<?
		if (isset($_GET['confirm'])) {
			echo "<div id='form_alert_update' style='color:#DD1144' class='alert alert-success'>";
			echo "<a class='close' data-dismiss='alert' href='#'>x</a>Data berhasil diupdate!";
			echo "</div>";
		}
		?>

		<div class="control-group">
			<button type="submit" value="update" class="btn btn-primary">
				<i class="icon icon-pencil"></i> Update
			</button>
		</div>
	</form>
</div>
</body>
</html>