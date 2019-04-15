<?php
session_start(); 
include "include/config.php";
?>
<script type="text/javascript">
function get_excel(){
var tgl_awal=document.getElementById('tgl_awal').value;
var tgl_akhir=document.getElementById('tgl_akhir').value;
window.location.assign("laporan_tim_leader.php?tgl_awal="+tgl_awal+"&tgl_akhir="+tgl_akhir);
}
</script>

<table  style="margin-left:5px;" >
  <tr>
	<td>
		
		<span>START DATE</span>
		<input name="tgl_awal" id="tgl_awal" type="date" />
	</td>
	</tr>
	<tr>
	<td>		
		<span>END DATE</span>&nbsp;&nbsp;&nbsp;
		<input name="tgl_akhir" id="tgl_akhir" type="date" />		
	</td>
  	<td>
		<span><button class="btn" onclick="get_excel()" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 80px; margin-bottom:18px; margin-left:5px;" >Export</button></span>
	</td>
  </tr>
</table>
