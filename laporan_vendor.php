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

<div align="center" style="border:1px solid;background-color:#00BFFF"><strong><p>LAPORAN VENDOR</strong></p></div>
<p></p>
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
</select>

<p></p>
<span>Tahun</span>
<select name="year" id="year" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
</select>
</div>
</form>

<table style="margin-left:30px;" >
  <tr>
    <td><button class="btn" onclick="get_excel()" >PPU</button></td>
    <td><button class="btn" onclick="get_excel1()">PERSAEL</button></td>
	<td><button class="btn" onclick="get_excel4()">PERMATA</button></td>
  </tr>
</table>