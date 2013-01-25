<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="no-js ie ie7 dark"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie dark"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html lang="en" class="no-js dark"><!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Constellation Admin Skin</title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- Mobile metas -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	
	<!-- Those meta will turn your website into an app on the iPhone -->
	<meta name="apple-mobile-web-app-capable" content="yes">
		<!-- Mobile metas -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	
	<!-- Those meta will turn your website into an app on the iPhone -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-startup-image" href="<?php echo base_url();?>images/iphone_startup.png">
	
	<!-- Global stylesheets -->
	<link href="<?php echo base_url();?>css/reset.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/common.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/form.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>css/mobile.css" rel="stylesheet" type="text/css">
	
	<!-- Custom styles -->
	<link href="<?php echo base_url();?>css/block-lists.css" rel="stylesheet" type="text/css">
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>favicon.ico">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>favicon-large.png">
	<link rel="apple-touch-icon" href="<?php echo base_url();?>apple-touch-icon.png">
	
	<!-- Modernizr for support detection, all javascript libs are moved right above </body> for better performance -->
	<script src="<?php echo base_url();?>/js/libs/modernizr.custom.min.js"></script>
	
</head>
<body>
	<header>
		<h1>Verify Authorize !!</h1>
	</header>
		<a href="<?php echo site_url();?>" id="back">Back</a>
	<div id="menu">
		<a href="#">Menu</a>
		<ul>
			<li class="red"><a href="<?php echo site_url();?>">Login</a></li>
		</ul>
	</div>
	<div id="header-shadow"></div>
	
	<article>
		<section id="login-block">
			<div class="block-border">
			<form class="form block-content" id="form-verify" name="form-verify" method="post" action="<?php echo site_url('welcome/verifyUser')?>">	
			<h1>Verify Authorize !!</h1>
			<?php
            $error = isset($errors)? $errors:validation_errors();
            if ($error){?>
                <p class="message error no-margin"><?php echo $error; ?></p>
			<?php } ?>
			<?php if (isset($ok)){?>
                    <p class="message success no-margin"><?php echo $ok; ?></p>
            <?php } ?>
				<p class="inline-mini-label">
					<label for="client">Client</label>
					<?php
                        
                            // เซ็ตค่าให้ $val โดยถ้ามีการส่งค่า client มาก็จะเซ็ตค่าให้ $val แต่ถ้าไม่มีก็จะเซ็ตให้เป็น 900
                            $val = (set_value('client-verify')!="")? set_value('client-verify'):"900";
                            //set ค่าให้ array เพื่อนำไปใช้กับ dropdown
                            $options = array(
                                '900'  => '900',
                                '300'    => '300',
                              );
                            $js = 'id="client-verify" class="full-width"';
                            // เรียกใช้ form helper dropdown
                            echo form_dropdown('client-verify', $options, $val,$js); 
                    ?>
				</p>
				<p class="inline-mini-label">
					<label for="user">User</label>
					<input type="text" name="user-verify" id="user-verify" class="full-width" value="<?php echo set_value('user-verify');?>">
				</p>
				<p class="inline-mini-label">
					<label for="pass">Code</label>
					<input type="text" name="code-verify" id="code-verify" maxlength="4" class="full-width" value="<?php echo set_value('code-verify');?>">
				</p>

				<p><button type="submit" class="full-width">Verify</button></p>
			</form>
			</div>
			</section>
	</article>
	<!--
	
	Updated as v1.5:
	Libs are moved here to improve performance
	
	-->
	
	<!-- Combined JS load -->
	<script src="<?php echo base_url();?>js/libs/jquery-1.6.3.min.js"></script>
	
	<!-- Template core functions -->
	<script src="<?php echo base_url();?>js/common.js"></script>
	<script src="<?php echo base_url();?>js/mobile.js"></script>
	<script src="<?php echo base_url();?>js/jquery.tip.js"></script>
	<!-- example login script -->
<script>
$(document).ready(function()
{
    var submitBt = $(this).find('button[type=submit]');
    submitBt.enableBt();
    
    $('#form-verify').submit(function(e) {
        e.preventDefault();
        
        var vlg = $('#user-verify');
        var vco = $('#code-verify');
        
        if (!vlg.val() || vlg.val().length == 0){
            $('#login-block').removeBlockMessages().blockMessage('Please enter your user.', {type: 'warning'});
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