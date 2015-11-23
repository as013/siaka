<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {
	
	function __construct(){
		parent::__construct();
		
		$this->methods['loguser_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['loguser_post']['limit'] = 100; // 100 requests per hour per user/key
        //$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	
	public function loguser_get(){
        $this->load->model('MUser');
		$data = $this->MUser->getData();
		
		//$data = json_encode($data);
		$this->response($data, REST_Controller::HTTP_OK); 
    }
	
	public function loguser_post(){
		$dtLUser = array();
        $this->load->model('Mlogin');
		
		$user = $this->post('user');
		$pass = $this->post('pass');
		
		$cekUser = $this->Mlogin->cekDosen($user);
		$cat_user = 'dosen';
		
		if($cekUser == FALSE){
			$cekUser = $this->Mlogin->cekMhs($user);
			$cat_user = 'mahasiswa';
		}
		
		if($cekUser == TRUE){
			if($cat_user == 'dosen'){
				$this->load->model('Mdosen');
				
				$res = $this->Mdosen->getByNIP($user);
				if($res){
					$dtLUser['kat_user'] = $cat_user;
					$dtLUser['NIP'] = $res->NIP;
					$dtLUser['NMDOS'] = $res->NMDOS;
					$dtLUser['ALM'] = $res->ALM;
					$dtLUser['KEL'] = $res->KEL;
					$dtLUser['TLP'] = $res->TLP;
					$dtLUser['PStudiID'] = $res->PStudiID;
					$dtLUser['GLR'] = $res->GLR;
					$dtLUser['GLR1'] = $res->GLR1;
					$dtLUser['TPLHR'] = $res->TPLHR;
					$dtLUser['TGLHR'] = $res->TGLHR;
				}
			}elseif($cat_user == 'mahasiswa'){
				$this->load->model('Mmhs');
				
				$res = $this->Mmhs->getByNIM($user);
				if($res){
					$dtLUser['kat_user'] = $cat_user;
					$dtLUser['STB'] = $res->STB;
					$dtLUser['NMMHS'] = $res->NMMHS;
					$dtLUser['KEL'] = $res->A_jenis_kelamin;
					$dtLUser['ALM'] = $res->A_alamat;
					$dtLUser['TLP'] = $res->A_no_tlp;
					$dtLUser['IDPRODI'] = $res->PStudiID;
				}
			}
			
			if($dtLUser){
				$message = $dtLUser;
			}else{
				$message = [
					'status' => 'error',
					'msg' => 'Data Tidak Ditemukan.'
				];
			}
		}else{
			$message = [
				'status' => 'error',
				'msg' => 'Data Tidak Ditemukan.'
			];
		}
		
		$this->set_response($message, REST_Controller::HTTP_CREATED);
		//$data = $this->MUser->getData();
		
		//$data = json_encode($data);
		
		//$this->response($cekUser, REST_Controller::HTTP_OK); 
    }
}