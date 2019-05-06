<?php

$TITLE = MS_TOPICS;

				$op = $_GET['op'];  
				$id = $_GET['id'];
				$q  = $_POST['q'];
				
				$select = $_GET['select'];
				$getlid = $_GET['lid'];
				$getfirm = $_GET['firm'];
				$p = $_GET['p'];
				$c = $_GET['c'];

				if ($c == 'all'){
					$c_select = '';
				}
				else {
					if ($c >0){
						$c_select = ' AND '.T_TOPICS_COMMUNITY.'='.$c.' ';
					}
					else{
							$c_select = '';
					}
				}
				
				
$qr_result = mysql_query("
	SELECT * FROM ".TABLE_TOPICS." 
	WHERE ".T_TOPICS_ACTIVE." = '1' ".$c_select." ORDER BY ".T_TOPICS_DATETIME." DESC") or die(mysql_error());
	
	
	$i=1;
	
	while($data = mysql_fetch_array($qr_result)){ 
	$num=$start+$i;
	
													
	echo '<div class="block_white">
			<table border="0" style="border-collapse: collapse; width: 100%;">
				<tbody>
					<tr>
						<td style="width: 100%;">
							<table border="0" style="border-collapse: collapse; width: 100%; height: 18px;">
								<tbody>
									<tr style="height: 18px;">
										<td style="width: 22px; height: 18px;"><img src="'.GetCommunityInfo($data[T_TOPICS_COMMUNITY], T_COMMUNITIES_LOGO).'" width=20px /></td>
										<td style="width: auto; height: 18px;"><span class="community_small"><a href="index.php?c='.$data[T_TOPICS_COMMUNITY].'">'.strtoupper(GetCommunityInfo($data[T_TOPICS_COMMUNITY], T_COMMUNITIES_NAME)).'</a></span></td>
										<td style="width: 33.3333%; height: 18px;"></td>
									</tr>
								</tbody>
							</table>
									<p class="caption">'.nl2br($data[T_TOPICS_CAPTION]).'</p>
									<p class="note">'.replaceBBCode(substr(nl2br($data[T_TOPICS_MESSAGE]), 0, VAR_PREWIEV_LENGTH_TRIM_NOTE)).'</p>
									<p><a href="index.php?c='.$data[T_TOPICS_COMMUNITY].'&t='.$data[T_TOPICS_ID].'">Читать дальше...</a></p>
							<table border="0" style="border-collapse: collapse; width: 100%;">
								<tbody>
									<tr>
										<td style="width: 120px;"><span class="likies">1451</span> <a href=""><img width="12px" src="images/plus.png" /></a><span class="plusminus"> </span><a href=""><img width="12px" src="images/minus.png" /></a></td>
										<td style="width: auto;" align="right">
											<span class="greytext">
												'.MS_TO_WRITE.' 
													<a href="">'.GetUserINFO($data[T_TOPICS_AUTHOR], T_USERS_USERNAME).'</a>
													&nbsp;&nbsp;
													'.GetDateFormat_Today($data[T_TOPICS_DATETIME]).' '.MS_V.' '.GetTimeFormat_Hi($data[T_TOPICS_DATETIME]).'
													&nbsp;&nbsp;
													<a href="">'.MS_COMMENTS.' (123)</a>	
											</span></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	';	
	}
	
mysql_query($query, $link);

mysql_close($link);
if(USER_LOGGED) {
}
?>
