<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

	public function index()
	{
		force_download('assets/apps/EAbsen.apk',NULL);
		redirect(site_url(),'refresh');
	}

}

/* End of file Download.php */
/* Location: ./application/controllers/Download.php */