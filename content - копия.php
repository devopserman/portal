<?php
session_start();

include ("auth.php");
	
	$cat = $_GET['cat'];
	$op = $_GET['op'];
	$c =  $_GET['c'];
	$v =  $_GET['v'];
	$u =  $_GET['u'];
	$p =  $_GET['p'];
	
	
	if ($c=='all'){
		switch $v {
				case C_V_LIST, C_V_POP, C_V_NEW, C_V_TRASH, C_V_DEL, C_V_BAN		:	
						include "menu_t.php"; include "communities/main.php"; break;
				
			
		}
		
		
		
	}
	if ($c>0){
		include "menu_t.php"; include "topics/main.php";
	}
	
	if ($u=='all'){
		include "menu_t.php"; include "users/main.php";
	}
	if ($u>0){
		include "menu_t.php"; include "topics/main.php";
	}
	
	if ($t=='all'){
		include "menu_t.php"; include "topics/main.php";
	}
	if ($t>0){
		include "menu_t.php"; include "topics/show.php";
	}
	
	
	
	/*switch $c {
		case 'all'		: 	include "menu_t.php"; include "topics/main.php"; break;
		
		
	}*/
	
	
	
	
/* 	 switch ($cat)  
	{  
		case 't' 			: 
								switch ($op)  
								{  
									case 'main' 		: include "menu_t.php"; include "topics/main.php"; break;  
									case 'new_topic' 	: include "menu_t.php"; include "topics/new_topic.php"; break;  
									case 'set_new_topic' :	include "topics/action.php"; break;  
									
		
									default 			: include "menu_t.php"; include "topics/main.php";  
								}
					
								break;  
        case 'c' 			: switch ($op)  
								{  
									case 'main' 		: include "menu_t.php";  include "communities/main.php"; break;  
									case 'reg' 			: include "communities/new_communities.php"; break;  
									case 'regfinish' 	: include "communities/action.php"; break;	
									case 'show'			: include "menu_t.php";  include "communities/show.php"; break;  
							
									default 			: include "menu_t.php"; include "communities/main.php";  
								}
					
								break; 
        case 'u' 			: switch ($op)  
								{  
									case 'main' 		: include "menu_t.php";  include "users/main.php"; break;  
									case 'reg' 			: include "users/new_communities.php"; break;  
									case 'regfinish' 	: include "users/action.php"; break;	
						
									default 			: include "menu_t.php"; include "users/main.php";  
								}
					
								break; 
		 
		case 'reg' 			: include "registration.php"; break;		
		case 'regfinish' 	: include "action.php"; break;	
        default    : 

						include "menu_t.php";include "topics/main.php"; 
	}    	
*/

	
//{echo '<div class="block_mess">Недостаточно прав</div>';}
?>