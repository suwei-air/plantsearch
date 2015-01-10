<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feature_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function add() {
		$data = $this->input->post(NULL, TRUE);
		unset($data['submit']);
		
		if ($this->db->insert('feature', $data) === FALSE) {
			return FALSE;
		}
		$sql = 'ALTER TABLE `plant_feature` ADD `' . $data['field_name'] . '` ';
		switch ($data['type']) {
			case 'SET':
				$arr = explode('|', $data['value']);
				for ($i = 0; $i < count($arr); ++$i) {
					$arr[$i] = '\'' . $arr[$i] . '\'';
				}
				$sql .= 'SET(' . implode(',', $arr) . ')';
				break;
			case 'FLOAT':
				$sql .= 'FLOAT';
				break;
			case 'DATE':
				$sql .= 'DATETIME';
				break;
		}
		$sql .= ' NULL;';
		return $this->db->simple_query($sql);
	}
	
	public function update($id) {
		$where = array('feature_id' => $id);
		
		$feature = $this->get_feature($id);
		$old_field_name = $feature['field_name'];
		
		$data = $this->input->post(NULL, TRUE);
		unset($data['submit']);
		
		if ($this->db->update('feature', $data, $where) === FALSE) {
			return FALSE;
		}
		$sql = 'ALTER TABLE `plant_feature` CHANGE `' . $old_field_name . '` `' . $data['field_name'] . '` ';
		switch ($data['type']) {
			case 'SET':
				$arr = explode('|', $data['value']);
				for ($i = 0; $i < count($arr); ++$i) {
					$arr[$i] = '\'' . $arr[$i] . '\'';
				}
				$sql .= 'SET(' . implode(',', $arr) . ')';
				break;
			case 'FLOAT':
				$sql .= 'FLOAT';
				break;
			case 'DATE':
				$sql .= 'DATETIME';
				break;
		}
		$sql .= ' NULL;';
		return $this->db->simple_query($sql);
	}
	
	public function get_list() {
		return $this->db->get('feature')->result_array();
	}
	
	public function get_feature($id) {
		return $this->db->get_where('feature', array('feature_id' => $id))->row_array();
	}
}
