<?php
session_start();

include ("auth.php");
	

echo '
Действие с выделенными: <SELECT name="act" ><option value="0"></option>';
							echo '
							<option value="1">Удалить</option>
							<option value="2">Заблокировать пользователя</option>
							<option value="3">Удалить и заблокировать</option>
							</select>';
							echo '<input type="submit" value="Применить">';
							echo '</div> 
';
	
	
?>