<h3 style="color: red;"><?= $produk['nama']; ?></h3>

<form action="" method="POST">
	<input type="hidden" name="produk_id" value="<?= $produk_id; ?>">
	<ul>
		<li>
			<label for="invoice">Invoice :</label>
			<input type="text" name="invoice" value="123456" readonly>
			<?= form_error('invoice'); ?>
		</li>
		<li>
			<label for="tanggal">Tanggal :</label>
			<input type="date" name="tanggal" value="<?= date('Y-m-d'); ?>" readonly>
			<?= form_error('tanggal'); ?>
		</li>
		<li>
			<label for="nama">Nama Pemesan :</label>
			<input type="text" name="nama" id="nama">
			<?= form_error('nama'); ?>
		</li>
		<li>
			<label for="alamat">Alamat :</label>
			<input type="text" name="alamat" id="alamat">
			<?= form_error('alamat'); ?>
		</li>
		<li>
			<label for="no_telp">No. Telepon :</label>
			<input type="number" name="no_telp" id="no_telp">
			<?= form_error('no_telp'); ?>
		</li>
		<li>
			<label for="jumlah">Jumlah :</label>
			<input type="text" name="jumlah" value="200000" readonly>
			<?= form_error('jumlah'); ?>
		</li>
		<li>
			<label for="gambar">Upload Bukti Transfer :</label>
			<input type="text" name="gambar" id="gambar">
			<?= form_error('gambar'); ?>
		</li>
	</ul>

	<button type="submit" name="submit">Kirim</button>
	<!-- <input type="submit" name="submit" value="Bayar"> -->
</form>