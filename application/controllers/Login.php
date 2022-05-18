<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		// $this->load->model('UserModel','user');

		if ((@$this->session->userdata('key') && @$this->session->userdata('token')) || (@get_cookie('key', TRUE) != null && @get_cookie('token', TRUE) != null)) {
			
			$key = @get_cookie('key', TRUE) ? get_cookie('key', TRUE) : $this->session->userdata('key');
			$token = @get_cookie('token', TRUE) ? get_cookie('token', TRUE) : $this->session->userdata('token');
			$result = $this->regenerate_key($key,$token);

			if ($result) {
				if ($this->session->userdata('data')['level'] == "Karyawan") {
					redirect('Karyawan/Dashboard','refresh');
				}else{
					redirect('Admin/Dashboard','refresh');
				}
			}

		}
	}

	public function regenerate_key($key,$token)
	{
		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://api-absensi.firalcreative.my.id/Regenerate");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'token: '.$key,
				'tokenkey: '.$token,
				'Content-Type: application/json',
			));
			$output = curl_exec($ch);
			curl_close ($ch);

			$res = json_decode($output, true);
			if (@$res['status']) {
				$array = array(
					'key' => $res['data']['key'],
					'token' => $res['data']['token'],
					'data' => $res['data'],
				);

				$cookie1 = array(
					'name'   => 'key',
					'value'  => $array['key'],
					'expire' => $res['data']['expire'],
					'secure' => TRUE
				);

				$cookie2 = [
					'name'   => 'token',
					'value'  => $array['token'],
					'expire' => $res['data']['expire'],
					'secure' => TRUE
				];

				$this->input->set_cookie($cookie1);
				$this->input->set_cookie($cookie2);

				$this->session->set_userdata( $array );
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
		}		
	}

	public function setSession()
	{
		$array = array(
			'key' => $this->input->post('key'),
			'token' => $this->input->post('token'),
			'data' => $this->input->post('data')
		);

		$cookie1 = array(
			'name'   => 'key',
			'value'  => $array['key'],
			'expire' => $this->input->post('data')['exp'],
			'secure' => TRUE
		);

		$cookie2 = [
			'name'   => 'token',
			'value'  => $array['token'],
			'expire' => $this->input->post('data')['exp'],
			'secure' => TRUE
		];

		$this->input->set_cookie($cookie1);
		$this->input->set_cookie($cookie2);

		$this->session->set_userdata( $array );
		$result = [
			'result' => true,
			'message' => 'Welcome to Apps!',
		];

		echo json_encode($result);
	}

	public function index()
	{
		$this->load->view('Login', '', FALSE);
	}

	private function _api($url,$data='')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'http://192.168.100.84:8088/api-absen/'.$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);

		if (@$data != null) {
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'token: k84oog80ggs8kg88cow04woccok04sgwokw00oko',
			'tokenkey: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjAwNjAzMDA0MTExNyIsIm5hbWEiOiJIZXJkaSBCYXJkaWFuIiwiZW1haWwiOiJoZXJkaS5iYXJkaWFuQGdtYWlsLmNvbSIsImxldmVsIjoiS2FyeWF3YW4iLCJrZXkiOiJrODRvb2c4MGdnczhrZzg4Y293MDR3b2Njb2swNHNnd29rdzAwb2tvIiwiaWF0IjoxNjI3ODI2NTA4LCJpc3MiOiJhcGkuYWJzZW5zaS5jb20iLCJuYmYiOjE2Mjc4MjY1MDgsImV4cCI6MTYzMDUwNDkwOH0.2gt7lO6a0SpJW2bTeC126hRLZ--HjnJ45vK-Sj9fT-A',
			'Content-Type: application/json',
		));

		$output = curl_exec($ch);
		curl_close ($ch);
		return json_decode($output, true);
	}

	public function admin()
	{
		
		$p = [
			'id' => random_string('basic', 12),
			'nama' => 'Admin',
			'email' => 'admin@admin.com',
			'pass' => 'Bismillah0578!!@',
			'level' => 'Admin',
			'create_at' => date('Y-m-d H:i:s')
		];
		$a = $this->_api('Api/KaryawanController/',json_encode($p));
		redirect('Login','refresh');
	}
	
	public function download()
	{
		force_download(base_url('assets/apps/EAbsen.apk'),NULL);
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */