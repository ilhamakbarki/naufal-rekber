<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if (user() == false) exit(redirect(base_url('auth/logout')));
	}
	public function index() {
		if ($this->input->post()) {
			$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|alpha_numeric_spaces|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Nomor HP', 'required|numeric|min_length[9]|max_length[13]');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'full_name' => $this->db->escape_str($this->input->post('full_name')),
					'username' => $this->db->escape_str($this->input->post('username')),
					'email' => $this->db->escape_str($this->input->post('email')),
					'phone' => $this->db->escape_str($this->input->post('phone')),
					'update_at' => date('Y-m-d H:i:s')
				];
                $path = 'assets/images/profile/';
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '3000'; // kb
                $this->load->library('upload', $config);
                if (!empty($_FILES['image']['name'])) {
                    $this->upload->do_upload('image');
                    $image = $this->upload->data();
                    $fileNameCmps = explode(".", $image['file_name']);
                    $fileExtension = strtolower(end($fileNameCmps));
                } else {
                    $fileNameCmps = explode(".", user('image'));
                    $fileExtension = strtolower(end($fileNameCmps));
                }
                if ($fileExtension !== "jpg" AND $fileExtension !== "jpeg" AND $fileExtension !== "png") {
    				$this->session->set_flashdata('result', array('alert' => 'error', 'msg' => '- Foto harus berformat JPG|JPEG|PNG.'));
    	    	} else if ($data_input['username'] <> user('username') AND $this->user_model->get_row(['username' => $data_input['username']])) {
    				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah terdaftar.'));
    			} else if ($data_input['email'] <> user('email') AND $this->user_model->get_row(['email' => $data_input['email']])) {
    				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Email sudah terdaftar.'));
    			} elseif ($data_input['phone'] <> user('phone') AND $this->user_model->get_row(['phone' => $data_input['phone']])) {
    				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Nomor HP sudah terdaftar.'));
				} else {
                    if (!empty($_FILES['image']['name'])) {
            		    if ($image['file_name'] == '') {
            		        $data_input['image'] = user('image');
            		    } else {
            		        @unlink($path.$this->input->post('old_image'));
            		        $data_input['image'] = $image['file_name'];
            		    }
                    }
					$update_user = $this->user_model->update($data_input, ['user_id' => user()]);
					if ($update_user) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Ubah data diri berhasil.'));
						exit(redirect(base_url('account')));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				}
			} else {
				$this->session->set_flashdata('result', array('msg' => ''.validation_errors()));
			}
		}
		$this->render('public/account/index', ['page' => 'Akun']);
	}
	public function history() {
		// SETTINGS //
		$data_query = [
			'select' => 'order.*',
			'join' => [
				[
					'table' => 'join_order',
					'on' => 'join_order.order_id = order.order_id',
					'param' => 'inner'
				]
			],
			'where' => [['order.user_id' => user()]],
			'order_by' => 'order.id DESC',
			'limit' => '10',
			'offset' => ($this->uri->segment(4)) ? $this->uri->segment(4) : 0
		];
		// END SETTINGS //
		// PAGINATION //
		if ($this->uri->segment(3) <> '' AND is_numeric($this->uri->segment(3)) == false) exit('No direct script access allowed');
		$config['base_url'] = base_url('account/history');
		$config['total_rows'] = $this->order_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render('public/account/history', ['table' => $this->order_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'order_count' => $this->order_model->get_count(['where' => [['user_id' => user()]]]), 'page' => 'Riwayat Transaksi']);
	}
}