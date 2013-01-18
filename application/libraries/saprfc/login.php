<style type="text/css">
#login
{
width:289px;
border:#D7C3B2 solid 1px;
background-color:#e8f1b8;
color:#101010;
margin:15px auto;
}

#login h2
{
height:42px;
padding:0 0 0 30px;
color:#181818;
font:normal 21px/42px "Trebuchet MS",Arial, Helvetica, sans-serif;
border:#b2c066 solid 1px;
background-color:#c5d474;;
margin:0 0 4px 0;
}

#login form
{
width:264px;
padding:0 12px 0 13px;
}

#login form label
{
display:block;
width:250px;
padding:0 12px 0 13px;
font:normal 11px/18px "Trebuchet MS",Arial, Helvetica, sans-serif;
margin:0;
float:left;
}

#login form input.submit
{
background:#8B7765;
width:61px;
height:20px;
float:right;
cursor:pointer;
border:none;
font:normal 11px/20px "Trebuchet MS",Arial, Helvetica, sans-serif;
color:#FFFFF;
margin:8px 0 0 0;
}
</style>

<?
include "function_php.php";
stdhead();

$priority=$_POST['priority_log'];
$Z_user=$_POST['username_log'];
$Z_pass=$_POST['password_log'];
$cookiemacad=$_COOKIE['cookiemacad'];

if($cookiemacad==""){$statustext="!Device Not Verify Contract Admin Please";}

if($priority!="login" OR $Z_user=="" OR $Z_pass==""){
?>
<div id='login'>
	<h2>SAP On Browser Logon</h2>
<form name='authForm' method='POST' action='#'>
	<label>Enter User:</label>
<input type='text' name='username_log' size='25' class="keyboardInput">
<label>Enter Password:</label><input type='password' name='password_log' size='25' class="keyboardInput">
<input type='hidden' name='cookiemacad' size='25'value=<?=$cookiemacad?>>
<input type='hidden' name='priority_log' value='login'><br>
<input type='submit' name='login' class='submit' value='Login'>
	<br class="spacer">
</form>
</div>
<?
	if ($statustext!=""){status_info($statustext);}
}	else	{
Z_RFC_SM_001($Z_user,$Z_pass,$cookiemacad);
echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
}


stdfoot();
?>
