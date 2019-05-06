<?php
session_start();
#users

$cat = $_GET['cat'];	
$op = $_GET['op'];  
	
	$c =  $_GET['c'];
	$v =  $_GET['v'];
	$u =  $_GET['u'];
	$p =  $_GET['p'];

echo '<div class="block_white">
		';

if (isset($_GET['id']) && is_numeric($_GET['id'])){$id = $_GET['id']; } else {$id = NULL;}

	switch ($v) 
	{ 

		case CAT_REGFINISH :
				mysql_select_db($dbname, $link);	
			
				$c_name = 		CheckStrENG($_POST['c_name']); 
				$c_comment = 	CheckStr($_POST['c_comment']);
				$c_logo = 		CheckStr($_POST['c_logo']);
				$c_note = 		CheckStr($_POST['c_note']);
				
				
				$f1 = 0;
				$f2 = 0;
				$f3 = 0;
				$f4 = 0;
				$f5 = 0;
				$f6 = 0; 
				$author = $UserID;
				
				
				#username
				if ($c_name == ""){$f1=0; echo '<p style="color:#f00;">Недопустимые символы.</p>';} else {$f1=1;}
				if (GetCommunityId($c_name) > 0){$f2=0; echo '<p style="color:#f00;">Сообщество с таким названием уже существует.</p>';} else {$f2=1;}
				
				#назад
				if (($f1==0) OR ($f2==0)) {echo '<p><a href="index.php?c='.$c.'&v='.new_communities.'">Назад</a></p>';}
				
				if (($f1==1) AND ($f2==1)) {
					$datereg = date('Y-m-d H:i:s');
					$status = '0';

				$sql = 'INSERT INTO '.TABLE_COMMUNITIES.' ('.T_COMMUNITIES_ACTIVE.', '.T_COMMUNITIES_NAME.', '.T_COMMUNITIES_COMMENT.', '.T_COMMUNITIES_LOGO.', '.T_COMMUNITIES_NOTE.',  '.T_COMMUNITIES_AUTHOR.', '.T_COMMUNITIES_DATETIMEREG.', '.T_COMMUNITIES_STATUS.' ) 
				VALUES("1", "'.$c_name.'", "'.$c_comment.'", "'.$c_logo.'", "'.$c_note.'", "'.$author.'", "'.$datereg.'", "'.$status.'")';
				 if(!mysql_query($sql))
				{$op = 'err';
				} 
					else
					{
						echo '
							<p class="caption">Регистрация</p>
							<p style="color:#000;">Сообщество создано.</p>
							<p><a href="index.php?c='.CU_ALL.'">Назад</a></p>
						';
					}
				}
				else { 
					#echo '<font color="red">Поле со звездочкой* должно быть заполнено!</font>';	
				}
				mysql_query($query, $link);
				mysql_close($link);
			break;
		
		case VAR_C_SUBSCRIBE :
				mysql_select_db($dbname, $link);	
				
				$author = $UserID;
				$datetime = date('Y-m-d H:i:s');
				#$ip = GetIP();
				if (isset($c)){
				if (GetCommunityInfo($c, T_COMMUNITIES_ACTIVE)=='1'){
					
						if (CheckUserSubscribe($author, $c) == 0) {
								$sql = 'INSERT INTO '.TABLE_USER_TO_COMMUNITIES.' ('.T_SUBS_DATETIME.', '.T_SUBS_AUTHOR.', '.T_SUBS_COMMUNITY.') 
								VALUES("'.$datetime.'", "'.$author.'", "'.$c.'")';
								$sub = GetCommunityInfo($c,T_COMMUNITIES_SUBS);
								$sub = $sub + 1;
								$sql2 = "UPDATE ".TABLE_COMMUNITIES." SET 
											".T_COMMUNITIES_SUBS."='$sub'
																				
											WHERE id=".$c;
								mysql_query($sql2) or die("Ошибка вставки" . mysql_error());
								
														
								 if(!mysql_query($sql))
									{$op = 'err';
										echo mysql_error($link);
									} 
									else
										{
											echo '
												<p class="caption">Подписка</p>
												<p style="color:#000;">Вы подписались на канал <b>'.GetCommunityInfo($c, T_COMMUNITIES_NAME).'</b>!</p>
												<p><a href="#" OnClick="history.back();">Назад</a></p>
											';
										}


							}
							else{
								echo '<p style="color:#f00;">Вы уже подписаны.</p>';
							}
					
						}
						else {echo '<p style="color:#f00;">Вы уже подписаны на это сообщество.</p>';}
				}
				else {
					echo '<p style="color:#f00;">Топик не выбан.</p>';
				}
					break;	
		
		case VAR_C_SUBSCRIBE_OFF :
				mysql_select_db($dbname, $link);	
				
				$author = $UserID;
				#$datetime = date('Y-m-d H:i:s');
				#$ip = GetIP();
				
				if (isset($c)){
					if (GetCommunityInfo($c, T_COMMUNITIES_ACTIVE)=='1'){
							$find = CheckUserSubscribe($author, $c);
							
							if ($find > 0) {
									$sql = 'DELETE FROM '.TABLE_USER_TO_COMMUNITIES.' WHERE id='.$find.' LIMIT 1';
									$sub = GetCommunityInfo($c,T_COMMUNITIES_SUBS);
									$sub = $sub - 1;
									$sql2 = "UPDATE ".TABLE_COMMUNITIES." SET 
												".T_COMMUNITIES_SUBS."='$sub'
																					
												WHERE id=".$c;
									mysql_query($sql2) or die("Ошибка вставки" . mysql_error());
									
															
									 if(!mysql_query($sql))
										{$op = 'err';
											echo mysql_error($link);
										} 
										else
											{
												echo '
													<p class="caption">Подписка</p>
													<p style="color:#000;">Вы отменили подписку на канал <b>'.GetCommunityInfo($c, T_COMMUNITIES_NAME).'</b>!</p>
													<p><a href="#" OnClick="history.back();">Назад</a></p>
												';
											}


							}
							else{echo '<p style="color:#f00;">Вы еще не подписаны.</p>';}
					}
					else {echo '<p style="color:#f00;">Вы не подписаны на это сообщество.</p>';}
				}
				else {
					echo '<p style="color:#f00;">Топик не выбан.</p>';
				}
					break;		
	case 'groupaction' :
				mysql_select_db($dbname, $link);	
				
				$author = $UserID;
				$checkbox = $_POST['checkbox'];
				$act = $_POST['act'];
				
				
				switch ($act) {
					case '0'	:	echo '
															<p style="color:#000;">Не выбрано действие</p>
															<p><a href="#" OnClick="history.back();">Назад</a></p>
														';
					
					case '1'	:	
									if(empty($checkbox)) {
										echo("You do not choose." . $checkbox = 0 . "<br /> ");
									} else {
										$N = count($checkbox);
										echo("Выделено $N записей:" . "<br /> ");
										for($i=0; $i < $N; $i++) {
											$check = $checkbox[$i];
											#echo("Line $i :" . $check ."<br /> ");
										//    echo($check . "<br /> ");
											#$iddel = substr($temp[$i], 0, 10); 
											#fwrite($file, $iddel . "\n"); //запись в файл ревизий выбранных на удаление строк        
											
											$sql2 = "UPDATE ".TABLE_COMMUNITIES." SET 
											".T_COMMUNITIES_ACTIVE."='0'
																				
											WHERE id=".$check;
											mysql_query($sql2) or die("Ошибка вставки" . mysql_error());
											
																	
											 
											
											} 
											if(!mysql_query($sql2))
												{$op = 'err';
													echo $op;
													echo mysql_error($link);
												} 
												else
													{
														echo '
															<p style="color:#000;">Сделано!</p>
															<p><a href="#" OnClick="history.back();">Назад</a></p>
														';
													}
										}
									break;
				}
				
					break;	
					
	}



	
		switch ($op)  
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
			   
			}  
		
	echo '</div>';

?>
