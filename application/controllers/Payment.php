<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Payment_model', 'payment');
	}

	public function detail()
	{
		$invoice = $this->input->post('invoice');

		$data['title'] = 'Detail pembayaran';
		$data['payment'] = $this->payment->getByInvoice($invoice);

		$this->load->view('layouts/header', $data);
		$this->load->view('pages/payment/detail');
		$this->load->view('layouts/footer');
	}
}
