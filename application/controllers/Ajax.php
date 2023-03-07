<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function get_fee() {
        $number = str_replace(".", "", $this->input->get('amount'));
		if ($this->input->get($this->security->get_csrf_token_name()) <> $this->security->get_csrf_hash()) exit("No direct script access allowed");
		if (is_numeric($number) == false) exit("No direct script access allowed");
		header('Content-Type: application/json');
		$fee = $this->fee_model->get_rows(['order_by' => 'id DESC']);
		foreach ($fee as $key => $value) {
    		if ($number >= $value['from'] AND $number <= $value['to']) {
    		    $fee = 'Rp '.number_format($value['fee'],0,',','.').'';
    		} else if ($number >= $value['from'] AND $value['to'] == '-') {
    		    $fee = 'Rp '.number_format($value['fee'],0,',','.').'';
    		} else if ($number < $value['from']) {
    		    $fee = 'Rp 0';
    		}
    		$result = [
    			'fee' => $fee
    		];
		}
		exit(json_encode($result, JSON_PRETTY_PRINT));
	}
}