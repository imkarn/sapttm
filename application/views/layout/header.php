<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="no-js ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie"><![endif]-->
<!--[if (gt IE 8)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Constellation Admin Skin</title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- Combined stylesheets load -->
	<!-- Load either 960.gs.fluid or 960.gs to toggle between fixed and fluid layout 
	<link href="<?php echo base_url();?>css/mini.php?files=reset,common,form,standard,960.gs.fluid,simple-lists,block-lists,planning,table,calendars,wizard,gallery" rel="stylesheet" type="text/css">-->

<link href="<?php echo base_url();?>css/reset.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/common.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/form.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/standard.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/960.gs.fluid.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/simple-lists.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/block-lists.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/planning.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/table.css" rel="stylesheet" type="text/css">	
<link href="<?php echo base_url();?>css/calendars.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>css/wizard.css" rel="stylesheet" type="text/css">	
<link href="<?php echo base_url();?>css/gallery.css" rel="stylesheet" type="text/css">	


	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>favicon.ico">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>favicon-large.png">
	
	<!-- Modernizr for support detection, all javascript libs are moved right above </body> for better performance -->
	<script src="<?php echo base_url();?>js/libs/modernizr.custom.min.js"></script>
	
</head>
<body>
<!-- Header -->
<!-- Server status -->
<header>
    <div class="container_12">
        <div class="server-info">Logged as: <strong><?php echo $this->session->userdata('EP_NAME');?></strong> <a href="<?php echo site_url('welcome/userLogout');?>" class="button red" title="Logout"><span class="smaller">LOGOUT</span></a></div>
        <div class="server-info">Server: <strong><?=$_SERVER["SERVER_NAME"]?></strong></div>
        <div class="server-info">User Info: <strong><?php echo $this->session->userdata('EP_USER');?></strong></div>
    </div>
</header>
<!-- End server status -->