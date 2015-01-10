<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->load->library('session');
	}
	
	public function reg() {
		
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'username' => $this->input->post('username'),
			'reg_time' => date('Y-m-d H:i:s'),
			'last_time' => date('Y-m-d H:i:s'),
			'last_ip' => $this->input->ip_address()
		);
		
		return $this->db->insert('user', $data);
	}
	
	public function login() {
		
		$where = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
		);
		
		$set = array(
			'last_time' => date('Y-m-d H:i:s'),
			'last_ip' => $this->input->ip_address()
		);
		
		$this->db->update('user', $set, $where);
		return $this->db->get_where('user', $where);
	}

	public function is_auth($auth = 'LOGIN') {
		if ($this->session->userdata('authorization') === FALSE) {
			return FALSE;
		}
		return strpos($this->session->userdata('authorization'), $auth);
	}
	
	public function is_self($user_id)
	{
		return $this->session->userdata('user_id') == $user_id || $user_id == 0;
	}
}
