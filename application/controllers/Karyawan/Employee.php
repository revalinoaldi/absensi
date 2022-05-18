<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('UserModel','user');
		if (@$this->session->userdata('data')['level'] != "Karyawan") {
			redirect('Login','refresh');
		}
	}

	private function _stucture($pages='')
	{
		$path = 'Karyawan/Layouts/';
		return $data = [
			'header' => $path.'header',
			// 'sidenav' => $path.'nav',
			'content' => $pages,
		];
	}

	private function _hari()
	{
		$date = date('N');
		switch ($date) {
			case '1':
			return 'Senin';
			break;
			case '2':
			return 'Selasa';
			break;
			case '3':
			return 'Rabu';
			break;
			case '4':
			return 'Kamis';
			break;
			case '5':
			return 'Jumat';
			break;
			case '6':
			return 'Sabtu';
			break;
			default:
			return 'Minggu';
			break;
		}
	}

	public function profile()
	{
		$data = [
			'hari' => $this->_hari().', '.date('d F Y'),
			'data' => $this->user->getUser(),
		];
		$data['structure'] = $this->_stucture('Karyawan/Pages/Karyawan/Profile');
		$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
		$this->load->view('main', $data, FALSE);
	}

	public function editProfile()
	{
		if ($this->input->post('save')) {
			if (@$this->input->post('pass') != @$this->input->post('repass')) {
				redirect('Karyawan/Employee/profile','refresh');
			}
			$arr = array(
				'id' => $this->input->post('id'), 
				'nama' => $this->input->post('nama'), 
				'email' => $this->input->post('email'), 
				'pass' => $this->input->post('pass'), 
			);
			try {
				$res = $this->user->getApi('Api/KaryawanController/'.$arr['id'],json_encode($arr));

				if ($res['status']) {
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
					$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">'.$res['title'].' '.$res['message'].'</div>');
					redirect('Karyawan/Employee/profile','refresh');
				}else{
					$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">'.$res['title'].' '.$res['message'].'</div>');
					redirect('Karyawan/Employee/profile','refresh');
				}
			} catch (Exception $e) {
				redirect('Karyawan/Employee/profile','refresh');
			}
		}else{
			redirect('Karyawan/Employee/profile','refresh');
		}
	}

	public function logout()
	{
		$this->user->logout();
	}

}

/* End of file Employee.php */
/* Location: ./application/controllers/Karyawan/Employee.php */