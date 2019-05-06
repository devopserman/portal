<?php


				$c = $_GET['c'];
				$v = $_GET['v'];
				$p = $_GET['p'];
				$s = $_POST['s'];
				
				$search ='';
				if ($s==''){$s_label='';} else {$search = " AND ".T_COMMUNITIES_COMMENT." LIKE '%".$s."%' "; $s_label='Поиск сообществ: <b><i>..'.$s.'..</i></b><hr class="hhr"/>';
				$s_label2='&nbsp;<span><a href="">X</a></span>';}
				
				if ($p > 0) {$p = $p-1; }	else{$p=0;}
				
				$start = $p*VAR_COUNT_COMMUNITIES_PER_PAGE;
				
				if (($c == CU_ALL) AND (($v == C_V_LIST) OR ($v == ''))){
					
					
											$sql = "SELECT * FROM ".TABLE_COMMUNITIES." 
													 WHERE ".T_COMMUNITIES_ACTIVE." = '1' ".$search." ORDER BY ".T_COMMUNITIES_SUBS." DESC ";
						
				
			
$qr_result = mysql_query($sql." LIMIT ".$start. ", ".VAR_COUNT_COMMUNITIES_PER_PAGE) or die(mysql_error());
	$count = mysql_num_rows(mysql_query($sql));
	
	#echo $all_q;
	$i=1;
	
	echo '<div class="block_white">
		<form method="POST" action="" align="right">
			<p>Поиск&nbsp;&nbsp;<input type="text" name="s" value="'.$_POST['s'].'"><input type="submit" name="ssb" value="Искать">'.$s_label2.'</p>
		</form>
	';
	echo $s_label;
	
						while($data = mysql_fetch_array($qr_result)){ 
						$num=$start+$i;
						
																		
						echo'
						</br><form method="POST" action="index.php?c='.CU_ALL.'&v=groupaction" align="right">
								<table  border="'.VAR_BORDER.'" style="border-collapse: collapse; width: 100%;">
									<tbody>
										<tr>
											<td align="left" valign="top" style="width: 50px;">
												<img src="'.$data[T_COMMUNITIES_LOGO].'" width="25px"/> ';
												
												if (GetUserInfo($UserID, T_USERS_ROLE) >= VAR_MODERATOR_ROLE) {
													echo '<input type="checkbox" name="checkbox[]" value="'.$data[T_COMMUNITIES_ID].'" />';
												}
												
												echo'
											</td>
										
											<td valign="top" style="width: 70%;">
												<p class="caption"><a href="index.php?c='.$data[T_COMMUNITIES_ID].'">'.nl2br($data[T_COMMUNITIES_COMMENT]).'</a></p>
												<p><span class="c_marker"><a href="index.php?c='.$data[T_COMMUNITIES_ID].'">'.nl2br($data[T_COMMUNITIES_NAME]).'</a></span> <span class="greytext">владелец — <a href="">'.GetUserINFO($data[T_COMMUNITIES_AUTHOR], T_USERS_USERNAME).'</a></span>
												</p>
												<p>'.replaceBBCode(substr(nl2br($data[T_COMMUNITIES_NOTE]), 0, VAR_LENGTH_TRIM_NOTE)).'</p>
											</td>
										
											<td align="center" valign="top" style="width: 260px;">
												<p class="caption">'.$data[T_COMMUNITIES_SUBS].'</p>
												<p><span class="greytext">подписчиков</span></p>
												';
												if(USER_LOGGED) {
												if (CheckUserSubscribe($UserID, $data[T_COMMUNITIES_ID])>0) {
													echo '<p><span class="greytext">Подписка оформлена</span></p>';
											
												}
												else{
												echo '<p><span class="button_blue"><a href="index.php?c='.$data[T_COMMUNITIES_ID].'&v='.VAR_C_SUBSCRIBE.'">Подписаться</a></span></p>';
												}
												}
												
											echo '</td>
										</tr>
									</tbody>
								</table>
						</br>
						
						
						
						
								
							<hr class="hhr"/>
						';	
						
						}
	
	
						
						
												
						
						echo '</div>';
						
						#pages
						echo GetPages($p+1, VAR_COUNT_COMMUNITIES_PER_PAGE, $count);

						if (GetUserInfo($UserID, T_USERS_ROLE) >= VAR_MODERATOR_ROLE) {
							echo '<div class="block_white" align="right">';
							
							echo 'Действие с выделенными: <SELECT name="act" ><option value="0"></option>';
							echo '<option value="1">Заблокировать</option>
							</select>';
							echo '<input type="submit" value="Применить">';
							echo '</div> </form>
							';
						}
						
					mysql_query($query, $link);
				}
mysql_close($link);



if(USER_LOGGED) {
}
?>
