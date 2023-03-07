<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (admin() == false) exit(redirect(base_url('admin/auth/logout')));
	}
	public function index() {
		// FORM INPUT //
		$field = 'user.username';
		// END FORM INPUT //
		// SETTINGS //
		$status = [
			'1' => ['status' => 'Aktif', 'color' => 'success'],
			'0' => ['status' => 'Tidak Aktif', 'color' => 'danger'],
		];
		$data_query = [
			'select' => 'user.*, level.level_name',
			'join' => [
				[
					'table' => 'level',
					'on' => 'level.level = user.level',
					'param' => 'inner'
				]
			],
			'order_by' => 'user.user_id DESC',
			'limit' => '10',
			'offset' => ($this->uri->segment(4)) ? $this->uri->segment(4) : 0
		];
		// END SETTINGS //
		// SEARCH
		if ($this->input->get('value') <> '') {
			$data_query['where'][] = $field." LIKE '%".$this->input->get('value')."%'";
		}
		// END SEARCH
		// PAGINATION //
		if ($this->uri->segment(4) <> '' AND is_numeric($this->uri->segment(4)) == false) exit('No direct script access allowed');
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$config['base_url'] = base_url('admin/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->user_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('admin/'.$this->uri->segment(2).'/index', ['table' => $this->user_model->get_rows($data_query), 'total_data' => $config['total_rows'], 'status' => $status]);
	}
	public function edit($i = '') {
		$target = $this->user_model->get_row(['user_id' => $i]);
		if ($target == false) {
			show_404();
		} else {
    		if ($this->input->post()) {
    			$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|alpha_numeric_spaces|min_length[5]|max_length[100]');
    			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[12]');
    			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    			$this->form_validation->set_rules('phone','Nomor HP','required|numeric|min_length[9]|max_length[13]');
    			$this->form_validation->set_rules('level', 'Level', 'required|in_list[1,2]');
    			$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
    			$this->form_validation->set_rules('status', 'Status', 'required|in_list[1,0]');
    			if ($this->form_validation->run() == true) {
    				$data_input = [
    					'full_name' => $this->db->escape_str($this->input->post('full_name')),
    					'username' => $this->db->escape_str($this->input->post('username')),
    					'email' => $this->db->escape_str($this->input->post('email')),
    					'phone' => $this->db->escape_str($this->input->post('phone')),
    					'level' => $this->db->escape_str($this->input->post('level')),
    					'status' => $this->db->escape_str($this->input->post('status')),
    					'update_at' => date('Y-m-d H:i:s'),
    				];
    				if ($this->input->post('password') <> '') $data_input['password'] = md5($this->input->post('password'));
    				if ($data_input['username'] <> $target->username AND $this->user_model->get_row(['username' => $data_input['username']])) {
    					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah ada didatabase.'));
    				} else if ($data_input['email'] <> $target->email AND $this->user_model->get_row(['email' => $data_input['email']])) {
    					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Email sudah ada didatabase.'));
    				} else if ($data_input['phone'] <> $target->phone AND $this->user_model->get_row(['phone' => $data_input['phone']])) {
    					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Nomor HP sudah ada didatabase.'));
    				} else {
    					$update_target = $this->user_model->update($data_input, ['user_id' => $i]);
    					if ($update_target) {
    						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Pengguna <b>#'.$data_input['full_name'].'</b> berhasil diperbaharui.'));
    						exit(redirect(base_url('admin/'.$this->uri->segment(2))));
    					} else {
    						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
    					}
    				}
    			} else {
    				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => ''.validation_errors()));
    			}
    		}
    		$this->render_admin('admin/'.$this->uri->segment(2).'/edit', ['target' => $target]);
		}
	}
	public function delete($i = '') {
		$target = $this->user_model->get_row(['user_id' => $i]);
		if ($target == false) show_404();
		$delete_target = $this->user_model->delete(['user_id' => $i]);
		if ($delete_target) {
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Pengguna <b>#'.$target->full_name.'</b> berhasil dihapus.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('admin/'.$this->uri->segment(2)));
	}
}