<?php

$cat = $_GET[cat];

if (($cat<> CAT_REGFINISH) AND ($cat <> CAT_REG)){
echo '<div align="right">

    
		<form method="POST" action="'.$_SERVER['PHP_SELF'].'">
				<p>
					<p>Имя&nbsp;&nbsp;<input type="text" name="user"></p>
					<p>Пароль&nbsp;&nbsp;<input type="password" name="pass"></p>
					<p><a href="index.php?cat=reg">Регистрация</a>&nbsp;&nbsp;&nbsp;<input type="submit" name="login" value="Войти"></p>					
				</p>
		</form>

</div>'; 
}


?>