<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{
	// tampilkan semua booking yang belum dibayar
	public function getNotPay()
	{
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->join('produk', 'produk.id = booking.produk_id');
		$this->db->where('pay_invoice', NULL);

		return $this->db->get()->result_array();
	}

	// tampilkan semua booking
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('booking');
		$this->db->join('produk', 'produk.id = booking.produk_id');

		return $this->db->get()->result_array();
	}

	// tampilkan booking berdasarkan user_id
	public function getByUser($user_id)
	{
		// mengahsilkan :
		//[id_booking, tanggal_booking, id_produk, paymenr_invoice, nama_produk, harga_produk, deskripsi_produk, gambar_produk, fasilitas_produk]
		$this->db->select('
			booking.id,
			booking.booking_at,
			booking.produk_id,
			booking.pay_invoice,
			produk.nama,
			produk.harga,
			produk.deskripsi,
			produk.gambar,
			tipe.fasilitas');

		$this->db->from('booking');
		$this->db->join('produk', 'produk.id = booking.produk_id');
		$this->db->join('tipe', 'tipe.id = produk.tipe');
		$this->db->where('booking.users_id', $user_id);

		return $this->db->get()->result_array();
	}

	// tambah data booking
	public function add($data)
	{
		return $this->db->insert('booking', $data);
	}

	public function update($users_id, $produk_id, $data)
	{
		return $this->db->update('booking', $data, ['users_id' => $users_id, 'produk_id' => $produk_id]);
	}


	// delete data booking
	public function delete($id)
	{
		return $this->db->delete('booking', ['id' => $id]);
	}
}
