<?php
//mysql_connect('localhost','root','') or die(mysql_error());
//mysql_select_db('crm') or die(mysql_error());
include ("config.php");
include ("db_connect.php");
include('uni-auth.php');

if(USER_LOGGED) { 
    if(!check_user($UserID)) logout(); 
}
else { 
}
?>