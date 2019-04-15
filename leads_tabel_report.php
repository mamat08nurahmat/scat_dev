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

function get_excel1(){
var status=document.getElementById('status').value;
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
window.location.assign("leads_laporan_batal.php?month="+month+"&year="+year+"&status="+status);
}
</script>
	<div><a href="laporan_leads_succes.php"><img src="images/excel-pipeline.png" style=" width:10%; height:10%; vertical-align: bottom; float:right;"></a></div>		
		
<table>
<div class="form_settings">
	<div class="span12">
		<span>Bulan</span>
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
		<span>Tahun</span>
		<select name="year" id="year" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
		<option value="2018">2018</option>
		</select>
	</div>

	<div class="span12">
	<span>Report</span>
	<select name="status" id="status"  class="form-control" >
		<option value="5">CART TIDAK TERTARIK</option>
		<option value="6">FOLLOW UP BATAL</option>
		<option value="8">CLOSING</option>
	</select>
	</div>
	<br><button class="btn" onclick="get_excel1()">PRINT</button></td>
</div>
  </table>
