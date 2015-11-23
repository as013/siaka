<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmhs extends CI_Model {
	
	public function getByNIM($nim){
		$this->db->select('*');
		$this->db->from('identitas_mahasiswa');
		$this->db-> where('STB', $nim);
		
		$dbMhs = $this->db->get();
		return $dbMhs->row();
	}
	
}