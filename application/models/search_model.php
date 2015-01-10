<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}
	
	public function get_plants_by_family_initial($initial) {
		$query = $this->db
			->select('p.plant_id pid, p.name pname, p.sci_name psci,'
				. 'p.taxon_id tid, t.name tname, t.sci_name tsci,'
				. 'tp.taxon_id tpid, tp.name tpname, tp.sci_name tpsci,')
			//->select('left(tp.`sci_name`, 1) tpinitial', FALSE)
			->from('plant p')
			->join('taxon t', 't.taxon_id=p.taxon_id')
			->join('taxon tp', 'tp.taxon_id=t.parent_id')
			->where('left(tp.`sci_name`,1)', $initial)
			->where('p.`status`', 'VERIFIED')
			->order_by('tpsci, psci')
			->get();
		return $query->result_array();
	}

	public function get_plants_by_sci_name_initial($initial) {
		$query = $this->db
			->select('p.plant_id pid, p.name pname, p.sci_name pname_2nd,'
				. 'p.taxon_id tid, tp.taxon_id tpid, tp.name tpname')
			//->select('left(tp.`sci_name`, 1) tpinitial', FALSE)
			->from('plant p')
			->join('taxon t', 't.taxon_id=p.taxon_id')
			->join('taxon tp', 'tp.taxon_id=t.parent_id')
			->where('UPPER(LEFT(TRIM(LEADING \'{\' FROM p.`sci_name`), 1)) = \'' . $initial . '\'')
			->where('p.`status`', 'VERIFIED')
			->order_by('tpname, pname_2nd')
			->get();
		return $query->result_array();
	}

	public function get_plants_by_pinyin_initial($initial) {
		$query = $this->db
			->select('p.plant_id pid, p.name pname, p.pinyin pname_2nd,'
				. 'p.taxon_id tid, tp.taxon_id tpid, tp.name tpname')
			//->select('left(tp.`sci_name`, 1) tpinitial', FALSE)
			->from('plant p')
			->join('taxon t', 't.taxon_id=p.taxon_id')
			->join('taxon tp', 'tp.taxon_id=t.parent_id')
			->where('UPPER(LEFT(p.`pinyin`, 1)) = \'' . $initial . '\'')
			->where('p.`status`', 'VERIFIED')
			->order_by('tpname, pname_2nd')
			->get();
		return $query->result_array();
	}
		
	public function get_total_number() {
		return $this->db->select('plant_id')->from('plant')->where('plant.status', 'VERIFIED')->get()->num_rows();
	}

	public function get_plants_by_taxon($genus_id) {
		$query = $this->db
			->select('p.plant_id pid, p.name pname, p.sci_name pname_2nd,'
				. 'p.taxon_id tid, tp.taxon_id tpid, tp.name tpname')
			//->select('left(tp.`sci_name`, 1) tpinitial', FALSE)
			->from('plant p')
			->join('taxon t', 't.taxon_id=p.taxon_id')
			->join('taxon tp', 'tp.taxon_id=t.parent_id')
			->where('p.taxon_id', $genus_id)
			->where('p.`status`', 'VERIFIED')
			->order_by('tpname, pname_2nd')
			->get();
		return $query->result_array();
	}
	
	private function _or_where($feature, $feature_name)
	{
		if ($feature === FALSE)
		{
			return '';
		}
		
		$arr = array();
		foreach ($feature as $feature_item)
		{
			array_push($arr, "FIND_IN_SET('" . $feature_item . "', " . $feature_name . ")>0");
		}
		$result = implode(' OR ', $arr);
		if ($result != '')
		{
			$result = ' AND (' . $result . ')';
		}
		return $result;
	}
	
	public function pop_search()
	{
		$where = '(1=1)'; // TODO: 花期
		$where .= $this->_or_where($this->input->post('entirety'), 'entirety');
		$where .= $this->_or_where($this->input->post('area'), 'area');
		$where .= $this->_or_where($this->input->post('leaf_type'), 'leaf_type');
		$where .= $this->_or_where($this->input->post('phyllotaxy'), 'phyllotaxy');
		$where .= $this->_or_where($this->input->post('leaf_shape'), 'leaf_shape');
		$where .= $this->_or_where($this->input->post('flower_color'), 'flower_color');
		$where .= $this->_or_where($this->input->post('pattern'), 'pattern');
		$where .= $this->_or_where($this->input->post('fruit_color'), 'fruit_color');
		$where .= $this->_or_where($this->input->post('leafmargin'), 'leafmargin');
		
		$this->db->select('*');
		$this->db->from('plant');
		$this->db->where($where);
		$this->db->join('plant_feature', 'plant_feature.plant_id = plant.plant_id', 'left outer');
		$this->db->order_by('common', 'desc');
		return $this->db->get()->result_array();
	}
}