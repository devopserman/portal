﻿<?php

				$c = $_GET['c'];
				$v = $_GET['v'];
				$p = $_GET['p'];
				$s = $_POST['s'];
				
				
				/* if (GetCommunityInfo($c,T_COMMUNITIES_ID) > 0){
					
				} */
				
				if ($c == CU_ALL){
					
					switch $v {
						case C_V_LIST		:
											include "communities/list.php"
						case C_V_POP		:
								
						case C_V_NEW		:
								
						case C_V_TRASH		:
								
						case C_V_DEL		:
								
						default				:
						
					}
					
				}
				
	#			"
	#SELECT * FROM ".TABLE_COMMUNITIES." 
	#WHERE ".T_COMMUNITIES_ACTIVE." = '1' ".$search." ORDER BY ".T_COMMUNITIES_DATETIMEREG." DESC LIMIT ".$start. ", ".VAR_COUNT_COMMUNITIES_PER_PAGE
				
/* $qr_result = mysql_query($query) or die(mysql_error());
	$all_q = mysql_num_rows(mysql_query("SELECT * FROM ".TABLE_COMMUNITIES." 	WHERE ".T_COMMUNITIES_ACTIVE." = '1' ".$search." ORDER BY ".T_COMMUNITIES_DATETIMEREG." DESC "));
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
	</br>
			<table  border="'.VAR_BORDER.'" style="border-collapse: collapse; width: 100%;">
				<tbody>
					<tr>
						<td align="left" valign="top" style="width: 50px;">
							<img src="'.$data[T_COMMUNITIES_LOGO].'" width="25px"/>
						</td>
					
						<td valign="top" style="width: 70%;">
							<p class="caption"><a href="index.php?c='.$data[T_COMMUNITIES_ID].'">'.nl2br($data[T_COMMUNITIES_COMMENT]).'</a></p>
							<p><span class="c_marker"><a href="">'.nl2br($data[T_COMMUNITIES_NAME]).'</a></span> <span class="greytext">владелец — <a href="">'.GetUserINFO($data[T_COMMUNITIES_AUTHOR], T_USERS_USERNAME).'</a></span>
							</p>
							<p>'.replaceBBCode(substr(nl2br($data[T_COMMUNITIES_NOTE]), 0, VAR_LENGTH_TRIM_NOTE)).'</p>
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
	
	$allpage = floor($all_q / VAR_COUNT_COMMUNITIES_PER_PAGE);
	if (($allpage*VAR_COUNT_COMMUNITIES_PER_PAGE)<$all_q){
		$allpage=$allpage+1;
	}
	#echo $allpage;
	$links='index.php?cat='.$cat.'&op='.$op;
	
		$i=1;
	for($i=1;$i<=$allpage;$i++) {
		echo '&nbsp;';
			if (($i-1)==$p){echo '<span class="numpage_selected">'.$i.'</span>';}
			else{
				echo '<span class="numpage"><a href="'.$links.'&p='.($i).'">'.$i."</a></span>";
	}			}
	
	;
	
	echo '</div>';
	
	#echo GetIP();

mysql_query($query, $link);

mysql_close($link);
if(USER_LOGGED) {
} */
?>
