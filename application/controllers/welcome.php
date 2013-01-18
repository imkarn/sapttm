<?php ob_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
        // หน้า formLogin
	public function index()
	{
		if($this->session->userdata('EP_AUTH')=="Y"){
			redirect('/welcome/main');
		}else{
			// load view loginform ขึ้นมาแสดง
            $data = array();
            if($this->session->flashdata('error')){
                 $data['errors'] = $this->session->flashdata('error');
            }else if($this->session->flashdata('ok')){
                 $data['ok'] = $this->session->flashdata('ok');
            }
            $this->load->view('authen/loginform',$data);
		}
	}
        
        // function สำหรับ checkLogin
        public function checkLogin(){
            // check ว่าเป็นการเรียก function มาเป็น แบบ Post หรือไม่
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                // ถ้าเป็นแบบ Post
                // เรียก lib validation
                $this->load->library('form_validation'); 
                //set tag เพื่อคลุมข้อความ error
                $this->form_validation->set_error_delimiters(' ','<br />');
                // set Error Msg
                $this->form_validation->set_message('required', 'Please enter your %s');
                //set เงื่อนไข สำหรับ field user โดย เงื่อนไข required|trim|xss_clean
                $this->form_validation->set_rules('user','username','required|trim|xss_clean');
                //set เงื่อนไข สำหรับ field pass โดย เงื่อนไข required|trim|xss_clean
				$this->form_validation->set_rules('pass','password','required|trim|xss_clean');
                //$this->form_validation->set_rules('pass','รหัสผ่าน','trim|xss_clean');
                //set เงื่อนไข สำหรับ select client โดย เงื่อนไข required|trim|xss_clean
                $this->form_validation->set_rules('client',' ','required|trim|xss_clean');
                
                // เช็คว่า validation ตามเงื่อนไขผ่านหรือไม่
                if ($this->form_validation->run() == true) {
                    // เรียก lib saprfc
                    $this->load->library('mysap');
                    // load lib verify ที่ใช้ในการจัดการ verify ระหว่าง Sv. กะ Client
                    $this->load->library('verify');
                    // หาค่า ip ที่เข้ามาใช้งาน
                    $ipaddr = $_SERVER['REMOTE_ADDR'];
                    // นำ ip มาเข้ารหัสด้วย MD5
                    $mdid =strtoupper(md5($ipaddr));
                    $user = strtoupper($this->input->post('user'));
                    //เช็คว่า user ได้ทำการ Verify แล้วหรือยัง
                    if($this->input->cookie("MDID")){
                        //ถ้า Verify แล้ว
                        // เช็คว่า md5 ของ ip ปัจจุบันกับ ของเก่าที่อยู่ใน cookie ตรงกันหรือไม่
                        if($this->input->cookie("MDID")<>$mdid) ///Check Comp. Cookie <> md5(ipaddr)
                        {
                            //ถ้าไม่เท่ากัน ให้อัพเดทไฟล์ที่อยู่บน sv และ cookie ให้ตรงกัน
                            $FileSES=$this->verify->Check_CookieMdid($this->input->cookie("MDID"),$mdid); 
                            //Function Update File SES Real $mdid to File SES & $_Cookie['MDID']
                        }else{
                            // ถ้าเท่ากัน
                            // เป็นการเช็คและสร้าง cookie ทับอีกครั้งเพื่อต่ออายุ cookie
                            $FileSES=$this->verify->Find_Sess($this->input->cookie("MDID"));
                        }
                        // หาว่า มีเลข 32 หลักใน file ของ ip นี้บน sv หรือไม่ ถ้ามาจะ return ไว้ที่ $iduser
                        $iduser = $this->verify->Check_User($FileSES,$user);
                        if($iduser){
                            // กำหนดค่า tmp = ตัวแปร config Z_RFC_SM_001 ที่อยู่ใน ttm_config
                            $tmp = $this->config->item('Z_RFC_SM_001');
                            // แก้ไขค่าในส่วนของ array("IMPORT","IM_USER",'911') โดยใส่ค่าตัวแปรที่รับมาจาก input form
                            $tmp[0][2] = $this->input->post('user');
                            // แก้ไขค่าในส่วนของ  array("IMPORT","IM_PASSW",'') โดยใส่ค่าตัวแปรที่รับมาจาก input form
                            $tmp[1][2] = $this->input->post('pass');
                            // แก้ไขค่าในส่วนของ  array("IMPORT","IM_MACID",'07c56eb9692b9fc564392e9ca135ac89') โดยใส่ค่าตัวแปร $iduser
                            $tmp[2][2] = $iduser;

                            //กำหนดค่าในการตัวแปร logindata ใน lib saprfc = ตัวแปร array logindata300 หรือ logindata900 ที่เซ็ตไว้ใน ttm_config เพื่อใช้ในการ connect 
                            $this->mysap->logindata = $this->config->item('logindata'.$this->input->post('client'));
                            //Call rfc function Z_RFC_SM_001 โดยมี parameter เป็น array $tmp
                            $result=$this->mysap->callFunction("Z_RFC_SM_001",$tmp);  

                            if($result['EP_AUTH']=="Y"){
                                $newdata = array(
                                    'EP_NAME'  => iconv('TIS-620','UTF-8',trim($result['EP_NAME'])),
                                    'EP_SAPUSER'     => iconv('TIS-620','UTF-8',trim($result['EP_SAPUSER'])),
                                    'EP_SAPPWD' => iconv('TIS-620','UTF-8',trim($result['EP_SAPPWD'])),
                                    'EP_MENUSCR'  => iconv('TIS-620','UTF-8',trim($result['EP_MENUSCR'])),
                                    'EP_AUTH'  => iconv('TIS-620','UTF-8',trim($result['EP_AUTH'])),
                                    'EP_MACID'  => trim($iduser),
									'EP_USER'  => trim($user),
									'EP_CLIENT'  => trim($this->input->post('client')),
                                );
								//$this->config->set_item('sess_expiration',0); 
								$this->session->sess_expiration = 0;
                                $this->session->set_userdata($newdata);
								redirect('/welcome/main');
                            }else{
                                $data['errors'] = $result['EP_MESSAGE'];
                                $this->load->view('authen/loginform',$data);
                            }
                        }else{
                            // ถ้าไม่มี
                            $data['errors'] = "Please Get Register Code for Verify!!";
                            $this->load->view('authen/loginform',$data);
                        }
                    }else{
                        //ถ้าไม่มี Cookie
						delete_cookie("MDID");
						$FileSES=$this->verify->Check_SessMdid($mdid);
						if(isset($FileSES))
						{	
							$status = $this->verify->Check_User($FileSES,$user);
							if(isset($status)){
								// กำหนดค่า tmp = ตัวแปร config Z_RFC_SM_001 ที่อยู่ใน ttm_config
								$tmp = $this->config->item('Z_RFC_SM_001');
								// แก้ไขค่าในส่วนของ array("IMPORT","IM_USER",'911') โดยใส่ค่าตัวแปรที่รับมาจาก input form
								$tmp[0][2] = $this->input->post('user');
								// แก้ไขค่าในส่วนของ  array("IMPORT","IM_PASSW",'') โดยใส่ค่าตัวแปรที่รับมาจาก input form
								$tmp[1][2] = $this->input->post('pass');
								// แก้ไขค่าในส่วนของ  array("IMPORT","IM_MACID",'07c56eb9692b9fc564392e9ca135ac89') โดยใส่ค่าตัวแปร $iduser
								$tmp[2][2] = $status;

								//กำหนดค่าในการตัวแปร logindata ใน lib saprfc = ตัวแปร array logindata300 หรือ logindata900 ที่เซ็ตไว้ใน ttm_config เพื่อใช้ในการ connect 
								$this->mysap->logindata = $this->config->item('logindata'.$this->input->post('client'));
								//Call rfc function Z_RFC_SM_001 โดยมี parameter เป็น array $tmp
								$result=$this->mysap->callFunction("Z_RFC_SM_001",$tmp);
								if($result['EP_AUTH']=="Y"){
									$newdata = array(
										'EP_NAME' => iconv('TIS-620','UTF-8',trim($result['EP_NAME'])),
										'EP_SAPUSER' => iconv('TIS-620','UTF-8',trim($result['EP_SAPUSER'])),
										'EP_SAPPWD' => iconv('TIS-620','UTF-8',trim($result['EP_SAPPWD'])),
										'EP_MENUSCR' => iconv('TIS-620','UTF-8',trim($result['EP_MENUSCR'])),
										'EP_AUTH' => iconv('TIS-620','UTF-8',trim($result['EP_AUTH'])),
										'EP_MACID' => trim($status),
										'EP_USER'  => trim($user),
										'EP_CLIENT'  => trim($this->input->post('client')),
									);
									//$this->config->set_item('sess_expiration',(60*20)); 
									$this->session->sess_expiration = 60*20;
									$this->session->set_userdata($newdata);
									redirect('/welcome/main');
								}else{
									$data['errors'] = $result['EP_MESSAGE'];
									$this->load->view('authen/loginform',$data);
								}
							}else{
								$data['errors'] = "Please Get Register Code for Verify!!";
								$this->load->view('authen/loginform',$data);
							}
						}else{
							$data['errors'] = "Please Get Register Code for Verify!!";
                            $this->load->view('authen/loginform',$data);
						}
                    }
                }else{
                    //ถ้า validation ไม่ผ่าน
                    //ให้ load view form และส่ง error ไปที่ view เพื่อแสดงด้วย
                    $this->load->view('authen/loginform');
                }
            }else{
                //ถ้าไม่เป็นแบบ Post
                //redirect ไปหน้า form
                redirect('/welcome/'); 
            }
        }
        
        // funtion สำหรับ Verify User เพื่อขอเลข 32 หลัก และ save ลง file บน Sv.
		//http://localhost/ttm/index.php/welcome/verifyUser/s2339/7051
        function verifyUser($user = null,$code = null){
                // เรียก lib validation
                $this->load->library('form_validation'); 
                //set tag เพื่อคลุมข้อความ error
                $this->form_validation->set_error_delimiters(' ',' ');
                //set เงื่อนไข สำหรับ field user โดย เงื่อนไข required|trim|xss_clean
                $this->form_validation->set_rules('user-verify','Username','required|trim|xss_clean');
                //set เงื่อนไข สำหรับ field pass โดย เงื่อนไข required|trim|xss_clean
				$this->form_validation->set_rules('code-verify','Register Code','required|trim|xss_clean|integer|exact_length[4]');
                //set เงื่อนไข สำหรับ select client โดย เงื่อนไข required|trim|xss_clean
                $this->form_validation->set_rules('client-verify',' ','required|trim|xss_clean');
				
				// เรียก lib saprfc
                $this->load->library('mysap');
				
				// กำหนดค่า tmp = ตัวแปร config Z_RFC_SM_006 ที่อยู่ใน ttm_config
                $tmp = $this->config->item('Z_RFC_SM_006');
				
				// เช็คว่า validation ตามเงื่อนไขผ่านหรือไม่
				if ($this->form_validation->run() == true) {
                    // แก้ไขค่าในส่วนของ array("IMPORT","IM_USER",'911') โดยใส่ค่าตัวแปรที่รับมาจาก input form
                    $tmp[0][2] = $this->input->post('user-verify');
                    // แก้ไขค่าในส่วนของ  array("IMPORT","IM_CODE",'') โดยใส่ค่าตัวแปรที่รับมาจาก input form
                    $tmp[1][2] = $this->input->post('code-verify');
					//กำหนดค่าในการตัวแปร logindata ใน lib saprfc = ตัวแปร array logindata300 หรือ logindata900 ที่เซ็ตไว้ใน ttm_config เพื่อใช้ในการ connect 
                    $this->mysap->logindata = $this->config->item('logindata'.$this->input->post('client-verify'));
					$user = $this->input->post('user-verify');
				}else if($user != null and $code != null){
					// แก้ไขค่าในส่วนของ array("IMPORT","IM_USER",'911') โดยใส่ค่าตัวแปรที่รับมาจาก input form
                    $tmp[0][2] = $user;
                    // แก้ไขค่าในส่วนของ  array("IMPORT","IM_CODE",'') โดยใส่ค่าตัวแปรที่รับมาจาก input form
                    $tmp[1][2] = $code;
					
					
					//กำหนดค่าในการตัวแปร logindata ใน lib saprfc = ตัวแปร array logindata300 หรือ logindata900 ที่เซ็ตไว้ใน ttm_config เพื่อใช้ในการ connect 
                    $this->mysap->logindata = $this->config->item('logindata300'); // fix client 300
				}else{
					//redirect ไปหน้า form
					redirect('/welcome/');
				}
                
				//Call rfc function Z_RFC_SM_006 โดยมี parameter เป็น array $tmp
                $result=$this->mysap->callFunction("Z_RFC_SM_006",$tmp);
				
				//check ว่า verify ผ่านหรือไม่
                if($result['EP_ERRFLAG']=="X"){
					//ถ้า ไม่ผ่าน
					//set ค่า error ไปให้ view เพื่อนำไปแสดง 
					$data['errors'] = "Incorrect Register Code Contact IT Dept!!";
					//load view พร้อมทั้งส่งค่าตัวแปรไปที่หน้า view ด้วย
					$this->load->view('authen/loginform',$data);
                }else{
					//ถ้า ผ่าน
                    // load lib verify ที่ใช้ในการจัดการ verify ระหว่าง Sv. กะ Client
                    $this->load->library('verify');
                    // หาค่า ip ที่เข้ามาใช้งาน
                    $ipaddr = $_SERVER['REMOTE_ADDR'];
                    // นำ ip มาเข้ารหัสด้วย MD5
                    $mdid =strtoupper(md5($ipaddr));
                    // เช็คว่ามี cookie MDID อยู่หรือไม่
                    $user = strtoupper($user);
                    if($this->input->cookie("MDID")){
                        //ถ้ามี cookie MDID อยู่
                        // เช็คว่า md5 ของ id ปัจจุบันกับ ของเก่าที่อยู่ใน cookie ตรงกันหรือไม่
                        if($this->input->cookie("MDID")<>$mdid) ///Check Comp. Cookie <> md5(ipaddr)
                        {
                            //ถ้าไม่เท่ากัน ให้อัพเดทไฟล์ที่อยู่บน sv และ cookie ให้ตรงกัน
                            $FileSES=$this->verify->Check_CookieMdid($this->input->cookie("MDID"),$mdid); 
                            //Function Update File SES Real $mdid to File SES & $_Cookie['MDID']
                        }else{
                            // ถ้าเท่ากัน
                            // เป็นการเช็คและสร้าง cookie ทับอีกครั้งเพื่อต่ออายุ cookie
                            $FileSES=$this->verify->Find_Sess($this->input->cookie("MDID"));
                        }	
                    }else{
                        // ถ้าไม่มี cookie อยู่
                        // เปิดไฟล์ที่จะเก็บ เลข 32 หลักที่อยู่บน Sv.
                        $strFileName = "./session/".$mdid."_.SES";
                        $objFopen = fopen($strFileName, 'a');
                        //set ค่าให้กับ array
                        $param = array(
							"name"=> "MDID", 
                            "value"  => $mdid, 
                            "expire" => time()+189216000
                        );
                        // นำค่าใน array มา สร้าง cookie
                        $this->input->set_cookie($param);
                    }
                        
                    //เช็คว่ามีการ set ตัวแปร $FileSES มาหรือไม่
                    if(isset($FileSES)){
                        //ถ้ามี
                        //check ว่า เลข 32 หลักในไฟล์บน Sv. มีแล้วหรือยัง ถ้ามีจะส่งค่ามาให้ตัวแปร $status
                        $status=$this->verify->Check_Sessuse($FileSES,$result['EP_MACID'],$user);
                        // check ว่า $status มีการเซ็ตค่ามาหรือไม่
                        if(isset($status)){	
                            // ถ้ามีก็ไม่ต้องทำอะไร
                        }else{
                            // ถ้ายังไม่มีให้ redirect ไปฟังชั่นส์ addVerify เพื่อเพิ่มเลข 32 หลักลง ไฟล์บน Sv.
                            redirect('/welcome/addVerify/'.$result['EP_MACID'].'/'.$user);
                        }     
                    }
                    //redirect ไปฟังชั่นส์ addVerify
                    redirect('/welcome/addVerify/'.$result['EP_MACID'].'/'.$user);
				}
        }
        
        //function addVerify รับค่า เลข 32 หลักและ user มาแบบ get
        public function addVerify($iduser,$user){      
            //check ว่ามี cookie MDID และ ค่าที่ส่งมามี 32 หลักหรือไม่
            if ($this->input->cookie("MDID") and strlen($iduser) == 32){
                // load lib verify ที่ใช้ในการจัดการ verify ระหว่าง Sv. กะ Client
                $this->load->library('verify');
                // เรียกใช้ function Verify_UsetoSES เพื่อบันทึก เลข 32 หลักลง file บน Sv.
                $this->verify->Verify_UsetoSES($this->input->cookie("MDID"),$iduser,$user);
                
                $this->session->set_flashdata('ok', 'Verify Successful');
            }else{
                $this->session->set_flashdata('error', 'Device Not Verify Or Iduse Incorrect');
            }
            redirect('/welcome/');
        }
        
        // แสดง form หน้า ขอ Verify Code 4
        public function getCode(){
           $this->load->view('authen/codeform');
        }
        
        // ส่ง Verify Code 4 หลักทาง e-mail.
        public function sendCode(){
            // check ว่าเป็นการเรียก function มาเป็น แบบ Post หรือไม่
            if ($this->input->server('REQUEST_METHOD') === 'POST') {
                // ถ้าเป็นแบบ Post
                // เรียก lib validation
                $this->load->library('form_validation'); 
                //set tag เพื่อคลุมข้อความ error
                $this->form_validation->set_error_delimiters(' ','<br />');
                // set Error Msg
                $this->form_validation->set_message('required', 'Please enter your %s');
                //set เงื่อนไข สำหรับ field user โดย เงื่อนไข required|trim|xss_clean
                $this->form_validation->set_rules('user','username','required|trim|xss_clean');
                //set เงื่อนไข สำหรับ field pass โดย เงื่อนไข required|trim|xss_clean
		$this->form_validation->set_rules('pass','password','required|trim|xss_clean');
                //$this->form_validation->set_rules('pass','รหัสผ่าน','trim|xss_clean');
                //set เงื่อนไข สำหรับ select client โดย เงื่อนไข required|trim|xss_clean
                $this->form_validation->set_rules('client',' ','required|trim|xss_clean');
                
                // เช็คว่า validation ตามเงื่อนไขผ่านหรือไม่
                if ($this->form_validation->run() == true) {
                     // เรียก lib saprfc
                     $this->load->library('mysap');
                     // กำหนดค่า tmp = ตัวแปร config Z_RFC_SM_005 ที่อยู่ใน ttm_config
                     $tmp = $this->config->item('Z_RFC_SM_005');
                     // แก้ไขค่าในส่วนของ array("IMPORT","IM_USER",'911') โดยใส่ค่าตัวแปรที่รับมาจาก input form
                     $tmp[0][2] = $this->input->post('user');
                     // แก้ไขค่าในส่วนของ  array("IMPORT","IM_PASSW",'') โดยใส่ค่าตัวแปรที่รับมาจาก input form
                     $tmp[1][2] = $this->input->post('pass');
                     
                     //กำหนดค่าในการตัวแปร logindata ใน lib saprfc = ตัวแปร array logindata300 หรือ logindata900 ที่เซ็ตไว้ใน ttm_config เพื่อใช้ในการ connect 
                     $this->mysap->logindata = $this->config->item('logindata'.$this->input->post('client'));
                     //Call rfc function Z_RFC_SM_001 โดยมี parameter เป็น array $tmp
                     $result=$this->mysap->callFunction("Z_RFC_SM_005",$tmp);  
                     
                     //check user and pass
                     if($result['EP_ERRFLAG']=="X"){
                         //incorrect add error to $data['errors']
                         $data['errors'] = $result['EP_MESSAGE'];
                         //load view codeform and send $data
                         $this->load->view('authen/codeform',$data);
                     }else{
                         //correct add EP_MESSAGE to $mss
                        $mss = $result['EP_MESSAGE'];
                        // make flash for show success
                        $this->session->set_flashdata('ok',$mss);
                        //redirect to login page
                        redirect('/welcome/');
                     }
                }else{
                    //ถ้า validation ไม่ผ่าน
                    //ให้ load view form และส่ง error ไปที่ view เพื่อแสดงด้วย
                    $this->load->view('authen/codeform');
                }
            }else{
                redirect('/welcome/getCode');
            }
        }

        // แสดงหน้าหลักหลัง Login
        public function main($fun=null){
			if($this->session->userdata('EP_AUTH')=="Y"){
				$pivi = $this->session->userdata('EP_MENUSCR');
				$this->load->library('privilege'); 
				if($fun==null){
					$this->privilege->outputHead($fun);
					$this->load->view('layout/main');
				}else{
					$arr = explode ("_",strtoupper($fun));
					if(isset($arr[2])){
						$ct = $arr[0]."_".$arr[1];
						redirect($ct.'/'.$fun);
					}else{
						show_404();
					}
				}
			}else{
				//redirect to login page
                redirect('/welcome/');
			}
        }
		
		function userLogout(){
			$this->session->unset_userdata('EP_NAME');
			$this->session->unset_userdata('EP_SAPUSER');
			$this->session->unset_userdata('EP_SAPPWD');
			$this->session->unset_userdata('EP_MENUSCR');
			$this->session->unset_userdata('EP_AUTH');
			$this->session->unset_userdata('EP_MACID');
			$this->session->unset_userdata('EP_USER');
			$this->session->unset_userdata('EP_CLIENT');
			//redirect to login page
            redirect('/welcome/');
		}

		public function test(){
			//$this->session->set_userdata('MDID555', "1234567890");
			
			/*$this->session->unset_userdata('MDID555');
			print_r($this->session->all_userdata());
			
			if($this->session->userdata('MDID555')){
				echo "mama";
			}else{
				echo "no mama";
			}*/
			//$this->session->sess_destroy();
			//delete_cookie("MDID");
			var_dump($_COOKIE);
		}
}
