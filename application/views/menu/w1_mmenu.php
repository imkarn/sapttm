	<?php if($active!=null){?>
	<a href="<?php echo site_url();?>" id="back">Back</a>
	<?php } ?>
	<div id="menu">
		<a href="#">Menu</a>
		<ul>
			<li <?php echo ($active==null)? 'class="red"':"";?>><a href="<?php echo site_url('welcome/main');?>">Home</a></li>
			<li <?php echo ($active=="Z_RFC_MM_202")? 'class="red"':"";?>><a href="<?php echo site_url('welcome/main/Z_RFC_MM_202');?>">Z_RFC_MM_202</a></li>
			<li><a href="<?php echo site_url('welcome/userLogout');?>">Logout</a></li>
		</ul>
	</div>
	
	<div id="header-shadow"></div>