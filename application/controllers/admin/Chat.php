<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (admin() == false) exit(redirect(base_url('admin/auth/logout')));
	}
	public function index() {
		// FORM INPUT //
		$field = 'order_id';
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
		$config['base_url'] = base_url('admin/'.$this->uri->segment(2).'/index');
		$config['total_rows'] = $this->chat_status_model->get_count($data_query);
		$config['per_page'] = $data_query['limit'];
		$this->pagination->initialize($config);
		// END PAGINATION //
		$this->render_admin('admin/'.$this->uri->segment(2).'/index', ['table' => $this->chat_status_model->get_rows($data_query), 'total_data' => $config['total_rows']]);
	}
	public function detail($i = '') {
		$target = $this->chat_status_model->get_by_id($i);
		if ($target == false) show_404();
		$this->render_admin('admin/'.$this->uri->segment(2).'/detail', ['target' => $target, 'chat' => $this->chat_model->get_rows(['where' => [['order_id' => $target->order_id]]])]);
	}
}