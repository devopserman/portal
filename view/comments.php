<?php


				$c = $_GET['c'];
				$t = $_GET['t'];
				
				$v = $_GET['v'];
				$p = $_GET['p'];
				$s = $_POST['s'];
				
				if ($_GET['p'] > 0) {$p = $_GET['p']-1; }	else{$p=0;}
				
				#$start = $p*VAR_COUNT_TOPICS_PER_PAGE;

				
			
		
			
				
				if (($t > 0) AND (GetTopicInfo($t, T_TOPICS_ACTIVE) == 1)) {
					
				
							
							$sql = "
								SELECT * FROM ".TABLE_COMMENTS." 
								WHERE ".T_COMMENTS_TOPIC." = ".$t." AND ".T_COMMENTS_ACTIVE."=1  ";
				
				
				
					
			
				$qr_result = mysql_query($sql) or die(mysql_error());
	
				$count = mysql_num_rows(mysql_query($sql));
				

				}
				#else {echo '<p>Запрошенная тема не найдена.</p>';}
	
	if ($count == 0){
		echo '<div class="block_white">Ваш комментарий может быть первым.</div>';
	}
	
	 while($data = mysql_fetch_array($qr_result)){ 
	
	$cc=$data[T_COMMENTS_ID];
													
/* 	echo '<div class="block_comment">
			<p class="note">
				
				
				<span class="greytext"><a href="">'.GetUserInfo($data[T_COMMENTS_USER], T_USERS_USERNAME).'</a> 
				'.GetDateFormat_Today($data[T_COMMENTS_DATETIME]).' в '.GetTimeFormat_Hi($data[T_COMMENTS_DATETIME]).'</span></p>
			<p class="note">'.replaceBBCode(substr(nl2br($data[T_COMMENTS_MESSAGE]), 0, VAR_PREWIEV_LENGTH_TRIM_NOTE)).'</p>
			<div>
			<span class="likies">'.$data[T_COMMENTS_RAITING].'</span>'; 
			
			# Проверка голосовал ли юзер
										$ur = CheckRateComment($UserID, $data[T_COMMENTS_ID]);
										if ( $ur == '') {
											echo '
											<a href="index.php?c='.$c.'&t='.$t.'&v='.TCC_V_PLUS.'&id='.$data[T_COMMENTS_ID].'"><img width="12px" src="images/plus.png" /></a>
											<a href="index.php?c='.$c.'&t='.$t.'&v='.TCC_V_MINUS.'&id='.$data[T_COMMENTS_ID].'"><img width="12px" src="images/minus.png" /></a>
											';
										}
										else {echo ' '.Rated($ur);}
			
				
			
											
	echo '</div></div>
	
	';	 */
	
		echo '<div class="block_comment">
			<p class="note">
				<table border="'.VAR_BORDER.'" style="border-collapse: collapse; width: 100%;">
					<tbody>
						<tr>
							<td style="width: auto;">
								
									<span class="greytext"><a href="">'.GetUserInfo($data[T_COMMENTS_USER], T_USERS_USERNAME).'</a> 
									'.GetDateFormat_Today($data[T_COMMENTS_DATETIME]).' в '.GetTimeFormat_Hi($data[T_COMMENTS_DATETIME]).'</span>
								
							</td>
							<td style="width: 200px;" align="right">';
											
											# Модерирование поста
										if (CheckUserRights($UserID, 'c', $data[T_TOPICS_COMMUNITY]) == '1') { 
											echo '<input type="checkbox" name="checkbox[]" value="'.$data[T_TOPICS_ID].'" />';
											echo '
											<label for="press'.$data[T_TOPICS_ID].'"><img src="images/arrowdown.jpg" width="12px" /></label>
												<div class="spoiler">
													<input type="checkbox" id="press'.$data[T_TOPICS_ID].'" style="display: none;">
													<div class="block">
														<span class="moder_text">
																	<ul class="boxshow" align="left" >
																		<li>IP : '.$data[T_TOPICS_IP].' </li>
																		<li><a href="index.php?c='.$c.'&t='.$t.'&v=ccedit&id='.$data[T_COMMENTS_ID].'">Редактировать</a></li>
																		<li><a href="index.php?c='.$c.'&t='.$t.'&v=ccdel&id='.$data[T_COMMENTS_ID].'">Удалить</a></li>
																		<li><a href="index.php?c='.$c.'&t='.$t.'&v=ccban&id='.$data[T_COMMENTS_ID].'">Бан</a></li>
																	</ul>
																</span>
													</div>
												</div>
												';
										}
										# Конец модерирования поста
											
											echo '</td>
						</tr>
					</tbody>
				</table>
				</p>
				
			<p class="note">'.replaceBBCode(nl2br($data[T_COMMENTS_MESSAGE])).'</p>
			<div>
			';
			if ($data[T_COMMENTS_RAITING] >= 0) {
				echo '<span class="likies">'.$data[T_COMMENTS_RAITING].'</span>';}
			else {echo '<span class="dislikies">'.$data[T_COMMENTS_RAITING].'</span>';}
			
			# Проверка голосовал ли юзер
										$ur = CheckRateComment($UserID, $data[T_COMMENTS_ID]);
										if ( $ur == '') {
											echo '
											<a href="index.php?c='.$c.'&t='.$t.'&v='.TCC_V_PLUS.'&id='.$data[T_COMMENTS_ID].'"><img width="12px" src="images/plus.png" /></a>
											<a href="index.php?c='.$c.'&t='.$t.'&v='.TCC_V_MINUS.'&id='.$data[T_COMMENTS_ID].'"><img width="12px" src="images/minus.png" /></a>
											';
										}
										else {echo ' '.Rated($ur);}
			
				
			
											
	echo '</div></div>
	
	';	
	
	} 
	
	
	#pages
	#echo GetPages($p, VAR_COUNT_TOPICS_PER_PAGE, $count);
	
	#echo $sql." LIMIT ".$start. ",".VAR_COUNT_TOPICS_PER_PAGE;
	
#mysql_query($query, $link);

#mysql_close($link);

?>
