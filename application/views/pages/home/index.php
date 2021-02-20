<h3>Halaman Home</h3>

<table>
	<thead>
		<th>nama</th>
		<th>fasilitas</th>
		<th>harga</th>
		<th>deskripsi</th>
		<th>gambar</th>
		<th></th>
	</thead>
	<tbody>
		<?php foreach ($produk as $p) : ?>
			<tr>
				<td><a href="<?= base_url('produk/detail/') . $p['id']; ?>"><?= $p['nama']; ?></a></td>
				<td><?= $p['fasilitas']; ?></td>
				<td><?= $p['harga']; ?></td>
				<td><?= $p['deskripsi']; ?></td>
				<td><img src="<?= base_url() . "upload/img/" . $p['gambar']; ?>" width="100px" alt="">
				<td style="color: red"><?= $p['status'] == '1' ? "Booked" : ""; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>