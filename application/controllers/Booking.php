<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_model', 'booking');
		$this->load->model('Produk_model', 'produk');
		$this->load->model('Payment_model', 'payment');
	}

	public function index()
	{
		$data['order'] = count_order(2);
		$data['title'] = 'Booking';
		$data['produk'] = $this->booking->getByUser(2);

		$this->load->view('layouts/header', $data);
		$this->load->view('pages/booking/index');
		$this->load->view('layouts/footer');
	}

	public function bayar()
	{
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('invoice', 'Invoice', ['required']);
			$this->form_validation->set_rules('tanggal', 'Tanggal', ['required']);
			$this->form_validation->set_rules('produk_id', 'Produk Id', ['required']);
			$this->form_validation->set_rules('nama', 'Nama Pemesan', ['required', 'alpha_numeric_spaces']);
			$this->form_validation->set_rules('alamat', 'Alamat', ['required']);
			$this->form_validation->set_rules('no_telp', 'No. Telepon', ['required', 'numeric']);
			$this->form_validation->set_rules('jumlah', 'Jumlah', ['required', 'numeric']);
			$this->form_validation->set_rules('gambar', 'Gambar', ['required']);

			if ($this->form_validation->run() === FALSE) {
				$data['title'] = 'Form pembayaran';
				$data['produk_id'] = $this->input->post('produk_id');
				$data['produk'] = $this->db->query("SELECT nama FROM produk WHERE id = " . $data['produk_id'])->row_array();
				$data['users_id'] = 2;

				$this->load->view('layouts/header', $data);
				$this->load->view('pages/booking/bayar');
				$this->load->view('layouts/footer');
			} else {
				$data['invoice'] = $this->input->post('invoice');
				$data['tanggal'] = date('Y-m-d H:i:s'); //generate tanggal sendiri
				$data['users_id'] = 2; //diambil dari session
				$data['produk_id'] = $this->input->post('produk_id');
				$data['nama_pemesan'] = $this->input->post('nama');
				$data['alamat'] = $this->input->post('alamat');
				$data['no_telp'] = $this->input->post('no_telp');
				$data['jumlah'] = $this->input->post('jumlah');
				$data['gambar'] = $this->input->post('gambar');

				$this->db->db_debug = FALSE;
				$this->db->trans_start();
				$this->payment->add($data);
				$this->booking->update($data['users_id'], $data['produk_id'], ['pay_invoice' => $data['invoice']]);
				$this->db->trans_complete();


				if ($this->db->trans_status() === FALSE) {
					$this->session->set_flashdata('message', 'Gagal melakukan pembayaran!');
					redirect(base_url('booking'));
				} else {
					$this->session->set_flashdata('message', 'Berhasil melakukan pembayaran!');
					redirect(base_url('booking'));
				}
			}
		} else {
			if (isset($_POST['produk_id'])) {
				$data['title'] = 'Form pembayaran';
				$data['produk_id'] = $this->input->post('produk_id');
				$data['produk'] = $this->db->query("SELECT nama FROM produk WHERE id = " . $data['produk_id'])->row_array();
				$data['users_id'] = 2;

				$this->load->view('layouts/header', $data);
				$this->load->view('pages/booking/bayar');
				$this->load->view('layouts/footer');
			} else {
				redirect(base_url('booking'));
			}
		}
	}

	public function cancel()
	{
		$booking_id = $this->input->post('booking_id');
		$produk_id = $this->input->post('produk_id');

		$this->db->db_debug = FALSE;
		$this->db->trans_start();
		$this->booking->delete($booking_id);
		$this->produk->update($produk_id, ['status' => '0']);
		$this->db->trans_complete();

		if ($this->db->trans_status === FALSE) {
			$this->session->set_flashdata('message', 'Booking gagal dibatalkan!');
			redirect(base_url('booking'));
		} else {
			$this->session->set_flashdata('message', 'Booking berhasil dibatalkan!');
			redirect(base_url('booking'));
		}
	}
}
