<?php
session_start();

include ("auth.php");


$cat = $_GET[cat];
$c = $_GET[c];



echo '



<table border="'.VAR_BORDER.'"  style="border-collapse: collapse; width: 100%;">
	<tbody>
		<tr>
			<td align="left" style="width: 50%;">
				<p class="caption"><a href="index.php">'.VAR_PORTAL_NAME.'</a></p>
			</td>
			<td style="width: 50%;">
			<a href="index.php?u=all"><b>Users</b></a> <span class="commbox"><a href="index.php?c=all&v=list"><div>Сообщества</div></a></span>
			<span class="openbox"><a href="index.php?c='.GetRandomC().'"><div>Случайное</div></a></span>
			
			
			'; 
				if(USER_LOGGED) { 
					if(!check_user($UserID)) logout(); 
		
				echo '				
					<p align="right";>Здравствуйте, <b><a href="index.php?cat=usr&op=show&id='.$UserID.'">'.$UserName.'</a>! <a href="?logout"><img valign="bottom" width="20px" src="images/logout.png" /></a></b></p>';
					
				#echo '<a href="index.php?'.VAR_URL_CAT.'='.CAT_COMMUNITIES.'&'.VAR_URL_OP.'='.CAT_REG.'">Новое сообщество</a>';
				
				}
				else {
					@include('logpls.php');
				}
			

				echo '
				
			</td>
			
		</tr>
	</tbody>
</table>'
;




?>
