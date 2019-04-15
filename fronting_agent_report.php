<?php
session_start(); 
?>
<html>
    <head>
        <meta charset="UTF-8">
		<link rel="stylesheet" href="bootstrap/css/bootstrapValidator.css">
        <script src="jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrapValidator.js"></script>
    </head>
        <?php
include "include/config.php";

$query = mssql_query ("SELECT id_perusahaan,nama_perusahaan FROM perusahaan ");
$arrpropinsi = array();
while ($row = mssql_fetch_array($query)) {
	$arrpropinsi [ $row['id_perusahaan'] ] = $row['nama_perusahaan'];
}
?>
<script type="text/javascript">
function get_excel1(){
var perusahaan=document.getElementById('perusahaan').value;
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
window.location.assign("fronting_agent_report_data.php?month="+month+"&year="+year+"&perusahaan="+perusahaan);
}
</script>
<div class="span_target_1" style="height:250px;">
	<div style="border:1px solid;background-color:#00BFFF">
		<h5><p><center>PRINT FRONT AGEN DATA</center></p></h5>
	</div><br>
	<table>
	<div class="span12">
		<span>BULAN</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="month" id="month" type="text" class="form-control">
				<option value="1">januari</option>
				<option value="2">februari</option>
				<option value="3">maret</option>
				<option value="4">april</option>
				<option value="5">mei</option>
				<option value="6">juni</option>
				<option value="7">juli</option>
				<option value="8">agustus</option>
				<option value="9">september</option>
				<option value="10">oktober</option>
				<option value="11">november</option>
				<option value="12">desember</option>
			</select>
	</div>
	<div class="span12">
		<span>TAHUN</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="year" id="year" type="text" class="form-control" >
				<option value="2018">2018</option>
			</select>
		</div>

	<div class="span12">
		<span>PERUSAHAAN</span>
			<select id="perusahaan" class="required" name="nama_perusahaan" required>
				<option value="1">ALL</option>
				<option value="<?php echo $nama_perusahaan ?>"><?php echo $nama_perusahaan ?></option>
				<?php
				foreach ($arrpropinsi as $kode=>$nama_perusahaan) {
					echo "<option value='$nama_perusahaan'>$nama_perusahaan</option>";
				}
				?>
			</select>
	</div>
	<div class="span12">
		<button  class="btn btn-danger" onclick="get_excel1()">EXPORT</button>
	</div>
	</table>
</div>