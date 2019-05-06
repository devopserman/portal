<?php

session_start();

include ("auth.php");

				$c = $_GET['c'];
				$t = $_GET['t'];
				
				$v = $_GET['v'];
				$p = $_GET['p'];
				$s = $_POST['s'];
				
				if ($_GET['p'] > 0) {$p = $_GET['p']-1; }	else{$p=0;}
				
				#$start = $p*VAR_COUNT_TOPICS_PER_PAGE;

				
			
		
			
				
				if (($t > 0) AND (GetTopicInfo($t, T_TOPICS_ACTIVE) == 1)) {
					
				
							
							$sql = "
								SELECT * FROM ".TABLE_TOPICS." 
								WHERE ".T_TOPICS_ID." = ".$t."  LIMIT 1 ";
				
				
				
					include("menu_t.php");	
			
				$qr_result = mysql_query($sql) or die(mysql_error());
	
				#$count = mysql_num_rows(mysql_query($sql));
				

				}
				#else {echo '<p>Запрошенная тема не найдена.</p>';}
	
	#if ($count == 0){
	#	echo '<div class="block_white">Ничего не найдено.</div>';
	#}
	#echo $sql;
	 while($data = mysql_fetch_array($qr_result)){ 
	
	
													
	echo '<div class="block_white"><a name="'.$data[T_COMMUNITIES_ID].'"></a>
			<table border="0" style="border-collapse: collapse; width: 100%;">
				<tbody>
					<tr>
						<td style="width: 100%;">
							<!--<table border="0" style="border-collapse: collapse; width: 100%; height: 18px;">
								<tbody>
									<tr style="height: 18px;">
										<td style="width: 22px; height: 18px;"><img src="'.GetCommunityInfo($data[T_TOPICS_COMMUNITY], T_COMMUNITIES_LOGO).'" width=20px /></td>
										<td style="width: auto; height: 18px;"><span class="community_small"><a href="index.php?c='.$data[T_TOPICS_COMMUNITY].'">'.strtoupper(GetCommunityInfo($data[T_TOPICS_COMMUNITY], T_COMMUNITIES_NAME)).'</a></span></td>
										<td style="width: 33.3333%; height: 18px;"></td>
									</tr>
								</tbody>
							</table>-->
							
									<p class="caption">'.nl2br($data[T_TOPICS_CAPTION]).'</p>
									<p class="note">'.replaceBBCode(nl2br($data[T_TOPICS_MESSAGE])).'</p>
									
									
									
								<div class="post-bottom">
							<table border="'.VAR_BORDER.'" style="border-collapse: collapse; width: 100%;">
								<tbody>
									<tr>
										<td style="width: 120px;">
										';
										if ($data[T_TOPICS_RAITING] >= 0) {
											echo '<span class="likies">'.$data[T_TOPICS_RAITING].'</span>';}
										else {echo '<span class="dislikies">'.$data[T_TOPICS_RAITING].'</span>';}
										
										
										# Проверка голосовал ли юзер
										$ur = CheckRateTopic($UserID, $t);
										if ( $ur == '') {
											echo '
											<a href="index.php?c='.$c.'&t='.$t.'&v='.T_V_PLUS.'"><img width="12px" src="images/plus.png" /></a>
											<a href="index.php?c='.$c.'&t='.$t.'&v='.T_V_MINUS.'"><img width="12px" src="images/minus.png" /></a>
											';
										}
										else {echo ' '.Rated($ur);}
										
									echo'</td>
											<td style="width: auto;" align="right">
											<span class="greytext">
												'.MS_TO_WRITE.' 
													<a href="#">'.GetUserINFO($data[T_TOPICS_AUTHOR], T_USERS_USERNAME).'</a>
													&nbsp;&nbsp;
													'.GetDateFormat_Today($data[T_TOPICS_DATETIME]).' '.MS_V.' '.GetTimeFormat_Hi($data[T_TOPICS_DATETIME]).'
													&nbsp;&nbsp;
													<a href="#">'.MS_COMMENTS.' ('.$data[T_TOPICS_COMMENTS].')</a>	
										';
											
											# Модерирование поста
										if (CheckUserRights($UserID, 'c', $data[T_TOPICS_COMMUNITY]) == '1') { 
											echo '</td><td>';
											include ("groupselect.php");
										}
										# Конец модерирования поста
											
											echo '
											</span>
											
											
											</td>
									</tr>
								</tbody>
							</table>
							 </div>
							
							';
							
							if ($data[T_TOPICS_CLOSE_COMMENTS] == 1){
								echo '<p class="note_grey">Комментарии закрыты автором.</p>';
							}
							else {
								echo '<h4>Комментарии</h4>';
								include ("view\add_comment.php");
								include ("view\comments.php");								
							}
							
							echo '
							
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	';	
	} 
	
		# Модерирование поста
										if (CheckUserRights($UserID, 'c', $data[T_TOPICS_COMMUNITY]) == '1') {
											
											echo '<div class="block_white" align="right">';
											include ("groupdoing.php");
											echo '</form>';
										}
										# Конец модерирования поста
	#pages
	#echo GetPages($p, VAR_COUNT_TOPICS_PER_PAGE, $count);
	
	#echo $sql." LIMIT ".$start. ",".VAR_COUNT_TOPICS_PER_PAGE;
	
mysql_query($query, $link);

mysql_close($link);

?>
