<?php
session_start();

include ("auth.php");
	

	$c =  $_GET['c'];
	
	// Выбираем нужное нам действие  

	echo '
			<div class="block_white">
				<p><a href="index.php?c=5&t=24">Вы здесь первый раз?</a></p>
				<p><a href="index.php?c='.$c.'&v=new_communities">Новое сообщество</a></p>

			</div>
	
	';
	
	
	if ($c > 0){
		include "communities/sub_menu.php";
	}
	
	
?>