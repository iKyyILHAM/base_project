<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Onplud extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('name')) {
			redirect('auth/login');
		}
		$this->load->model('image_model', 'image');
	}

	public function index()
	{
		$data['title'] = 'Data Upload';
		$data['upload'] = $this->image->select();
		$data['content'] = 'onplud/view';


		// dd($this->session->userdata());

		$this->load->view('template/layout/base', $data);
	}

	public function add()
	{
		$data['title'] = 'Tambah Data Upload';
		$data['content'] = 'onplud/add';
		$this->load->view('template/layout/base', $data);
	}

	public function edit($id)
	{
		$data['title'] = 'Ubah Data Upload';
		$data['upload'] = $this->image->select_by_id($id);
		$data['content'] = 'onplud/edit';
		$this->load->view('template/layout/base', $data);
	}

	public function create()
	{
		$data = [
			"name" => $this->input->post('name', true),
			"link" => $this->input->post('link', true),
			"created_by" => $this->session->userdata('name'),
		];

		$create = $this->image->insert($data);

		if ($create) {
			echo json_encode(['status' => 'success']);
			return;
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
			return;
		}
	}
}
