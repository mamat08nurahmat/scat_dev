(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_report = 0;
		var main = "data_tim_leader_tidak_closing.php";
		$("#data-report-tidak-closing").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=cari3]').on('input',function(e){
			var v_cari = $('input:text[name=cari3]').val();
			if(v_cari!="") {
				$.post(main, {cari3: v_cari} ,function(data) {	
				$("#data-report-tidak-closing").html(data).show();
				});
			} else {
				$("#data-report-tidak-closing").load(main);
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-report-tidak-closing").html(data).show();
			});
		});
	});
}) (jQuery);
