<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('user')) {
	function user($i = 'user_id') {
		if (!get_instance()->session->userdata('login')) return false;
		$user = get_instance()->user_model->get_row(['user_id' => get_instance()->session->userdata('login'), 'status' => '1']);
		if ($user == false) return false;
		return $user->$i;
	}
}

if (!function_exists('admin')) {
	function admin($i = 'user_id') {
		if (!get_instance()->session->userdata('admin')) return false;
		$admin = get_instance()->user_model->get_row(['user_id' => get_instance()->session->userdata('admin'), 'level' => '2', 'status' => '1']);
		if ($admin == false) return false;
		return $admin->$i;
	}
}

if (!function_exists('dd')) {
	function dd($param) {
		print_r($param);
		die;
	}
}