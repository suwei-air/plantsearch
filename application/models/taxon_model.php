<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxon_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function add() {
		
		$data = $this->input->post(NULL, TRUE);
		unset($data['submit']);
		
		return $this->db->insert('taxon', $data);
	}
	
	public function update($id) {
		
		$where = array(
			'taxon_id' => $id
		);
		
		$set = $this->input->post(NULL, TRUE);
		unset($set['submit']);
		
		return $this->db->update('taxon', $set, $where);
	}
	
	public function delete($taxon_id)
	{
		$this->db->delete('taxon', array('taxon_id' => $taxon_id));
	}
	
	public function get_list() {
		return $this->db->get('taxon')->result_array();
	}
	
	public function get_taxon($id) {
		return $this->db->get_where('taxon', array('taxon_id' => $id))->row_array();
	}
	
	public function get_parent_level_taxons_by_level($level)
	{
		switch ($level)
		{
			case 'KINGDOM':
				return array(array('taxon_id' => 0, 'name' => '无'));
				break;
			case 'PHYLUM':
				$parent_level = 'KINGDOM';
				break;
			case 'CLASS':
				$parent_level = 'PHYLUM';
				break;
			case 'ORDER':
				$parent_level = 'CLASS';
				break;
			case 'FAMILY':
				$parent_level = 'ORDER';
				break;
			case 'GENUS':
				$parent_level = 'FAMILY';
				break;
			case 'SPECIES':
				$parent_level = 'GENUS';
				break;
		}
		return $this->db->get_where('taxon', array('level' => $parent_level))->result_array();
	}
	
	private function level2number($level)
	{
		switch ($level)
		{
			case 'KINGDOM':
				return 0;
			case 'PHYLUM':
				return 1;
			case 'CLASS':
				return 2;
			case 'ORDER':
				return 3;
			case 'FAMILY':
				return 4;
			case 'GENUS':
				return 5;
			case 'SPECIES':
				return 6;
		}
	}
	private function number2level($number)
	{
		switch ($number)
		{
			case 0:
				return 'KINGDOM';
			case 1:
				return 'PHYLUM';
			case 2:
				return 'CLASS';
			case 3:
				return 'ORDER';
			case 4:
				return 'FAMILY';
			case 5:
				return 'GENUS';
			case 6:
				return 'SPECIES';
		}
	}
	
	public function compare_level($level_a, $level_b)
	{
		return $this->level2number($level_a) - $this->level2number($level_b);
	}
	
	public function get_children_taxons($tid)
	{
		return $this->db->get_where('taxon', array('parent_id' => $tid))->result_array();
	}
	
	public function get_the_children_level_taxons_by_tid_and_level($tid, $level)
	{
		$taxon = $this->get_taxon($tid);
		if ($this->compare_level($taxon['level'], $level) >= 0) {
			return array();
		}
		$children = $this->get_children_taxons($tid);
		$result = array();
		foreach ($children as $child)
		{
			if ($child['level'] == $level)
			{
				array_push($result, $child);
			}
			else
			{
				$result = array_merge($result, $this->get_the_children_level_taxons_by_tid_and_level($child['taxon_id'], $level));
			}
		}
		return $result;
	}
}
