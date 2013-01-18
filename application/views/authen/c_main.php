<head>
	<meta charset="tis-620">
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
        <div class="server-info">Logged as: <strong>Admin</strong> <a href="logout.php" class="button red" title="Logout"><span class="smaller">LOGOUT</span></a></div>
        <div class="server-info">Server: <strong><?=$_SERVER["SERVER_NAME"]?></strong></div>
        <div class="server-info">User Info: <strong>aaa</strong></div>
    </div>
</header>
<!-- End server status -->
<!-- Main nav -->
<nav id="main-nav">
    <ul class="container_12">
        <li class='home current'><a href='' title='Home'>Home</a></li>
        <li class="medias"><a href="#" title="Medias">Medias</a></li>
        <li class="users"><a href="#" title="Users">Users</a></li>
        <li class="stats"><a href="#" title="Stats">Stats</a></li>
        <li class="settings"><a href="#" title="Settings">Settings</a></li>
        <li class="backup"><a href="#" title="Backup">Backup</a></li>
    </ul>
</nav>
<!-- Sub nav -->
<div id="sub-nav">
    <div class="container_12">
    </div>  
</div>
<!-- End sub nav -->
<!-- Status bar -->
<div id="status-bar">
    <div class="container_12">
    </div>
</div>
<!-- End status bar -->
<div id="header-shadow"></div>
<!-- End header -->
<!-- Content -->
<article class="container_12">
    <section class="grid_6">
        <div class="block-border">
            <div class="block-content">
            <h1>Auto System Plan</h1>
                <div class="block-controls">
                    <ul class="controls-buttons">
                        <li><strong>Monday-Friday</strong></li>
                        <li class="sep"></li>
                        <li class="controls-block"><strong><?=date("F Y");?></strong></li>
                        <li class="sep"></li>
                        <li>
						<?
						$hour=date("G");
					$m=date("i");
					if($m>="30"){
						$min="30";
					}else if($m<="29"){
					$min="00";
					}
						?><strong><?=$hour.":".$m?><strong>
                        </li>
                    </ul>
                </div>
                <ul class="planning no-margin">
                    <li class="planning-header">
                        <span><b>System</b></span>
                        <ul>
                            <li class="at-8">8</li>
                            <li class="at-9">9</li>
                            <li class="at-10">10</li>
                            <li class="at-11">11</li>
                            <li class="at-12">12</li>
                            <li class="at-13">13</li>
                            <li class="at-14">14</li>
                            <li class="at-15">15</li>
                            <li class="at-16">16</li>
                            <li class="at-17">17</li>
                            <li class="at-18">18</li>
                            <li class="at-19">19</li>
                        </ul>
                    </li>
			
                    <li>
                        <a href=""> Kaspersky Send Email</a>
                        <ul>
                            <li class="zebras from-12 to-13"></li>
                            <li class="zebras from-18 to-19"></li>
                            <li class="current-time at-<?=$hour?>-<?=$min?>"></li>
								<!--<li class="from-8 to-9">
									<a href="#" title="Event description" class="with-tip">
									<span class="event-blue" style="width:100%"></span>
									</a>
								</li>
								-->
                            <li class="milestone at-8"><a href="" title="KAS Send Mail Protection Report" class="with-tip"></a></li>
			</ul>
                    </li>
                    <li>
                        <a href=""> Kaspersky Send Email</a>
			<ul>
                            <li class="zebras from-12 to-13"></li>
                            <li class="zebras from-18 to-19"></li>
                            <li class="current-time at-<?=$hour?>-<?=$min?>"></li>
								<!--<li class="from-8 to-9">
									<a href="#" title="Event description" class="with-tip">
									<span class="event-blue" style="width:100%"></span>
									</a>
								</li>
								-->
                            <li class="milestone at-8"><a href="" title="KAS Send Mail Protection Report" class="with-tip"></a></li>
			</ul>
                    </li>
                    <li>
                        <a href=""> Kaspersky Send Email</a>
			<ul>
                            <li class="zebras from-12 to-13"></li>
                            <li class="zebras from-18 to-19"></li>
                            <li class="current-time at-<?=$hour?>-<?=$min?>"></li>
								<!--<li class="from-8 to-9">
									<a href="#" title="Event description" class="with-tip">
									<span class="event-blue" style="width:100%"></span>
									</a>
								</li>
								-->
                            <li class="milestone at-8"><a href="" title="KAS Send Mail Protection Report" class="with-tip"></a></li>
			</ul>
                    </li>
                </ul>	
            </div>
        </div>
    </section>
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1>aaa</h1>
                    <ul class="shortcuts-list">
                    abc
                    </ul>
            </div>
        </div>
    </section>
    <div class="clear"></div>
</article>
</body>