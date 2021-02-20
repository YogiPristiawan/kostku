<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Produk_model', 'produk');
	}

	public function index()
	{
		$data['order'] = count_order(2);
		$data['title'] = 'Kostku';
		$data['produk'] = $this->produk->getAll();

		$this->load->view('layouts/header', $data);
		$this->load->view('pages/home/index');
		$this->load->view('layouts/footer');
	}
}
