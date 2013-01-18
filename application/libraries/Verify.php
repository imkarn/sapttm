<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

/*
 * Class Verify ใช้สำหรับ verify สร้าง file ขึ้นบนเครื่องและ cookie
 */

/**
 * Description of Verify
 *
 * @author Quize
 * */
class Verify {

    var $CI;
    var $path = "./session/";
    var $dirname = "session";

    function __construct() {
        $this->CI = & get_instance();
    }

    public function Verify_UsetoSES($cookie, $iduser, $user) {
        $FileSES = $this->path . $cookie . "_.SES";                    /// Directory Name SES
        $opendir = opendir($this->path);
        $i = 0;                                       /// Loop Find MDID = FileSES
        $flagW;
        $status;
        while (($file = readdir($opendir)) == true) {
            $cuting = substr($file, 0, 2);              /// Cuting . & ..
            list($str1, $str2) = explode(".", $file);   /// Split FileType

            if ($cuting == "." or $cuting == "..") {
                
            } else if ($str2 == "SES") {                /// Select FileType SES Only
                $filename[$i] = $file;
                list($sess1[$i], $sess2[$i]) = explode("_", $str1);
                ///Loop Find MDID = FileSES
                if ($sess1[$i] == $cookie) {
                    $objRead = fopen($FileSES, 'r');
                    if ($objRead) {
                        while (!feof($objRead)) {
                            $TextStr = fgets($objRead, 4096);
                            if (trim($TextStr) === trim($iduser.",".$user)) {
                                $flagW = "1";
                            } else {
                                $arr = explode ( ",", $TextStr );
                                if(isset($arr[1])){
                                    if (trim($arr[1]) === trim($user)) {
                                    $status = $arr[1];
                                    }
                                }
                            }
                        }
                        fclose($objRead);
                        //echo "<br>FlagW=".$flagW;
                    }
                    if (!isset($flagW)) {
						if(isset($status)){
							$fileArr = file($FileSES);
							for($j=0;$j<count($fileArr);$j++){
								$arr = explode ( ",", $fileArr[$j] );
								if(isset($arr[1])){
                                    if (trim($arr[1]) === trim($user)) {
										$fileArr[$j] = $iduser .",".strtoupper($user). "\r\n";
                                    }
                                }
							}
							file_put_contents($FileSES, implode( '', $fileArr ), LOCK_EX );
						}else{
							$FileSES = $this->path . $cookie . "_.SES";
							$objFopen = fopen($FileSES, 'a');
							$Text1 = $iduser .",".strtoupper($user). "\r\n";
							fwrite($objFopen, $Text1);
						}
                    }
                }
                $i = $i + 1;
            }
        }
    }

    public function Find_Sess($cookie) {
        //Find SES File//
        //#############//
        $opendir = opendir($this->path);
        $i = 0;     /// Loop Find MDID = FileSES
        while (($file = readdir($opendir)) == true) {
            $cuting = substr($file, 0, 2);  /// Cuting . & ..
            list($str1, $str2) = explode(".", $file); /// Split FileType
            if ($cuting == "." or $cuting == "..") {
                
            } else if ($str2 == "SES") {  /// Select FileType SES Only
                $filename[$i] = $file;
                list($sess1[$i], $sess2[$i]) = explode("_", $str1);
                ///Loop Find MDID = FileSES
                //#############//
                if ($sess1[$i] == $cookie) {
                    $strFileName = $this->path . $cookie . "_.SES"; //"session/".$cookie."_.SES";
                    $param = array(
                        "name" => "MDID",
                        "value" => $cookie,
                        "expire" => time() + 189216000
                    );
                    $this->CI->input->set_cookie($param);
                    // setcookie("MDID",$cookie,time() + 1892160000);
                    return $strFileName;
                }
                $i = $i + 1;
            }
        }
        //#############//
        closedir($opendir);
    }
    
    public function Check_User($FileSES,$user){
        $status = false;
        $objRead = fopen($FileSES, 'r');
        if ($objRead) {
            while (!feof($objRead)) {
                $TextStr = fgets($objRead, 4096);
                $arr = explode ( ",", $TextStr );
                if(isset($arr[1])){
                    if (trim($arr[1]) === trim($user)) {
                    $status = $arr[0];
                    }
                }
            }
            fclose($objRead);
            return $status;
        }
        return $status;
    }

    public function Check_CookieMdid($cookie, $mdid) {
        //Find SES File//
        //#############//
        $opendir = opendir($this->path);
        $i = 0;
        while (($file = readdir($opendir)) == true) {
            $cuting = substr($file, 0, 2);
            list($str1, $str2) = explode(".", $file);
            if ($cuting == "." or $cuting == "..") {
                
            } else if ($str2 == "SES") {
                $filename[$i] = $file;
                list($sess1[$i], $sess2[$i]) = explode("_", $str1);
                //#############//
                if ($sess1[$i] == $cookie) {
                    copy($this->path . $file, $this->path . $mdid . "_.SES");  //Copy & Rename File SES
                    $strFileName = $this->path . $mdid . "_.SES";    //Save File Name SES
                    unlink($this->path . $file);        //Del. Old File SES
                    $param = array(
                        "name" => "MDID",
                        "value" => $mdid,
                        "expire" => time() + 189216000
                    );
                    $this->CI->input->set_cookie($param);
                    //setcookie("MDID",$mdid,time() + 1892160000);			//Creat Cookie New By md5(IP Addr) 
                    return $strFileName;         //Return File Name SES
                }
                $i = $i + 1;
            }
        }
        //#############//
        closedir($opendir);
    }

    public function Check_SessMdid($mdid) {
        $opendir = opendir($this->path);
        $i = 0;
        while (($file = readdir($opendir)) == true) {
            $cuting = substr($file, 0, 2);
            list($str1, $str2) = explode(".", $file);

            if ($cuting == "." or $cuting == "..") {
                
            } else if ($str2 == "SES") {
                $filename[$i] = $file;
                list($sess1[$i], $sess2[$i]) = explode("_", $str1);

                if ($sess1[$i] == $mdid) {
                    // $_SESSION['MDID']=$mdid;					//Create Session MDID  
                    //echo "<br>Session Verify 20 Min.<br>";
                    $strFileName = $this->path . $mdid . "_.SES";
                    return $strFileName;
                }
                $i = $i + 1;
            }
        }
        closedir($opendir);
    }

    public function Check_Sessuse($FileSES, $iduser, $user) {
        $status = null;
        $objRead = fopen($FileSES, 'r');
        if ($objRead) {
            while (!feof($objRead)) {
                $TextStr = fgets($objRead, 4096);
                if (trim($TextStr) === trim($iduser.",".$user)) {
                    $status = $iduser;
                } else {
                    
                }
            }
            fclose($objRead);
            return $status;
        }
        closedir($opendir);
    }

}

?>
