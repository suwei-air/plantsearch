<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxon extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('taxon_model');
		$this->load->model('user_model');
	}

	public function add() {
		if ($this->user_model->is_auth('UPLOAD') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有上传权限！'));
			$this->load->view('footer');
			return;
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', '中文名', 'required');
		
		$data = array('action' => 'add');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('header');
			$this->load->view('taxon/update', $data);
			$this->load->view('footer');
		}
		else {
			$this->taxon_model->add();
			$data = array('taxons' => $this->taxon_model->get_list());
			$this->load->view('header');
			$this->load->view('taxon/list', $data);
			$this->load->view('footer');
		}
	}
	
	public function modify($id = FALSE) {
		if ($this->user_model->is_auth('VERIFY') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有审核权限！'));
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
		
		$this->form_validation->set_rules('name', '中文名', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$taxon = $this->taxon_model->get_taxon($id);
			$data = array(
				'action' => 'modify/' . $id,
				'taxon' => $taxon,
				'parent_level' => $this->taxon_model->get_parent_level_taxons_by_level($taxon['level'])
			);
			$this->load->view('header');
			$this->load->view('taxon/update', $data);
			$this->load->view('footer');
		}
		else {
			$this->taxon_model->update($id);
			$data = array('taxons' => $this->taxon_model->get_list());
			$this->load->view('header');
			$this->load->view('taxon/list', $data);
			$this->load->view('footer');
		}
	}
	
	public function view_list() {
		$data = array('taxons' => $this->taxon_model->get_list());
		$this->load->view('header');
		$this->load->view('taxon/list', $data);
		$this->load->view('footer');
	}
	
	public function delete($taxon_id){
		if ($this->user_model->is_auth('VERIFY') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有审核权限！'));
			$this->load->view('footer');
			return;
		}
		$this->taxon_model->delete($taxon_id);
		redirect('/taxon/view_list', 'refresh');
	}
}
