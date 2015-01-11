<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plant extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('plant_model');
		$this->load->model('feature_model');
		$this->load->model('taxon_model');
		$this->load->model('user_model');
	}
	
	public function view_list() {
		$data = array(
			'plants' => $this->plant_model->get_list()
		);
		$this->load->view('header');
		$this->load->view('plant/list', $data);
		$this->load->view('footer');
	}
	
	public function view($id) {
		$data = array(
			'plant' => $this->plant_model->get_plant($id),
			'photos' => $this->plant_model->get_photo_by_plant($id)
		);
		$this->load->view('header');
		$this->load->view('plant/view', $data);
		$this->load->view('footer');
	}

//	public function add_old() {
//		if ($this->user_model->is_auth('UPLOAD') === FALSE) {
//			$this->load->view('header');
//			$this->load->view('message', array('message' => '未登录或没有上传权限！'));
//			$this->load->view('footer');
//			return;
//		}
//		
//		$this->load->helper('form');
//		$this->load->library('form_validation');
//		
//		$this->form_validation->set_rules('name', '中文名', 'required');
//		
//		$data = array(
//			'action' => 'add',
//			'features' => $this->feature_model->get_list()
//		);
//		
//		if ($this->form_validation->run() === FALSE) {
//			$this->load->view('header');
//			$this->load->view('plant/update', $data);
//			$this->load->view('footer');
//		}
//		else {
//			if ($this->plant_model->add()) {
//				$data = array('plants' => $this->plant_model->get_list());
//				$this->load->view('header');
//				$this->load->view('plant/list', $data);
//				$this->load->view('footer');
//				return TRUE;
//			}
//			else {
//				$this->load->view('header');
//				$this->load->view('message', array('message' => '添加失败！'));
//				$this->load->view('footer');
//				return FALSE;
//			}
//		}
//	}
	
	public function add($operation = 'next')
	{
		if ($this->user_model->is_auth('UPLOAD') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有上传权限！'));
			$this->load->view('footer');
			return;
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', '中文名', 'required');
		
		$data = array(
			'taxons' => $this->taxon_model->get_parent_level_taxons_by_level('SPECIES'),
			'action' => 'add/' . $operation
		);
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('header');
			$this->load->view('plant/update_std', $data);
			$this->load->view('footer');
		}
		else {
			$plant_id = $this->plant_model->add();
			if ($plant_id === FALSE) {
				$this->load->view('header');
				$this->load->view('message', array('message' => '添加失败！'));
				$this->load->view('footer');
				return FALSE;
			}
			else {
				switch ($operation)
				{
					case 'save':
						redirect('/plant/view_list', 'refresh');
						break;
					case 'submit':
						$this->submit($plant_id);
						break;
					case 'next':
					default:
						redirect('/plant/update_feature/' . $plant_id, 'refresh');
						break;
				}
				return TRUE;
			}
		}
	}
	
//	public function modify_old($id = FALSE) {
//		if ($this->user_model->is_auth('UPLOAD') === FALSE) {
//			$this->load->view('header');
//			$this->load->view('message', array('message' => '未登录或没有上传权限！'));
//			$this->load->view('footer');
//			return;
//		}
//		
//		if ($id === FALSE) {
//			$this->load->view('header');
//			$this->load->view('message', array('message' => '参数错误！'));
//			$this->load->view('footer');
//			return FALSE;
//		}
//		
//		$this->load->helper('form');
//		$this->load->library('form_validation');
//		
//		$this->form_validation->set_rules('name', '中文名', 'required');
//		
//		if ($this->form_validation->run() === FALSE) {
//			$data = array(
//				'action' => 'modify/' . $id,
//				'features' => $this->feature_model->get_list(),
//				'plant' => $this->plant_model->get_plant($id)
//			);
//			$this->load->view('header');
//			$this->load->view('plant/update', $data);
//			$this->load->view('footer');
//		}
//		else {
//			$this->plant_model->update($id);
//			$data = array(
//				'plants' => $this->plant_model->get_list()
//			);
//			$this->load->view('header');
//			$this->load->view('plant/list', $data);
//			$this->load->view('footer');
//		}
//	}
	
	public function modify($id, $operation = 'next')
	{
		if ($this->user_model->is_auth('VERIFY') === FALSE)
		{
			$plant = $this->plant_model->get_plant($id);
			if ( ! ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($plant['uploader_id'])))
			{
				$this->load->view('header');
				$this->load->view('message', array('message' => '未登录或没有上传权限！或者该植物不是你添加的。'));
				$this->load->view('footer');
				return;
			}
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', '中文名', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'taxons' => $this->taxon_model->get_parent_level_taxons_by_level('SPECIES'),
				'action' => 'modify/' . $id . '/' . $operation,
				'plant' => $this->plant_model->get_plant($id)
			);
			$this->load->view('header');
			$this->load->view('plant/update_std', $data);
			$this->load->view('footer');
		}
		else {
			if ($this->plant_model->update($id) === FALSE) {
				$this->load->view('header');
				$this->load->view('message', array('message' => '修改失败！'));
				$this->load->view('footer');
				return FALSE;
			}
			else {
				switch ($operation)
				{
					case 'save':
						redirect('/plant/view_list', 'refresh');
						break;
					case 'submit':
						$this->submit($id);
						break;
					case 'next':
					default:
						redirect('/plant/update_feature/' . $id, 'refresh');
						break;
				}
				return TRUE;
			}
		}
	}
	
	public function update_feature($id, $operation = 'next')
	{
		if ($this->user_model->is_auth('VERIFY') === FALSE)
		{
			$plant = $this->plant_model->get_plant($id);
			if ( ! ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($plant['uploader_id'])))
			{
				$this->load->view('header');
				$this->load->view('message', array('message' => '未登录或没有上传权限！或者该植物不是你添加的。'));
				$this->load->view('footer');
				return FALSE;
			}
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('entirety[]', 'entirety', '');
		
		if ($this->form_validation->run() === FALSE) {
			$data = array(
				'action' => 'update_feature/' . $id . '/' . $operation,
				'features' => $this->feature_model->get_list(),
				'plant' => $this->plant_model->get_plant($id)
			);
			$this->load->view('header');
			$this->load->view('plant/update_feature', $data);
			$this->load->view('footer');
		}
		else {
			if ($this->plant_model->update_feature($id) === FALSE) {
				$this->load->view('header');
				$this->load->view('message', array('message' => '修改失败！'));
				$this->load->view('footer');
				return FALSE;
			}
			else {
				switch ($operation)
				{
					case 'save':
						redirect('/plant/view_list', 'refresh');
						break;
					case 'submit':
						$this->submit($id);
						break;
					case 'next':
					default:
						redirect('/plant/update_photo/' . $id, 'refresh');
						break;
				}
				return TRUE;
			}
		}
	}
		
	public function update_photo($plant_id, $operation = FALSE)
	{
		if ($this->user_model->is_auth('VERIFY') === FALSE)
		{
			$plant = $this->plant_model->get_plant($plant_id);
			if ( ! ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($plant['uploader_id'])))
			{
				$this->load->view('header');
				$this->load->view('message', array('message' => '未登录或没有上传权限！或者该植物不是你添加的。'));
				$this->load->view('footer');
				return FALSE;
			}
		}
		if ($operation != FALSE && $this->plant_model->update_photo($plant_id) === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '修改失败！'));
			$this->load->view('footer');
			return FALSE;
		}
		else {
			switch ($operation)
			{
				case FALSE:
					$this->load->helper('form');
					$this->load->library('form_validation');
					
					$data = array(
						'plant_id' => $plant_id,
						'photos' => $this->plant_model->get_photo_by_plant($plant_id),
						'plant' => $this->plant_model->get_plant($plant_id)
					);
					$this->load->view('header');
					$this->load->view('plant/update_photo', $data);
					$this->load->view('footer');
					break;
				case 'save':
					redirect('/plant/view_list', 'refresh');
					break;
				case 'submit':
					$this->submit($plant_id);
					break;
			}
		}
	}
	
	public function add_photo($plant_id) {
		if ($this->user_model->is_auth('VERIFY') === FALSE)
		{
			$plant = $this->plant_model->get_plant($plant_id);
			if ( ! ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($plant['uploader_id'])))
			{
				$this->load->view('header');
				$this->load->view('message', array('message' => '未登录或没有上传权限！或者该植物不是你添加的。'));
				$this->load->view('footer');
				return;
			}
		}
		
		$this->load->helper('form');
		
		$data = array('plant_id' => $plant_id);
		
		if (! isset($_FILES['photo'])) {
			redirect('plant/update_photo/' . $plant_id, 'refresh');
		}
		else {
			if ($this->plant_model->add_photo($plant_id)) {
				redirect('/plant/update_photo/' . $plant_id, 'refresh');
			}
			else {
				$this->load->view('header');
				$this->load->view('message', array('message' => '上传失败！'));
				$this->load->view('footer');
			}
		}
	}
	
	public function delete_photo($plant_id, $photo_id){
		if ($this->user_model->is_auth('VERIFY') === FALSE)
		{
			$plant = $this->plant_model->get_plant($plant_id);
			if ( ! ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($plant['uploader_id'])))
			{
				$this->load->view('header');
				$this->load->view('message', array('message' => '未登录或没有上传权限！或者该植物不是你添加的。'));
				$this->load->view('footer');
				return;
			}
		}
		$this->plant_model->delete_photo($photo_id);
		redirect('/plant/update_photo/' . $plant_id, 'refresh');
	}
	
	public function set_cover($plant_id, $photo_id){
		if ($this->user_model->is_auth('VERIFY') === FALSE)
		{
			$plant = $this->plant_model->get_plant($plant_id);
			if ( ! ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($plant['uploader_id'])))
			{
				$this->load->view('header');
				$this->load->view('message', array('message' => '未登录或没有上传权限！或者该植物不是你添加的。'));
				$this->load->view('footer');
				return;
			}
		}
		$this->plant_model->set_cover($plant_id, $photo_id);
		redirect('/plant/update_photo/' . $plant_id, 'refresh');
	}
	
	public function delete($plant_id){
		if ($this->user_model->is_auth('VERIFY') === FALSE)
		{
			$plant = $this->plant_model->get_plant($plant_id);
			if ( ! ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($plant['uploader_id'])))
			{
				$this->load->view('header');
				$this->load->view('message', array('message' => '未登录或没有上传权限！或者该植物不是你添加的。'));
				$this->load->view('footer');
				return;
			}
		}
		$this->plant_model->delete($plant_id);
		redirect('/plant/view_list', 'refresh');
	}
	
	public function verify($id)
	{
		if ($this->user_model->is_auth('VERIFY') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有审核权限！'));
			$this->load->view('footer');
			return;
		}

		$this->plant_model->verify($id);
		redirect('/plant/view_list', 'refresh');
	}

	public function submit($plant_id)
	{
		$plant = $this->plant_model->get_plant($plant_id);
		if ( ! ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($plant['uploader_id'])))
		{
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有上传权限！或者该植物不是你添加的。'));
			$this->load->view('footer');
			return;
		}

		$this->plant_model->submit($plant_id);
		redirect('/plant/view_list', 'refresh');
	}

	public function retreat($plant_id)
	{
		if ($this->user_model->is_auth('VERIFY') === FALSE) {
			$this->load->view('header');
			$this->load->view('message', array('message' => '未登录或没有审核权限！'));
			$this->load->view('footer');
			return;
		}

		$this->plant_model->retreat($plant_id);
		redirect('/plant/view_list', 'refresh');
	}
}
