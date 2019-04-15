<?php error_reporting(0);?>
<title>Biodata Sales</title>
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
		url: 'show_biodata_sales.php',
		dataType: 'json',
		colModel : [
		//{display: 'SALES', name : 'SALES', width : 50, sortable : true, align: 'center' , hide:true},	
			{display: 'NPP', name : 'NPP', width : 50, sortable : true, align: 'left'},
			{display: 'NAMA SALES', name : 'NAMASALES', width : 250, sortable : true, align: 'left'},
			{display: 'SALES TYPE', name : 'SALES_TYPE', width : 250, sortable : true, align: 'left'},
			{display: 'SPV', name : 'SPV', width : 50, sortable : true, align: 'left'},
			{display: 'VENDOR', name : 'VENDOR', width : 150, sortable : true, align: 'left'},
			{display: 'BRANCH', name : 'BRANCH', width : 150, sortable : true, align: 'left'},
			{display: 'REGION', name : 'REGION', width : 80, sortable : true, align: 'left'},
			{display: 'GRADE', name : 'GRADE', width : 150, sortable : true, align: 'right'},
			{display: 'KETERANGAN', name : 'KETERANGAN', width : 150, sortable : true, align: 'right'},
			{display: 'AKTIF', name : 'AKTIF', width : 150, sortable : true, align: 'right', hide:true}
			//{display: 'STATUS', name : 'STATUS', width : 80, sortable : true, align: 'center'}
		],
		
		 buttons : [ {
                    name : 'Pilih',
                    bclass : 'add',
                 onpress : Example4
                    }
								],
		
	searchitems : [
		{display: 'NPP', name : 'NPP',isdefault: true},
		{display: 'NAMA SALES', name : 'NAMASALES'},
		{display: 'SALES TYPE', name : 'SALES_TYPE'},
		{display: 'SPV', name : 'SPV'},
		{display: 'BRANCH', name : 'BRANCH'},
		{display: 'REGION', name : 'REGION'},
		{display: 'VENDOR', name : 'VENDOR'}
		//{display: 'GRADE', name : 'GRADE'}
		],
	sortname: "NPP",
	sortorder: "asc",
	usepager: true,
	title: 'Biodata Sales',
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
					jQuery('#npp').val(arrData[0][0]);
					jQuery('#nama').val(arrData[0][1]);
					jQuery('#sales_type').val(arrData[0][2]);
					jQuery('#grade').val(arrData[0][7]);
					//jQuery('#id_user_atasan').val(arrData[0][9]);
					//jQuery('#nama_vendor').val(arrData[0][7]);
					jQuery('#tanggal_aktif').val(arrData[0][8]);
					jQuery('#keterangan').val(arrData[0][8]);
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

