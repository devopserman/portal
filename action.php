<?php
session_start();
#users

$cat = $_GET['cat'];	
$op = $_GET['op'];  

echo '<div class="block_white">
		<p class="caption">Регистрация</p>';

if (isset($_GET['id']) && is_numeric($_GET['id'])){$id = $_GET['id']; } else {$id = NULL;}

	switch ($cat) 
	{ 

		case 'regfinish' :
				mysql_select_db($dbname, $link);	
			
				$username = CheckStr($_POST['username']); 
				$email = CheckStr($_POST['email']);
				$pass = ($_POST['pass']);
				$pass2 = ($_POST['pass']);
				
				$f1 = 0;
				$f2 = 0;
				$f3 = 0;
				$f4 = 0;
				$f5 = 0;
				$f6 = 0; 
				
				
				#username
				if ($username == ""){$f1=0; echo '<p style="color:#f00;">Не указано имя пользователя.</p>';} else {$f1=1;}
				if (GetUserId($username) > 0){$f2=0; echo '<p style="color:#f00;">Пользователь с таким ником уже существует.</p>';} else {$f2=1;}
				# e-mail
				if (($email <> "") AND (filter_var($email, FILTER_VALIDATE_EMAIL))) {$f3=1;} else { 
				#если $f3=0, то email обязателен
				$f3=1; echo '<p style="color:#f00;">E-mail адрес <b>'.$email.'</b> указан не верно.';}
				if (GetEmailId($email) > 0){$f6=0; echo '<p style="color:#f00;">Пользователь с таким e-mail уже существует.</p>';} else {$f6=1;}		
				# pass empty
				if (!empty($pass)){$f4 = 1;} 
				else {
					$f4 = 0; 
					echo '<p style="color:#f00;">Пароль не может быть пуст.</p>';
				}
				
				#pass <> pass2
				if ($pass == $pass2){$f5=1;} 
				else {
					$f5=0;
					echo '<p style="color:#f00;">Пароли не совпадают.</p>';
				}
				
				
				
				
				if (($f1==1) AND ($f2==1) AND ($f3==1) AND ($f4==1) AND ($f5==1)) {
					$datereg = date('Y-m-d H:i:s');
					$ip = GetIP();

				$sql = 'INSERT INTO '.TABLE_USERS.' ('.T_USERS_ACTIVE.', '.T_USERS_LOGIN.', '.T_USERS_USERNAME.', '.T_USERS_PASSWORD.', '.T_USERS_DATETIMEREG.',  '.T_USERS_IP.', '.T_USERS_EMAIL.', '.T_USERS_ROLE.' ) 
				VALUES("1", "'.$username.'", "'.$username.'", "'.md5($pass).'", "'.$datereg.'", "'.$ip.'", "'.$email.'", "'.VAR_DEFAULT_ROLE.'")';
				 if(!mysql_query($sql))
				{$op = 'err';
				#echo mysql_errno($link) . ": " . mysql_error($link) . "\n";
				} 
					else
					{
						echo '
							<p style="color:#000;">Учетная запись успешно создана.</p>
							<p><a href="index.php">Вернуться на главную станицу и войти</a></p>
						';
					}
				}
				else { 
					#echo '<font color="red">Поле со звездочкой* должно быть заполнено!</font>';	
				}
				mysql_query($query, $link);
				mysql_close($link);
			break;
		
		
			

}

if (($f1 != 1) OR ($f2 != 1) OR($f3 != 1) OR($f4 != 1) OR($f5 != 1) OR($f6 != 1)){
	echo '<p><a href="#" OnClick="history.back();">Назад</a></p>';	
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
