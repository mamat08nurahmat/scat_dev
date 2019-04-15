(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var kd_npp = 0;
		var main = "data-leads.php";
		var main2 = "data-leads-2.php";

		// tampilkan data mahasiswa dari berkas data-leads.php
		// ke dalam <div id="data-leads"></div>
		$("#data-leads").load(main);
		$("#data-leads-2").load(main2);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-validasisales").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-validasisales").load(main);
			}
		});
		
		// ketika tombol ubah/tambah ditekan
		$('.update_kupret').live("click", function(){

			var url = "leads-input-aksi.php";
			// ambil nilai id dari tombol ubah
			id_leads = this.id;
				$("#id_leads").val(id_leads);
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-leads").bind("click", function(event) {
			var url = "leads-input-aksi.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_leads = $('input[name=id_leads]').val();
			var v_aksi = $('textarea[name=aksi]').val();
			// mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {id_leads: v_leads, aksi: v_aksi } ,
						 function() {
				// tampilkan data mahasiswa yang sudah di perbaharui 
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-mahasiswa").load(main);

				// sembunyikan modal dialog
				$('#dialog-leads').modal('hide');

				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah Data Mahasiswa");
			});
		});
	});
}) (jQuery);
