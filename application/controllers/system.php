<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('system_model');
	}

	public function install($token) {
		if ($token != 'suwei.air')
		{
			show_404();
		}
		$this->system_model->install();
	}
}
