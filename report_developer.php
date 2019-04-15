<?php
include "include/config.php";
?>
<script type="text/javascript">
function get_excel1(){
var status_developer=document.getElementById('status_developer').value;
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
window.location.assign("report_data_developer.php?month="+month+"&year="+year+"&status_developer="+status_developer);
}
</script>
<div class="span_target_1" style="height:250px;">
<div style="border:1px solid;background-color:#00BFFF">
<h5><p><center>PRINT DATA DEVELOPER</center></p></h5>
</div><br>
<table>
<div class="span12">
	<span>BULAN</span>&nbsp;
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
	<span>TAHUN</span>&nbsp;
	<select name="year" id="year" type="text" class="form-control">
		<option value="2018">2018</option>
	</select>
</div>

<div class="span12">
	<span>STATUS</span>
	<select name="status_developer" id="status_developer" type="text" class="form-control" >
		<option value="">--PILIH--</option>
		<option value="0">ALL</option>
		<option value="1">Aktif</option>
		<option value="2">Non Aktif</option>
	</select>
</div>

<div class="span12">
	<button class="btn btn-danger" onclick="get_excel1()">EXPORT</button>
</div><p></p>
		
		
</table>

</div>