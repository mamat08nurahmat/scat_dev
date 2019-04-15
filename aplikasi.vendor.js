(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var kd_npp = 0;
		var main = "vendor.php";

		// tampilkan data mahasiswa dari berkas mahasiswa.data.php
		// ke dalam <div id="data-mahasiswa"></div>
		$("#sgv").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();
			
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#sgv").html(data).show();
				});
			} else {
				// tampilkan data mahasiswa dari berkas mahasiswa.data.php
				// ke dalam <div id="data-mahasiswa"></div>
				$("#sgv").load(main);
			}
		});

		// ketika tombol hapus ditekan
		$('.hapus').live("click", function(){
			var url = "sgv_hapus.php";
			// ambil nilai id dari tombol hapus
			kd_npp = this.id;

			// tampilkan dialog konfirmasi
			var answer = confirm("Apakah anda ingin mengghapus data ini?");

			// ketika ditekan tombol ok
			if (answer) {
				// mengirimkan perintah penghapusan ke berkas transaksi.input.php
				$.post(url, {hapus: kd_npp} ,function() {
					// tampilkan data mahasiswa yang sudah di perbaharui
					// ke dalam <div id="data-mahasiswa"></div>
					$("#sgv").load(main);
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
			var v_id_grup = $('select[name=id_grup]').val();
			var v_id_cabang = $('select[name=id_cabang]').val();
			var v_nama = $('input:text[name=nama_sales]').val();
			var v_no_ktp = $('input:text[name=no_ktp]').val();
			var v_alamat = $('textarea[name=alamat]').val();
			var v_tanggal_lahir = $('input:text[name=tanggal_lahir]').val();
			var v_status = $('select[name=status]').val();
			var v_id_vendor = $('select[name=id_vendor]').val();
			var v_id_user_atasan = $('input:text[name=id_user_atasan]').val();
			var v_id_user_leader = $('input:text[name=id_user_leader]').val();
			var v_grade = $('select[name=grade]').val();
			var v_telepon = $('input:text[name=telepon]').val();
			var v_keterangan = $('textarea[name=keterangan]').val();
			var v_tanggal_aktif = $('input:text[name=tanggal_aktif]').val();
			var v_tanggal_resign = $('input:text[name=tanggal_resign]').val();
			var v_tanggal_buat = $('input:text[name=tanggal_buat]').val();
			var v_pass = $('input:hidden[name=pass]').val();
			var v_status_sales = $('select[name=status_sales]').val();
			// mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {npp: v_npp, id_grup: v_id_grup, id_cabang: v_id_cabang, nama: v_nama, no_ktp: v_no_ktp, alamat: v_alamat, tanggal_lahir: v_tanggal_lahir, status: v_status, id_vendor: v_id_vendor, id_user_atasan: v_id_user_atasan, id_user_leader: v_id_user_leader, grade: v_grade, telepon: v_telepon,keterangan: v_keterangan, tanggal_aktif: v_tanggal_aktif,tanggal_resign: v_tanggal_resign, tanggal_buat: v_tanggal_buat, pass: v_pass, status_sales: v_status_sales, id: kd_npp} ,function() {
				// tampilkan data mahasiswa yang sudah di perbaharui 
				// ke dalam <div id="data-mahasiswa"></div>
				$("#sgv").load(main);

			});
		});
	});
}) (jQuery);
