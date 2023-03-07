<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lib {
	function __construct() {
		$this->ci = & get_instance();
	}
    function generate_letter($length) {
    	$str = "";
    	$characters = array_merge(range('A','Z'));
    	$max = count($characters) - 1;
    	for ($i = 0; $i < $length; $i++) {
    		$rand = mt_rand(0, $max);
    		$str .= $characters[$rand];
    	}
    	return $str;
    }
	function format_date($format_waktu) {
        $convert_waktu = date_create($format_waktu);
        $a = date_format($convert_waktu, 'Y-m-d');
		$month = [
			'01' => 'Jan',
			'02' => 'Feb',
			'03' => 'Mar',
			'04' => 'Apr',
			'05' => 'Mei',
			'06' => 'Jun',
			'07' => 'Jul',
			'08' => 'Agu',
			'09' => 'Sep',
			'10' => 'Okt',
			'11' => 'Nov',
			'12' => 'Des',
		];
		$date = explode("-", $a);
		$format_date = $date[2].' '.$month[$date[1]].' '.$date[0];
		return $format_date;
	}
	function format_time($format_waktu) {
        $convert_waktu = date_create($format_waktu);
        $waktu = date_format($convert_waktu, 'H:i');
		return $waktu;
	}
	function status_order($i) {
		if ($i == 'Menunggu Pembeli') {
			$color = 'warning';
		} else if ($i == 'Pending Pembayaran') {
			$color = 'info';
		} else if ($i == 'Pesanan Belum Dikirim') {
			$color = 'danger';
		} else if ($i == 'Pesanan Telah Dikirim') {
			$color = 'info';
		} else if ($i == 'Transaksi Success') {
			$color = 'success';
		} elseif ($i == 'Cancel Transaksi') {
			$color = 'danger';
		} else if ($i == 'Refund Pending') {
			$color = 'warning';
		} else if ($i == 'Refund Success') {
			$color = 'success';
		} else if ($i == 'Refund Cancel') {
			$color = 'danger';
		} else {
			$color = 'info';
		}
		return $color;
	}
}