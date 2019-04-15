<?php

//print_r($_SESSION);die();
?>
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
$(document).ready(function(){
	$(".btn").click(function(){
	var nnp=$("#npp").val();
	var month=$("#month").val();
	var year=$("#year").val();
	var x="tampil_performance.php?id="+nnp +"&month="+month+"&year="+year;
	$("#kupret").load(x);
}
);
});

// autofill form

  $(document).ready(function() {
    $("#nnp").keyup(function() {
        var nppp = $('#nnp').val();		
		$.post('include/load_data.php', // request ke file load_data.php
		{parent_id: nppp},
		function(data){
			 $('#nama').val(data[0].nama);
			 $('#sales_type').val(data[0].nama_grup);
			 $('#status').val(data[0].status);		  
			 $('#grade').val(data[0].grade);		  
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
<body>
<!--<form method="POST" action="tampil.php">-->
		<table>
		<div class="form_settings">
				<?php
				if($_SESSION['user_level']==8||$_SESSION['user_level']==9||$_SESSION['user_level']==11||$_SESSION['user_level']==12)
				{
				?>
					<div class="span12">
					<span>NPP</span><span>:</span><input  name="npp" id="npp" type="text" value="<?php echo $_SESSION['username'] ?>" style="width:168px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>NAMA</span><span>:</span><input  name="nama" id="nama" type="text" value="<?php echo $_SESSION['namauser'] ?>" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>TYPE</span><span>:</span><input  name="sales_type" id="sales_type" type="text" value="<?php echo $_SESSION['nama_grup'] ?>" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>GRADE</span><span>:</span><input  name="grade" id="grade" value="<?php echo $_SESSION['grade'] ?>" type="text" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>CABANG</span><span>&nbsp;:</span><input  name="nama_cabang" id="nama_cabang" value="<?php echo $_SESSION['nama_cabang'] ?>" type="text" style="height:20px;" readonly="readonly"/>
					</div>
				<?php
				}
				elseif($_SESSION['user_level'] == 2 || $_SESSION['user_level'] == 3 )
				{
				?>
					<div class="span12">
					<span>NPP</span><span>:</span><a id="buka"><input type=text style="width:105px; color: #f00; height:20px;" name="npp" id="npp" value="Masukkan NPP" onblur="if(this.value == '') { this.style.color='#f00'; this.value='Masukkan NPP'}" onfocus="if (this.value == 'Masukkan NPP') {this.style.color='#0ff'; this.value=''}" /></a>
					</div>
					<div class="span12">
					<span>NAMA</span><span>:</span><input  name="nama" id="nama" type="text" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>TYPE</span><span>:</span><input  name="sales_type" id="sales_type" type="text" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>GRADE</span><span>:</span><input  name="grade" id="grade" type="text" style="height:20px;" readonly="readonly"/>
					</div>
<!---
					<div class="span12">
					<span>CABANG</span><span>&nbsp;:</span><input  name="nama_cabang" id="nama_cabang" value="<?php echo $_SESSION['nama_cabang'] ?>" type="text" style="height:20px;" readonly="readonly"/>
					</div>
--->					
					
				<?php
				}
				elseif($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 10 || $_SESSION['user_level'] == 5 || $_SESSION['user_level'] == 4 || $_SESSION['user_level'] == 6 || $_SESSION['user_level'] == 7)
				{
				?>
					<div class="span12">
					<span>NPP</span><span>:</span><a id="buka"><input type=text style="width:105px;color: #f00; height:20px;" name="npp" id="npp" value="Masukkan NPP" onblur="if(this.value == '') { this.style.color='#f00'; this.value='Masukkan NPP'}" onfocus="if (this.value == 'Masukkan NPP') {this.style.color='#0ff'; this.value=''}" /></a>
					</div>
					<div class="span12">
					<span>NAMA</span><span>:</span><input  name="nama" id="nama" type="text" style="height:20px;;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>TYPE</span><span>:</span><input  name="sales_type" id="sales_type" type="text" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>GRADE</span><span>:</span><input  name="grade" id="grade" type="text" style="height:20px;" readonly="readonly"/>
					</div>
					<div class="span12">
					<span>CABANG</span><span>&nbsp;:</span><input  name="nama_cabang" id="nama_cabang"  type="text" style="height:20px;" readonly="readonly"/>
					</div>
					
<!--
					<div class="span12">
					<span>CABANG</span><span>&nbsp;:</span><input  name="nama_cabang" id="nama_cabang" value="<?php echo $_SESSION['nama_cabang'] ?>" type="text" style="height:20px;" readonly="readonly"/>
					</div>
--->					
					
				<?php
				}
				?>
			
				
				<div class="span12">
				<span>BULAN</span><span>:</span><select name="month" id="month" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
						        <option value="">pilih bulan</option>
						        <option value="1">januari</option>
						        <option value="2">Februari</option>
						        <option value="3">Maret</option>
						        <option value="4">April</option>
						        <option value="5">Mei</option>
						        <option value="6">Juni</option>
						        <option value="7">Juli</option>
						        <option value="8">Agustus</option>
						        <option value="9">September</option>
						        <option value="10">Oktober</option>
						        <option value="11">November</option>
						        <option value="12">Desember</option>
						      </select>
							  </div>
				<div class="span12">
				<span>TAHUN</span><span>:</span><select name="year" id="year" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
						        <option value="">pilih tahun</option>
						        <!--<option value="2015">2015</option>-->
							<option value="2015">2015</option>
						        <option value="2016">2016</option>
						        <option value="2017">2017</option>
						      </select>
							  </div>	
				<div class="span12">
				<span>&nbsp;</span><span>&nbsp;</span><button class="btn">Hitung</button>
				</div>
				<div class="span12">
				<br>
				</div>
				</div>
		
		</table>
				<div id="kotakdialog" title="">
               	<?php
               		include "biodata_sales.php";
               	?>
				</div>
<!--</form>-->
<div id="kupret"></div>
</body>
