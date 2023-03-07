<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (admin() == false) exit(redirect(base_url('admin/auth/logout')));
	}
	public function index() {
		// FORM INPUT //
		$field = 'order.order_id';
		// END FORM INPUT //
		// SETTINGS //
		$data_query = [
			'select' => 'order.*, user.username AS seller',
			'join' => [
				[
					'table' => 'user',
					'on' => 'user.user_id = order.seller_id',
					'param' => 'inner'
				]
			],
			'order_by' => 'order.id DESC',
			'limit' => '10',
			'offset' => ($this->uri->segment(4)) ? $this->uri->segment(4) : 0
		];
		// END SETTINGS //
		// SEARCH
		if ($this->input->get('value') <> '') {
			$data_query['where'][] = $field." LIKE '%".$this->input->get('value')."%'";
		}
		// END SEARCH
		// SESSION FILTER //
		if ($this->session->userdata('status') == 'Success') {
			$data_query['where'][]['order.status'] = 'Transaksi Success';
		}
		if ($this->session->userdata('status') == 'Refund') {
            $data_query = ['where' => ["order.status IN ('Refund Pending', 'Refund Success', 'Refund Cancel')"]];
		}
		// END SESSION FILTER //
		// PAGINATION //
		if ($this->uri->segment(4) <> '' AND is_numeric($this->uri->segment(4)) == false) exit('No direct script access allowed');
		$config['base_url'] = base_url('admin/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->order_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('admin/'.$this->uri->segment(2).'/index', ['table' => $this->order_model->get_rows($data_query), 'total_data' => $config['total_rows']]);
	}
	public function filter() {
	    $action = $this->input->post('action');
	    if ($action == 'all') {
    		$this->session->unset_userdata('status');
	    }
	    if ($action == 'success') {
    		$this->session->set_userdata('status', 'Success');
	    }
	    if ($action == 'refund') {
    		$this->session->set_userdata('status', 'Refund');
	    }
		redirect(base_url('admin/'.$this->uri->segment(2)));
	}
	public function edit($i = '') {
		$target = $this->order_model->get_by_id($i);
		if ($target == false) {
			show_404();
		} else {
			if ($this->input->post()) {
				$this->form_validation->set_rules('status', 'Status', 'required|in_list[Refund Success,Refund Cancel]');
				if ($this->form_validation->run() == true) {
					$data_input = [
						'status' => $this->db->escape_str($this->input->post('status')),
						'update_at' => date('Y-m-d H:i:s')
					];
					$update_target = $this->order_model->update($data_input, ['order_id' => $target->order_id]);
					if ($update_target) {
    					if ($data_input['status'] == 'Refund Success') {
                            $data_input_chat = [
                                'order_id' => $target->order_id,
                                'user_id' => '0',
                                'sender' => 'Admin',
                                'message' => '*Kasus Di Menangkan oleh Pembeli, Admin Telah Mengirimkan Dana Kembali Kepada Pembeli',
                                'created_at' => date('Y-m-d H:i:s'),
                                'update_at' => date('Y-m-d H:i:s'),
                            ];
                            $this->chat_model->insert($data_input_chat);
    					} else if ($data_input['status'] == 'Refund Cancel') {
                            $data_input_chat = [
                                'order_id' => $target->order_id,
                                'user_id' => '0',
                                'sender' => 'Admin',
                                'message' => '*Kasus Dimenangkan oleh Penjual, Admin Telah Mengirimkan Dana Kepada Penjual',
                                'created_at' => date('Y-m-d H:i:s'),
                                'update_at' => date('Y-m-d H:i:s'),
                            ];
                            $this->chat_model->insert($data_input_chat);
    					}
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Transaksi <b>#'.$target->order_id.'</b> berhasil diperbaharui.'));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				} else {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => ''.validation_errors()));
				}
				exit(redirect(base_url('admin/'.$this->uri->segment(2))));
			}
			$this->load->view('admin/'.$this->uri->segment(2).'/edit', ['target' => $target]);
		}
	}
	public function delete($i = '') {
		$target = $this->order_model->get_by_id($i);
		if ($target == false) show_404();
		$delete_target = $this->order_model->delete(['id' => $i]);
		if ($delete_target) {
			$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Data Transaksi <b>#'.$target->order_id.'</b> berhasil dihapus.'));
		} else {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		}
		redirect(base_url('admin/'.$this->uri->segment(2)));
	}
}