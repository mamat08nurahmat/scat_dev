<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script language="javascript" src="js/jquery.js"></script>
   
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<link rel="stylesheet" href="resources/demos/style.css" />
    <script type="text/javascript" src="js/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui.js"></script>
	
<script>
// Give $ back to prototype.js; create new alias to jQuery.
var $jq = jQuery.noConflict();
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#nnp").keyup(function() {
        var nppp = $('#nnp').val();		
		$.post('include/load_data.php', // request ke file load_data.php
		{parent_id: nppp},
		function(data){
			 $('#nama').val(data[0].nama);
			 $('#sales_type').val(data[0].nama_grup);
			 $('#status').val(data[0].status);	
			// $('#grade').val(data[0].grade);		  
		},'json'
      );
   });
   });
   
 
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
 
 <script language="JavaScript" type="text/JavaScript">
        counter=0;
        function action(){
            counterNext=counter+1;
            document.getElementById("input"+counter).innerHTML = "<p><span>GRADE</span><span>:</span><input name='grade' type='text' /></p><p><span>KETERANGAN</span><span>:</span><textarea name='keterangan' style='height:80px;' type='text' /></textarea></p><div id=\"input"+counterNext+"\"></div>";
           
        }
    </script>
<form method="POST" action="update_grade_proses.php">
		<table>
			<div class="form_settings">
					<div class="span12">
					<span>NPP</span><span>:</span><a id="buka"><input type=text style="width:105px; color: #f00; height:20px;" name="npp" id="npp" value="Masukkan NPP" onblur="if(this.value == '') { this.style.color='#f00'; this.value='Masukkan NPP'}" onfocus="if (this.value == 'Masukkan NPP') {this.style.color='#0ff'; this.value=''}" /></a>
					</div>
					<div class="span12">
					<span>NAMA</span><span>:</span><input  name="nama" id="nama" type="text" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>TIPE</span><span>:</span><input  name="sales_type" id="sales_type" type="text" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12" id="input0">
					<span>GRADE</span><span>:</span><input name="grade" id="grade" type="text" style="height:20px;" readonly="readonly"><a href="JavaScript:action();">edit</a></th>
					</div>
					<div class="span12" >
					<?php
						$year=date('Y');
						$month=date('m');
					?>
					<input type="hidden" name="year" value="<?php echo $year ?>" readonly="readonly">
					<input type="hidden" name="month" value="<?php echo $month ?>" readonly="readonly">
					</div>
				<span>&nbsp;</span><button class="tombol">UPDATE</button>
			</div>
		</table>
		     <div id="kotakdialog" title="">
               	<?php
               		include "biodata_sales.php";
               	?>
			</div>
</form>
<div id="kupret"></div>

<script>
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>


