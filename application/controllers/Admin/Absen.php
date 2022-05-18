<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absen extends CI_Controller {

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

	private function _hari($date ='')
	{
		if (@$date != null) {
			$date = date('N', strtotime($date));	
		}else{
			$date = date('N');	
		}

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
			'absen' => $this->user->getApi('Api/AbsenController/absenlist')
		];
		$data['structure'] = $this->_stucture('Absen', 'Admin/Pages/Absensi/ListByDate');
		$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
		$this->load->view('main', $data, FALSE);
	}

	public function detail($date)
	{
		if (@$date != null) {
			$date = date('Y-m-d', strtotime($date));
			$data = [
				'hari' => $this->_hari().', '.date('d F Y'),
				'data' => $this->user->getUser(),
				'absen' => $this->user->getApi('Api/AbsenController/?date='.$date),
				'list' => $this->_hari($date).', '.date('d F Y', strtotime($date)),
			];
			$data['structure'] = $this->_stucture('Absen', 'Admin/Pages/Absensi/AbsenDate');
			$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
			$this->load->view('main', $data, FALSE);
		}else{
			redirect('Admin/Absen','refresh');
		}
	}

	public function report()
	{
		$data = [
			'hari' => $this->_hari().', '.date('d F Y'),
			'data' => $this->user->getUser(),
		];

		if (@$this->input->get('datefrom') && @$this->input->get('dateto')) {
			$from = date('Y-m-d', strtotime($this->input->get('datefrom')));
			$to = date('Y-m-d', strtotime($this->input->get('dateto')));
			$data['absen'] = $this->user->getApi('Api/AbsenController/?date_from='.$from.'&date_to='.$to);
		}else{
			$data['absen'] = $this->user->getApi('Api/AbsenController/');
		}

		$data['structure'] = $this->_stucture('Report', 'Admin/Pages/Absensi/ReportAbsen');
		$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
		$this->load->view('main', $data, FALSE);
	}

	public function download_excel()
	{
		$data = [
			'hari' => $this->_hari().', '.date('d F Y'),
			'data' => $this->user->getUser(),
		];

		if (@$this->input->get('datefrom') && @$this->input->get('dateto')) {
			$from = date('Y-m-d', strtotime($this->input->get('datefrom')));
			$to = date('Y-m-d', strtotime($this->input->get('dateto')));
			$data['absen'] = $this->user->getApi('Api/AbsenController/?date_from='.$from.'&date_to='.$to);
		}else{
			$data['absen'] = $this->user->getApi('Api/AbsenController/');
		}

		// $data['structure'] = $this->_stucture('Report', 'Admin/Pages/Absensi/ExcelDownload');
		$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
		$this->load->view('Admin/Pages/Absensi/ExcelDownload', $data, FALSE);
	}

}

/* End of file Absen.php */
/* Location: ./application/controllers/Admin/Absen.php */