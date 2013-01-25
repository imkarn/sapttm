<?php ob_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Z_rfc_mm extends CI_Controller {
	
	public function Z_RFC_MM_202(){
		if($this->session->userdata('EP_AUTH')=="Y"){
			$this->load->library('privilege'); 
			$per = $this->privilege->checkPermission(__FUNCTION__);
			$this->privilege->outputHead(__FUNCTION__);
			if($per!=true){ // true คือมีสิทธิ์ใช้งาน
				$this->load->library('mysap');
				$tmp = $this->config->item('Z_RFC_MM_202');
                $tmp[0][2] = $this->session->userdata('EP_MACID');
				
				$this->mysap->logindata = $this->config->item('logindata'.$this->session->userdata('EP_CLIENT'));
				//Call rfc function Z_RFC_SM_001 โดยมี parameter เป็น array $tmp
				$result=$this->mysap->callFunction("Z_RFC_MM_202",$tmp);  
				
				$tbhead = Array('BANFN' => "PR NO.",'BNFPO' => "PR Itm.",'BSART' => 'Type',"BSTYP" => "Status",'MATNR' => "Meterial",'TXZ01' => 'Shot Text','MENGE' => 'QTY', 'MEINS' => 'Unit','EKGRP' => 'PC Grp.','AFNAM' => 'Requester', 'PREIS' => 'Per/Un' ,'GSWRT' => 'Total', 'BEDNR' => 'Tracking', 'WAERS' => 'Curr');
				if ($this->agent->is_mobile()){
					$arr = array('tbname'=>'TAB_DISPLAY_202','theme'=>'use','action'=>array(),'uni'=>'uni','key'=>'BANFN',"fun"=>"Z_RFC_MM_202","mobile"=>true);
				}else{
					$arr = array('tbname'=>'TAB_DISPLAY_202','theme'=>'use','action'=>array(),'uni'=>'uni','key'=>'BANFN',"fun"=>"Z_RFC_MM_202");
				}
				$data['tb'] = genGrid($result,$arr,$tbhead);
				$data['rs'] = $result;
			}
			$data['per'] = $per;
			if ($this->agent->is_mobile()){
				$this->load->view(__FUNCTION__ .'/mmain',$data);
			}else{
				$this->load->view(__FUNCTION__ .'/main',$data);
			}
		}else{
			//redirect to login page
            redirect('/welcome/');
		}
	}
	
	public function Z_RFC_MM_202_Detail($pr){
		
	}
	
	public function Z_RFC_MM_201(){
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if($this->session->userdata('EP_AUTH')=="Y"){
				$this->load->library('form_validation'); 
				$this->form_validation->set_rules('id',' ','required|trim|xss_clean');
					if ($this->form_validation->run() == true) {
					$this->load->library('privilege'); 
					$per = $this->privilege->checkPermission(__FUNCTION__);
					if($per==false){
						echo "NP"; // NP = permission denied
					}else{
						$this->load->library('mysap');
						$tmp = $this->config->item('Z_RFC_MM_201');
						$tmp[0][2] = $this->session->userdata('EP_MACID');
						$tmp[1][2] = $this->input->post('id');//"9999999999";
						
						$this->mysap->logindata = $this->config->item('logindata'.$this->session->userdata('EP_CLIENT'));
						//Call rfc function Z_RFC_SM_001 โดยมี parameter เป็น array $tmp
						$result=$this->mysap->callFunction("Z_RFC_MM_201",$tmp);  
						
						if($result['EP_ERRFLAG']=="X"){
							echo $result['EP_MESSAGE'];
							//echo "SU"; //SU = success
						}else{
							echo "SU"; //SU = success
						}
					}
				}
			}else{
				echo "NA"; // NA = Not Authen
			}
		}else{
			show_404();
		}
	}
}
