<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="no-js ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="TIS-620">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Toptrend Web UI LogOn</title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- Combined stylesheets load 
	<link href="<?php echo base_url();?>css/mini.php?files=reset,common,form,standard,special-pages" rel="stylesheet" type="text/css">
	-->

        <link href="<?php echo base_url();?>css/reset.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/common.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/form.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/standard.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/special-pages.css" rel="stylesheet" type="text/css">


	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>favicon.ico">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>favicon-large.png">
	
	<!-- Modernizr for support detection, all javascript libs are moved right above </body> for better performance -->
	<script src="<?php echo base_url();?>js/libs/modernizr.custom.min.js"></script>
	<script src="<?php echo base_url();?>js/libs/jquery-1.6.3.min.js"></script>
	<script src="<?php echo base_url();?>js/old-browsers.js"></script>		<!-- remove if you do not need older browsers detection -->
	
	<!-- Template libs -->
	<script src="<?php echo base_url();?>js/common.js"></script>
	<script src="<?php echo base_url();?>js/standard.js"></script>
	<!--[if lte IE 8]><script src="<?php echo base_url();?>js/standard.ie.js"></script><![endif]-->
	<script src="<?php echo base_url();?>js/jquery.tip.js"></script>
</head>
<body class="special-page login-bg dark">
    <section id="message"></section>
<?php 
    // เรียกใช้ form helper form_open โดยให้ action ไปที่ welcome/checkLogin
?>
    <section id="login-block">
        <div class="block-border"><div class="block-content">
        <!--
        IE7 compatibility: if you want to remove the <h1>,
        add style="zoom:1" to the above .block-content div
        -->
	<div class="block-header">Please login</div>
	<?php
            $error = isset($errors)? $errors:validation_errors();
            if ($error){?>
                <p class="message error no-margin"><?php echo $error; ?></p>
	<?php } ?>
                <?php if (isset($ok)){?>
                    <p class="message success no-margin"><?php echo $ok; ?></p>
                <?php } ?>
                <form class="form with-margin" name="login-form" id="login-form" method="post" action="<?php echo site_url('welcome/checkLogin')?>">
                        <p class="inline-small-label">
                            <label for="client"><span class="big">Client</span></label>
                        <?php
                        
                            // เซ็ตค่าให้ $val โดยถ้ามีการส่งค่า client มาก็จะเซ็ตค่าให้ $val แต่ถ้าไม่มีก็จะเซ็ตให้เป็น 900
                            $val = (set_value('client')!="")? set_value('client'):"900";
                            //set ค่าให้ array เพื่อนำไปใช้กับ dropdown
                            $options = array(
                                '900'  => '900',
                                '300'    => '300',
                              );
                            $js = 'class="full-width" id="client"';
                            // เรียกใช้ form helper dropdown
                            echo form_dropdown('client', $options, $val,$js); 
                        ?>
                        </p>
                        <p class="inline-small-label">
                            <label for="user"><span class="big">Username</span></label>
                        <?
                             //set ค่าให้ array เพื่อนำไปใช้กับ input ตาม attribute
                            $data = array(
                                'name'        => 'user',
                                'id'          => 'user',
                                'value'       => set_value('user'),
                                'class'        => 'full-width',
                                'AUTOCOMPLETE'        => 'OFF',
                            );
                            // เรียกใช้ form helper input
                            echo form_input($data);
                            // เรียกใช้ form error จาก validation lib หาก field user ไม่ผ่านก็จะแสดง error
                            //echo form_error('user');
                        ?>
                        </p>
			<p class="inline-small-label">
                            <label for="pass"><span class="big">Password</span></label>
                        <?php
                            //set ค่าให้ array เพื่อนำไปใช้กับ input ตาม attribute
                            $data = array(
                            'name'        => 'pass',
                            'id'          => 'pass',
                            'value'       => set_value('pass'),
                            'class'        => 'full-width',
                            );
                            // เรียกใช้ form helper password
                            echo form_password($data);
                            // เรียกใช้ form error จาก validation lib หาก field นี้ ไม่ผ่านก็จะแสดง error
                            //echo form_error('pass');
                        ?>
			</p>
                            <button type="submit" class="float-right">Login</button>
			<p class="input-height">
                            <a class="button red" href="<?php echo site_url('welcome/getCode');?>">Get Register Code!!</a>
			</p>
		</form>
			
		<form class="form" id="form-verify" name="form-verify" method="post" action="<?php echo site_url('welcome/verifyUser')?>">
                    <fieldset class="grey-bg no-margin collapse">
                        <legend><a href="#">Verify Authorize !!</a></legend>
			<p class="input-with-button">
                            <label for="client-verify">Client</label>
                            <?php
                        
                            // เซ็ตค่าให้ $val โดยถ้ามีการส่งค่า client มาก็จะเซ็ตค่าให้ $val แต่ถ้าไม่มีก็จะเซ็ตให้เป็น 900
                            $val = (set_value('client-verify')!="")? set_value('client-verify'):"900";
                            //set ค่าให้ array เพื่อนำไปใช้กับ dropdown
                            $options = array(
                                '900'  => '900',
                                '300'    => '300',
                              );
                            $js = 'id="client-verify"';
                            // เรียกใช้ form helper dropdown
                            echo form_dropdown('client-verify', $options, $val,$js); 
                            ?>
                            <label for="user-verify">Username</label>
                            <input type="text" name="user-verify" id="user-verify" value="<?php echo set_value('user-verify');?>">
                            <label for="code-verify">Register Code</label>
                            <input type="text" name="code-verify" maxlength="4" id="code-verify" value="<?php echo set_value('code-verify');?>">
                            <button type="submit">Verify</button>
			</p>
                    </fieldset>
		</form>
        </div></div>
    </section> 
    
<!-- Combined JS load -->
<script src="<?php echo base_url();?>js/mini.php?files=libs/jquery-1.6.3.min,old-browsers,common,standard,jquery.tip"></script>
<!--[if lte IE 8]><script src="<?php echo base_url();?>js/standard.ie.js"></script><![endif]-->

<!-- example login script -->
<script>
$(document).ready(function()
{
    var submitBt = $(this).find('button[type=submit]');
    submitBt.enableBt();
    $('#login-form').submit(function(e) {
        e.preventDefault();
        // Check fields
        var login = $('#user').val();
        var pass = $('#pass').val();
        var lg = $('#user');
        var pa = $('#pass');
				
        if (!login || login.length == 0){
            $('#login-block').removeBlockMessages().blockMessage('Please enter your username for login.', {type: 'warning'});
            lg.focus();
        }else if (!pass || pass.length == 0){
            $('#login-block').removeBlockMessages().blockMessage('Please enter your password.', {type: 'warning'});
            pa.focus();
        }else{
            submitBt.disableBt();
            this.submit();
        }
    });
    
    $('#form-verify').submit(function(e) {
        e.preventDefault();
        
        var vlg = $('#user-verify');
        var vco = $('#code-verify');
        
        if (!vlg.val() || vlg.val().length == 0){
            $('#login-block').removeBlockMessages().blockMessage('Please enter your username for verify.', {type: 'warning'});
            vlg.focus();
        }else if (!vco.val()){
            $('#login-block').removeBlockMessages().blockMessage('Please enter your verify code.', {type: 'warning'});
            vco.focus();
        }else if(isNaN(vco.val())){
            $('#login-block').removeBlockMessages().blockMessage('Verify code is integer only.', {type: 'warning'});
            vco.focus();
        }else if(vco.val().length != 4){
            $('#login-block').removeBlockMessages().blockMessage('Verify code have 4 length.', {type: 'warning'});
            vco.focus();
        }else{
            this.submit();
        }
    });
});
</script>
</body>
</html>