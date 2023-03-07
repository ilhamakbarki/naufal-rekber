<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (admin() == false) exit(redirect(base_url('admin/auth/logout')));
	}
	public function index() {
		// SETTINGS //
		$data_query = [
			'select' => '*',
			'order_by' => 'level ASC',
			'limit' => '30',
			'offset' => ($this->uri->segment(4)) ? $this->uri->segment(4) : 0
		];
		// END SETTINGS //
		// PAGINATION //
		if ($this->uri->segment(4) <> '' AND is_numeric($this->uri->segment(4)) == false) exit('No direct script access allowed');
		$config['base_url'] = base_url('admin/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->level_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('admin/'.$this->uri->segment(2).'/index', ['table' => $this->level_model->get_rows($data_query), 'total_data' => $config['total_rows']]);
	}
	public function edit($i = '') {
		$target = $this->level_model->get_row(['level' => $i]);
		if ($target == false) {
			show_404();
		} else {
			if ($this->input->post()) {
    			$this->form_validation->set_rules('level', 'ID Level', 'required|numeric');
    			$this->form_validation->set_rules('level_name', 'Nama Level', 'required');
				if ($this->form_validation->run() == true) {
					$data_input = [
    					'level' => $this->db->escape_str($this->input->post('level')),
    					'level_name' => $this->db->escape_str($this->input->post('level_name'))
					];
    				$update_target = $this->level_model->update($data_input, ['level' => $i]);
    				if ($update_target) {
    					$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Level berhasil diperbaharui.'));
    					exit(redirect(base_url('admin/'.$this->uri->segment(2))));
    				} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				} else {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => ''.validation_errors()));
				}
			}
			$this->render_admin('admin/'.$this->uri->segment(2).'/edit', ['target' => $target]);
		}
	}
}