(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		var id_pipeline = 0;
		var main = "pipeline_data.php";
		$("#data_pipeline").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					$("#data_pipeline").html(data).show();
				});
			} else {
				$("#data_pipeline").load(main);
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data_pipeline").html(data).show();
			});
		});
	});
}) (jQuery);
