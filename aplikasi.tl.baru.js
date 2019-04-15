(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id_report = 0;
		var main = "data_tim_leader.php";
		$("#data-report").load(main);

		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {	
				$("#data-report").html(data).show();
				});
			} else {
				$("#data-report").load(main);
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
				$("#data-report").html(data).show();
			});
		});
	});
}) (jQuery);
