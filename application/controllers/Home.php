<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('login')) {
			if (user() == false) exit(redirect(base_url('auth/logout')));
		}
	}
	public function index() {
	    if ($this->session->userdata('login')) {
		    $this->render('public/home/index', ['page' => 'Beranda']);
	    } else {
            $this->load->view('public/landing', ['config' => $this->config->item('web')]);
	    }
	}
	public function session() {
	    print_r($this->session->all_userdata());
	}
}