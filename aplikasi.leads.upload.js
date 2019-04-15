(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_report = 0;
		var main = "leads_upload.php";
		$("#data-leads-upload").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=cari_data_upload]').on('input',function(e){
			var v_cari = $('input:text[name=cari_data_upload]').val();
			if(v_cari!="") {
				$.post(main, {cari_data_upload: v_cari} ,function(data) {	
				$("#data-leads-upload").html(data).show();
				});
			} else {
				$("#data-leads-upload").load(main);
			}
		});

		// ketika tombol ubah/tambah ditekan
		$('.ubah, .tambah').live("click", function(){

			var url = "data_tim_leader_form2.php";
			// ambil nilai id dari tombol ubah
			id_report = this.id;
				$("#myModalLabel").html("Ubah Data");
						$.post(url, {id: id_report} ,function(data) {
				$(".modal-body").html(data).show();
			});
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-leads-upload").html(data).show();
			});
		});
	});
}) (jQuery);
