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
		$id = $this->session->userdata('user_id');

		$sql = "SELECT * FROM gambar WHERE created_by = '$id'";
		$query = $this->db->query($sql);
		$res = $query->result_array();

		$data_sql = array();
		foreach ($res as $key => $value) {
			$data_sql[] = $value;
		}

		$data['upload'] = $data_sql;
		$data['title'] = 'Data Upload';
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

		$session_user_id = $this->session->userdata('user_id');

		$upload = $this->image->select_by_id($id);

		if ($upload) {
			if ($upload['created_by'] == $session_user_id) {
				$data['upload'] = $upload;
				$data['content'] = 'onplud/edit';
				$this->load->view('template/layout/base', $data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}


	public function create()
	{
		$data = [
			"name" => $this->input->post('name', true),
			"link" => $this->input->post('link', true),
			"created_by" => $this->session->userdata('user_id'),
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

	public function delete($id)
	{
		$this->image->delete($id);
		$this->session->set_flashdata('berhasil', 'Data berhasil dihapus!');
		redirect('onplud');
	}

	public function update()
	{
		$data = [
			"name" => $this->input->post('name', true),
			"link" => $this->input->post('link', true),
			"created_by" => $this->session->userdata('user_id'),
		];
		// dd($data);
		$update = $this->image->update($data, $this->input->post('id', true));

		if ($update) {
			echo json_encode(['status' => 'success']);
			return;
		}

		echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
		return;
	}
}
