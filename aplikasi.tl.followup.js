(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_report = 0;
		var main = "data_tim_leader_followup.php";
		$("#data-report-followup").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=cari1]').on('input',function(e){
			var v_cari = $('input:text[name=cari1]').val();
			if(v_cari!="") {
				$.post(main, {cari1: v_cari} ,function(data) {	
				$("#data-report-followup").html(data).show();
				});
			} else {
				$("#data-report-followup").load(main);
			}
		});

		// ketika tombol ubah/tambah ditekan
		$('.ubah').live("click", function(){

			var url = "data_tim_leader_form_followup.php";
			// ambil nilai id dari tombol ubah
			id_report = this.id;
				$("#myModalLabel1").html("Ubah Data");
						$.post(url, {id: id_report} ,function(data) {
				$(".modal-body1").html(data).show();
			});
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-report-followup").html(data).show();
			});
		});
	});
}) (jQuery);
