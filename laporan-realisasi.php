<?php
include "include/config.php";
?>
<script type="text/javascript">
function get_excel(){
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
window.location.assign("get-laporan-realisasi.php?month="+month+"&year="+year);
}

function get_excel1(){
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
window.location.assign("get-laporan-performance.php?month="+month+"&year="+year);
}

function get_excel2(){
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
window.location.assign("get-laporan-insentif.php?month="+month+"&year="+year);
}

function get_excel3(){
var status_sales=document.getElementById('status_sales').value;
window.location.assign("get-laporan-datasales.php?status_sales="+status_sales);
}

function get_excel4(){
var status_sales=document.getElementById('status_sales').value;
window.location.assign("get-laporan-pipeline.php?status_sales="+status_sales);
}



</script>

<form class="form_settings" action="cari.php" method="post">
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
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
</select>
</div>
<!--Masukkan kata yang anda cari <input name="cari" type="text" id="cari">
<input type ="submit" value="cari"  -->
</div>
</form>
<table width="600" height="200" style="margin-left:30px;" >
  <tr>
    <td><span><b>&raquo; Realisasi Sales</b></span> &nbsp;&nbsp;<button class="btn" onclick="get_excel()" >D.Realisasi</button></td><br>
    <td><span><b>&raquo; Performance Sales</b></span>&nbsp;&nbsp;<button class="btn" onclick="get_excel1()">D.Performance</button></td>
	<!--<td><span><b>&raquo; Data Pipeline</b></span>&nbsp;&nbsp;<button class="btn" onclick="get_excel2()">D.Pipeline</button></td>-->
  </tr>
  <tr>
  <td><span><b>&raquo; Insentif Sales</b></span> &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn" onclick="get_excel2()">D.Insentif</button></td>
  <td><select name="year" id="status_sales" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 137px;">
		<option value="1">Sales Aktif</option>
		<option value="2">Sales Resign</option>
		<option value="3">Sales Cancel</option>
		</select>
		<button class="btn" onclick="get_excel3()">D.Sales</button></td>
  </tr>
</table>