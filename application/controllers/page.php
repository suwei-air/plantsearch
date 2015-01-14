<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	public function view($page = 'index') {
		
		//$data['title'] = ucfirst($page); // 将title中的第一个字符大写
		if ($page == 'index') {
			$this->load->view('index');
		}
		else {
			if ( ! file_exists(APPPATH . 'views/page/'.$page.'.php'))
			{
				show_404();
			}
			$this->load->view('header');
			$this->load->view('page/' . $page);
			$this->load->view('footer');
		}
	}

	public function acknowledgements() {
		$this->load->model('plant_model');
		$data = array(
			'photographers' => $this->plant_model->get_photographers()
		);
		$this->load->view('header');
		$this->load->view('page/acknowledgements', $data);
		$this->load->view('footer');
	}
}
