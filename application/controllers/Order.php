<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Xendit\Xendit;

class Order extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if (user() == false) exit(redirect(base_url('auth/logout')));
	}
	public function create() {
		if ($this->input->post()) {
			$this->form_validation->set_rules('category', 'Kategori', 'required');
			$this->form_validation->set_rules('product', 'Nama Produk', 'required');
			$this->form_validation->set_rules('seller_name', 'Nama Penjual', 'required');
			$this->form_validation->set_rules('buyyer_name', 'Nama Pembeli', 'required');
			$this->form_validation->set_rules('amount', 'Harga Produk', 'required');
			$this->form_validation->set_rules('rekening', 'Rekening Penjual', 'required');
			$this->form_validation->set_rules('method', 'Metode Pencairan', 'required');
			$this->form_validation->set_rules('fee_by', 'Biaya Admin', 'required');
			if ($this->form_validation->run() == true) {
			    $amount = str_replace(".", "", $this->input->post('amount'));
        		$fee = $this->fee_model->get_rows(['order_by' => 'id DESC']);
        		foreach ($fee as $key => $value) {
            		if ($amount >= $value['from'] AND $amount <= $value['to']) {
            		    $get_fee = $value['fee'];
            		} else if ($amount >= $value['from'] AND $value['to'] == '-') {
            		    $get_fee = $value['fee'];
            		} else if ($amount < $value['from']) {
            		    $get_fee = '0';
            		}
		        }
				$data_input = [
					'user_id' => user(),
					'seller_name' => $this->db->escape_str($this->input->post('seller_name')),
					'buyyer_name' => $this->db->escape_str($this->input->post('buyyer_name')),
					'order_id' => $this->lib->generate_letter(10),
					'order_by' => 'Penjual',
					'category_name' => $this->db->escape_str($this->input->post('category')),
					'order_name' => $this->db->escape_str($this->input->post('product')),
					'date' => date('Y-m-d'),
					'amount' => $amount,
					'amount_unix' => rand(111,999),
					'fee' => $get_fee,
					'grand_total' => 0,
					'rekening' => $this->db->escape_str($this->input->post('rekening')),
					'payment' => $this->db->escape_str($this->input->post('method')),
					'fee_by' => $this->db->escape_str($this->input->post('fee_by')),
					'status' => 'Menunggu Pembeli',
					'created_at' => date('Y-m-d H:i:s'),
					'update_at' => date('Y-m-d H:i:s')
				];
				$data_input_chat_status = [
					'chat_id' => '1',
					'order_id' => $data_input['order_id'],
					'status_seller' => '0',
					'status_buyyer' => '0',
					'created_at' => date('Y-m-d H:i:s'),
					'update_at' => date('Y-m-d H:i:s'),
				];
                
				$data_input['grand_total'] = $data_input['amount'] + $data_input['amount_unix'] + $data_input['fee'];
				if ($this->order_model->get_row(['order_id' => $data_input['order_id']]) == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kode transaksi sudah terdaftar.'));
				} else if (is_numeric($data_input['amount']) == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Harga hanya dapat diisi dengan angka.'));
				} else if ($data_input['amount'] < 10000) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Harga produk minimal 10.000 rupiah.'));
                } else {
                    Xendit::setApiKey($this->config->item('xendit_key'));
                    
                    if ($data_input['fee_by'] == 'Penjual') {
                        $fee_admin = $data_input['amount'] + $data_input['amount_unix'];
                    } else if ($data_input['fee_by'] == 'Pembeli') {
                        $fee_admin = $data_input['amount'] + $data_input['amount_unix'] + $data_input['fee'];
                    }
                    
                    $params = [ 
                        'external_id' => $data_input['order_id'],
                        'amount' => $fee_admin,
                        'description' => 'Transaksi #'.$data_input['order_id'].'',
                        'invoice_duration' => 86400,
                        'success_redirect_url' => base_url('order/detail/'.$data_input['order_id']),
                        'failure_redirect_url' => base_url('order/detail/'.$data_input['order_id']),
                        'currency' => 'IDR',
                        'items' => [
                            [
                                'name' => $data_input['order_name'],
                                'quantity' => 1,
                                'price' => $data_input['amount'],
                                'category' => $data_input['category_name'],
                            ]
                        ],
                        'fees' => [
                            [
                                'type' => 'ADMIN',
                                'value' => $data_input['amount_unix']
                            ]
                        ]
                    ];
                    
                    $createInvoice = \Xendit\Invoice::create($params);
                    // print_r($createInvoice);
                    
    				$data_input_chat_mutation = [
    					'order_id' => $data_input['order_id'],
    					'mutation_id' => $createInvoice['id'],
    					'amount' => $createInvoice['amount'],
    					'bank' => '-',
    					'description' => $createInvoice['description'],
    					'invoice_url' => $createInvoice['invoice_url'],
    					'status' => 'Pending',
    					'created_at' => date('Y-m-d H:i:s'),
    					'update_at' => date('Y-m-d H:i:s'),
    				];
                    
                    $data_input['reference_id'] = $createInvoice['id'];
                    
					$insert_order = $this->order_model->insert($data_input);
					if ($insert_order) {
                        $file = "chat.txt";
                        $content = file_get_contents($file);
                        $line = explode("\n", $content);
                        foreach ($line as $word) {
            				$data_input_chat = [
            					'order_id' => $data_input['order_id'],
            					'user_id' => '0',
            					'sender' => 'Admin',
            					'message' => $word,
            					'created_at' => date('Y-m-d H:i:s'),
            					'update_at' => date('Y-m-d H:i:s'),
            				];
					        $this->chat_model->insert($data_input_chat);
                        }
					    $this->chat_status_model->insert($data_input_chat_status);
					    $this->mutation_model->insert($data_input_chat_mutation);
        				$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Buat transaksi berhasil.'));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
					exit(redirect(base_url('order/detail/'.$data_input['order_id'])));
				}
			} else {
				$this->session->set_flashdata('result', array('msg' => ''.validation_errors()));
			}
		}
		$this->render('public/order/create', ['category' => $this->category_model->get_rows(['order_by' => 'category_name ASC']), 'payment_bank' => $this->m_payment_method_model->get_rows(['where' => [['category' => 'BANK', 'status' => '1']]]), 'payment_emoney' => $this->m_payment_method_model->get_rows(['where' => [['category' => 'E-MONEY', 'status' => '1']]]), 'page' => 'Buat Transaksi']);
	}
	public function payment($i = '') {
		$this->render('public/order/payment', ['target' => $i, 'page' => 'Detail Pembayaran']);
	}
	public function detail($i = '') {
		$i = $this->db->escape_str($i);
		$target = $this->order_model->get_row(['user_id' => user(), 'order_id' => $i]);
		if ($target == false) {
		    $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi tidak ditemukan.'));
            exit(redirect(base_url()));
		}
		if ($target->fee_by == 'Penjual') {
		    $get_amount = $target->amount - $target->fee;
		    $get_fee = $target->amount + $target->amount_unix;
		} else if ($target->fee_by == 'Pembeli') {
		    $get_amount = $target->amount;
		    $get_fee = $target->amount + $target->fee + $target->amount_unix;
		}
		$mutation = $this->mutation_model->get_row(['order_id' => $target->order_id, 'status' => 'Pending']);
		if ($mutation == true) {
    	    Xendit::setApiKey($this->config->item('xendit_key'));
            $getInvoice = \Xendit\Invoice::retrieve($mutation->mutation_id);
            if ($getInvoice['status'] == 'SETTLED') {
                $data_input = [
                    'order_id' => $target->order_id,
                    'user_id' => '0',
                    'sender' => 'Admin',
                    'message' => '*Pembeli melakukan pembayaran ke kami senilai Rp '.number_format($mutation->amount,0,',','.').'',
                    'created_at' => date('Y-m-d H:i:s'),
                    'update_at' => date('Y-m-d H:i:s'),
                ];
                $this->chat_model->insert($data_input);
                $this->mutation_model->update(['bank' => $getInvoice['bank_code'], 'status' => 'Success', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
                $this->order_model->update(['status' => 'Pesanan Belum Dikirim', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
            } else {
                $this->mutation_model->update(['status' => 'Pending', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
            }
		}
	    $action = $this->input->post('action');
	    if ($action == 'cancel') {
    		$order = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Cancel Transaksi']);
    		$check_order = $this->order_model->get_row(['order_id' => $target->order_id, 'order_by' => 'Pembeli']);
    		if ($order == true) {
    			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dibatalkan.'));
    		} else if ($check_order == true) {
    			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi tidak bisa dibatalkan.'));
            } else if ($target->order_by == 'Pembeli') {
    			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Pembeli tidak bisa melakukan batalkan transaksi.'));
    		} else {
    		    $update_order = $this->order_model->update(['status' => 'Cancel Transaksi', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
    		    if ($update_order) {
    		        $this->mutation_model->update(['status' => 'Canceled', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
    		        $this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Transaksi berhasil dibatalkan.'));
    		    } else {
    		        $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
    		    }
                exit(redirect(base_url('order/detail/'.$i)));
    		}
	    }
	    if ($action == 'refund') {
			$data_input = [
				'rekening' => $this->db->escape_str($this->input->post('rekening')),
				'payment' => $this->db->escape_str($this->input->post('payment')),
			];
    		$order = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Cancel Transaksi']);
    		$check_status = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Pesanan Belum Dikirim']);
    		$check_refund = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Refund Pending']);
    		$check_success = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Transaksi Success']);
    		if ($order == true) {
    			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dibatalkan.'));
    		} else if ($check_status == true) {
    			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi belum dikirim.'));
    		} else if ($check_refund == true) {
    			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dalam proses refund.'));
    		} else if ($check_success == true) {
    			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah success.'));
			} else if (empty($this->db->escape_str($this->input->post('rekening'))) AND empty($this->db->escape_str($this->input->post('payment')))) {
				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Mohon mengisi semua input.'));
    		} else {
    		    $update_order = $this->order_model->update(['rekening' => $data_input['rekening'],  'payment' => $data_input['payment'], 'status' => 'Refund Pending', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id, 'order_by' => 'Pembeli']);
    		    if ($update_order) {
                    $data_input = [
                        'order_id' => $target->order_id,
                        'user_id' => '0',
                        'sender' => 'Admin',
                        'message' => '*Pembeli Melakukan Kasus Terbuka untuk Pengembalian Dana, Proses Refund Sedang Diperiksa Oleh Admin',
                        'created_at' => date('Y-m-d H:i:s'),
                        'update_at' => date('Y-m-d H:i:s'),
                    ];
                    $this->chat_model->insert($data_input);
        		    $this->order_model->update(['status' => 'Refund Pending', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
    		        $this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Transaksi sedang diproses refund.'));
    		    } else {
    		        $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
    		    }
                exit(redirect(base_url('order/detail/'.$i)));
    		}
	    }
	    if ($action == 'confirmation') {
	        if ($target->order_by == 'Penjual') {
        		$order_cancel = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Cancel Transaksi']);
        		$order_confirm = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Pesanan Telah Dikirim']);
        		if ($order == true) {
        			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dibatalkan.'));
        		} else if ($order_confirm == true) {
        			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dikonfirmasi.'));
        		} else {
        		    $update_order = $this->order_model->update(['status' => 'Pesanan Telah Dikirim', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
        		    if ($update_order) {
                        $data_input = [
                            'order_id' => $target->order_id,
                            'user_id' => '0',
                            'sender' => 'Admin',
                            'message' => '*Penjual Melakukan Konfirmasi Pesanan Telah Dikirim, Mohon Periksa Kembali Pesanan Anda',
                            'created_at' => date('Y-m-d H:i:s'),
                            'update_at' => date('Y-m-d H:i:s'),
                        ];
                        $this->chat_model->insert($data_input);
        		        $this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Transaksi berhasil dikonfirmasi.'));
        		    } else {
        		        $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
        		    }
                    exit(redirect(base_url('order/detail/'.$i)));
        		}
	        } else if ($target->order_by == 'Pembeli') {
        		$order_cancel = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Cancel Transaksi']);
        		$order_confirm = $this->order_model->get_row(['order_id' => $target->order_id, 'status' => 'Transaksi Success']);
        		if ($order == true) {
        			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dibatalkan.'));
        		} else if ($order_confirm == true) {
        			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dikonfirmasi.'));
        		} else {
        		    $update_order = $this->order_model->update(['status' => 'Transaksi Success', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
        		    if ($update_order) {
                        $data_input = [
                            'order_id' => $target->order_id,
                            'user_id' => '0',
                            'sender' => 'Admin',
                            'message' => '*Pembeli Telah Mengkonfirmasi Pesanan Penjual, Transaksi Selesai',
                            'created_at' => date('Y-m-d H:i:s'),
                            'update_at' => date('Y-m-d H:i:s'),
                        ];
                        $this->chat_model->insert($data_input);
        		        $this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Transaksi berhasil dikonfirmasi.'));
        		    } else {
        		        $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
        		    }
                    exit(redirect(base_url('order/detail/'.$i)));
        		}
	        }
	    }
		$this->render('public/order/detail', ['target' => $target, 'payment_bank' => $this->m_payment_method_model->get_rows(['where' => [['category' => 'BANK', 'status' => '1']]]), 'payment_emoney' => $this->m_payment_method_model->get_rows(['where' => [['category' => 'E-MONEY', 'status' => '1']]]), 'get_amount' => $get_amount, 'get_fee' => $get_fee, 'mutation' => $this->mutation_model->get_row(['order_id' => $target->order_id]), 'page' => 'Transaksi #'.$i.'']);
	}
	public function chat($i = '') {
		$i = $this->db->escape_str($i);
		$target = $this->chat_model->get_rows(['where' => [['order_id' => $i]]]);
		$order_by = $this->order_model->get_row(['user_id' => user(), 'order_id' => $i]);
		$order_buyyer = $this->order_model->get_row(['order_id' => $i, 'order_by' => 'Pembeli']);
		$order = $this->order_model->get_row(['user_id' => user(), 'order_id' => $i]);
		if ($order == false) {
		    $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi tidak ditemukan.'));
            exit(redirect(base_url()));
		}
		if ($order_buyyer == false) {
		    $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Pembeli belum melakukan join transaksi.'));
            exit(redirect(base_url('order/detail/'.$i)));
		}
		if ($order->status == 'Cancel Transaksi') {
		    $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dibatalkan.'));
            exit(redirect(base_url('order/detail/'.$i)));
		}
		if ($order->order_by == 'Penjual') {
		    $order = $this->order_model->get_row(['order_id' => $i, 'order_by' => 'Pembeli']);
		    $user = $this->user_model->get_row(['user_id' => $order->user_id]);
		} else if ($order->order_by == 'Pembeli') {
		    $order = $this->order_model->get_row(['order_id' => $i, 'order_by' => 'Penjual']);
		    $user = $this->user_model->get_row(['user_id' => $order->user_id]);
		}
		$user = $this->user_model->get_row(['user_id' => $order->user_id]);
		if ($target == false) show_404();
		if ($this->input->post()) {
			$this->form_validation->set_rules('message', 'Pesan', 'required');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'order_id' => $order->order_id,
					'user_id' => user(),
					'sender' => $order_by->order_by,
					'message' => $this->db->escape_str(strip_tags($this->input->post('message'))),
					'created_at' => date('Y-m-d H:i:s'),
					'update_at' => date('Y-m-d H:i:s'),
				];
		        $chat = $this->chat_model->get_row(['order_id' => $i]);
    			if ($data_input['message'] == 'Saya hanya berkomunikasi di fitur chat Rekber. Dan mengabaikan pesan yang mengajak berkomunikasi di luar aplikasi Rekber, karena yang berkomunikasi di luar Rekber adalah PENIPU. Jika saya salah atau lalai, maka saya menerima semua konsekuensi.') {
				    if ($order_by->order_by == 'Penjual') {
				        $chat_status = $this->chat_status_model->get_row(['order_id' => $order->order_id, 'status_seller' => '0']);
				    } else if ($order_by->order_by == 'Pembeli') {
				        $chat_status = $this->chat_status_model->get_row(['order_id' => $order->order_id, 'status_buyyer' => '0']);
				    }
    			} else {
				    $chat_status = $this->chat_status_model->get_row(['order_id' => $order->order_id, 'status_seller' => '1', 'status_buyyer' => '1']);
    			}
				if ($chat_status == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Chat belum terverifikasi.'));
				} else {
    				if ($data_input['message'] == 'Saya hanya berkomunikasi di fitur chat Rekber. Dan mengabaikan pesan yang mengajak berkomunikasi di luar aplikasi Rekber, karena yang berkomunikasi di luar Rekber adalah PENIPU. Jika saya salah atau lalai, maka saya menerima semua konsekuensi.') {
				        if ($order_by->order_by == 'Penjual') {
    				        $this->chat_status_model->update(['status_seller' => '1', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $order->order_id]);
    				    } else if ($order_by->order_by == 'Pembeli') {
    				        $this->chat_status_model->update(['status_buyyer' => '1', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $order->order_id]);
    				    }
				    }
        			$insert_chat = $this->chat_model->insert($data_input);
        			if ($insert_chat) {
        				$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Chat berhasil dikirim.'));
        				exit(redirect(base_url('order/chat/'.$i)));
        			} else {
        				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
        			}
			    }
			} else {
				$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => ''.validation_errors()));
			}
		}
		$this->render('public/order/chat', ['target' => $target, 'order' => $order, 'user' => $user, 'page' => 'Chat #'.$i.'']);
	}
	public function join() {
		if ($this->input->post()) {
			$this->form_validation->set_rules('order_id', 'Kode Transaksi', 'required|min_length[10]|max_length[10]');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'order_id' => $this->db->escape_str($this->input->post('order_id'))
				];
				$target = $this->order_model->get_row(['order_id' => $data_input['order_id']]);
				$order = $this->order_model->get_row(['order_id' => $data_input['order_id'], 'order_by' => 'Pembeli']);
				$check_order = $this->order_model->get_row(['order_id' => $data_input['order_id'], 'status' => 'Cancel Transaksi']);
				if ($this->order_model->get_row(['order_id' => $data_input['order_id']]) == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kode transaksi tidak terdaftar.'));
				} else if ($check_order == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah dibatalkan oleh penjual.'));
				} else if ($target->user_id == user()) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah terdaftar diriwayat.'));
				} else if ($order == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Transaksi sudah terdaftar diriwayat.'));
                } else {
    				$data_input = [
    					'user_id' => user(),
					    'seller_name' => $target->seller_name,
					    'buyyer_name' => $target->buyyer_name,
    					'order_id' => $target->order_id,
    					'order_by' => 'Pembeli',
    					'category_name' => $target->category_name,
    					'order_name' => $target->order_name,
    					'date' => $target->date,
    					'amount' => $target->amount,
    					'amount_unix' => $target->amount_unix,
    					'fee' => $target->fee,
    					'grand_total' => $target->grand_total,
    					'rekening' => '-',
    					'payment' => '-',
    					'reference_id' => $target->reference_id,
    					'fee_by' => $target->fee_by,
    					'status' => 'Pending Pembayaran',
    					'created_at' => date('Y-m-d H:i:s'),
    					'update_at' => date('Y-m-d H:i:s')
    				];
					$insert_order = $this->order_model->insert($data_input);
					if ($insert_order) {
            		    $this->order_model->update(['status' => 'Pending Pembayaran', 'update_at' => date('Y-m-d H:i:s')], ['order_id' => $target->order_id]);
    					$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Transaksi ditemukan.'));
    					exit(redirect(base_url('order/detail/'.$data_input['order_id'])));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				}
			} else {
				$this->session->set_flashdata('result', array('msg' => ''.validation_errors()));
			}
		}
		$this->render('public/order/join', ['page' => 'Join Transaksi']);
	}
}