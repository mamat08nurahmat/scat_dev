<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script language="javascript" src="js/jquery.js"></script> 
	<link rel="stylesheet" href="css/jquery-ui.css" />
    <script type="text/javascript" src="js/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui.js"></script>
	
<?php
include "include/config.php";
$sql=mssql_query("select * from sales_target");
?>
<script>
// Give $ back to prototype.js; create new alias to jQuery.
var $jq = jQuery.noConflict();
</script>	
<script type="text/javascript">
function run_generate(){
var npp=document.getElementById('npp').value;
var id_grup=document.getElementById('id_grup').value;
window.location.assign("proses-update-type-sales.php?npp="+npp+"&id_grup="+id_grup);
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
<p><center>TARGET</center></p>
</div><br>
<form class="form_settings" action="cari.php" method="post">
<div class="span12">
<span>NPP</span><a id="buka"><input type=text style="width:105px;color: #f00; height:20px;" name="npp" id="npp" value="Masukkan NPP" onblur="if(this.value == '') { this.style.color='#f00'; this.value='Masukkan NPP'}" onfocus="if (this.value == 'Masukkan NPP') {this.style.color='#0ff'; this.value=''}" /></a>
</div>
<div class="span12">
<span>Type</span>
<select name="id_grup" id="id_grup" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
<option value="8">Asistent Penjualan Fleksi</option>
<option value="9">Asistent Penjualan Griya</option>

</select>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
</form>
<br>
<div class="span12">
<span>&nbsp;</span>
</div>
<table width="600" height="50" style="margin-left:80px;" >
  <tr>
    <td><button class="btn" onclick="run_generate()" >Generate</button></td><br>
  </tr>
</table>
</div>
<div id="kotakdialog" title="">
               	<?php
               		include "biodata_sales.php";
               	?>
				</div>