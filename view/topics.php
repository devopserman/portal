<?php


				$c = $_GET['c'];
				$v = $_GET['v'];
				$p = $_GET['p'];
				$s = $_POST['s'];
				
				if ($_GET['p'] > 0) {$p = $_GET['p']-1; }	else{$p=0;}

				
				
				$start = $p*VAR_COUNT_TOPICS_PER_PAGE;

				if (($c == CU_ALL) OR ($c == C_SUBS)){
					$c_select = '';
				}
				
				# проверить подписки CheckUserSubscribe
				
				if ((GetCommunityInfo($c, T_COMMUNITIES_ID) > 0) AND (GetCommunityInfo($c, T_COMMUNITIES_ACTIVE) == 1)) {
					$c_select = ' AND '.T_TOPICS_COMMUNITY.' = '.$c.' ';
				}
				else{
						$c_select = '';
				}
				
				if (!isset($c)){
					$c = CU_ALL;
				}
				if (!isset($v)){
					$v = C_V_NEW;
				}
				
				
				
			if (isset($c)){	
				switch ($v) {
					case C_V_POP		:	$vselect = T_TOPICS_ACTIVE." = '1' AND ".T_TOPICS_RAITING." >= '".VAR_RAITING_POP."' ";		
											break;
					case C_V_NEW		: 	$vselect = T_TOPICS_ACTIVE." = '1' AND ".T_TOPICS_RAITING." >= '".VAR_RAITING_NEW."' ";
											break;
					case C_V_BEST		:	$vselect = T_TOPICS_ACTIVE." = '1' AND ".T_TOPICS_RAITING." >= '".VAR_RAITING_BEST."' ";		
											break;
					case C_V_TRASH		:	$vselect = T_TOPICS_ACTIVE." = '1' AND ".T_TOPICS_RAITING." <= '".VAR_RAITING_TRASH."' ";		
											break;
					case C_V_DEL		:	$vselect = T_TOPICS_ACTIVE." = '0' ";		
											break;	
					#default				:	$vselect = T_TOPICS_ACTIVE." = '1' ";
					#						break;	
					
				}
				
			}
				if (($v > 0) AND (GetTopicInfo($v, T_TOPICS_ACTIVE) == 1)) {
					$vselect = T_TOPICS_ID." = ".$v." ";
				}
				
				
							
				$sql = "
	SELECT * FROM ".TABLE_TOPICS." 
	WHERE ".$vselect." ".$c_select." ORDER BY ".T_TOPICS_DATETIME." DESC ";
				
				
				
			include("menu_t.php");	
			
	$qr_result = mysql_query($sql." LIMIT ".$start. ",".VAR_COUNT_TOPICS_PER_PAGE) or die(mysql_error());
	
	$count = mysql_num_rows(mysql_query($sql));


	
	if ($count == 0){
		echo '<div class="block_white">Ничего не найдено.</div>';
	}
	
	while($data = mysql_fetch_array($qr_result)){ 
	
										
		echo '<div class="block_white"><a name="'.$data[T_COMMUNITIES_ID].'"></a>
			<table border="0" style="border-collapse: collapse; width: 100%;">
				<tbody>
					<tr>
						<td style="width: 100%;">';
						#if ($c > 0) {
							echo '<table border="0" style="border-collapse: collapse; width: 100%; height: 18px;">
								<tbody>
									<tr style="height: 18px;">
										<td style="width: 22px; height: 18px;">';
										
										
										
										echo '<img src="'.GetCommunityInfo($data[T_TOPICS_COMMUNITY], T_COMMUNITIES_LOGO).'" width=20px /></td>
										<td style="width: auto; height: 18px;"><span class="community_small"><a href="index.php?c='.$data[T_TOPICS_COMMUNITY].'">'.strtoupper(GetCommunityInfo($data[T_TOPICS_COMMUNITY], T_COMMUNITIES_NAME)).'</a></span></td>
										<td style="width: 33.3333%; height: 18px;" align="right">
										';
										# Модерирование поста
										if (CheckUserRights($UserID, 'c', '1') == '1') {
											echo '<input type="checkbox" name="checkbox[]" value="'.$data[T_TOPICS_ID].'" />';
											include ("groupselect.php");
										}
										# Конец модерирования поста
										
										echo '</td>
									</tr>
								</tbody>
							</table>';
						#}
							echo '		<p class="caption">'.nl2br($data[T_TOPICS_CAPTION]).'</p>
									<p class="note">'.replaceBBCode(substr(nl2br($data[T_TOPICS_MESSAGE]), 0, VAR_PREWIEV_LENGTH_TRIM_NOTE)).'</p>
									<p><a href="index.php?c='.$data[T_TOPICS_COMMUNITY].'&t='.$data[T_TOPICS_ID].'">Читать дальше...</a></p>
									<div class="post-bottom">
							<table border="0" style="border-collapse: collapse; width: 100%;">
								<tbody>
									<tr>
										<td style="width: 120px;">
										';
										if ($data[T_TOPICS_RAITING] >= 0) {
											echo '<span class="likies">'.$data[T_TOPICS_RAITING].'</span>';}
										else {echo '<span class="dislikies">'.$data[T_TOPICS_RAITING].'</span>';}
										
										
										# Проверка голосовал ли юзер
										$ur = CheckRateTopic($UserID, $data[T_COMMUNITIES_ID]);
										if ( $ur == '') {
											echo '
											<a href="index.php?c='.$data[T_TOPICS_COMMUNITY].'&t='.$data[T_COMMUNITIES_ID].'&v='.T_V_PLUS.'"><img width="12px" src="images/plus.png" /></a>
											<a href="index.php?c='.$data[T_TOPICS_COMMUNITY].'&t='.$data[T_COMMUNITIES_ID].'&v='.T_V_MINUS.'"><img width="12px" src="images/minus.png" /></a>
											';
										}
										else {echo ' '.Rated($ur);}
										
										echo '
										</td>
										<td style="width: auto;" align="right">
											<span class="greytext">
												'.MS_TO_WRITE.' 
													<a href="#">'.GetUserINFO($data[T_TOPICS_AUTHOR], T_USERS_USERNAME).'</a>
													&nbsp;&nbsp;
													'.GetDateFormat_Today($data[T_TOPICS_DATETIME]).' '.MS_V.' '.GetTimeFormat_Hi($data[T_TOPICS_DATETIME]).'
													&nbsp;&nbsp;
													<a href="index.php?c='.$data[T_TOPICS_COMMUNITY].'&t='.$data[T_TOPICS_ID].'">'.MS_COMMENTS.' ('.$data[T_TOPICS_COMMENTS].')</a>	
											</span></td>
									</tr>
								</tbody>
							</table>
							 </div> 	 
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		';	

	}
	
	
	#pages
	
	echo GetPages($p, VAR_COUNT_TOPICS_PER_PAGE, $count);
	
	# Модерирование поста
	if ($count > 0){
	
										if (CheckUserRights($UserID, 'c', $data[T_TOPICS_COMMUNITY]) == '1') {
											
											echo '<div class="block_white" align="right">';
											include ("groupdoing.php");
											echo '</form>';
										}
										# Конец модерирования поста
	}
	
mysql_query($query, $link);

mysql_close($link);
?>
