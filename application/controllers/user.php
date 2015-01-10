<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}

	public function reg() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', '密码', 'required');
		$this->form_validation->set_rules('username', '用户名', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('header');
			$this->load->view('user/reg');
			$this->load->view('footer');
		}
		else {
			$this->user_model->reg();
			$this->load->view('header');
			$this->load->view('message', array('message'=>'注册成功'));
			$this->load->view('footer');
		}
	}
	
	public function login() {
		if ($this->session->userdata('email') !== FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message'=>'已经登录:' . $this->session->userdata('email')));
			$this->load->view('footer');
			return;
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', '密码', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('header');
			$this->load->view('user/login');
			$this->load->view('footer');
		}
		else {
			$query = $this->user_model->login();
			if ($query->num_rows() > 0) {
				$user = $query->row_array();
				$this->session->set_userdata($user);
				$this->session->unset_userdata('password');
				$this->load->view('header');
				$this->load->view('message', array('message'=>'登陆成功'));
				$this->load->view('footer');
			}
			else {
				$this->load->view('header');
				$this->load->view('user/login');
				$this->load->view('footer');
			}
		}
	}
	
	public function logout() {
		$this->session->sess_destroy();
		$this->load->view('message', array('message'=>'登出成功'));
	}
}
