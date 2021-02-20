<h3>Halaman Booking</h3>

<table>
	<thead>
		<th>nama</th>
		<th>gambar</th>
		<th>tanggal</th>
		<th>harga</th>
		<th></th>
	</thead>
	<tbody>
		<?php foreach ($produk as $p) : ?>
			<tr>
				<td><a href="<?= base_url('produk/detail/') . $p['produk_id']; ?>"><?= $p['nama']; ?></a></td>
				<td><img src="<?= base_url() . "upload/img/" . $p['gambar']; ?>" width="100px" alt="">
				<td><?= $p['booking_at']; ?></td>
				<td><?= $p['harga']; ?></td>
				<td>
					<?php if ($p['pay_invoice'] == NULL) : ?>
						<form action="<?= base_url('booking/bayar'); ?>" method="POST">
							<input type="hidden" name="produk_id" value="<?= $p['produk_id']; ?>">
							<button type="submit">Bayar Sekarang</button>
						</form>
						<form action="<?= base_url('booking/cancel'); ?>" method="POST">
							<input type="hidden" name="booking_id" value="<?= $p['id']; ?>">
							<input type="hidden" name="produk_id" value="<?= $p['produk_id']; ?>">
							<button type="submit">Batalkan booking</button>
						</form>
					<?php else : ?>
						<form action="<?= base_url('payment/detail'); ?>" method="POST">
							<input type="hidden" name="invoice" value="<?= $p['pay_invoice']; ?>">
							<button type="submit">Lihat bukti bayar</button>
						</form>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>