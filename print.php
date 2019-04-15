
<script language="javascript" src="js/jquery.js"></script>   
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<link rel="stylesheet" href="resources/demos/style.css" />
    <script type="text/javascript" src="js/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui.js"></script>
	
<?php
include "include/config.php";
$sql=mysql_query("select * from sales_target");
?>
<script>
// Give $ back to prototype.js; create new alias to jQuery.
var $jq = jQuery.noConflict();
</script>	
<script type="text/javascript">
function run_generate(){
var npp=document.getElementById('npp').value;
var month=document.getElementById('month').value;
var year=document.getElementById('year').value;
window.location.assign("run_generate.php?npp="+npp+"&month="+month+"&year="+year);
}
   		$jq(document).ready(function() {
			$jq("#kotakdialog").dialog({
				modal:true, 
			
				height:660,
				width:805,
				autoOpen:false
			});
			$jq("#buka").click(function(){
				$jq("#kotakdialog").dialog('open');
			}
			);
		});

</script>

<div class="span_target_1" style="height:250px;">
<div style="border:1px solid;background-color:#00BFFF">
<h5><p><center>PRINT INSENTIF</center></p></h5>
</div><br>
<table width="600" height="50" style="margin-left:80px;" >
<form action="print_insentif.php" method="get">
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

<div class="span12">
<span>* pilih bulan & tahun untuk print insentif salles</span>
</div>
<tr><td><input type="submit" value="PRINT"></td></tr>
</form>
</table>
</div>
