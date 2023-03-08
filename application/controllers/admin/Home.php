<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
		if (admin() == false) exit(redirect(base_url('admin/auth/logout')));
	}
	public function index() {
		$widget = [
			'user' => $this->user_model->get_rows(['select' => 'COUNT(user_id) AS total']),
			'order' => $this->order_model->get_rows(['select' => 'SUM(grand_total) AS rupiah, COUNT(id) AS total', 'where' => [['order_by' => 'Penjual', 'status' => 'Transaksi Success']]]),
			'fee' => $this->order_model->get_rows(['select' => 'SUM(fee) AS rupiah', 'where' => [['order_by' => 'Penjual', 'status' => 'Transaksi Success']]]),
		];
		$this->render_admin('admin/home/index', ['widget' => $widget]);
	}
}