<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{
	// tampilkan semua riwayat pembayaran
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('payment');
		$this->db->join('produk', 'produk.id = payment.produk_id');

		return $this->db->get()->result_array();
	}

	// tampilkan detail pembayaran berdasarkan invoice
	public function getByInvoice($invoice)
	{
		$this->db->select('*');
		$this->db->from('payment');
		$this->db->join('produk', 'produk.id = payment.produk_id');
		$this->db->where('payment.invoice', $invoice);

		return $this->db->get()->row_array();
	}

	// tambah data pembayaran
	public function add($data)
	{
		return $this->db->insert('payment', $data);
	}

	// edit data pembayaran
	public function update($invoice, $data)
	{
		$this->db->update('payment', $data, ['invoice' => $invoice]);
		return $this->db->affected_rows();
	}

	// delete data pembayaran
	public function delete($invoice)
	{
		return $this->db->delete('payment', ['invoice' => $invoice]);
	}
}
