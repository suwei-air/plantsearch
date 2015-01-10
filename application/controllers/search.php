<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('search_model');
	}

	public function pro($order = 'scientific_name', $order_id = 0) {
		switch ($order) {
			case 'scientific_name':
				$data = array();
				$total_number = 0;
				foreach (range('A', 'Z') as $initial) {
					$data[$initial] = $this->search_model->get_plants_by_sci_name_initial($initial);
					$total_number += count($data[$initial]);
				}
				$this->load->view('header');
				$this->load->view('search/pro_alphabet', array('plants' => $data, 'total_number' => $total_number));
				$this->load->view('footer');
				break;
			case 'pinyin':
				$data = array();
				$total_number = 0;
				foreach (range('A', 'Z') as $initial) {
					$data[$initial] = $this->search_model->get_plants_by_pinyin_initial($initial);
					$total_number += count($data[$initial]);
				}
				
				$this->load->view('header');
				$this->load->view('search/pro_alphabet', array('plants' => $data, 'total_number' => $total_number));
				$this->load->view('footer');
				break;
			case 'taxon':
				$total_number = $this->search_model->get_total_number();
				
				$this->load->model('taxon_model');
				if ($order_id === 0) {
					$orders = $this->taxon_model->get_parent_level_taxons_by_level('FAMILY');
				}
				else {
					$orders = array($this->taxon_model->get_taxon($order_id));
				}
				$data = array();
				foreach ($orders as $order) {
					$genus = $this->taxon_model->get_the_children_level_taxons_by_tid_and_level($order['taxon_id'], 'GENUS');
					$data[$order['name']] = array();
					foreach ($genus as $gen) {
						$data[$order['name']] = array_merge($data[$order['name']], $this->search_model->get_plants_by_taxon($gen['taxon_id']));
					}
				}
				
				$this->load->view('header');
				$this->load->view('search/pro_taxon', array('plants' => $data, 'total_number' => $total_number));
				$this->load->view('footer');
				break;
		}
	}
	
	public function pop() {
		$selected = $this->input->post();
		$plants = $this->search_model->pop_search();
		$this->load->view('header');
		$this->load->view('search/pop', array('selected' => $selected, 'plants' => $plants));
		$this->load->view('footer');
	}
}
