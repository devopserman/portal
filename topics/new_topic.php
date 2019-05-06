<?php

$TITLE = MS_TOPICS;

				$op = $_GET['op'];  
				$c = $_GET['c'];
				$v = $_GET['v'];
				

				if ($c == 'all'){
					$c_select = '';
				}
				else {
					if ($c >0){
						$c_select = ' AND '.T_TOPICS_COMMUNITY.'='.$c.' ';
					}
					else{
							$c_select = '';
					}
				}
				
		if (($c > 0) AND (GetCommunityInfo($c,T_COMMUNITIES_ACTIVE)=='1') AND (GetCommunityInfo($c,T_COMMUNITIES_NAME)<>'')) {
			 
			echo'
			<div class="block_white" >
				<p class="caption">Новая тема в сообществе - <span>'.GetCommunityInfo($c,T_COMMUNITIES_NAME).'</span></p>
				
				
				<div>
					<form method="post" action="index.php?c='.$c.'&v=set_new_topic">
							
								<p>Заголовок</br><input type="text" name="title"></p>
								<textarea id="editor" cols="60" rows="5" name="c_note"></textarea>
								<p><input type="submit" name="new_topic" value="Опубликовать"></p>					
							
					</form>
				</div>
			</div>
			';
		}
		else{
			echo 'Сообщество не найдено!';
		}
	
	
	
mysql_query($query, $link);

mysql_close($link);
if(USER_LOGGED) {
}
?>
