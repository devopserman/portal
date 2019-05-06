<?php 

$link = mysql_connect($dbhost, $dbuser, $dbpassword);

mysql_select_db($dbname, $link);
#mysql_query('SET NAMES cp1251');

  if (!$link)   
  {   
    echo "<p>К сожалению, не доступен сервер mySQL</p>";   
    exit();   
  }   
  if (!mysql_select_db($dbname,$link) )   
  {   
    echo "<p>К сожалению, не доступна база данных</p>";   
    exit();   
  }   
  $ver = mysql_query("SELECT VERSION()");   
  if(!$ver)   
  {   
    echo "<p>Ошибка в запросе</p>";   
    exit();   
  }   
 // echo mysql_result($ver, 0);   

?>