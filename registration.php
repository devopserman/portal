<?php

if(USER_LOGGED) {
echo'
	<div class="block_white">
	<p class="caption">Регистрация</p>
	<p>Вы уже зарегистрированы на этом ресурсе.</p>
	</div>
	';
}
else{


echo'
	<div class="block_white" >
		<p class="caption">Регистрация</p>
		<p>Всякие правила, и т.д.</p>
		
		<div>
			<form method="post" action="index.php?cat=regfinish">
					
						<p>Имя</br><input type="text" name="username"></p>
						<p>E-mail</br><input type="text" name="email"></p>
						<p>Пароль</br><input type="password" name="pass"></p>
						<p>Повторите пароль</br><input type="password" name="pass2"></p>
						
						<p><input type="submit" name="reg" value="Подтвердить"></p>					
					
			</form>
		</div>
	</div>
					
				


';
}	
?>