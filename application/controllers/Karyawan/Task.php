<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

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
			'absenHarian' => $this->user->getApi('Api/AbsenController/'.$this->user->getUser()['data']['id']),
		];
		$data['structure'] = $this->_stucture('Karyawan/Pages/ListTask');
		$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
		$this->load->view('main', $data, FALSE);
	}

	public function editTaks($id)
	{
		if ($id) {
			$data = [
				'hari' => $this->_hari().', '.date('d F Y'),
				'data' => $this->user->getUser(),
				'absenHarian' => $this->user->getApi('Api/AbsenController/'.$this->user->getUser()['data']['id'].'?id='.$id),
			];
			$data['structure'] = $this->_stucture('Karyawan/Pages/formEditTaks');
			$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"));
			$this->load->view('main', $data, FALSE);
		}else{
			redirect('Karyawan/Task','refresh');
		}
	}

	public function prosesEditTask()
	{
		if ($this->input->post('save')) {
			$arr = array(
				'id' => $this->input->post('id'), 
				'employee' => $this->input->post('employee'), 
				'desc' => $this->input->post('desc'), 
				'tgl' => $this->input->post('tgl'),
				'idkey' => $this->user->key
			);
			$return = $this->user->getApi('Api/AbsenController/absenpulang',json_encode($arr));
			
			if ($return['status']) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">'.$return['title'].' '.$return['message'].'</div>');
			}else{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">'.$return['title'].' '.$return['message'].'</div>');
			}
			redirect('Karyawan/Task','refresh');
		}else{
			redirect('Karyawan/Task','refresh');
		}
	}
}

/* End of file Task.php */
/* Location: ./application/controllers/Karyawan/Task.php */