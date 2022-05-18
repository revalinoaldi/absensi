<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Karyawan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('UserModel','user');
		if (@$this->session->userdata('data')['level'] != "Admin") {
			redirect('Login','refresh');
		}
	}

	private function _stucture($pages='')
	{
		$path = 'HRD_GA/Layouts/';
		return $data = [
			'header' => $path.'header',
			'side' => $path.'nav',
			'right' => $path.'sideright',
			'content' => $pages,
			'footer'=> $path.'footer'
		];
	}

	public function index()
	{
		$page = 'HRD_GA/Pages/Karyawan/List';
		$data['structure'] = $this->_stucture($page);

		$data['location'] = json_decode(file_get_contents("http://ipinfo.io/"))->city;
		$this->load->view('main', $data, FALSE);
	}

	public function action($id='')
	{
		$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_rules('repass', 'Mathces Password', 'trim|required|matches[pass]');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Error Action! Please check your input requirement</div>');
			redirect('Admin/Dashboard','refresh');
		} else {
			$newData['id'] = $this->input->post('id');
			$newData['nama'] = $this->input->post('name');
			$newData['email'] = $this->input->post('email');
			$newData['pass'] = $this->input->post('pass');
			$result = $this->user->getApi('Api/KaryawanController/'.$newData['id']);
			if (!$result['status']) {
				$ins = $this->user->getApi('Api/KaryawanController/',json_encode($newData));
				if ($ins['status']) {
					$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Successfull Added! Success Add new Employee</div>');
					redirect('Admin/Dashboard','refresh');
				}else{
					// var_dump($ins);
					$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Error Action! '.$ins['message'].'</div>');
					redirect('Admin/Dashboard','refresh');
				}
			}else{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Error Action! Employee already exist </div>');
					redirect('Admin/Dashboard','refresh');
			}
		}
	}

	public function importData()
	{
		$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if(isset($_FILES['importData']['name']) && in_array($_FILES['importData']['type'], $file_mimes)) {

			$extension = pathinfo($_FILES['importData']['name'], PATHINFO_EXTENSION);

			if('csv' == $extension) {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} elseif ('xls' == $extension) {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$spreadsheet = $reader->load($_FILES['importData']['tmp_name']);

			// $sheetData = $spreadsheet->getActiveSheet()->toArray();
			$sheetKaryawan = $spreadsheet->getSheetByName('KARYAWAN')->toArray();
			$i = 0;
			$newData = [];
			foreach ($sheetKaryawan as $val) {
				if ($i == 0) {
					if ($val[0] == 'ID_KARYAWAN' || $val[0] == 'NIP' && 
						$val[1] == 'NAMA_KARYAWAN' || $val[1] == 'NAMA' &&
						$val['2'] == 'Username' || $val['2'] == 'Email' &&
						$val[3] == 'Password'
					){echo "&nbsp;";}else{
						redirect('Admin/Dashboard','refresh');
					}
				}else{
					if (@$val[0] != null) {
						
						$newData['id'] = $val[0];
						$newData['nama'] = $val[1];
						$newData['email'] = $val[2];
						$newData['pass'] = $val[3];

						$result = $this->user->getApi('Api/KaryawanController/'.$newData['id']);
						if (!$result['status']) {
							$ins = $this->user->getApi('Api/KaryawanController/',json_encode($newData));
						}
					}
				}
				$i++;
			}
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Successfull Import! Complate Import Data</div>');
			redirect('Admin/Dashboard','refresh');
		}
	}

	public function logout()
	{
		$this->user->logout();
	}

}

/* End of file Karyawan.php */
/* Location: ./application/controllers/HRD/Karyawan.php */