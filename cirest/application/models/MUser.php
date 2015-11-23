<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUser extends CI_Model {
	
	public function getData(){
		$this->db->select('*');
		$this->db-> from('mdosen');
		$query = $this->db->get();
		return $query->result_array();
	}
}