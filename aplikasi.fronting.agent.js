(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var id = 0;
		var main = "fronting_agent_data.php";
		// tampilkan data  dari berkas 
		$("#data-bfp").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data  yang sudah di perbaharui
					$("#data-bfp").html(data).show();
				});
			} else {
				// tampilkan data  dari berkas
				$("#data-bfp").load(main);
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				// tampilkan data mahasiswa yang sudah di perbaharui
				$("#data-bfp").html(data).show();
			});
		});
		
	});
}) (jQuery);
