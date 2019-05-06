<?php
session_start();

include ("auth.php");
	
	
	$t =  $_GET['t'];
	$c =  $_GET['c'];
	$v =  $_GET['v'];
	$u =  $_GET['u'];
	$p =  $_GET['p'];
	$cat = $_GET['cat'];
	
	switch ($cat) {
		case 'reg'		:	include "registration.php"; break;
		case 'regfinish':	include "action.php"; break;
		
	}
	
	if (!isset($cat)) {
			if (($c == CU_ALL) OR ($c == C_SUBS)){
				switch ($v)	{
						case C_V_LIST		: 		include "view/clist.php"; break;
						case C_V_POP		:
						case C_V_NEW		: 
						case C_V_BEST		:
						case C_V_TRASH		:
						case C_V_DEL		:		include "view/topics.php"; break;	
						case C_V_BAN		:		include "view/banlist.php"; break;	
						case 'new_communities':		include "communities/new_communities.php"; break;		
						case 'groupaction':			include "communities/action.php"; break;		

						
						default 			: 		include "view/topics.php"; break;
					
				}
			}
			 if (($c <> CU_ALL) AND ($c <> C_SUBS)){
				 
				if (GetCommunityInfo($c, T_COMMUNITIES_ID) > 0){
					if (GetCommunityInfo($c, T_COMMUNITIES_ACTIVE) == 1){
						
						
						
						if (!isset($t)){
						
							switch ($v)	{
								case C_V_INFO		: 		include "view/cinfo.php"; break;
								case C_V_POP		:
								case C_V_NEW		: 
								case C_V_BEST		:
								case C_V_TRASH		:
								case C_V_DEL		:		include "view/topics.php"; break;	
								case C_V_BAN		:		include "view/banlist.php"; break;	
								case C_V_NEW_TOPIC	:		include "topics/new_topic.php"; break;	
								
								case C_V_NEW_TOPIC	:		include "topics/new_topic.php"; break;	
								case 'set_new_topic':		include "topics/action.php"; break;	
								case 'new_communities':		include "communities/new_communities.php"; break;	
								case CAT_REGFINISH	:		include "communities/action.php"; break;	
								case VAR_C_SUBSCRIBE	:	include "communities/action.php"; break;	
								case VAR_C_SUBSCRIBE_OFF:	include "communities/action.php"; break;
								
								default 			: 		include "view/topics.php"; break;
							
							} 
						}
					
						if ($t > 0){ 
							switch ($v)	{
										case 'post'			: 		include "view/posts.php"; break;
										case T_V_PLUS		:		include "topics/action.php"; break;	
										case T_V_MINUS		:		include "topics/action.php"; break;
										case TCC_V_PLUS		:		include "topics/action.php"; break;	
										case TCC_V_MINUS	:		include "topics/action.php"; break;
										
										case 'set_new_comment':		include "topics/action.php"; break;	
										
										
										default 			: 		include "view/posts.php"; break;
									
									}
						}			
					
					
					
					
					
					
					}
					else {echo '<p>Сообщество не найдено.</p>';}
				}
				else {
					if (!isset($c)){
							include "view/topics.php"; 
					}
				}	
			}
		}

	
?>