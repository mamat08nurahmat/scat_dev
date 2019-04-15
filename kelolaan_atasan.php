<?php error_reporting(0);?>
<title>KELOLAAN</title>
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
			{display: 'NPP', name : 'NPP', width : 50, sortable : true, align: 'left'},
			{display: 'NAMA SALES', name : 'NAMASALES', width : 250, sortable : true, align: 'left'},
			{display: 'CART', name : 'CART', width : 250, sortable : true, align: 'left'},
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
		{display: 'CART', name : 'CART'},
		],
	sortname: "NPP",
	sortorder: "asc",
	usepager: true,
	title: 'KELOLAAN',
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
				var npp_=	jQuery('#npp').val(arrData[0][0]);
					jQuery('#nama').val(arrData[0][1]);
					jQuery('#cart').val(arrData[0][2]);
console.log(npp_);					
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

