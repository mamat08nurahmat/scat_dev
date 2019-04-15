(function($) {
	$(document).ready(function(e) {
		var id_berita = 0;
		var main = "berita.data.php";
		$("#data-berita").load(main);
		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					$("#data-berita").html(data).show();
				});
			} else {
				
				$("#data-berita").load(main);
			}
		});
		
		// ketika tombol ubah/tambah ditekan
		$('.ubah, .tambah').live("click", function(){
			var url = "berita.ubah.php";
			// ambil nilai id dari tombol ubah
			id_berita = this.id;
			if(id_berita != 0) {
				// ubah judul modal dialog
				$("#myModalLabel").html("Ubah Berita");
			} else {
				// saran dari mas hangs
				$("#myModalLabel").html("Tambah Berita");
			}

			$.post(url, {id: id_berita} ,function(data) {
				// tampilkan mahasiswa.form.php ke dalam <div class="modal-body"></div>
				$(".modal-body").html(data).show();
			});
		});
		
		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "berita.ubah.proses.php";
			id_berita = this.id;
			var answer = confirm("Apakah anda ingin menghapus data ini?");
			if (answer) {
				$.post(url, {hapus: id_berita} ,function() {
					$("#data-berita").load(main);
				});
			}
		});		
		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-berita").html(data).show();
			});
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-berita").bind("click", function(event) {
			var url = "berita.ubah.proses.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_judul = $('input:text[name=judul]').val();
			var v_isi = $('texarea[name=isi]').val();
			var v_tanggal = $('select[name=tanggal]').val();
			var v_aksi = $('select[name=aksi]').val();
			//var id = $('input:text[name=id_berita]').val();
			
			$.post(url, {judul: v_judul, isi: v_isi, tanggal: v_tanggal, aksi: v_aksi,id: id_berita} ,function() {
				$("#data-berita").load(main);
				// sembunyikan modal dialog
				$('#dialog-berita').modal('hide'); 
				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah Berita");
			});
		});
	});
}) (jQuery);
