(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_report = 0;
		var main = "leads_cart_baru_data.php";
		$("#data-leads-cart").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {	
				$("#data-leads-cart").html(data).show();
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
				$("#data-leads-cart").html(data).show();
			});
		});
	});
}) (jQuery);
