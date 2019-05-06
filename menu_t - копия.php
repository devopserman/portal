<?php
session_start();

include ("auth.php");


$cat = $_GET['cat'];

echo '

	<ul class="topmenu">';
	
		echo '<li '; if ($cat == NULL) 				{echo ' class="current"';} echo '><a href="/"><b>Главная</b></a></li>';
		echo '<li '; if ($cat == CAT_COMMUNITIES) 	{echo ' class="current"';} echo '><a href="index.php?cat='.CAT_COMMUNITIES.'&op=main"><b>Сообщества</b></a></li>';		
		echo '<li '; if ($cat == CAT_TOPICS)    	{echo ' class="current"';} echo '><a href="index.php?cat='.CAT_TOPICS.'&op=main"><b>Записи</b></a></li>';
		echo '<li '; if ($cat == CAT_USERS)  		{echo ' class="current"';} echo '><a href="index.php?cat='.CAT_USERS.'&op=main"><b>Пользователи</b></a></li>';
		#echo "<li "; if(($_SERVER['PHP_SELF']=='/products/products.php')or($_SERVER['PHP_SELF']=='/groups/groups.php'))  		echo " class=\"current\""; echo "><a href='/products/products.php'><b>Товары</b></a></li>";
		
		#echo "<li "; if($_SERVER['PHP_SELF']=='/messages/messages.php') echo " class=\"current\""; echo "><a href='/messages/messages.php'><b>Сообщения</b></a></li>";
		#echo "<li "; if($_SERVER['PHP_SELF']=='/tasks/tasks.php') 		echo " class=\"current\""; echo "><a href='/tasks/tasks.php'><b>Задачи</b></a></li>";
		
		
echo '	</ul>

 ';

?>