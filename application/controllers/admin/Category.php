<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (admin() == false) exit(redirect(base_url('admin/auth/logout')));
	}
	public function index() {
		// SETTINGS //
		$data_query = [
			'select' => '*',
			'order_by' => 'category ASC',
			'limit' => '30',
			'offset' => ($this->uri->segment(4)) ? $this->uri->segment(4) : 0
		];
		// END SETTINGS //
		// PAGINATION //
		if ($this->uri->segment(4) <> '' AND is_numeric($this->uri->segment(4)) == false) exit('No direct script access allowed');
		$config['base_url'] = base_url('admin/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->category_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('admin/'.$this->uri->segment(2).'/index', ['table' => $this->category_model->get_rows($data_query), 'total_data' => $config['total_rows']]);
	}
	public function add() {
		if ($this->input->post()) {
			$this->form_validation->set_rules('category_name', 'Nama Kategori', 'required|min_length[1]|max_length[100]');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'category_name' => strip_tags($this->input->post('category_name')),
				];
				if ($this->category_model->get_row(['category_name' => $data_input['category_name']])) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Nama Kategori sudah ada didatabase.'));
				} else {
					$insert_data = $this->category_model->insert($data_input);
					if ($insert_data) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'msg' => 'Data Kategori <b>#'.$data_input['category_name'].'</b> berhasil ditambahkan.'));
						exit(redirect(base_url('admin/'.$this->uri->segment(2))));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				}
			} else {
				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => ''.validation_errors()));
			}
		}
		$this->render_admin('admin/'.$this->uri->segment(2).'/add');
	}
	public function edit($i = '') {
		$target = $this->category_model->get_row(['category' => $i]);
		if ($target == false) {
			show_404();
		} else {
			if ($this->input->post()) {
    			$this->form_validation->set_rules('category_name', 'Nama Kategori', 'required');
				if ($this->form_validation->run() == true) {
					$data_input = [
    					'category_name' => $this->db->escape_str($this->input->post('category_name'))
					];
    				$update_target = $this->category_model->update($data_input, ['category' => $i]);
    				if ($update_target) {
    					$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Kategori berhasil diperbaharui.'));
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
	public function delete($i = '') {
		$target = $this->category_model->get_row(['category' => $i]);
		if ($target == false) show_404();
		$delete_target = $this->category_model->delete(['category' => $i]);
		if ($delete_target) {
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Kategori <b>#'.$target->category_name.'</b> berhasil dihapus.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('admin/'.$this->uri->segment(2)));
	}
}