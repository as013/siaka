<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdosen extends CI_Model {
	
	public function getByNIP($nip){
		$this->db->select('*');
		$this->db->from('mdosen');
		$this->db-> where('NIP', $nip);
		
		$dbDosen = $this->db->get();
		
		return $dbDosen->row();
	}
	
}