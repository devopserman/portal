<?php
session_start();
#users

$cat = $_GET['cat'];	
$op = $_GET['op'];  
	$c =  $_GET['c'];
	$v =  $_GET['v'];
	$t =  $_GET['t'];
	$u =  $_GET['u'];
	$p =  $_GET['p'];
	$id = $_GET['id'];
	
echo '<div class="block_white">
		<p class="caption">Публикация</p>';

#if (isset($_GET['id']) && is_numeric($_GET['id'])){$id = $_GET['id']; } else {$id = NULL;}

	switch ($v) 
	{ 

		case 'set_new_topic' :
				mysql_select_db($dbname, $link);	
				
				
				$title = CheckStr($_POST[title]);
				$c_note = CheckStr($_POST['c_note']);
				$author = $UserID;
				$datetime = date('Y-m-d H:i:s');
				$ip = GetIP();
				
				
				if (($c > 0) AND (GetCommunityInfo($c,T_COMMUNITIES_ACTIVE)=='1') AND (GetCommunityInfo($c,T_COMMUNITIES_NAME)<>'') AND ($author > 0)) {
					if ($c_note <> ''){
						
						$sql = 'INSERT INTO '.TABLE_TOPICS.' ('.T_COMMUNITIES_ACTIVE.', '.T_TOPICS_COMMUNITY.', '.T_TOPICS_DATETIME.', '.T_TOPICS_AUTHOR.', '.T_TOPICS_CAPTION.',  '.T_TOPICS_URL.', '.T_TOPICS_MESSAGE.', '.T_TOPICS_IP.' ) 
						VALUES("1", "'.$c.'", "'.$datetime.'", "'.$author.'", "'.$title.'", "0", "'.$c_note.'", "'.$T_TOPICS_IP.'")';
						 if(!mysql_query($sql))
							{$op = 'err';
								echo mysql_error($link);
							} 
							else
								{
									echo '
										<p style="color:#000;">Запись опубликована.</p>
										<p><a href="index.php?c='.$c.'">Назад</a></p>
									';
								}
								
						}
						else { 
							echo '<p style="color:#f00;">Сообщение не должно быть пустым.</p>
							<p><a href="#" OnClick="history.back();">Назад</a></p>';	
						}
						mysql_query($query, $link);
						mysql_close($link);
					}
					else{
						echo '<p style="color:#f00;">Сообщество не выбрано, не существует или не активно.</p>
						<p><a href="#" OnClick="history.back();">Назад</a></p>';
					}
					break;
			default : break;
				
				
				
		case 'set_new_comment' :
				mysql_select_db($dbname, $link);	
				
				
				$title = CheckStr($_POST[title]);
				$c_note = CheckStr($_POST['c_note']);
				$author = $UserID;
				$datetime = date('Y-m-d H:i:s');
				$ip = GetIP();
				
				
				if (($c > 0) AND (GetCommunityInfo($c,T_COMMUNITIES_ACTIVE)=='1') AND ($author > 0)) {
					if ($c_note <> ''){
						
						$sql = 'INSERT INTO '.TABLE_COMMENTS.' ('.T_COMMENTS_ACTIVE.', '.T_COMMENTS_TOPIC.', '.T_COMMENTS_DATETIME.', '.T_COMMENTS_USER.', '.T_COMMENTS_IP.',  '.T_COMMENTS_MESSAGE.') 
						VALUES("1", "'.$t.'", "'.$datetime.'", "'.$author.'", "'.$ip.'", "'.$c_note.'")';
						 
						$cmnt = GetTopicInfo($t,T_TOPICS_COMMENTS);
						$cmnt = $cmnt + 1;
						$sql2 = "UPDATE ".TABLE_TOPICS." SET 
									".T_TOPICS_COMMENTS."='$cmnt'
																		
									WHERE id=".$t;
						mysql_query($sql2) or die("Ошибка вставки" . mysql_error());
						 
						 if(!mysql_query($sql))
							{$op = 'err';
								echo mysql_error($link);
							} 
							else
								{
									echo '
										<p style="color:#000;">Запись опубликована.</p>
										<p><a href="index.php?c='.$c.'&t='.$t.'">Назад</a></p>
									';
								}		
						}
						else {
							echo '<p style="color:#f00;">Сообщение не должно быть пустым.</p>
							<p><a href="#" OnClick="history.back();">Назад</a></p>';	
						}
					}
					else{
						echo '<p style="color:#f00;">Сообщество не выбрано, не существует или не активно.</p>
						<p><a href="#" OnClick="history.back();">Назад</a></p>';
					}
					break;
			default : break;
			
		case T_V_PLUS :
				mysql_select_db($dbname, $link);	
				
				$author = $UserID;
				$datetime = date('Y-m-d H:i:s');
				#$ip = GetIP();
				if ((isset($t))AND ($author > 0)){
				if (CheckRateTopic($UserID, $t)==''){
					
						
						$sql = 'INSERT INTO '.TABLE_RATE_TO_TOPICS.' ('.T_RATE_T_DATETIME.', '.T_RATE_T_AUTHOR.', '.T_RATE_T_TOPIC.', '.T_RATE_T_RATE.') 
						VALUES("'.$datetime.'", "'.$author.'", "'.$t.'", "'.VAR_RATE_UP.'")';
						$rate = GetTopicInfo($t,T_TOPICS_RAITING);
						$rate = $rate + 1;
						$sql2 = "UPDATE ".TABLE_TOPICS." SET 
									".T_TOPICS_RAITING."='$rate'
																		
									WHERE id=".$t;
						mysql_query($sql2) or die("Ошибка вставки" . mysql_error());
						
												
						 if(!mysql_query($sql))
							{$op = 'err';
								echo mysql_error($link);
							} 
							else
								{
									echo '
										<p style="color:#000;">Спасибо за голос!</p>
										<p><a href="#" OnClick="history.back();">Назад</a></p>
									';
								}


					}
					else{
						echo '<p style="color:#f00;">Вы уже проголосовали.</p>
						<p><a href="#" OnClick="history.back();">Назад</a></p>';
					}
				}
				else {
					echo '<p style="color:#f00;">Невозможно проголосовать.</p>
					<p><a href="#" OnClick="history.back();">Назад</a></p>';
				}
					break;
					
		case T_V_MINUS :
				mysql_select_db($dbname, $link);	
				
				$author = $UserID;
				$datetime = date('Y-m-d H:i:s');
				#$ip = GetIP();
				if ((isset($t)) AND ($author > 0)){
				if (CheckRateTopic($UserID, $t)==''){
					
						
						$sql = 'INSERT INTO '.TABLE_RATE_TO_TOPICS.' ('.T_RATE_T_DATETIME.', '.T_RATE_T_AUTHOR.', '.T_RATE_T_TOPIC.', '.T_RATE_T_RATE.') 
						VALUES("'.$datetime.'", "'.$author.'", "'.$t.'", "'.VAR_RATE_DOWN.'")';
						$rate = GetTopicInfo($t,T_TOPICS_RAITING);
						$rate = $rate - 1;
						$sql2 = "UPDATE ".TABLE_TOPICS." SET 
									".T_TOPICS_RAITING."='$rate'
																		
									WHERE id=".$t;
						mysql_query($sql2) or die("Ошибка вставки" . mysql_error());
						
												
						 if(!mysql_query($sql))
							{$op = 'err';
								echo mysql_error($link);
							} 
							else
								{
									echo '
										<p style="color:#000;">Спасибо за голос!</p>
										<p><a href="#" OnClick="history.back();">Назад</a></p>
									';
								}


					}
					else{
						echo '<p style="color:#f00;">Вы уже проголосовали.</p>
						<p><a href="#" OnClick="history.back();">Назад</a></p>';
					}
				}
				else {
					echo '<p style="color:#f00;">Невозможно проголосовать.</p>
					<p><a href="#" OnClick="history.back();">Назад</a></p>';
				}
					break;					
					
		case TCC_V_PLUS :
				mysql_select_db($dbname, $link);	
				
				$author = $UserID;
				$datetime = date('Y-m-d H:i:s');
				#$ip = GetIP();
				if ((isset($id)) AND ($author > 0)){
				if (CheckRateComment($UserID, $id)==''){
					
						
						$sql = 'INSERT INTO '.TABLE_RATE_TO_COMMENTS.' ('.T_RATE_C_DATETIME.', '.T_RATE_C_AUTHOR.', '.T_RATE_C_COMMENT.', '.T_RATE_T_RATE.') 
						VALUES("'.$datetime.'", "'.$author.'", "'.$id.'", "'.VAR_RATE_UP.'")';
						$rate = GetCommentInfo($id,T_COMMENTS_RAITING);
						$rate = $rate + 1;
						$sql2 = "UPDATE ".TABLE_COMMENTS." SET 
									".T_COMMENTS_RAITING."='$rate'
																		
									WHERE id=".$id;
						mysql_query($sql2) or die("Ошибка вставки" . mysql_error());
						
												
						 if(!mysql_query($sql))
							{$op = 'err';
								echo mysql_error($link);
							} 
							else
								{
									echo '
										<p style="color:#000;">Спасибо за голос!</p>
										<p><a href="#" OnClick="history.back();">Назад</a></p>
									';
								}


					}
					else{
						echo '<p style="color:#f00;">Вы уже проголосовали.</p>
						<p><a href="#" OnClick="history.back();">Назад</a></p>';
					}
				}
				else {
					echo '<p style="color:#f00;">Невозможно проголосовать.</p>
					<p><a href="#" OnClick="history.back();">Назад</a></p>';
				}
					break;	
		case TCC_V_MINUS :
				mysql_select_db($dbname, $link);	
				
				$author = $UserID;
				$datetime = date('Y-m-d H:i:s');
				#$ip = GetIP();
				if ((isset($id)) AND ($author > 0)){
				if (CheckRateComment($UserID, $id)==''){
					
						
						$sql = 'INSERT INTO '.TABLE_RATE_TO_COMMENTS.' ('.T_RATE_C_DATETIME.', '.T_RATE_C_AUTHOR.', '.T_RATE_C_COMMENT.', '.T_RATE_T_RATE.') 
						VALUES("'.$datetime.'", "'.$author.'", "'.$id.'", "'.VAR_RATE_DOWN.'")';
						$rate = GetCommentInfo($id,T_COMMENTS_RAITING);
						$rate = $rate - 1;
						$sql2 = "UPDATE ".TABLE_COMMENTS." SET 
									".T_COMMENTS_RAITING."='$rate'
																		
									WHERE id=".$id;
						mysql_query($sql2) or die("Ошибка вставки" . mysql_error());
						
												
						 if(!mysql_query($sql))
							{$op = 'err';
								echo mysql_error($link);
							} 
							else
								{
									echo '
										<p style="color:#000;">Спасибо за голос!</p>
										<p><a href="#" OnClick="history.back();">Назад</a></p>
									';
								}


					}
					else{
						echo '<p style="color:#f00;">Вы уже проголосовали.</p>
						<p><a href="#" OnClick="history.back();">Назад</a></p>';
					}
				}
				else {
					echo '<p style="color:#f00;">Невозможно проголосовать.</p>
					<p><a href="#" OnClick="history.back();">Назад</a></p>';
				}
					break;	



	
					
			default : break;
	
	}
		
			





	
	/* 	switch ($op)  
			{  
				case 'firmadd' 					: echo '<p>Запись добавлена!</p><p><a href="index.php?cat=usr&op=show&id='.$id.'">Вернуться назад</a></p>'; break;  
				case 'usr_to_edit_firm' 		: echo '<p>Данные обновлены!</p><p><a href="index.php?cat=usr&op=show&id='.$user.'">Вернуться назад</a></p>'; break;  
				case 'usr_to_del_firm' 			: echo '<p>Запись удалена!</p><p><a href="index.php?cat=usr&op=show&id='.$user.'">Вернуться назад</a></p>'; break;  
				case 'usr_add_prj_add' 			: echo '<p>Запись добавлена!</p><p><a href="index.php?cat=usr&op=show&id='.$user_id.'">Вернуться назад</a></p>'; break;  
				case 'usr_add_prj_err' 			: echo '<p>Пользователь уже прикреплен в этот проект!</p><p><a href="index.php?cat=usr&op=show&id='.$user_id.'">Вернуться назад</a></p>'; break;  
				case 'usr_to_del_prj' 			: echo '<p>Запись удалена!</p><p><a href="index.php?cat=usr&op=show&id='.$user.'">Вернуться назад</a></p>'; break;  
				case 'usr_to_del' 				: echo '<p>Запись удалена!</p><p><a href="index.php?cat=usr">Вернуться назад</a></p>'; break;  
				case 'usr_to_edit' 				: echo '<p>Запись отредактирована!</p><p><a href="index.php?cat=usr&op=show&id='.$id.'">Вернуться назад</a></p>'; break;  
				case 'usr_to_add' 				: echo '<p>Запись добавлена!</p><p><a href="index.php?cat=usr&op=main&sort=desc">Вернуться назад</a></p>'; break;  
				
				case 'pass_error' 				: echo '<p>Неверный пароль!</p><p><a href="index.php?cat=usr&op=usr_new_pass&id='.$id.'">Вернуться назад</a></p>'; break;  
				case 'pass_error2' 				: echo '<p>Новые пароли не совпадают!</p><p><a href="index.php?cat=usr&op=usr_new_pass&id='.$id.'">Вернуться назад</a></p>'; break;  
				case 'pass_ok' 					: echo '<p>Пароль изменен!</p><p><a href="index.php?cat=usr&op=show&id='.$id.'">Вернуться назад</a></p>'; break;  
				
				
				
				case 'edit' 		: echo '<p>Запись отредактирована!</p><p><a href="index.php?cat=prj&op=show&id='.$id.'">Вернуться назад</a></p>'; break;  
				case 'new' 			: echo '<p>Проект создан!</p><p><a href="index.php?cat=prj&op=main">Вернуться назад</a></p>'; break;  
				case 'prdel' 		: echo '<p>Запись удалена!</p><p><a href="index.php?cat=prj&op=main">Вернуться назад</a></p>'; break;
				case 'msgdel' 		: echo '<p>Запись удалена!</p><p><a href="index.php?cat=prj&op=show&id='.$id.'">Вернуться назад</a></p>'; break;
				case 'err' 			: echo '<p>Возникла ошибка! Проверьте данные и повторите операцию.</p><p><a href="index.php?cat=prj&op=main">Вернуться назад</a></p>'; break;  
			   
			} */  
		
	echo '</div>';
						#mysql_query($query, $link);
						#mysql_close($link);
?>
