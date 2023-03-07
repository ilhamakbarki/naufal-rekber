<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('login') AND $this->uri->segment(2) <> 'logout') {
			if (user() == false) exit(redirect(base_url('auth/logout')));
		}
	}
	public function login() {
		if ($this->session->userdata('login')) exit(redirect(base_url()));
		if ($this->input->post()) {
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'email' => $this->db->escape_str($this->input->post('email')),
					'password' => md5($this->input->post('password'))
				];
				$user = $this->user_model->get_row(['email' => $data_input['email'], 'password' => $data_input['password']]);
				if ($user == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Email atau password salah.'));
				} else if ($user->is_verification == '0') {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Akun belum terverifikasi.'));
				} else if ($user->status == '0') {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Akun dinonaktifkan.'));
				} else {
				    if ($user->level == '1') {
    					$this->session->set_userdata('login', $user->user_id);
    					$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Silahkan untuk melanjutkan transaksi anda.'));
    					exit(redirect(base_url()));
				    } else if ($user->level == '2') {
    					$this->session->set_userdata('admin', $user->user_id);
    					$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Masuk akun berhasil.'));
    					exit(redirect(base_url('admin')));
				    }
				}
				exit(redirect(base_url('auth/login')));
			} else {
				$this->session->set_flashdata('result', array('msg' => ''.validation_errors()));
			}
		}
		$this->render_auth('public/auth/login');
	}
	public function register() {
		if ($this->session->userdata('login')) exit(redirect(base_url()));
		if ($this->input->post()) {
			$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|alpha_numeric_spaces|min_length[5]|max_length[100]');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Nomor HP', 'required|numeric|min_length[9]|max_length[13]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
			$this->form_validation->set_rules('terms', 'Ketentuan Layanan', 'required');
			if ($this->form_validation->run() == true) {
				$data_input = [
					'user_id' => '',
					'full_name' => $this->db->escape_str($this->input->post('full_name')),
					'username' => $this->db->escape_str($this->input->post('username')),
					'email' => $this->db->escape_str($this->input->post('email')),
					'phone' => $this->db->escape_str($this->input->post('phone')),
					'level' => '1',
					'password' => md5($this->input->post('password')),
					'token' => random_string('alnum', 30),
					'image' => 'male.png',
					'is_verification' => '0',
					'status' => '1',
					'created_at' => date('Y-m-d H:i:s'),
					'update_at' => date('Y-m-d H:i:s')
				];

				if ($this->user_model->get_row(['username' => $data_input['username']]) == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah terdaftar.'));
				} else if ($this->user_model->get_row(['email' => $data_input['email']]) == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Email sudah terdaftar.'));
				} else if ($this->user_model->get_row(['phone' => $data_input['phone']]) == true) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Nomor HP sudah terdaftar.'));
                } else {
                    $this->load->library('PHPMailer_Lib');
                    $mail = $this->phpmailer_lib->load();
                    $mail->isSMTP();
                    $mail->Host     = 'mail.rekbersama.my.id';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'support@rekbersama.my.id';
                    $mail->Password = 'VYl2rWz^k{-a';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = '465';
                    $mail->setFrom('support@rekbersama.my.id', 'Rekber');
                    $mail->addAddress($this->input->post('email'));
                    $mail->Subject = 'Verifikasi Akun';
                    $mail->MsgHTML('Untuk melanjutkan transaksi, silahkan verifikasi akun <a href="'.base_url('auth/verification/'.$data_input['token']).'">Klik Disini</a>');
                    $mail->isHTML(true);
                    $mail->CharSet="utf-8";
                    if ($mail->Send())
					$insert_user = $this->user_model->insert($data_input);
					if ($insert_user) {
        				$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Daftar akun berhasil, Silahkan melakukan verifikasi akun yang sudah terkirim ke email terdaftar.'));
        				exit(redirect(base_url('auth/login')));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				}
				exit(redirect(base_url('auth/register')));
			} else {
				$this->session->set_flashdata('result', array('msg' => ''.validation_errors()));
			}
		}
		$this->render_auth('public/auth/register');
	}
	public function forgot_password() {
		if ($this->session->userdata('login')) exit(redirect(base_url()));
		if ($this->input->post()) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run() == true) {
				$data_input = [
    				'token' => random_string('alnum', 30)
				];

				$email = $this->user_model->get_row(['email' => $this->input->post('email'), 'status' => '1']);
				if ($email == false) {
					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Email tidak ditemukan.'));
				} else {
                    $this->load->library('PHPMailer_Lib');
                    $mail = $this->phpmailer_lib->load();
                    $mail->isSMTP();
                    $mail->Host     = 'mail.rekbersama.my.id';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'support@rekbersama.my.id';
                    $mail->Password = 'VYl2rWz^k{-a';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = '465';
                    $mail->setFrom('support@rekbersama.my.id', 'Rekber');
                    $mail->addAddress($this->input->post('email'));
                    $mail->Subject = 'Lupa Password';
                    $mail->MsgHTML('Untuk mengatur ulang password anda silahkan <a href="'.base_url('auth/change_password/'.$data_input['token']).'">Klik Disini</a>');
                    $mail->isHTML(true);
                    $mail->CharSet="utf-8";
                    if ($mail->Send())
					$update_user = $this->user_model->update($data_input, ['email' => $this->input->post('email')]);
					if ($update_user) {
						$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Link untuk mengatur ulang kata sandi sudah dikirim ke email. Silahkan cek email anda bagian inbox/spam.'));
						exit(redirect(base_url('auth/login')));
					} else {
						$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
					}
				}
				exit(redirect(base_url('auth/forgot_password')));
			} else {
				$this->session->set_flashdata('result', array('msg' => ''.validation_errors()));
			}
		}
		$this->render_auth('public/auth/forgot_password');
	}
	public function change_password($i = '') {
		if ($this->session->userdata('login')) exit(redirect(base_url()));
		$i = $this->db->escape_str($i);
		$data = $this->user_model->get_row(['token' => $i]);
	    if (!$i) {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Link tidak ditemukan.'));
			exit(redirect(base_url('auth/forgot_password')));
	    } elseif ($data == false) {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Link tidak ditemukan.'));
			exit(redirect(base_url('auth/forgot_password')));
		} else {
			if ($this->input->post()) {
    			$this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[5]');
    			$this->form_validation->set_rules('confirm_new_password', 'Konfirmasi Password Baru', 'required|matches[new_password]');
    			if ($this->form_validation->run() == true) {
    				$data_input = [
    					'password' => md5($this->input->post('new_password')),
    					'token' => random_string('alnum', 30)
    				];
    				$update_user = $this->user_model->update($data_input, ['user_id' => $data->user_id]);
    				if ($update_user) {
    					$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Ganti password berhasil.'));
						exit(redirect(base_url('auth/login')));
    				} else {
    					$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
    				}
    				exit(redirect(base_url('auth/change_password')));
    			} else {
    				$this->session->set_flashdata('result', array('msg' => ''.validation_errors()));
    			}
    		}
    		$this->render_auth('public/auth/change_password');
		}
	}
	public function verification($i = '') {
		if ($this->session->userdata('login')) exit(redirect(base_url()));
		$i = $this->db->escape_str($i);
		$data = $this->user_model->get_row(['token' => $i, 'is_verification' => '0']);
	    if (!$i) {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Link tidak ditemukan.'));
			exit(redirect(base_url('auth/login')));
	    } elseif ($data == false) {
			$this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Link tidak ditemukan.'));
			exit(redirect(base_url('auth/login')));
		} else {
		    $update_user = $this->user_model->update(['is_verification' => '1', 'token' => random_string('alnum', 30)], ['user_id' => $data->user_id]);
		    if ($update_user) {
		        $this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Verifikasi akun berhasil.'));
		        exit(redirect(base_url('auth/login')));
		    } else {
		        $this->session->set_flashdata('result', array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Kesalahan tidak terduga.'));
		    }
		    exit(redirect(base_url('auth/login')));
		}
	}
	public function logout() {
		if ($this->session->userdata('login') == false) exit(redirect(base_url()));
		$this->session->unset_userdata('login');
		$this->session->set_flashdata('result', array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Semoga hari anda menyenangkan!'));
		redirect(base_url());
	}
}