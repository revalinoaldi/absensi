<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('UserModel','user');
		if (@$this->session->userdata('data')['level'] != "Admin") {
			redirect('Login','refresh');
		}
	}

	private function _stucture($active, $pages="")
	{
		$path = 'Admin/Layouts/';
		return $data = [
			'header' => $path.'header',
			'sidenav' => $path.'nav',
			'content' => $pages,
			'setActivePage' => [
				'active' => $active
			]
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
			'employee' => $this->user->getApi('Api/KaryawanController/')
		];
		$data['structure'] = $this->_stucture('Dashboard', 'Admin/Pages/CDashboard');
		$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
		$this->load->view('main', $data, FALSE);
	}



}

/* End of file Dashboard.php */
/* Location: ./application/controllers/HRD/Dashboard.php */