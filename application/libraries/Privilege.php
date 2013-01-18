<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

/*
 * Class Privilege ใช้สำหรับ render menu ตามสิทธิ์ต่างๆ
 */

/**
 * Description of Privilege
 *
 * @author Quize
 * */
class Privilege {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
    }
	
	public function outputHead($fun){
		$pivi = $this->CI->session->userdata('EP_MENUSCR');
		$this->CI->load->view('layout/header');
		$data['active'] = $fun;
		$this->CI->load->view('menu/'.$pivi.'_menu',$data);
	}
	
	public function checkPermission($fun){
		$this->CI->load->library('mysap');
        $tmp = $this->CI->config->item('Z_RFC_SM_007');
        $tmp[0][2] = $this->CI->session->userdata('EP_MACID');
        $tmp[1][2] = strtoupper($fun);
		
		$this->CI->mysap->logindata = $this->CI->config->item('logindata'.$this->CI->session->userdata('EP_CLIENT'));
        //Call rfc function Z_RFC_SM_001 โดยมี parameter เป็น array $tmp
        $result=$this->CI->mysap->callFunction("Z_RFC_SM_007",$tmp);  
		
		//print_r($result);
		if($result['EP_ERRFLAG']=="X"){
			return false;
		}else{
			return true;
		}
	}

}

?>
