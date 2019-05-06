<?php
/*
Универсальный скрипт авторизации.
Используется сессии для хранения данных.
Скрипт типа "всё-в-одном" - его необходимо
включать в каждый файл для использования.
Распространяется по лицензии BSD.

+Требования:
+-Mysql & PHP5
+-Созданое подключение к MySQL и запущеная сессия =)

(c)2008 Vasilii B. Shpilchin
*/

##Определяем константы
define('USERS_TABLE','users');
define('SID',session_id());
	$redicet = $_SERVER['HTTP_REFERER'];
##Определяем функции
//Функция выхода.
//Пользователь считается авторизированым, если в сессии присутствует uid
//см. "Действия - если пользователь авторизирован".

if (!function_exists('logout')) {
    function logout() {

    
	unset($_SESSION['uid']); //Удаляем из сессии ID пользователя
    
	die(header('Location: '.$_SERVER['PHP_SELF']));
	//die(header("Location: $redicet"));

}
   
 }
//Функция входа.
//Все выбраные поля записываются в сессию.
//Таким образом, при каждом просмотре страницы не надо выбирать их заново.
//Для обновления информации из БД можно пользоваться этой же функцией - имя и пароль
//хранятся в сессиях

if (!function_exists('login')) {
function login($username,$password)    {
    $result = mysql_query("SELECT * FROM `".USERS_TABLE."` WHERE `username`='$username' AND `password`=md5('$password');")
        or die(mysql_error());
    $USER = mysql_fetch_array($result,1); //Генерирует удобный массив из результата запроса
    if(!empty($USER)) { //Если массив не пустой (это значит, что пара имя/пароль верная)
        $_SESSION = array_merge($_SESSION,$USER); //Добавляем массив с пользователем к массиву сессии
        
        mysql_query("UPDATE `".USERS_TABLE."` SET `sid`='".SID."' WHERE `uid`='".$USER['uid']."';")
            or die(mysql_error());
        return true;
    }
    else {
        return false;
    }
}
}
//Функция проверки залогинности пользователя.
//При входе, ID сессии записывается в БД.
//Если ID текущей сессии и SID из БД не совпадают, производится logout.
//Благородя этому нельзя одновременно работать под одним ником с разных браузеров.
if (!function_exists('check_user')) {
function check_user($uid) {
    $result = mysql_query("SELECT `sid` FROM `".USERS_TABLE."` WHERE `uid`='$uid';") or die(mysql_error());
    $sid = mysql_result($result,0);
    return $sid==SID ? true : false;
}
}
##Действия - если пользователь авторизирован
if(isset($_SESSION['uid'])) { //Если была произведена авторизация, то в сессии есть uid

    //Константу удобно проверять в любом месте скрипта
    define('USER_LOGGED',true);
    //Создаём удобные переменные
    //Все поля таблицы пользователей записываются в сесси (см. стр. 35-37)
    //Таким образом, после добавления нового поля в таблицу надо дописть лишь одну строку
    $UserName = $_SESSION['username'];
    $UserPass = $_SESSION['password'];
    $UserID = $_SESSION['uid'];
	$UserRole = $_SESSION['role'];
}
else {
    define('USER_LOGGED',false);
}

##Действия при попытке входа
if (isset($_POST['login'])) {
    
    if(get_magic_quotes_gpc()) { //Если слеши автоматически добавляются
        $_POST['user']=stripslashes($_POST['user']);
        $_POST['pass']=stripslashes($_POST['pass']);
    }
    $user = mysql_real_escape_string($_POST['user']);
    $pass = mysql_real_escape_string($_POST['pass']);
    if(login($user,$pass)) {
        //header('Refresh: 3');
			die(header("Location: $redicet"));
        die('Вы успешно авторизировались!');
		
    }
    else {
       // header('Refresh: 3;');
	   	die(header("Location: $redicet"));
		die('Пароль неправильный!');
		
    }
    
}

##Действия при попытке выхода
if(isset($_GET['logout'])) {
    logout();
	
}
?>