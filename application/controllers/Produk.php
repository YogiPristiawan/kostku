<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Produk_model', 'produk');
		$this->load->model('Booking_model', 'booking');
	}

	// menampilkan detail produk
	public function detail($id = '')
	{
		$data['order'] = count_order(2);
		$data['title'] = 'Detail produk';
		$data['produk'] = $this->produk->getById($id);

		// jika produk sudah dipesan tampilkan halaman 404 Not Found
		if ($data['produk'] === NULL) {
			return $this->err_404();
		}

		$this->load->view('layouts/header', $data);
		$this->load->view('pages/produk/detail');
		$this->load->view('layouts/footer');
	}

	// handle booking produk
	public function booking()
	{
		// jika tidak ada input post tampilkan halaman not found
		if ($this->input->post() === []) {

			return $this->err_404();
		}

		$data['booking_at'] = date('Y-m-d H:i:s');
		$data['users_id'] = 2;
		$data['produk_id'] = $this->input->post('produk_id');

		// disable db_debug untuk generate error message sendiri
		$db_debug = $this->db->db_debug;
		$this->db->db_debug = FALSE;

		// start transaction jika salah satu query ada error maka rollback
		$this->db->trans_start();
		$this->booking->add($data);
		$this->produk->update($data['produk_id'], ['status' => '1']);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {

			// jika gagal redirect ke detail
			$this->session->set_flashdata('message', 'Gagal melakukan pesanan!');
			redirect(base_url('produk/detail/' . $data['produk_id']));
		} else {

			// jika berhasil redirect ke home
			$this->session->set_flashdata('message', 'Berhasil melakukan pesanan, silahkan melakukan pembayaran dalam 3 hari!');
			redirect(base_url('home'));
		}

		$this->db->db_debug = $db_debug;  //aktifkan kembali db_debug
	}
}
