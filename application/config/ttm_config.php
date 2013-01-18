<?php
// ตั้งค่าการเชื่อมต่อ
$config['logindata900'] = array("ASHOST"=>"192.168.1.7",
                    "SYSNR"=>"00",
                    "CLIENT"=>"900",
                    "USER"=>"rfcuser",
                    "PASSWD"=>"789qqq",
                    "LANGUAGE"=>"EN",
                    "CODEPAGE"=>"8600");

$config['logindata300'] = array("ASHOST"=>"192.168.1.10",
                    "SYSNR"=>"00",
                    "CLIENT"=>"300",
                    "USER"=>"rfcuser",
                    "PASSWD"=>"789qqq",
                    "LANGUAGE"=>"EN",
                    "CODEPAGE"=>"8600");


$config['Z_RFC_SM_001'] = array( 
                            array("IMPORT","IM_USERID",'911'),
                            array("IMPORT","IM_PASSWD",''),
                            array("IMPORT","IM_MACID",'07c56eb9692b9fc564392e9ca135ac89'),

                            array("EXPORT","EP_AUTH",array()),
                            array("EXPORT","EP_NAME",array()),
                            array("EXPORT","EP_SAPUSER",array()),
                            array("EXPORT","EP_SAPPWD",array()),
                            array("EXPORT","EP_MENUSCR",array()),
                            array("EXPORT","EP_MESSAGE",array()),
                            array("TABLE","TAB_ZT29AUTR",array())
	);

$config['Z_RFC_SM_005'] = array( 
                          array("IMPORT","IM_USER",''),
                          array("IMPORT","IM_PASSW",''),

                          array("EXPORT","EP_ERRFLAG",array()),
                          array("EXPORT","EP_MESSAGE",array())
                          );
$config['Z_RFC_SM_006'] = array( 
                          array("IMPORT","IM_USER",''),
                          array("IMPORT","IM_CODE",''),

                          array("EXPORT","EP_ERRFLAG",array()),
                          array("EXPORT","EP_MESSAGE",array()),
                          array("EXPORT","EP_MACID",array())
                          );
						  
$config['Z_RFC_SM_007'] = array( 
                          array("IMPORT","IM_MACID",''),
                          array("IMPORT","IM_PROC",''),

                          array("EXPORT","EP_ERRFLAG",array()),
                          array("EXPORT","EP_MESSAGE",array())
                          );
?>
