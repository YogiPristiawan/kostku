<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipe_model extends CI_Model
{
	// tampikan semua tipe
	public function getAll()
	{
		return $this->db->get('tipe')->result_array();
	}

	// tampilkan data berdasarkan id
	public function getById($id)
	{
		return $this->db->get_where('tipe', ['id' => $id])->row_array();
	}

	// tambah data tipe
	public function add($data)
	{
		return $this->db->insert('tipe', $data);
	}

	// edit data tipe
	public function update($id, $data)
	{
		$this->db->update('tipe', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	// delete data
	public function delete($id)
	{
		return $this->db->delete('tipe', ['id' => $id]);
	}
}
