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
</select><br>
</div>
<div class="span12">
<span>Tahun</span>
<select name="year" id="year" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
<option value="2018">2018</option>
</select>
</div>
</div>
</form>
<table>
  <tr>
    <td><button class="btn" onclick="get_excel()" >BATAL</button></td>
    <td><button class="btn" onclick="get_excel1()">TIDAK TERTARIK</button></td>
	<td><button class="btn" onclick="get_excel2()">EXPIRED</button></td>
	<td><button class="btn" onclick="get_excel2()">CLOSING</button></td>
  </tr>
</table><br>