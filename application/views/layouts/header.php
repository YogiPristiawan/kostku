<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>

	<style>
		table,
		th,
		td {
			border: 1px solid black;
		}
	</style>
</head>
<nav><a href="<?= base_url('booking'); ?>">
		<b>Order: <?= isset($order) ? $order : " " ?></b>
	</a>
</nav>

<h5>Header</h5>

<?= $this->session->flashdata('message'); ?>