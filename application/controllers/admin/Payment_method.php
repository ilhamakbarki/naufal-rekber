<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_method extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (admin() == false) exit(redirect(base_url('admin/auth/logout')));
	}
	public function index() {
		// FORM INPUT //
		$field = 'payment_method_name';
		// END FORM INPUT //
		// SETTINGS //
		$data_query = [
			'select' => '*',
			'order_by' => 'id DESC',
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
		$config['total_rows'] = $this->m_payment_method_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('admin/'.$this->uri->segment(2).'/index', ['table' => $this->m_payment_method_model->get_rows($data_query), 'total_data' => $config['total_rows']]);
	}
	public function add() {
		if ($this->input->post()) {
			$this->form_validation->set_rules('category', 'Kategori', 'required|in_list[BANK,E-MONEY]');
			$this->form_validation->set_rules('payment_method_name', 'Metode Payment', 'required|min_length[1]|max_length[100]');
			$this->form_validation->set_rules('fee', 'Fee', 'required|numeric');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'category' => $this->db->escape_str($this->input->post('category')),
					'payment_method_name' => $this->db->escape_str($this->input->post('payment_method_name')),
					'fee' => $this->db->escape_str($this->input->post('fee')),
					'status' => '1',
					'created_at' => date('Y-m-d H:i:s'),
				];
                $path = 'assets/images/payment/';
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '3000'; // kb
                $this->load->library('upload', $config);
                $this->upload->do_upload('image');
                $hasil = $this->upload->data();
                $fileNameCmps = explode(".", $hasil['file_name']);
                $fileExtension = strtolower(end($fileNameCmps));
				if ($fileExtension !== "jpg" AND $fileExtension !== "jpeg" AND $fileExtension !== "png") {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Gambar harus berformat JPG|JPEG|PNG.'));
				} elseif ($this->m_payment_method_model->get_row(['payment_method_name' => $data_input['payment_method_name']])) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Metode Payment sudah ada didatabase.'));
				} else {
				    $data_input['image'] = $hasil['file_name'];
					$insert_data = $this->m_payment_method_model->insert($data_input);
					if ($insert_data) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Metode Payment <b>#'.$data_input['payment_method_name'].'</b> berhasil ditambahkan.'));
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
		$target = $this->m_payment_method_model->get_by_id($i);
		if ($target == false) {
			show_404();
		} else {
			if ($this->input->post()) {
    			$this->form_validation->set_rules('category', 'Kategori', 'required|in_list[BANK,E-MONEY]');
    			$this->form_validation->set_rules('payment_method_name', 'Metode Payment', 'required|min_length[1]|max_length[100]');
    			$this->form_validation->set_rules('fee', 'Fee', 'required|numeric');
    			$this->form_validation->set_rules('status', 'Status', 'required|in_list[1,0]');
				if ($this->form_validation->run() == true) {
					$data_input = [
    					'category' => $this->db->escape_str($this->input->post('category')),
    					'payment_method_name' => $this->db->escape_str($this->input->post('payment_method_name')),
    					'fee' => $this->db->escape_str($this->input->post('fee')),
    					'status' => $this->db->escape_str($this->input->post('status'))
					];
                    $path = 'assets/images/payment/';
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = '3000'; // kb
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('image');
                    $hasil = $this->upload->data();
                    if ($hasil['file_name'] == '') {
                        $fileNameCmps = explode(".", $target->image);
                        $fileExtension = strtolower(end($fileNameCmps));
                    } else {
                        $fileNameCmps = explode(".", $hasil['file_name']);
                        $fileExtension = strtolower(end($fileNameCmps));
                    }
                    if ($fileExtension !== "jpg" AND $fileExtension !== "jpeg" AND $fileExtension !== "png") {
    					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Gambar harus berformat JPG|JPEG|PNG.'));
    				} elseif ($data_input['payment_method_name'] <> $target->payment_method_name AND $this->m_payment_method_model->get_row(['payment_method_name' => $data_input['payment_method_name']])) {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Metode Payment sudah ada didatabase.'));
					} else {
    				    if ($hasil['file_name'] == '') {
    				        $data_input['image'] = $target->image;
    				    } else {
    				        @unlink($path.$this->input->post('old_image'));
    				        $data_input['image'] = $hasil['file_name'];
    				    }
						$update_target = $this->m_payment_method_model->update($data_input, ['id' => $i]);
						if ($update_target) {
							$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Metode Payment <b>#'.$data_input['payment_method_name'].'</b> berhasil diperbaharui.'));
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
		$target = $this->m_payment_method_model->get_by_id($i);
		if ($target == false) show_404();
		$delete_target = $this->m_payment_method_model->delete(['id' => $i]);
		if ($delete_target) {
		    @unlink('assets/images/payment/'.$target->image);
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Metode Payment <b>#'.$target->payment_method_name.'</b> berhasil dihapus.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('admin/'.$this->uri->segment(2)));
	}
}