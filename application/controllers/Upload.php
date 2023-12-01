<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('name')) {
			redirect('auth/login');
		}
		$this->load->model('upload_model', 'Upload');
	}

	public function index()
	{
		$data['title'] = 'Data Upload';
		$data['upload'] = $this->Upload->select();
		$data['content'] = 'upload/view';
		$this->load->view('template/layout/base', $data);
	}

	public function add()
	{
		$data['title'] = 'Tambah Data Upload';
		$data['content'] = 'upload/add';
		$this->load->view('template/layout/base', $data);
	}

	public function edit($id)
	{
		$data['title'] = 'Ubah Data Upload';
		$data['upload'] = $this->Upload->select_by_id($id);
		$data['content'] = 'upload/edit';
		$this->load->view('template/layout/base', $data);
	}

	public function create()
	{
		$name = $this->input->post('name', true);

		if (empty($name)) {
			echo json_encode(['status' => 'error', 'message' => 'Nama harus diisi']);
			return;
		}

		$config['upload_path'] = 'assets/uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif|zip|bmp|gif|pdf|doc|docx|odt|xls|xlsx|ppt|pptx|txt|ods';

		$file_info = pathinfo($_FILES['berkas_input']['name']);
		$file_extension = $file_info['extension'];

		$disallowed_extensions = ['js', 'php', 'css', 'html', 'htm'];

		if (in_array($file_extension, $disallowed_extensions)) {
			echo json_encode(['status' => 'error', 'message' => 'File tidak diizinkan diupload']);
			return;
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('berkas_input')) {
			$error = $this->upload->display_errors();
			echo json_encode(['status' => 'error', 'message' => $error]);
			return;
		} else {
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];

			$data = [
				"name" => $name,
				"berkas" => $file_name,
			];

			$create = $this->Upload->insert($data);

			if ($create) {
				echo json_encode(['status' => 'success']);
				return;
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
				return;
			}
		}
	}

	public function update()
	{
		$id = $this->input->post('id', true);
		$name = $this->input->post('name', true);

		if (empty($name)) {
			echo json_encode(['status' => 'error', 'message' => 'Nama harus diisi']);
			return;
		}

		if (!empty($_FILES['berkas_input']['name'])) {
			$config['upload_path'] = 'assets/uploads/';
			$config['allowed_types'] = '*';

			$file_info = pathinfo($_FILES['berkas_input']['name']);
			$file_extension = $file_info['extension'];

			$disallowed_extensions = ['js', 'php', 'css', 'html', 'htm'];

			if (in_array($file_extension, $disallowed_extensions)) {
				echo json_encode(['status' => 'error', 'message' => 'File tidak diizinkan diupload']);
				return;
			}

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('berkas_input')) {
				$error = $this->upload->display_errors();
				echo json_encode(['status' => 'error', 'message' => $error]);
				return;
			}

			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];

			$data = [
				"name" => $name,
				"berkas" => $file_name,
			];
		} else {
			$data = [
				"name" => $name,
			];
		}

		$update = $this->Upload->update($data, $id);

		if ($update) {
			echo json_encode(['status' => 'success']);
			return;
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal memperbaharui data']);
			return;
		}
	}

	public function delete($id)
	{
		$fileInfo = $this->Upload->select_by_id($id);
		// dd($fileInfo); 
		if ($fileInfo) {
			$this->Upload->delete($id);

			$filePath = FCPATH . 'assets/uploads/' . $fileInfo['berkas'];
			if (file_exists($filePath)) {
				unlink($filePath);
			}

			$this->session->set_flashdata('berhasil', 'Data berhasil dihapus!');
		} else {
			$this->session->set_flashdata('gagal', 'File tidak ditemukan!');
		}

		redirect('upload');
	}
}
