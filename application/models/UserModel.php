<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class UserModel extends CI_Model {
	public $key,$tokenkey;

	public function __construct()
	{
		parent::__construct();
		if ((@$this->session->userdata('key') && @$this->session->userdata('token')) || (@get_cookie('key', TRUE) != null && @get_cookie('token', TRUE) != null)) {
				$this->key = @get_cookie('key', TRUE) ? get_cookie('key', TRUE) : $this->session->userdata('key');
				$this->tokenkey = @get_cookie('token', TRUE) ? get_cookie('token', TRUE) : $this->session->userdata('token');
		}else{
			redirect('Login','refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		delete_cookie('key');
		delete_cookie('token');
		redirect('Login','refresh');
	}

	public function getUser()
	{
		try {
			$payload = JWT::decode($this->tokenkey, $this->key, array('HS256'));
			$time = new DateTimeImmutable();

			if ($time->getTimestamp() > $payload->exp) {
				$data = [
					'result' => false,
					'data' => []
				];
			}else{
				$data = [
					'result' => true,
					'data' => [
						'id' => $payload->id,
						'nama' => $payload->nama,
						'email' => $payload->email,
						'level' => $payload->level,
					]
				];
			}
			return $data;
		} catch (Exception $e) {
			return $data = [
				'result' => false,
				'data' => []
			];

		}
	}

	public function getApi($url, $data='')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'http://api-absensi.firalcreative.my.id/'.$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);

		if (@$data != null) {
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'token: '.$this->key,
			'tokenkey: '.$this->tokenkey,
			'Content-Type: application/json',
		));

		$output = curl_exec($ch);
		curl_close ($ch);
		return json_decode($output, true);
	}

}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */