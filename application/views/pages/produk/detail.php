<h3>Halaman produk detail</h3>

<table>
	<thead>
		<th>nama</th>
		<th>fasilitas</th>
		<th>harga</th>
		<th>deskripsi</th>
		<th>gambar</th>
	</thead>
	<tbody>
		<tr>
			<td><?= $produk['nama']; ?></td>
			<td><?= $produk['fasilitas']; ?></td>
			<td><?= $produk['harga']; ?></td>
			<td><?= $produk['deskripsi']; ?></td>
			<td><img src="<?= base_url() . "upload/img/" . $produk['gambar']; ?>" width="100px" alt="">
		</tr>
	</tbody>
</table>

<?php if ($produk['status'] == '0') : ?>
	<form method="POST" action="<?= base_url('produk/booking'); ?>">
		<input type="hidden" name="produk_id" value="<?= $produk['id']; ?>">
		<button type="submit">BOOKING</button>
	</form>
<?php endif; ?>