<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

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

	public function index()
	{
		$data = [
			'hari' => $this->_hari().', '.date('d F Y'),
			'data' => $this->user->getUser(),
			'checkHarian' => $this->user->getApi('Api/AbsenController/checkAbsenHarian/'.$this->user->getUser()['data']['id']),
			'absenHariIni' => $this->user->getApi('Api/AbsenController/'.$this->user->getUser()['data']['id'].'?date='.date('d-m-Y'))
		];

		$data['structure'] = $this->_stucture('Karyawan/Pages/CDashboard');
		$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
		$this->load->view('main', $data, FALSE);
	}

	public function absen_masuk($id)
	{
		if (@$id) {
			$arr = array(
				'id' => $id, 
				'idkey' => $this->user->key
			);
			$return = $this->user->getApi('Api/AbsenController/absenmasuk',json_encode($arr));
			// var_dump($return);

			if (@$return['status']) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">'.$return['title'].' '.$return['message'].'</div>');
			}else{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">'.$return['title'].' '.$return['message'].'</div>');
			}
			redirect('Karyawan/Dashboard','refresh');
		}else{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Employee not Found</div>');
			redirect('Karyawan/Dashboard','refresh');
		}
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/HRD/Dashboard.php */