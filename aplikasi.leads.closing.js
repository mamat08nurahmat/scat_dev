(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_report = 0;
		var main = "leads_closing_data.php";
		$("#data-leads-closing").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=cari_closing]').on('input',function(e){
			var v_cari = $('input:text[name=cari_closing]').val();
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {	
				$("#data-leads-closing").html(data).show();
				});
			} else {
				$("#data-leads-closing").load(main);
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-leads-closing").html(data).show();
			});
		});
	});
}) (jQuery);
