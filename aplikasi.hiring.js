(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var kd_npp = 0;
		var main = "sales_hiring_data.php";
		$("#data-hiring").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=cari_data]').on('input',function(e){
			var v_cari = $('input:text[name=cari_data]').val();
			if(v_cari!="") {
				$.post(main, {cari_data: v_cari} ,function(data) {
					$("#data-hiring").html(data).show();
				});
			} else {
				$("#data-hiring").load(main);
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-hiring").html(data).show();
			});
		});
	});
}) (jQuery);
