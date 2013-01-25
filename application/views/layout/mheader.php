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
	<link href="<?php echo base_url();?>css/table.css" rel="stylesheet" type="text/css">
	<!-- Custom styles -->
	<link href="<?php echo base_url();?>css/block-lists.css" rel="stylesheet" type="text/css">
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>favicon.ico">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>favicon-large.png">
	<link rel="apple-touch-icon" href="<?php echo base_url();?>apple-touch-icon.png">
	
	<!-- Modernizr for support detection, all javascript libs are moved right above </body> for better performance -->
	<script src="<?php echo base_url();?>js/libs/modernizr.custom.min.js"></script>
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
	
</head>
<body>
	
	<header>
		<h1>Logged as: <strong><?php echo $this->session->userdata('EP_NAME');?></strong></h1>
	</header>