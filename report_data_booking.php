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
?>
<script type="text/javascript">
function get_excel(){
var ket=document.getElementById('ket').value;
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
window.location.assign("report_data_booking_data.php?month="+month+"&year="+year+"&ket="+ket);
}
</script>
<div class="span_target_1" style="height:250px;">
<div style="border:1px solid;background-color:#00BFFF">
<h5><p><center>PRINT DATA BOOKING</center></p></h5>
</div><br>
<table>
<div class="span12">
	<span>BULAN </span>
	<select name="month" id="month" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
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
	</select>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<div class="span12">
	<span>TAHUN </span>
	<select name="year" id="year" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
		<option value="2018">2018</option>
	</select>
</div>
	
<div class="span12">
	<span>STATUS </span>
	<select name="ket" id="ket" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 175px;">
		<option value="">--PILIH--</option>
		<option value="1">ALL</option>
		<option value="2">BOOKING</option>
		<option value="3">TIDAK BOOKING</option>
	</select>				
</div>
<div class="span12">
	<button class="btn btn-danger" onclick="get_excel()">EXPORT</button>
</div>
</table>
</div>