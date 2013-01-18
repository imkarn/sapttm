<?php ob_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Zttm_mm extends CI_Controller {
	
	public function Zttm_mm_001(){
		if($this->session->userdata('EP_AUTH')=="Y"){
			$this->load->library('privilege'); 
			$per = $this->privilege->checkPermission(get_class($this));
			$this->privilege->outputHead(__FUNCTION__);
			$data['per'] = $per;
			$this->load->view(__FUNCTION__ .'/main',$data);
		}else{
			//redirect to login page
            redirect('/welcome/');
		}
	}
}
