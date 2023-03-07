<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	public function logout() {
		if (admin() == false) exit(redirect(base_url('admin')));
		$this->session->unset_userdata('admin');
		$this->session->set_flashdata('result', array('alert' => 'success', 'msg' => 'Berhasil keluar akun.'));
		redirect(base_url());
	}
}