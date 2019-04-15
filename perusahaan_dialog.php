<?php error_reporting(0);?>
<title>NAMA PERUSAHAAN</title>
<script type="text/javascript" src="libs/jquery.min.js"></script>
		<script type="text/javascript" src="libs/jquery.form.js"></script>
		<script type="text/javascript" src="libs/jquery.validate.min.js"></script>
		<link rel="stylesheet" type="text/css" href="libs/flexigrid/css/flexigrid.css">
		<script type="text/javascript" src="libs/jquery.cookie.js"></script>
		<script type="text/javascript" src="libs/flexigrid/js/flexigrid.js"></script>	
<table id="flex1" style="display:none"></table>
<script type="text/javascript">
	jQuery.noConflict();
	jQuery("#flex1").flexigrid({
		url: 'kelolaan_atasan_show.php',
		dataType: 'json',
		colModel : [
		//{display: 'SALES', name : 'SALES', width : 50, sortable : true, align: 'center' , hide:true},	
			{display: 'NAMAPERUSAHAAN', name : 'NAMAPERUSAHAAN', width : 50, sortable : true, align: 'left'},
			{display: 'ALAMAT', name : 'ALAMAT', width : 250, sortable : true, align: 'left'},
			{display: 'KOTA', name : 'KOTA', width : 250, sortable : true, align: 'left'},
			{display: 'KODEPOS', name : 'KODEPOS', width : 250, sortable : true, align: 'left'},
			{display: 'NO_TELP', name : 'NO_TELP', width : 250, sortable : true, align: 'left'},
		],
		
		 buttons : [ {
                    name : 'Pilih',
                    bclass : 'add',
                 onpress : Example4
                    }
								],
		
	searchitems : [
		{display: 'NAMAPERUSAHAAN', name : 'NAMAPERUSAHAAN',isdefault: true},
		{display: 'ALAMAT', name : 'ALAMAT'},
		{display: 'KOTA', name : 'KOTA'},
		{display: 'KODEPOS', name : 'KODEPOS'},
		{display: 'NO_TELP', name : 'NO_TELP'},
		],
	sortname: "NAMA PERUSAHAAN",
	sortorder: "asc",
	usepager: true,
	title: 'NAMA PERUSAHAAN',
	useRp: true,
	rp: 10,
	showTableToggleBtn: true,
	width: 780,
	height: 330
});   
    
 function Example4(com, grid) {
 	if (com=='Pilih')
			{
			   if(jQuery('.trSelected',grid).length>0 && jQuery('.trSelected',grid).length<2) {
					// to provide value in ie 6 suck
					var arrData = getSelectedRow();
					var nama = arrData[0][1].toUpperCase();
				var npp_=	jQuery('#nama').val(arrData[0][0]);
					jQuery('#alamat').val(arrData[0][1]);
					jQuery('#kota').val(arrData[0][2]);	
					jQuery('#kodepos').val(arrData[0][3]);	
					jQuery('#no_telp').val(arrData[0][4]);	
					jQuery('input').removeAttr("disabled");
					$jq("#kotakdialog").dialog('close');
				}  else { alert('Pilih satu data saja !'); }	
			}          
	}
				
function getSelectedRow() {
	var arrReturn   = [];
	jQuery('.trSelected').each(function() {
			var arrRow              = [];
			jQuery(this).find('div').each(function() {
					arrRow.push( jQuery(this).html() );
			});
			arrReturn.push(arrRow);
	});
	return arrReturn;
}
</script>

