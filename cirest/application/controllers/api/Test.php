<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Test extends REST_Controller {
	
	function __construct(){
		parent::__construct();
		
		$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        //$this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        //$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	
	public function users_get(){
        $this->load->model('Mlogin');
		
		$nip = $this->get('nip');
		$data = $this->Mlogin->cekDosen($nip);
		
		//$data = json_encode($data);
		$this->response($data, REST_Controller::HTTP_OK); 
    }
}