<?php
@include ("const.php");

##Определяем константы

define('VAR_ADMIN_EMAIL','admin@admin.ru');
define('VAR_PORTAL_NAME','Портал');
define('VAR_DEFAULT_ROLE','1');
define('VAR_MODERATOR_ROLE','10');

define('VAR_LENGTH_TRIM_NOTE','280');
define('VAR_PREWIEV_LENGTH_TRIM_NOTE','1000');


# кол-во на странице
define('VAR_COUNT_COMMUNITIES_PER_PAGE','10');
define('VAR_COUNT_USERS_PER_PAGE','5');
define('VAR_COUNT_TOPICS_PER_PAGE','10');

define('VAR_RAITING_POP','10');			# pop
define('VAR_RAITING_BEST','100');		# best
define('VAR_RAITING_TRASH','-10');		# trash
define('VAR_RAITING_NEW','-10');		# new





# ШАБЛОН
define('VAR_BORDER','0');
define('VAR_LEFT_COL_WIDTH','160px');
define('VAR_CENTER_COL_WIDTH','55%');
define('VAR_RIGHT_COL_WIDTH','260px');
define('VAR_MAX_WIDTH','70%');
define('VAR_CARCAS_3COL','3_col');


define('VAR_RATE_UP','+');
define('VAR_RATE_DOWN','-');
define('VAR_C_SUBSCRIBE','subscribe');
define('VAR_C_SUBSCRIBE_OFF','subscribe_off');

define('VAR_URL_CAT','cat');
define('VAR_URL_OP','op');

#URL CATEGORY
define('CAT_REG','reg');
define('CAT_REGFINISH','regfinish');
define('CAT_USERS','u');
define('CAT_TOPICS','t');
define('CAT_COMMUNITIES','c');


define('CU_ALL','all');						# список
define('C_SUBS','sub');						# подписки


define('C_V_LIST','list');					# список сообществ
define('C_V_INFO','info');					# информация о сообществе
define('C_V_POP','pop');					# популярные записи
define('C_V_NEW','new');					# новые записи
define('C_V_BEST','best');					# лучшее

define('C_V_TRASH','trash');				# трешевые (с низким рейтингом)
define('C_V_DEL','del');					# удаленные
define('C_V_BAN','ban');					# забаненные в сообществе
define('C_V_NEW_TOPIC','new_topic');		# новый топик в сообществе



define('U_V_LIST','list');					# список пользователей
define('U_V_INFO','info');					# информация о пользователе
define('U_V_COMMUNITIES','communities');	# сообщества пользователя
#define('U_V_SUB','sub');					# подписки пользователя
define('U_V_RAITING','rait');				# сорт по рейтингу
define('U_V_COMMENTS','comments');			# сорт. по числу комментариев
define('U_V_POP','pop');					# популярные топики
define('U_V_NEW','new');					# новые топики
define('U_V_TRASH','trash');				# трешевые (с низким рейтингом)
define('U_V_DEL','del');					# удаленные топики юзера
define('T_V_PLUS','plus');					# +1 к теме
define('T_V_MINUS','minus');				# -1 к теме
define('TCC_V_PLUS','ccplus');					# +1 к коменту
define('TCC_V_MINUS','ccminus');				# -1 к коменту







#define('USERS_TABLE','users');
#TABLES
define('TABLE_USERS','users');
define('TABLE_TOPICS','topics');
define('TABLE_COMMUNITIES','communities');
define('TABLE_COMMENTS','comments');
define('TABLE_MODERATORTOCOMMUNITIES','moderator_to_communities');
define('TABLE_SETTINGS','settings');
define('TABLE_RATE_TO_TOPICS','rate_to_topics');
define('TABLE_RATE_TO_COMMENTS','rate_to_comments');
define('TABLE_USER_TO_COMMUNITIES','user_to_communities');





# T_USERS
define('T_USERS_UID','uid');
define('T_USERS_PASSWORD','password');
define('T_USERS_ACTIVE','active');
define('T_USERS_LOGIN','login');
define('T_USERS_USERNAME','username');
define('T_USERS_DATETIMEREG','datetime_reg');
define('T_USERS_IP','ip');
define('T_USERS_FROM','form');
define('T_USERS_EMAIL','email');
define('T_USERS_EMAILCONFIRM','email_confirm');
define('T_USERS_ROLE','role');
define('T_USERS_BAN','ban');

# T_TOPICS
define('T_TOPICS_ID','id');
define('T_TOPICS_ACTIVE','active');
define('T_TOPICS_CLOSE_COMMENTS','close_comments');
define('T_TOPICS_COMMUNITY','community');
define('T_TOPICS_DATETIME','datetime');
define('T_TOPICS_AUTHOR','author');
define('T_TOPICS_CAPTION','caption');
define('T_TOPICS_URL','url');
define('T_TOPICS_MESSAGE','message');
define('T_TOPICS_IP','ip');
define('T_TOPICS_RAITING','rating');
define('T_TOPICS_COMMENTS','comments');




# T_COMMENTS
define('T_COMMENTS_ID','id');
define('T_COMMENTS_ACTIVE','active');
define('T_COMMENTS_TOPIC','topic');
define('T_COMMENTS_RAITING','rating');
define('T_COMMENTS_DATETIME','datetime');
define('T_COMMENTS_USER','user');
define('T_COMMENTS_IP','ip');
define('T_COMMENTS_MESSAGE','message');
define('T_COMMENTS_MODER_MESSAGE','moder_message');
define('T_COMMENTS_EDITAUTHOR','edit_author');
define('T_COMMENTS_EDITDATETIME','edit_datetime');

#T_COMMUNITIES
define('T_COMMUNITIES_ID','id');
define('T_COMMUNITIES_ACTIVE','active');
define('T_COMMUNITIES_NAME','name');
define('T_COMMUNITIES_COMMENT','name_ru');
define('T_COMMUNITIES_LOGO','logo');
define('T_COMMUNITIES_NOTE','note');
define('T_COMMUNITIES_AUTHOR','author');
define('T_COMMUNITIES_DATETIMEREG','datetime_reg');
define('T_COMMUNITIES_STATUS','STATUS');
define('T_COMMUNITIES_SUBS','subscribers');#Подписчики


# T_SETTINGS
define('T_SETTINGS_ID','id');
define('T_SETTINGS_ACTIVE','active');
define('T_SETTINGS_OPTION','option');
define('T_SETTINGS_NAME','name');
define('T_SETTINGS_VALUE','value');

#RATE_TO_TOPICS
define('T_RATE_T_ID','id');
define('T_RATE_T_DATETIME','datetime');
define('T_RATE_T_AUTHOR','author');
define('T_RATE_T_TOPIC','topic');
define('T_RATE_T_RATE','rate');
define('T_RATE_T_VALUE','value');

#RATE TO COMMENTSS
define('T_RATE_C_ID','id');
define('T_RATE_C_DATETIME','datetime');
define('T_RATE_C_AUTHOR','author');
define('T_RATE_C_COMMENT','comment');
define('T_RATE_C_RATE','rate');
define('T_RATE_C_VALUE','value');

#USER_TO COMMUNITIES
define('T_SUBS_ID','id');
define('T_SUBS_DATETIME','datetime');
define('T_SUBS_AUTHOR','user');
define('T_SUBS_COMMUNITY','community');


#
define('MS_TO_WRITE','написал');
define('MS_TODAY','сегодня');
define('MS_YESTERDAY','вчера');
define('MS_V','в');
define('MS_HELLO','Здравствуйте');
define('MS_COMMENTS','Комментарии');
#

#TITLE
define('MS_TOPICS','Главная');




?>