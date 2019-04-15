<?php
include "include/config.php";
?>
<script type="text/javascript">
function get_excel5(){
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
var status=document.getElementById('status').value;
window.location.assign("get-laporan-leads.php?month="+month+"&year="+year+"&status="+status);
}

</script>

<form class="form_settings" action="cari.php" method="post">
<div class="form_settings">

</div>
</form>
<table  style="margin-left:5px;" >
  <tr>
	<td>
		
		<span><b>Bulan</b></span>
		<select name="month" id="month" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 150px;">
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
	</td>
	<td>		
		<span><b>Tahun</b></span>
		<select name="year" id="year" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
		<option value="2017">2017</option>
		<option value="2018">2018</option>
		</select>		
	</td>
	 <td>
	 <span><b>Type</b></span>
	 <select name="status" id="status" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 137px;">
		<option value="3">Collect</option>
		<option value="4">Input</option>
		<option value="5">Booking</option>
		</select>
	</td>
  	<td>
		<span><button class="btn" onclick="get_excel5()" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 80px; margin-bottom:18px; margin-left:5px;" >Export</button></span>
	</td>
  </tr>
</table>
