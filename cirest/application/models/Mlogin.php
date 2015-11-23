<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model {
	
	public function cekDosen($nip){
		$this->db->select('NIP');
		$this->db->from('mdosen');
		$this->db-> where('NIP', $nip);
		
		$dbDosen = $this->db->get();
		if($dbDosen->num_rows() == 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	public function cekMhs($nim){
		$this->db->select('STB');
		$this->db->from('identitas_mahasiswa');
		$this->db-> where('STB', $nim);
		
		$dbMhs = $this->db->get();
		if($dbMhs->num_rows() == 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
}