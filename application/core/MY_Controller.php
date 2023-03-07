<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function render_auth($content, $data = null) {
    	$data['config'] = $this->config->item('web');
    	$data['content'] = $this->load->view($content, $data, true);
    	$this->load->view('public/auth', $data);
	}
	function render($content, $data = null) {
    	if (user() == true)
    	$data['config'] = $this->config->item('web');
    	$data['level'] = $this->level_model->get_row(['level' => user('level')]);
    	$data['content'] = $this->load->view($content, $data, true);
    	$this->load->view('public/header', $data);
	}
	function render_admin($content, $data = null) {
    	if (admin() == true)
		$data['config'] = $this->config->item('web');
		$data['content'] = $this->load->view($content, $data, true);
		$this->load->view('admin/header', $data);
	}
}