(function($) {
	// fungsi dijalankan setelah seluruh dokumen ditampilkan
	$(document).ready(function(e) {

		// deklarasikan variabel
		var kd_npp = 0;
		var main = "data_penyelia.php";
		$("#data-penyelia").load(main);

		
		// ketika inputbox pencarian diisi
		$('input:text[name=pencarian]').on('input',function(e){
			var v_cari = $('input:text[name=pencarian]').val();	
			if(v_cari!="") {
				$.post(main, {cari: v_cari} ,function(data) {
					$("#data-penyelia").html(data).show();
				});
			} else {
				$("#data-penyelia").load(main);
			}
		});

		// ketika tombol ubah ditekan
		$('.ubah, .tambah').live("click", function(){

			var url = "data_penyelia_form.php";
			kd_npp = this.id;
			$.post(url, {id: kd_npp} ,function(data) {
				$(".modal-body").html(data).show();
			});
		});

		
		// ketika tombol halaman ditekan
		$('.halaman').live("click", function(event){
			kd_hal = this.id;
			$.post(main, {halaman: kd_hal} ,function(data) {
				$("#data-penyelia").html(data).show();
			});
		});
		
		// ketika tombol simpan ditekan
		$("#simpan-mahasiswa").bind("click", function(event) {
			var url = "data_penyelia_input.php";

			// mengambil nilai dari inputbox, textbox dan select
			var v_keterangan = $('textarea[name=keterangan]').val();
			var v_tanggal_aktif = $('input:text[name=tanggal_aktif]').val();
			var v_tanggal_resign = $('input:text[name=tanggal_resign]').val();
			var v_tanggal_buat = $('input:text[name=tanggal_buat]').val();
			var v_status_sales = $('select[name=status_sales]').val();
			// mengirimkan data ke berkas transaksi.input.php untuk di proses
			$.post(url, {keterangan: v_keterangan, tanggal_aktif: v_tanggal_aktif,tanggal_resign: v_tanggal_resign, tanggal_buat: v_tanggal_buat, status_sales: v_status_sales, id: kd_npp} ,function() {
				$("#data-penyelia").load(main);
				
				$('#dialog-penyelia').modal('hide');
			});
		});
	});
}) (jQuery);
