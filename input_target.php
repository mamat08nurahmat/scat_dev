<?php 
include('include/config.php');
?>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script language="javascript" src="js/jquery.js"></script>    
    <script type="text/javascript" src="js/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<link href="sales-css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui.js"></script>
<script>
// Give $ back to prototype.js; create new alias to jQuery.
var $jq = jQuery.noConflict();
</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".btn").click(function(){
	var nnp=$("#nnp").val();
	var month=$("#month").val();
	var year=$("#year").val();
	var x="get_target.php?id="+nnp +"&month="+month+"&year="+year;
	$("#kupret").load(x);
}
);
});

function myFunction() {
    var y = document.getElementById("year").value;
    var nnp=$("#npp").val();
	var month=$("#month").val();
	var year=$("#year").val();
	var x="get_target.php?id="+nnp +"&month="+month+"&year="+year;
	$("#kupret").load(x);
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

<form id="form-data1" method="POST" action="proses_input_target.php">
<table>
			  <div class="form_settings">
				<div class="span12">
				<span>NPP</span><a id="buka"><input type=text style="width:105px;color: #f00; height:20px;" name="npp" id="npp"></a>
				</div>
				<div class="span12">
				<span>NAMA</span><input  name="nama" id="nama" type="text" style="height:20px;" readonly="readonly"/>
				</div>
				<div class="span12">
				<span>TYPE</span><input  name="sales_type" id="sales_type" type="text" style="height:20px;" readonly="readonly"/>
				</div>
				<div class="span12">
				<span>AKTIF</span><input  name="tanggal_aktif" id="tanggal_aktif" type="text" style="height:20px;" readonly="readonly"/>
				</div>
				<div class="span12">
				<span>BULAN</span><select name="month" id="month" type="text" class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
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
				<span>TAHUN</span><select name="year" id="year" onchange='myFunction()' class="form-control" style="border:1px solid #E6E6FA; padding: 6px 2px; width: 180px;">
						        <option value="">pilih tahun</option>
						        <option value="2015">2015</option>
						        <option value="2016">2016</option> 
								<option value="2017">2017</option>
								<option value="2018">2018</option>
						      </select>
							  </div> 
			
				<!--<p><span>&nbsp;</span><button class="btn">Hitung</button></p>-->
				</div>
		</table>
		         <div id="kotakdialog" title="">
               	<?php
               		include "biodata_sales.php";
               	?>
				</div>
		<div id="kupret"></div><br>
		
<!------------------------------------------------------------------------ batas table bawah ----------------------------------------------------------------------->
<div class="row" style="width:98%;margin-left:10px;">
		
		<h3>
			<!-- textbox untuk pencarian -->
			<div class="input-prepend pull-right">
				<span class="add-on"><i class="icon-search"></i></span>
				<input class="span2" id="prependedInput" type="text" name="pencarian" placeholder="Pencarian All...">
				
			</div>
		</h3>

		<!-- tempat untuk menampilkan data mahasiswa -->
		<div id="data-mahasiswa"></div>
	</div>


<!-- awal untuk modal dialog (ada di css dengan .modal)-->
<div id="dialog-mahasiswa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Tambah Data Sales</h3>
	</div>
	<!-- tempat untuk menampilkan form mahasiswa -->
	<div class="modal-body"></div>
	<div class="modal-footer">
		<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
		<button id="simpan-mahasiswa" class="btn btn-success">Simpan</button>
	</div>
</div>
<!-- akhir kode modal dialog -->

<!-- memanggil berkas javascript yang dibutuhkan -->
<script src="jquery-1.8.3.min.js"></script>
<script src="sales-js/bootstrap.min.js"></script>
<script src="aplikasi.target.js"></script>

</body>
</html>

</form>



