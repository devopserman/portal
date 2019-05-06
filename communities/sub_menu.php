<?php


	
	$c = $_GET['c'];
	$v = $_GET['v'];
	
	if ($c > 0){
		
	echo'
		<div class="block_white"><img src="'.GetCommunityInfo($c,T_COMMUNITIES_LOGO).'" width="100px"/>
		<p class="caption">'.GetCommunityInfo($c,T_COMMUNITIES_COMMENT).'</p>
		<p><span class="c_marker"><a href="index.php?c='.$c.'">'.GetCommunityInfo($c, T_COMMUNITIES_NAME).'</a></span> <span class="greytext">владелец — <a href="index.php?u='.GetUserInfo(GetCommunityInfo($c,T_COMMUNITIES_AUTHOR), T_USERS_UID).'">'.GetUserInfo(GetCommunityInfo($c,T_COMMUNITIES_AUTHOR), T_USERS_USERNAME).'</a></span>
							</p>
							<p>'.replaceBBCode(GetCommunityInfo($c, T_COMMUNITIES_NOTE)).'</p>
							
		';					
		if(USER_LOGGED) {
				if (CheckUserSubscribe($UserID, $c)>0) {
													echo '<p><span class="greytext">Подписка оформлена</span> <a href="index.php?c='.$c.'&v='.VAR_C_SUBSCRIBE_OFF.'">Отменить подписку</a></p>';
											
												}
												else{
												echo '<p><span class="button_blue"><a href="index.php?c='.$c.'&v='.VAR_C_SUBSCRIBE.'">Подписаться</a></span></p>';
												}			
							
		echo '				
		<p><span class="button_blue"><a href="index.php?c='.$c.'&v=new_topic">Новая запись</a></span></p>	';
		}
		
							
							
			echo '				
		</div>
		';

	}
	
?>