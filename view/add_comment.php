<?php
	$c =  $_GET['c'];
	$v =  $_GET['v'];
	$t =  $_GET['t'];
	$u =  $_GET['u'];
	$p =  $_GET['p'];
if(USER_LOGGED) {
echo'
			<div>
				<div>
					<form method="post" action="index.php?c='.$c.'&t='.$t.'&v=set_new_comment">
								<textarea id="editor" cols="60" rows="5" name="c_note"></textarea>
								<p><input type="submit" name="new_comment" value="Опубликовать"></p>					
							
					</form>
				</div>
			</div>
			';
}
else {
	echo '<p class="note_grey">Чтобы оставлять комментарии необходимо войти или <a href="/index.php?cat=reg">зарегистрироваться</a>.</p>';
 
}	
				
	

?>
