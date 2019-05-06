<?php
session_start();

include ("auth.php");

# VAR
$important_style = 'style="border:1px solid #FF6666;"';

#user IP
function GetIP (){
	$ip = $_SERVER['REMOTE_ADDR'];
	return $ip;
}

# Вычисляем возраст человека
function calculate_age($birthday) {
  $birthday_timestamp = strtotime($birthday);
  $age = date('Y') - date('Y', $birthday_timestamp);
  if (date('md', $birthday_timestamp) > date('md')) {
    $age--;
  }
  return $age;
}

# Проверка строки
function CheckStr($str){
	$res = htmlspecialchars($str, ENT_COMPAT, 'windows-1251');
	return $res;
}

# Проверка строки только ENG
function CheckStrENG($str){
	
	if (preg_match("#^[aA-zZ0-9\-_]+$#",$str)){
		$res = htmlspecialchars($str, ENT_COMPAT, 'windows-1251');
	}
	else {
		$res="";
	}
	return $res;
}

# Получаем ID
function GetCommunityId($value) {
	if ($value<>"")
	{		
		$res = mysql_result(mysql_query("SELECT ".T_COMMUNITIES_ID." FROM ".TABLE_COMMUNITIES." WHERE ".T_COMMUNITIES_NAME."='".$value."' LIMIT 1"),0);
	}
	else
	{
			$res = 0;
	}
	return $res;
}

# Получаем ID email по email
function GetEmailId($value) {
	if ($value<>"")
	{		
		$result = mysql_query("SELECT uid FROM ".TABLE_USERS." WHERE ".T_USERS_EMAIL."='".$value."' LIMIT 1");
		if ($result){
			$res = @mysql_result($result,0);
		}
		else {$res = 0;}
	}
	else
	{
			$res = 0;
	}
	return $res;
}

# Получаем ID юзера по имени
function GetUserId($value) {
	if (isset($value))
	{	
		$result = mysql_query("SELECT uid FROM ".TABLE_USERS." WHERE ".T_USERS_USERNAME."='".$value."' LIMIT 1");
		if ($result){
			$res = @mysql_result($result,0);
		}
		else {$res = 0;}
	}
	else
	{
			$res = 0;
	}
	return $res;
}

# Получаем INFO юзера по ID
function GetUserInfo($id,$value) {
	if (($id >0) AND ($value<>""))
	{		
		$res = mysql_result(mysql_query("SELECT ".$value." FROM ".TABLE_USERS." WHERE ".T_USERS_UID."=".$id." LIMIT 1"),0);
	}
	else
	{
			$res = "";
	}
	return $res;
}

# Получаем INFO топика по ID
function GetTopicInfo($id,$value) {
	if (($id >0) AND ($value<>""))
	{		
		$res = mysql_result(mysql_query("SELECT ".$value." FROM ".TABLE_TOPICS." WHERE ".T_TOPICS_ID."=".$id." LIMIT 1"),0);
	}
	else
	{
			$res = "";
	}
	return $res;
}

# Получаем INFO сообщества по ID
function GetCommunityInfo($id,$value) {
	if (($id >0) AND ($value<>""))
	{		
		$res = mysql_result(mysql_query("SELECT ".$value." FROM ".TABLE_COMMUNITIES." WHERE ".T_COMMUNITIES_ID."=".$id." LIMIT 1"),0);
	}
	else
	{
			$res = "";
	}
	return $res;
}

# Получаем INFO комментария по ID
function GetCommentInfo($id,$value) {
	if (($id >0) AND ($value<>""))
	{		
		$res = mysql_result(mysql_query("SELECT ".$value." FROM ".TABLE_COMMENTS." WHERE ".T_COMMENTS_ID."=".$id." LIMIT 1"),0);
	}
	else
	{
			$res = "";
	}
	return $res;
}


# Вывод голоса
function Rated($rate) {
	switch ($rate){
		case '+' : $res = '<span class="ratedlike">+</span>'; break;
		case '-' : $res = '<span class="rateddislike">–</span>'; break;
		default : $res = '';
	}
	return $res;
}
# Получаем голос юзера за топик tid
function CheckRateTopic($author,$tid) {
	
	if (($author > 0) AND ($tid > 0))
	{		
		$sql = 	"SELECT rate FROM ".TABLE_RATE_TO_TOPICS." WHERE ".T_RATE_T_AUTHOR."=".$author." AND ".T_RATE_T_TOPIC."=".$tid." LIMIT 1";
		$r = mysql_query($sql);

		if (mysql_num_rows($r)!=0) {
			
			$res = mysql_result($r,0);
		}
		else {
			$res = '';
		}
	}
	else
	{
			$res = '';
	}
	return $res;
}

# Получаем количество голосов юзера за комментарий cid
function CheckRateComment($author,$cid) {	
	if (($author > 0) AND ($cid > 0))
	{		
		$sql = 	"SELECT rate FROM ".TABLE_RATE_TO_COMMENTS." WHERE ".T_RATE_C_AUTHOR."=".$author." AND ".T_RATE_C_COMMENT."=".$cid." LIMIT 1";
		$r = mysql_query($sql);

		if (mysql_num_rows($r)!=0) {
			
			$res = mysql_result($r,0);
		}
		else {
			$res = '';
		}
	}
	else
	{
			$res = '';
	}
	return $res;
}

# Получаем количество голосов юзера за комментарий cid
function CheckUserSubscribe($author,$c) {	

	if (($author > 0) AND ($c > 0))
	{		
		$sql = 	"SELECT id FROM ".TABLE_USER_TO_COMMUNITIES." WHERE ".T_SUBS_AUTHOR."=".$author." AND ".T_SUBS_COMMUNITY."=".$c." LIMIT 1";
		$r = mysql_query($sql);

		if (mysql_num_rows($r)!=0) {
			
			$res = mysql_result($r,0);
		}
		else {
			$res = '';
		}
	}
	else
	{
			$res = '';
	}
	return $res;
}

# Преобразуем дату Y-m-d -> d.m.Y
function GetDateFormat_dmY($date){
	if ($date>0)    
	{
		$dateformat = @date_format(date_create_from_format('Y-m-d H:i:s',$date), 'd.m.Y');
	}
	else 
	{	
		$dateformat = '';
	}
	return $dateformat;
}


# Преобразуем дату Y-m-d H:i:s -> d.m.Y H:i
function GetDateFormat_dmY_Hi($date){
	if ($date>0)    
	{
		$dateformat = @date_format(date_create_from_format('Y-m-d H:i:s',$date), 'd.m.Y H:i');
	}
	else 
	{	
		$dateformat = '';
	}
	return $dateformat;
}

# сегодня, вчера
function GetDateFormat_Today($date){

		#MS_YESTERDAY
		#MS_TODAY
		
		$label = @date_format(date_create_from_format('Y-m-d H:i:s',$date), 'd.m.Y');
		
		if ($label == date("d.m.Y")){
			$label = MS_TODAY;
		}
		else{
			 if ($label == date("d.m.Y", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")))){
				$label = MS_YESTERDAY;
			} 
		}
	return $label;
}

# Преобразуем дату Y-m-d H:i:s -> d.m.Y H:i
function GetTimeFormat_Hi($date){
	if ($date>0)    
	{
		$dateformat = @date_format(date_create_from_format('Y-m-d H:i:s',$date), 'H:i');
	}
	else 
	{	
		$dateformat = '';
	}
	return $dateformat;
}


# Вывод страниц
function GetPages($p, $perp, $count){
	$pageblock = '';
	
	$c = $_GET['c'];
	$v = $_GET['v'];
	$s = $_POST['s'];
	
	
	
	if (!isset($c)){$c = CU_ALL;}
	if (!isset($v)){$v = C_V_NEW;}
	
	$allpage = floor($count / $perp);
						if (($allpage*$perp)<$count){
							$allpage=$allpage+1;
						}
	if (!isset($p) OR ($p == 0)) {$p = 1;}
		
		$pageblock = '<p align="center">'; 
		if (($allpage > 1) AND ($p > 3)) {$pageblock = $pageblock.'<span class="numpage"><a href=index.php?c='.$c.'&v='.$v.'&p=1>1</a></span>';}
		if ($p > 4) {$pageblock = $pageblock.'<span class="numpage">...</span>';}
		if (($p-2) >= 1) {$pageblock = $pageblock.'<span class="numpage"><a href=index.php?c='.$c.'&v='.$v.'&p='.($p-2).'>'.($p-2).'</a></span>';}
		if (($p-1) >= 1) {$pageblock = $pageblock.'<span class="numpage"><a href=index.php?c='.$c.'&v='.$v.'&p='.($p-1).'>'.($p-1).'</a></span>';}
		if ($allpage > 1) {$pageblock = $pageblock.'<span class="numpage_selected">'.$p.'</span>';}
		if (($p+1) <= $allpage) {$pageblock = $pageblock.'<span class="numpage"><a href=index.php?c='.$c.'&v='.$v.'&p='.($p+1).'>'.($p+1).'</a></span>';}
		if (($p+2) <= $allpage) {$pageblock = $pageblock.'<span class="numpage"><a href=index.php?c='.$c.'&v='.$v.'&p='.($p+2).'>'.($p+2).'</a></span>';}
		if (($p+3) <  $allpage) {$pageblock = $pageblock.'<span class="numpage">...</span>';}
		if (($p+3) <= $allpage) {$pageblock = $pageblock.'<span class="numpage"><a href=index.php?c='.$c.'&v='.$v.'&p='.($allpage).'>'.($allpage).'</a></span>';}
		
		/* $st = substr($count, -1);
		switch ($st) {
			case '0': case '5': case '6' : case '7': case '8': case '9'	: $z = 'записей'; break;
			case '1'	: $z = 'запись'; break;
			case '2' : case '3' : case 4	: $z = 'записи'; break;	
		} */
		$z = 'записей';
		$pageblock = $pageblock.'</p><p align="center">'.$count.' '.$z.'</p>';
	
	return $pageblock;
}


# Случайное сообщество, которое активно и существует
function GetRandomC(){
	$i = 0;
	$count = mysql_result(mysql_query("SELECT id FROM ".TABLE_COMMUNITIES." ORDER BY id DESC LIMIT 1"),0);
	while ($i == 0) {
		$rc = rand (0, $count);
		if (GetCommunityInfo($rc, T_COMMUNITIES_ACTIVE) == 1){
		$res = $rc;
		$i = 1;
		
		}
	}
	
	return $rc;
}

# проверка прав юзера

function CheckUserRights($user, $where, $id) {
	if (GetUserInfo($user, T_USERS_ROLE) >= VAR_MODERATOR_ROLE) {
		$res = 1;
	}
	else {$res = 0;}
	return $res;
}




function replaceBBCode($text_post) {
$str_search = array(
      "#\\\n#is",
      "#\[b\](.+?)\[\/b\]#is",
      "#\[i\](.+?)\[\/i\]#is",
      "#\[u\](.+?)\[\/u\]#is",
      "#\[s\](.+?)\[\/s\]#is",
      "#\[sup\](.+?)\[\/sup\]#is",
      "#\[sub\](.+?)\[\/sub\]#is",
      "#\[video\](.+?)\[\/video\]#is",
      "#\[code\](.+?)\[\/code\]#is",
      "#\[quote\](.+?)\[\/quote\]#is",
      "#\[url=(.+?)\](.+?)\[\/url\]#is",
      "#\[url\](.+?)\[\/url\]#is",
      "#\[img\](.+?)\[\/img\]#is",
      "#\[size=(.+?)\](.+?)\[\/size\]#is",
      "#\[color=(.+?)\](.+?)\[\/color\]#is",
      "#\[font=(.+?)\](.+?)\[\/font\]#is",
      "#\[list\](.+?)\[\/list\]#is",
      "#\[list=1](.+?)\[\/list\]#is",
      "#\[\*\](.+?)\[\/\*\]#",
      "#\:\)#",
      "#\:\(#",
      "#\:D #",
      "#\;\)#",
      "#\:up:#",
      "#\:down:#",
      "#\:shock:#",
      "#\:angry:#",
      "#\:sick:#",
    );
    $str_replace = array(
      "<br />",
      "<b>\\1</b>",
      "<i>\\1</i>",
      "<span style='text-decoration:underline'>\\1</span>",
      "<span style='text-decoration:line-through'>\\1</span>",
      "<sup>\\1</sup>",
      "<sub>\\1</sub>",
      "<iframe width='640' height='480' frameborder='0' src='http://www.youtube.com/embed/\\1'></iframe>",
      "<code class='code'>\\1</code>",
      "<table width = '95%'><tr><td>Цитата</td></tr><tr><td class='quote'>\\1</td></tr></table>",
      "<a href='\\1'>\\2</a>",
      "<a href='\\1'>\\1</a>",
      "<img src='\\1' />",
      "<span style='font-size:\\1%'>\\2</span>",
      "<span style='color:\\1'>\\2</span>",
      "<span style='font-family:\\1'>\\2</span>",
      "<ul>\\1</ul>",
      "<ol>\\1</ol>",
      "<li>\\1</li>",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm1.png\">",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm2.png\">",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm3.png\">",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm4.png\">",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm5.png\">",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm6.png\">",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm7.png\">",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm8.png\">",
      "<img class=\"sm\" src=\"http://ваш_сайт/templates/имя_шаблона/wysibb/theme/default/img/smiles/sm9.png\">",
    );
    return preg_replace($str_search, $str_replace, $text_post);
  }



?>