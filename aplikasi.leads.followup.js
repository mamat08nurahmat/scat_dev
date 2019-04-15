(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_report = 0;
		var main = "leads_follow_up_data.php";
		$("#data-leads-followup").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=cari_followup]').on('input',function(e){
			var v_cari = $('input:text[name=cari_followup]').val();
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {	
				$("#data-leads-followup").html(data).show();
				});
			} else {
				$("#data-leads-followup").load(main);
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-leads-followup").html(data).show();
			});
		});
	});
}) (jQuery);
