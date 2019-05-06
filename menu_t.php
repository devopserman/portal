<?php
session_start();

include ("auth.php");

$c = $_GET['c'];
$v = $_GET['v'];
$p = $_GET['p'];

$cat = $_GET['cat'];

	#c
	if (isset($c) AND ($c > 0)){
			$c_label = 'c='.$c;
	}
	else {$c_label = 'c='.CU_ALL;}
	
	#v  <------------------------- сделать проверку V на pop best new
	if (isset($v) AND ($v > 0)){
			$v_label = '&v='.$v;
	}
	else {$v_label = '&v='.C_V_NEW;}
	
	#p
	if (isset($p) AND ($p > 0)){
			$p_label = '&p='.$p;
	}
	else {$p_label = '';}

echo '

	<ul class="catmenu">';
	if (isset($c) AND ($c>0)){
		#echo '<li><span><img src="'.GetCommunityInfo($c,T_COMMUNITIES_LOGO).'" width="20px" valign="middle"/></span>&nbsp;<span class="c_marker"><a href="index.php?c='.$c.'">'.GetCommunityInfo($c, T_COMMUNITIES_NAME).'</a></span></li>';
		echo '<li><a href="index.php?c='.$c.'"><span><img src="'.GetCommunityInfo($c,T_COMMUNITIES_LOGO).'" width="20px" valign="middle"/></span>&nbsp;<span class="c_marker">'.GetCommunityInfo($c, T_COMMUNITIES_NAME).'</span></a></li>';
		
	}
		#echo '<li '; if ($cat == NULL) 				{echo ' class="current"';} echo '><a href="/"><b>Главная</b></a></li>';
		echo '<li '; if (($c != C_SUBS) AND ($v == C_V_POP))    	{echo ' class="current"';} echo '><a href="index.php?'.$c_label.'&v='.C_V_POP.'"><b>ПОПУЛЯРНОЕ</b></a></li>';
		echo '<li '; if (($c != C_SUBS) AND (($v == C_V_NEW) OR (!isset($v))) AND (!isset($t)))    	{echo ' class="current"';} echo '><a href="index.php?'.$c_label.'&v='.C_V_NEW.'"><b>НОВОЕ</b></a></li>';
		#echo '<li '; if ($v == C_V_BEST)    	{echo ' class="current"';} echo '><a href="index.php?'.$c_label.'&v='.C_V_BEST.'"><b>ЛУЧШЕЕ</b></a></li>';
		echo '<li '; if ($c == C_SUBS)    	{echo ' class="current"';} echo '><a href="#"><b>ПОДПИСКИ</b></a></li>';
			
echo '	</ul>

 ';

?>