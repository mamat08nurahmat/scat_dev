(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		var id = 0;
		var main = "leads_expired_data.php";
		$("#data_leads_expired").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=cari_exps]').on('input',function(e){
			var v_cari = $('input:text[name=cari_exps]').val();
			
			if(v_cari!="") {
				$.post(main, {cari_exp: v_cari} ,function(data) {
					$("#data_leads_expired").html(data).show();
				});
			} else {
				$("#data_leads_expired").load(main);
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data_leads_expired").html(data).show();
			});
		});
	});
}) (jQuery);
