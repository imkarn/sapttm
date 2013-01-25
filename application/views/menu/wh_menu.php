<!-- Main nav -->
<nav id="main-nav">
    <ul class="container_12">
        <li class='home<?php echo ($active==null)? " current":"";?>'><a href='<?php echo site_url('welcome/main');?>' title='Home'>Home</a></li>
        <li class="medias<?php echo (strtoupper($active)=="Z_RFC_MM_202")? " current":"";?>"><a href="<?php echo site_url('welcome/main/Z_RFC_MM_202');?>" title="Z_RFC_MM_202">Z_RFC_MM_202</a></li>
        <li class="users<?php echo (strtoupper($active)=="ZTTM_MM_001")? " current":"";?>"><a href="<?php echo site_url('welcome/main/ZTTM_MM_001');?>" title="ZTTM_MM_001">ZTTM_MM_001</a></li>
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