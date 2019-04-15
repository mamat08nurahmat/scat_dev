(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {
		
		// deklarasikan variabel
		var id_developer = 0;
		var main = "data_developer_data.php";
		$("#data-developer").load(main);

		$('input:text[name=cari_dev]').on('input',function(e){
			var v_cari = $('input:text[name=cari_dev]').val();
			
			if(v_cari!="") {
				$.post(main, {cari_dev: v_cari} ,function(data) {
					$("#data-developer").html(data).show();
				});
			} else {
				$("#data-developer").load(main);
			}
		});
		
		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-developer").html(data).show();
			});
		});
		
		// ketika tombol ubah/tambah ditekan
		$('.tambah').live("click", function(){
			var url = "data_developer_form_tambah .php";
			id_developer = this.id;
			$.post(url, {id: id_developer} ,function(data) {
				$(".modal-body").html(data).show();
			});
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-data").bind("click", function(event) {
			var url = "data_developer_proses.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_judul = $('input:text[name=judul]').val();
			var v_isi = $('texarea[name=isi]').val();
			var v_tanggal = $('select[name=tanggal]').val();
			var v_aksi = $('select[name=aksi]').val();
			//var id = $('input:text[name=id_berita]').val();
			
			$.post(url, {judul: v_judul, isi: v_isi, tanggal: v_tanggal, aksi: v_aksi,id: id_berita} ,function() {
				$("#data-developer").load(main);
				// sembunyikan modal dialog
				$('#dialog-berita').modal('hide'); 
				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah Berita");
			});
		});
	
	});
}) (jQuery);
