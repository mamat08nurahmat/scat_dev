(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var kd_npp = 0;
		var main = "management_validasi_tampil.php";

		// tampilkan data mahasiswa dari berkas mahasiswa.data.php
		$("#data-mahasiswa").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					$("#data-mahasiswa").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				$("#data-mahasiswa").load(main);
			}
		});
		
		$('#anjing').live("click", function(){
		location.reload();	
		});
		// ketika tombol ubah/tambah ditekan
		$('.ubah, .tambah').live("click", function(){

			var url = "management_validasi_form.input.php";
			// ambil nilai id dari tombol ubah
			kd_npp = this.id;

			if(kd_npp != 0) {
				// ubah judul modal dialog
				$("#myModalLabel").html("Ubah Data Sales");
			} else {
				// saran dari mas hangs
				$("#myModalLabel").html("Tambah Data Sales");
			}

			$.post(url, {id: kd_npp} ,function(data) {
				// tampilkan mahasiswa.form.php ke dalam <div class="modal-body"></div>
				$(".modal-body").html(data).show();
			});
		});

		// ketika tombol hapus ditekan
		$('.hapusxxx').live("click", function(){
			var url = "management_validasi_proses.input.php";
			// ambil nilai id dari tombol hapus
			kd_npp = this.id;

			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin mengghapus data ini?"+kd_npp);

			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapus: kd_npp} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					//$("#data-mahasiswa").load(main);
				});
			}
		});
		
		// ketika tombol ubah/tambah ditekan
		$('.get_ket').live("click", function(){
			var url = "management_validasi.php";
			//$("#data-mahasiswa").load(url);
			// ambil nilai id dari tombol ubah
			i = this.id;
			kettol = $('#kettol'+i).val();
			//var kettol='test';
				$("#ketetol").val(kettol);
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
			var url = "management_validasi_proses.input.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_npp 				= $('input:text[name=npp]').val();
			var v_id_grup 			= $('select[name=id_grup]').val();
			var v_id_cabang 		= $('select[name=id_cabang]').val();
			var v_nama 				= $('input:text[name=nama_sales]').val();
			var v_panggilan 		= $('input:text[name=nama_panggilan]').val();
			var v_ec_nama			= $('input:text[name=ec_nama]').val();
			var v_jenis 			= $('select[name=jenis]').val();
			var v_tempat_lahir		= $('input:text[name=tempat_lahir]').val();
			var v_path 				= $('input:file[name=path]').val();
			var v_alamat			= $('textarea[name=alamat_1]').val();
			var v_kota_1			= $('input:text[name=kota_1]').val();
			var v_kode_pos_1		= $('input:text[name=kode_pos_1]').val();
			var v_lama_tinggal_1	= $('input:text[name=lama_tinggal_1]').val();
			var v_status_tinggal	= $('input:text[name=status_tinggal]').val();
			var v_agama				= $('input:text[name=agama]').val();
			var v_telp_rumah		= $('input:text[name=telp_rumah]').val();
			var v_ibu				= $('input:text[name=ibu]').val();
			var v_telp_user_atasan	= $('input:text[name=telp_user_atasan]').val();
			var v_email				= $('input:text[name=email]').val();
			var v_kendaraan			= $('input:text[name=kendaraan]').val();
			var v_no_ktp			= $('input:text[name=no_ktp]').val();
			var v_tanggal_lahir 	= $('input:text[name=tanggal_lahir]').val();
			var v_status 			= $('select[name=status]').val();
			var v_id_vendor 		= $('select[name=id_vendor]').val();
			var v_id_user_atasan 	= $('input:text[name=id_user_atasan]').val();
			var v_id_user_leader 	= $('input:text[name=id_user_leader]').val();
			var v_grade 			= $('select[name=grade]').val();
			var v_telepon 			= $('input:text[name=telepon]').val();
			var v_keterangan 		= $('textarea[name=keterangan]').val();
			var v_tanggal_aktif 	= $('input:text[name=tanggal_aktif]').val();
			var v_tanggal_resign 	= $('input:text[name=tanggal_resign]').val();
			var v_tanggal_buat 		= $('input:text[name=tanggal_buat]').val();
			var v_pass 				= $('input:hidden[name=pass]').val();
			var v_status_sales 		= $('select[name=status_sales]').val();
			var v_ket_tolak 		= $('textarea[name=ket_tolak]').val();
			// mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {	npp: v_npp,
							id_grup: v_id_grup,
							id_cabang: v_id_cabang,
							nama: v_nama,
							nama_panggilan: v_panggilan,
							ec_nama: v_ec_nama,
							jenis: v_jenis,
							tempat_lahir: v_tempat_lahir,
							path: v_path,
							alamat_1: v_alamat,
							kota_1: v_kota_1,
							kode_pos_1: v_kode_pos_1,
							lama_tinggal_1: v_lama_tinggal_1,
							status_tinggal: v_status_tinggal,
							agama: v_agama,
							telp_rumah: v_telp_rumah,
							ibu: v_ibu,
							telp_user_atasan: v_telp_user_atasan,
							email: v_email,
							kendaraan: v_kendaraan,
							no_ktp: v_no_ktp,
							tanggal_lahir: v_tanggal_lahir,
							status: v_status,
							id_vendor: v_id_vendor,
							id_user_atasan: v_id_user_atasan,
							id_user_leader: v_id_user_leader,
							grade: v_grade,
							telepon: v_telepon,
							keterangan: v_keterangan,
							tanggal_aktif: v_tanggal_aktif,
							tanggal_resign: v_tanggal_resign,
							tanggal_buat: v_tanggal_buat,
							pass: v_pass,
							status_sales: v_status_sales,
							ket_tolak: v_ket_tolak,
							id: kd_npp
						} ,function() {
				// tampilkan data mahasiswa yang sudah di perbaharui 
				// ke dalam <div id="data-mahasiswa"></div>
				var main = "management_validasi_tampil.php";
				location.reload(main);

				// sembunyikan modal dialog
				$('#dialog-mahasiswa').modal('hide');

				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah Data Mahasiswa");
			});
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-accept").bind("click", function(event) {
			var url = "management_validasi_proses1.input.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_npp 				= $('input:text[name=npp]').val();
			var v_id_grup 			= $('select[name=id_grup]').val();
			var v_id_cabang 		= $('select[name=id_cabang]').val();
			var v_nama 				= $('input:text[name=nama_sales]').val();
			var v_panggilan 		= $('input:text[name=nama_panggilan]').val();
			var v_ec_nama			= $('input:text[name=ec_nama]').val();
			var v_jenis 			= $('select[name=jenis]').val();
			var v_tempat_lahir		= $('input:text[name=tempat_lahir]').val();
			var v_path 				= $('input:file[name=path]').val();
			var v_alamat			= $('textarea[name=alamat_1]').val();
			var v_kota_1			= $('input:text[name=kota_1]').val();
			var v_kode_pos_1		= $('input:text[name=kode_pos_1]').val();
			var v_lama_tinggal_1	= $('input:text[name=lama_tinggal_1]').val();
			var v_status_tinggal	= $('input:text[name=status_tinggal]').val();
			var v_agama				= $('input:text[name=agama]').val();
			var v_telp_rumah		= $('input:text[name=telp_rumah]').val();
			var v_ibu				= $('input:text[name=ibu]').val();
			var v_telp_user_atasan	= $('input:text[name=telp_user_atasan]').val();
			var v_email				= $('input:text[name=email]').val();
			var v_kendaraan			= $('input:text[name=kendaraan]').val();
			var v_no_ktp			= $('input:text[name=no_ktp]').val();
			var v_tanggal_lahir 	= $('input:text[name=tanggal_lahir]').val();
			var v_status 			= $('select[name=status]').val();
			var v_id_vendor 		= $('select[name=id_vendor]').val();
			var v_id_user_atasan 	= $('input:text[name=id_user_atasan]').val();
			var v_id_user_leader 	= $('input:text[name=id_user_leader]').val();
			var v_grade 			= $('select[name=grade]').val();
			var v_telepon 			= $('input:text[name=telepon]').val();
			var v_keterangan 		= $('textarea[name=keterangan]').val();
			var v_tanggal_aktif 	= $('input:text[name=tanggal_aktif]').val();
			var v_tanggal_resign 	= $('input:text[name=tanggal_resign]').val();
			var v_tanggal_buat 		= $('input:text[name=tanggal_buat]').val();
			var v_pass 				= $('input:hidden[name=pass]').val();
			var v_status_sales 		= $('select[name=status_sales]').val();
			var v_ket_tolak 		= $('textarea[name=ket_tolak]').val();
			// mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {	npp: v_npp,
							id_grup: v_id_grup,
							id_cabang: v_id_cabang,
							nama: v_nama,
							nama_panggilan: v_panggilan,
							ec_nama: v_ec_nama,
							jenis: v_jenis,
							tempat_lahir: v_tempat_lahir,
							path: v_path,
							alamat_1: v_alamat,
							kota_1: v_kota_1,
							kode_pos_1: v_kode_pos_1,
							lama_tinggal_1: v_lama_tinggal_1,
							status_tinggal: v_status_tinggal,
							agama: v_agama,
							telp_rumah: v_telp_rumah,
							ibu: v_ibu,
							telp_user_atasan: v_telp_user_atasan,
							email: v_email,
							kendaraan: v_kendaraan,
							no_ktp: v_no_ktp,
							tanggal_lahir: v_tanggal_lahir,
							status: v_status,
							id_vendor: v_id_vendor,
							id_user_atasan: v_id_user_atasan,
							id_user_leader: v_id_user_leader,
							grade: v_grade,
							telepon: v_telepon,
							keterangan: v_keterangan,
							tanggal_aktif: v_tanggal_aktif,
							tanggal_resign: v_tanggal_resign,
							tanggal_buat: v_tanggal_buat,
							pass: v_pass,
							status_sales: v_status_sales,
							ket_tolak: v_ket_tolak,
							id: kd_npp
						} ,function() {
				// tampilkan data mahasiswa yang sudah di perbaharui 
				// ke dalam <div id="data-mahasiswa"></div>
				var main = "management_validasi_tampil.php";
				location.reload(main);

				// sembunyikan modal dialog
				$('#dialog-mahasiswa').modal('hide');

				// kembalikan judul modal dialog
				$("#myModalLabel").html("Tambah Data Mahasiswa");
			});
		});
	});
}) (jQuery);
