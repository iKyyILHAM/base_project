<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('name')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
		// dd($this->session->userdata('role'));
        $data['title'] = 'Dashboard';
        $data['count_user'] = $this->db->count_all('user');
        $data['content'] = 'home';
        $this->load->view('template/layout/base', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
