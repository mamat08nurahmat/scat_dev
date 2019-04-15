(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var kd_npp = 0;
		var main = "sales_aktif.php";
		$("#data-approve").load(main);

		$('input:text[name=cari_data]').on('input',function(e){
			var v_cari = $('input:text[name=cari_data]').val();
			
			if(v_cari!="") {
				$.post(main, {cari_data: v_cari} ,function(data) {
					// tampilkan data approve yang sudah di perbaharui
					// ke dalam <div id="data-approve"></div>
					$("#data-approve").html(data).show();
				});
			} else {
				// tampilkan data approve dari berkas approve.data.php
				// ke dalam <div id="data-approve"></div>
				$("#data-approve").load(main);
			}
		});


		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			kd_hal = this.id;

			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-approve").html(data).show();
			});
		});
		

			});
}) (jQuery);
