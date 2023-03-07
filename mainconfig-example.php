<?php
date_default_timezone_set('Asia/Jakarta');
$_SERVER['CI_ENV'] = 'production'; // ci env: development, testing, production

$config['web'] = [
	'base_url' => 'https://example.com/',
	'title' => 'Rekber - Rekening Bersama',
	'short_title' => 'Rekber',
	'footer' => 'Copyright © 2023 <b>Rekening Bersama</b>. All Rights Reserved.',
	'meta' => [
		'description' => 'Adalah Sebuah Platform Bisnis Yang Menyediakan',
		'keywords' => 'Jasa Rekber, Rekening Bersama',
	],
	'author' => '-',
];

$config['db'] = [
	'hostname' => 'localhost',
	'username' => '',
	'password' => '',
	'database' => ''
];