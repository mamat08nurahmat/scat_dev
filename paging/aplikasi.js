(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var npp = 0;
		var main = "mahasiswa.data.php";

		// tampilkan data mahasiswa dari berkas mahasiswa.data.php
		// ke dalam <div id="data-mahasiswa"></div>
		$("#data-mahasiswa").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-mahasiswa").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-mahasiswa").load(main);
			}
		});

		// ketika tombol ubah/tambah ditekan
		$('.ubah, .tambah').live("click", function(){

			var url = "mahasiswa.form.php";
			// ambil nilai id dari tombol ubah
			npp = this.id;

			if(npp != 0) {
				// ubah judul modal dialog
				$("#myModalLabel").html("Ubah Data Mahasiswa");
			} else {
				// saran dari mas hangs
				$("#myModalLabel").html("Tambah Data Mahasiswa");
			}

			$.post(url, {id: npp} ,function(data) {
				// tampilkan mahasiswa.form.php ke dalam <div class="modal-body"></div>
				$(".modal-body").html(data).show();
			});
		});

		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "mahasiswa.input.php";
			// ambil nilai id dari tombol hapus
			npp = this.id;

			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin mengghapus data ini?");

			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapus: npp} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#data-mahasiswa").load(main);
				});
			}
		});

		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			// mengambil nilai dari inputbox
			kd_hal = this.id;

			$.post(main, {halaman: kd_hal} ,function(data) {
				// tampilkan data mahasiswa yang sudah di perbaharui
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-mahasiswa").html(data).show();
			});
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-mahasiswa").bind("click", function(event) {
			var url = "mahasiswa.input.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_npp = $('input:text[name=npp]').val();
			var v_id_grup = $('input:text[name=id_grup]').val();
			var v_id_vendor = $('input[name=id_vendor]').val();
			var v_id_cabang = $('input[name=id_cabang]').val();
			var v_nama = $('input[name=nama]').val();
			var v_tanggal_lahir = $('input[name=tanggal_lahir]').val();
			var v_status = $('input[name=status]').val();
			var v_id_user_atasan = $('input[name=id_user_atasan]').val();
			var v_id_user_leader = $('input[name=id_user_leader]').val();
			var v_grade = $('input[name=grade]').val();
			var v_alamat = $('textarea[name=alamat]').val();
			var v_telepon = $('input[name=telepon]').val();
			var v_keterangan = $('textarea[name=keterangan]').val();
			var v_tanggal_aktif = $('input[name=tanggal_aktif]').val();
			var v_tanggal_resign = $('input[name=tanggal_resign]').val();
			var v_tanggal_buat = $('input[name=tanggal_buat]').val();

			// mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {npp: v_npp, id_grup: v_id_grup, id_vendor: v_id_vendor, id_cabang: v_id_cabang, nama: v_nama, tanggal_lahir: v_tanggal_lahir,
							status: v_status, id_user_atasan: v_id_user_atasan, id_user_leader: v_id_user_leader, grade: v_grade, alamat: v_alamat,
							telepon: v_telepon, keterangan: v_keterangan, tanggal_aktif: v_tanggal_aktif, tanggal_resign: v_tanggal_resign,
							tanggal_buat: v_tanggal_buat, id: npp} ,function() {
				// tampilkan data mahasiswa yang sudah di perbaharui
				// ke dalam <div id="data-mahasiswa"></div>
				$("#data-mahasiswa").load(main);

				// sembunyikan modal dialog
				$('#dialog-mahasiswa').modal('hide');

				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah Data Mahasiswa");
			});
		});
	});
}) (jQuery);
