<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feature extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('feature_model');
		$this->load->model('user_model');
	}

	public function add() {
		if ($this->user_model->is_auth('ADMIN') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有管理权限！'));
			$this->load->view('footer');
			return;
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', '特征名', 'required');
		$this->form_validation->set_rules('field_name', '字段名', 'required|alpha_dash');
		$this->form_validation->set_rules('is_display', '是否显示', 'required|greater_than[0]|less_than[2]');
		
		if ($this->form_validation->run() === FALSE) {
			$data = array('action' => 'add');
			$this->load->view('header');
			$this->load->view('feature/update', $data);
			$this->load->view('footer');
		}
		else {
			if ($this->feature_model->add()) {
				$data = array('features' => $this->feature_model->get_list());
				$this->load->view('header');
				$this->load->view('feature/list', $data);
				$this->load->view('footer');
				return TRUE;
			}
			else {
				$this->load->view('header');
				$this->load->view('message', array('message' => '添加失败！'));
				$this->load->view('footer');
				return FALSE;
			}
		}
	}
	
	public function modify($id = FALSE) {
		if ($this->user_model->is_auth('ADMIN') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有管理权限！'));
			$this->load->view('footer');
			return;
		}
		
		if ($id === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '参数错误！'));
			$this->load->view('footer');
			return FALSE;
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', '特征名', 'required');
		$this->form_validation->set_rules('field_name', '字段名', 'required|alpha_dash');
		$this->form_validation->set_rules('is_display', '是否显示', 'required|greater_than[0]|less_than[2]');
		
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'action' => 'modify/' . $id,
				'feature' => $this->feature_model->get_feature($id)
			);
			$this->load->view('header');
			$this->load->view('feature/update', $data);
			$this->load->view('footer');
		}
		else {
			if ($this->feature_model->update($id)) {
				$data = array('features' => $this->feature_model->get_list());
				$this->load->view('header');
				$this->load->view('feature/list', $data);
				$this->load->view('footer');
				return TRUE;
			}
			else {
				$this->load->view('header');
				$this->load->view('message', array('message' => '修改失败！'));
				$this->load->view('footer');
				return FALSE;
			}
		}
	}
	
	public function view_list() {
		if ($this->user_model->is_auth('ADMIN') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有管理权限！'));
			$this->load->view('footer');
			return;
		}
		
		$data = array('features' => $this->feature_model->get_list());
		$this->load->view('header');
		$this->load->view('feature/list', $data);
		$this->load->view('footer');
	}
}
