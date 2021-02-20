<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
	//tampilkan semua product yang belum di pesan
	public function getAvailable()
	{
		$this->db->select(
			'produk.id,
			produk.nama,
			produk.harga,
			produk.deskripsi,
			produk.gambar,
			tipe.fasilitas'
		);
		$this->db->from('produk');
		$this->db->join('tipe', 'tipe.id = produk.tipe');
		$this->db->where('produk.status', '0');

		return $this->db->get()->result_array();
	}

	//tampilkan semua product
	public function getAll()
	{
		$this->db->select(
			'produk.id,
			produk.nama,
			produk.harga,
			produk.deskripsi,
			produk.gambar,
			produk.status,
			tipe.fasilitas'
		);
		$this->db->from('produk');
		$this->db->join('tipe', 'tipe.id = produk.tipe');

		return $this->db->get()->result_array();
	}

	// tampilkan product berdasarkan id
	public function getByid($id)
	{
		$this->db->select(
			'produk.id,
			produk.nama,
			produk.harga,
			produk.deskripsi,
			produk.gambar,
			produk.status,
			tipe.fasilitas'
		);
		$this->db->from('produk');
		$this->db->join('tipe', 'tipe.id = produk.tipe');
		$this->db->where('produk.id', $id);

		return $this->db->get()->row_array();
	}

	//tambah data product
	public function add($data)
	{
		return $this->db->insert('produk', $data);
	}

	// update data product
	public function update($id, $data)
	{
		return $this->db->update('produk', $data, ['id' => $id]);
	}

	//delete data product
	public function delete($id)
	{
		$this->db->delete('produk', ['id' => $id]);
		return $this->db->affected_rows();
	}
}
