<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plant_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->load->model('upyun_model');
	}
	
//	public function add_old() {
//		$data = array(
//			'name' => $this->input->post('name', TRUE),
//			'pinyin' => $this->input->post('pinyin', TRUE),
//			'sci_name' => $this->input->post('sci_name', TRUE),
//			'comm_name' => $this->input->post('comm_name', TRUE),
//			'sci_intro' => $this->input->post('sci_intro', TRUE),
//			'sci_intro_source' => $this->input->post('sci_intro_source', TRUE),
//			'pop_intro' => $this->input->post('pop_intro', TRUE),
//			'uploader_id' => $this->session->userdata('user_id'),
//			'upload_ip' => $this->input->ip_address(),
//			'upload_time' => date('Y-m-d H:i:s')
//		);
//		if ($this->db->insert('plant', $data) === FALSE) {
//			return FALSE;
//		}
//		
//		$data = array();
//		$data['plant_id'] = $this->db->insert_id();
//		
//		$this->load->model('feature_model');
//		$features = $this->feature_model->get_list();
//		foreach ($features as $feature) {
//			switch ($feature['type']) {
//				case 'SET':
//					if ($this->input->post($feature['field_name']) !== FALSE &&
//							count($this->input->post($feature['field_name'])) > 0)
//					{
//						$data[$feature['field_name']] = implode(',', $this->input->post($feature['field_name']));
//					}
//					else
//					{
//						$data[$feature['field_name']] = '';
//					}
//					break;
//				case 'FLOAT':
//					$data[$feature['field_name']] = $this->input->post($feature['field_name'], TRUE);
//					break;
//				case 'DATE':
//					$data[$feature['field_name']] =
//						$this->input->post($feature['field_name'] . '_from') . '~' . $this->input->post($feature['field_name'] . '_to');
//					break;
//			}
//		}
//		return $this->db->insert('plant_feature', $data);
//	}
	
	public function add() {
		$this->load->library('session');
		$data = array(
			'name' => $this->input->post('name', TRUE),
			'pinyin' => $this->input->post('pinyin', TRUE),
			'sci_name' => $this->input->post('sci_name', TRUE),
			'comm_name' => $this->input->post('comm_name', TRUE),
			'taxon_id' => $this->input->post('taxon_id', TRUE),
			'sci_intro' => $this->input->post('sci_intro', TRUE),
			'sci_intro_source' => $this->input->post('sci_intro_source', TRUE),
			'pop_intro' => $this->input->post('pop_intro', TRUE),
			'uploader_id' => $this->session->userdata('user_id'),
			'upload_ip' => $this->input->ip_address(),
			'upload_time' => date('Y-m-d H:i:s')
		);
		if ($this->db->insert('plant', $data) === FALSE) {
			return FALSE;
		}
		
		$data = array();
		$data['plant_id'] = $this->db->insert_id();
		$this->db->insert('plant_feature', $data);
		if ($this->db->affected_rows() === 0)
		{
			return FALSE;
		}
		return $data['plant_id'];
	}
	
	public function add_photo($plant_id) {
		if ((($_FILES['photo']['type'] != 'image/gif')
			&& ($_FILES['photo']['type'] != 'image/jpeg')
			&& ($_FILES['photo']['type'] != 'image/pjpeg')
			&& ($_FILES['photo']['type'] != 'image/png')
			&& ($_FILES['photo']['type'] != 'image/x-png'))
			|| ($_FILES['photo']['size'] > 3000000)
			|| ($_FILES['photo']['error'] > 0))
			return FALSE;
		$url_original = $this->upyun_model->upload_original(
			$_FILES['photo']['tmp_name'],
			$_FILES['photo']['type']
		);
		$url = $this->upyun_model->upload(
			$_FILES['photo']['tmp_name'],
			$_FILES['photo']['type']
		);
		if ($url === FALSE || $url_original === FALSE)
			return FALSE;
		$data = array(
			'url' => $url,
			'url_original' => $url_original,
			'plant_id' => $plant_id,
			'uploader_id' => $this->session->userdata('user_id'),
			'upload_ip' => $this->input->ip_address(),
			'upload_time' => date('Y-m-d H:i:s'),
			'description' => $this->input->post('description', TRUE)
		);
		$this->db->insert('photo', $data);
		return TRUE;
	}
	
//	public function update_old($id) {
//		$where = array('plant_id' => $id);
//		
//		$data = array(
//			'name' => $this->input->post('name', TRUE),
//			'pinyin' => $this->input->post('pinyin', TRUE),
//			'sci_name' => $this->input->post('sci_name', TRUE),
//			'comm_name' => $this->input->post('comm_name', TRUE),
//			'sci_intro' => $this->input->post('sci_intro', TRUE),
//			'sci_intro_source' => $this->input->post('sci_intro_source', TRUE),
//			'pop_intro' => $this->input->post('pop_intro', TRUE)
//		);
//		if ($this->db->update('plant', $data, $where) === FALSE) {
//			return FALSE;
//		}
//		
//		$data = array();
//		$data['plant_id'] = $id;
//		
//		$this->load->model('feature_model');
//		$features = $this->feature_model->get_list();
//		foreach ($features as $feature) {
//			switch ($feature['type']) {
//				case 'SET':
//					if ($this->input->post($feature['field_name']) !== FALSE &&
//							count($this->input->post($feature['field_name'])) > 0)
//					{
//						$data[$feature['field_name']] = implode(',', $this->input->post($feature['field_name']));
//					}
//					else
//					{
//						$data[$feature['field_name']] = '';
//					}
//					break;
//				case 'FLOAT':
//					$data[$feature['field_name']] = $this->input->post($feature['field_name'], TRUE);
//					break;
//				case 'DATE':
//					$data[$feature['field_name']] =
//						$this->input->post($feature['field_name'] . '_from') . '~' . $this->input->post($feature['field_name'] . '_to');
//					break;
//			}
//		}
//		return $this->db->update('plant_feature', $data, $where);
//	}

	public function update($id) {
		$where = array('plant_id' => $id);
		
		$data = array(
			'name' => $this->input->post('name', TRUE),
			'pinyin' => $this->input->post('pinyin', TRUE),
			'sci_name' => $this->input->post('sci_name', TRUE),
			'comm_name' => $this->input->post('comm_name', TRUE),
			'taxon_id' => $this->input->post('taxon_id', TRUE),
			'sci_intro' => $this->input->post('sci_intro', TRUE),
			'sci_intro_source' => $this->input->post('sci_intro_source', TRUE),
			'pop_intro' => $this->input->post('pop_intro', TRUE)
		);
		
		$this->load->library('session');
		$plant = $this->get_plant($id);
		if ($plant['uploader_id'] == 0)
		{
			$data['uploader_id'] = $this->session->userdata('user_id');
			$data['upload_ip'] = $this->input->ip_address();
			$data['upload_time'] = date('Y-m-d H:i:s');
		}
		
		$this->db->update('plant', $data, $where);
		//return $this->db->affected_rows() > 0;
		return TRUE;
	}
	
	public function update_feature($id) {
		$where = array('plant_id' => $id);
		
		$data = array();
		$this->load->model('feature_model');
		$features = $this->feature_model->get_list();
		foreach ($features as $feature) {
			switch ($feature['type']) {
				case 'SET':
					if ($this->input->post($feature['field_name']) !== FALSE &&
							count($this->input->post($feature['field_name'])) > 0)
					{
						$data[$feature['field_name']] = implode(',', $this->input->post($feature['field_name']));
					}
					else
					{
						$data[$feature['field_name']] = '';
					}
					break;
				case 'FLOAT':
					$data[$feature['field_name']] = $this->input->post($feature['field_name'], TRUE);
					break;
				case 'DATE':
					$data[$feature['field_name']] =
						$this->input->post($feature['field_name'] . '_from') . '~' . $this->input->post($feature['field_name'] . '_to');
					break;
			}
		}
		$this->db->update('plant_feature', $data, $where);
		//return $this->db->affected_rows() > 0;
		return TRUE;
	}

	public function update_photo($id) {
		$where = array('plant_id' => $id);
		
		$my_post = $this->input->post(NULL, TRUE);

		foreach ($my_post as $key => $value) {
			if ("pic_desc_" == substr($key, 0, 9)) {
				$pic_id = substr($key, 9);
				$this->db->update('photo',
					array('description' => $value),
					array('pic_id' => $pic_id));
			}
			if ("pic_photographer_" == substr($key, 0, 17)) {
				$pic_id = substr($key, 17);
				$this->db->update('photo',
					array('photographer' => $value),
					array('pic_id' => $pic_id));
			}
		}
		//return $this->db->affected_rows() > 0;
		return TRUE;
	}
	
	public function delete($plant_id)
	{
		$this->db->delete('plant', array('plant_id' => $plant_id));
		$this->db->delete('plant_feature', array('plant_id' => $plant_id));
	}
	
	public function get_list() {
		return $this->db->get('plant')->result_array();
	}
	
	public function get_plant($id) {
		$this->db->select('*');
		$this->db->from('plant');
		$this->db->where('plant.plant_id', $id);
		$this->db->join('plant_feature', 'plant_feature.plant_id = plant.plant_id', 'left outer');
		return $this->db->get()->row_array();//_where('plant', array('plant_id' => $id))->row_array();
	}
	
	public function get_photo_by_plant($plant_id) {
		return $this->db->from('photo')->where('plant_id', $plant_id)->order_by('description')->get()->result_array();
	}

	public function get_photographers() {
		return $this->db->select('photographer')->distinct()->from('photo')->get()->result_array();
	}
	
	public function verify($plant_id)
	{
		$query = $this->db->select('status')
			->from('plant')
			->where('plant_id', $plant_id)
			->get();
		if ($query->num_rows() == 0)
			return FALSE;
		$is_verified = $query->row_array();
		if ($is_verified['status'] == 'VERIFYING')
		{
			return $this->db->update('plant', array('status' => 'VERIFIED'), array('plant_id' => $plant_id));
		}
		if ($is_verified['status'] == 'VERIFIED')
		{
			return $this->db->update('plant', array('status' => 'VERIFYING'), array('plant_id' => $plant_id));
		}
	}
	
	public function submit($plant_id)
	{
		$query = $this->db->select('status')
			->from('plant')
			->where('plant_id', $plant_id)
			->get();
		if ($query->num_rows() == 0)
			return FALSE;
		$status = $query->row_array();
		if ($status['status'] == 'EDITING')
		{
			$this->db->update('plant', array('status' => 'VERIFYING'), array('plant_id' => $plant_id));
			return TRUE;
		}
		return TRUE;
	}

	public function retreat($plant_id)
	{
		$query = $this->db->select('status')
			->from('plant')
			->where('plant_id', $plant_id)
			->get();
		if ($query->num_rows() == 0)
			return FALSE;
		$status = $query->row_array();
		if ($status['status'] == 'VERIFYING')
		{
			return $this->db->update('plant', array('status' => 'EDITING'), array('plant_id' => $plant_id));
			return TRUE;
		}
		return TRUE;
	}
	
	public function set_cover($plant_id, $photo_id)
	{
		$photo = $this->db->get_where('photo', array('pic_id' => $photo_id))->row_array();
		$url = $photo['url'];
		$this->db->update('plant',
				array('cover_pic' => $url),
				array('plant_id' => $plant_id));
		return TRUE;
	}
	
	public function delete_photo($photo_id)
	{
		$photo = $this->db->get_where('photo', array('pic_id' => $photo_id))->row_array();
		$url = $photo['url'];
		if ($this->upyun_model->delete($url) === NULL) {
			$this->db->delete('photo', array('pic_id' => $photo_id));
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
