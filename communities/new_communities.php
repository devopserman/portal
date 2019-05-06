<?php

	
	$c =  $_GET['c'];
	$v =  $_GET['v'];
	$u =  $_GET['u'];
	$p =  $_GET['p'];

if(!USER_LOGGED) {
echo'
	<div class="block_white">
	<p class="caption">Регистрация сообщества</p>
	<p>Нужно быть зарегистрированным пользователем, чтобы создать сообщество.</p>
	</div>
	';
}
else{


echo'
	<div class="block_white" >
		<p class="caption">Регистрация сообщества</p>
		<p>Всякие правила, и т.д.</p>
		
		<div>
			<form method="post" action="index.php?c='.$c.'&v='.CAT_REGFINISH.'">
					
						<p>Краткое название сообщества латинскими буквами (A-z,0-9,-_):</br><input type="text" name="c_name"></p>
						<p>Полное название сообщества:</br><input type="text" name="c_comment"></p>
						<p>Ссылка на логотип:</br><input type="text" name="c_logo"></p>
						<p>Описание:</br>
						<textarea id="editor" cols="60" rows="5" name="c_note"></textarea>
						
						<p><input type="submit" name="reg" value="Подтвердить"></p>					
			</form>
		</div>
	</div>
					
				


';
}	
?>