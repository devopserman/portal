<?php

$TITLE = MS_TOPICS;

				$op = $_GET['op'];  
				$id = $_GET['id'];
				$q  = $_POST['q'];

				$p = $_GET['p'];
				$s = $_POST['s'];

				if ($s==''){$s_label='';} else {$search = " AND ".T_USERS_USERNAME." LIKE '%".$s."%' "; $s_label='Поиск пользователей: <b><i>..'.$s.'..</i></b><hr class="hhr"/>';
				$s_label2='&nbsp;<span><a href="">X</a></span>';}
				
$qr_result = mysql_query("
	SELECT * FROM ".TABLE_USERS." 
	WHERE ".T_USERS_ACTIVE." = '1' ".$search." ORDER BY ".T_USERS_USERNAME." ASC") or die(mysql_error());
	
	
	$i=1;
	
	echo '<div class="block_white">
		<form method="POST" action="" align="right">
			<p>Поиск&nbsp;&nbsp;<input type="text" name="s" value="'.$_POST['s'].'"><input type="submit" name="ssb" value="Искать">'.$s_label2.'</p>
		</form>
	';
	echo $s_label;
	
		
	while($data = mysql_fetch_array($qr_result)){ 
	$num=$start+$i;
	
	#echo '<div class="b-img-radius" style="background: url(images/user_icon.png)"><img src="images/user_icon.png" /></div>';
		
	echo'
	</br>
			<table  border="'.VAR_BORDER.'" style="border-collapse: collapse; width: 100%;">
				<tbody>
					<tr>
						<td align="left" valign="top" style="width: 50px;">
							<p class="user_icon">
								<img src="images/user_icon.png" width="25px"/>
							</p>
						</td>
					
						<td valign="top" style="width: 70%;">
							<p class="caption"><a href="">'.nl2br($data[T_USERS_USERNAME]).'</a></p>
							<p><span class="greytext">Зарегистрирован — '.GetDateFormat_Today($data[T_USERS_DATETIMEREG]).' в '.GetTimeFormat_Hi($data[T_USERS_DATETIMEREG]).'</span>
							</p>
							<p>'.substr(nl2br($data[T_COMMUNITIES_NOTE]), 0, VAR_LENGTH_TRIM_NOTE).'</p>
						</td>
					
						<td align="center" valign="top" style="width: 260px;">
							<p class="caption">876543</p>
							<p><span class="greytext">подписчиков</span></p>
						</td>
					</tr>
				</tbody>
			</table>
	</br>
	
	
	
	
			
		<hr class="hhr"/>
	';	
	}
	echo '</div>';
mysql_query($query, $link);

mysql_close($link);
if(USER_LOGGED) {
}
?>
