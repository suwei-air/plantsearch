<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function get_parent_level_taxons_by_level($level)
	{
//		if ($this->user_model->is_auth('VERIFY') === FALSE) {
//			$this->load->view('message', array('message' => '未登录或没有审核权限！'));
//			return;
//		}

		$this->load->model('taxon_model');
		$data = $this->taxon_model->get_parent_level_taxons_by_level($level);
		$this->load->view('json', array('data' => $data));
	}

	public function get_the_children_level_taxons_by_tid_and_level($tid, $level)
	{
		$this->load->model('taxon_model');
		$taxon = $this->taxon_model->get_taxon($tid);
		if ($this->taxon_model->compare_level($taxon['level'], $level) >= 0) {
			$this->load->view('json', array('data' => array()));
			return;
		}
		
		$data = $this->taxon_model->get_the_children_level_taxons_by_tid_and_level($tid, $level);
		$this->load->view('json', array('data' => $data));
	}
}