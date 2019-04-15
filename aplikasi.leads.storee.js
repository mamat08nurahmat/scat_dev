(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_report = 0;
		
		var main = "leads_store_data.php";
		$("#data-leads").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=cari_store]').on('input',function(e){
			var v_cari = $('input:text[name=cari_store]').val();
			if(v_cari!="") {
				$.post(main, {cari_store: v_cari} ,function(data) {	
				$("#data-leads").html(data).show();
				});
			} else {
				$("#data-leads").load(main);
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-leads").html(data).show();
			});
		});
	});
}) (jQuery);
