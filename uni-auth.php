<?php
/*
������������� ������ �����������.
������������ ������ ��� �������� ������.
������ ���� "��-�-�����" - ��� ����������
�������� � ������ ���� ��� �������������.
���������������� �� �������� BSD.

+����������:
+-Mysql & PHP5
+-�������� ����������� � MySQL � ��������� ������ =)

(c)2008 Vasilii B. Shpilchin
*/

##���������� ���������
define('USERS_TABLE','users');
define('SID',session_id());
	$redicet = $_SERVER['HTTP_REFERER'];
##���������� �������
//������� ������.
//������������ ��������� ���������������, ���� � ������ ������������ uid
//��. "�������� - ���� ������������ �������������".

if (!function_exists('logout')) {
    function logout() {

    
	unset($_SESSION['uid']); //������� �� ������ ID ������������
    
	die(header('Location: '.$_SERVER['PHP_SELF']));
	//die(header("Location: $redicet"));

}
   
 }
//������� �����.
//��� �������� ���� ������������ � ������.
//����� �������, ��� ������ ��������� �������� �� ���� �������� �� ������.
//��� ���������� ���������� �� �� ����� ������������ ���� �� �������� - ��� � ������
//�������� � �������

if (!function_exists('login')) {
function login($username,$password)    {
    $result = mysql_query("SELECT * FROM `".USERS_TABLE."` WHERE `username`='$username' AND `password`=md5('$password');")
        or die(mysql_error());
    $USER = mysql_fetch_array($result,1); //���������� ������� ������ �� ���������� �������
    if(!empty($USER)) { //���� ������ �� ������ (��� ������, ��� ���� ���/������ ������)
        $_SESSION = array_merge($_SESSION,$USER); //��������� ������ � ������������� � ������� ������
        
        mysql_query("UPDATE `".USERS_TABLE."` SET `sid`='".SID."' WHERE `uid`='".$USER['uid']."';")
            or die(mysql_error());
        return true;
    }
    else {
        return false;
    }
}
}
//������� �������� ������������ ������������.
//��� �����, ID ������ ������������ � ��.
//���� ID ������� ������ � SID �� �� �� ���������, ������������ logout.
//��������� ����� ������ ������������ �������� ��� ����� ����� � ������ ���������.
if (!function_exists('check_user')) {
function check_user($uid) {
    $result = mysql_query("SELECT `sid` FROM `".USERS_TABLE."` WHERE `uid`='$uid';") or die(mysql_error());
    $sid = mysql_result($result,0);
    return $sid==SID ? true : false;
}
}
##�������� - ���� ������������ �������������
if(isset($_SESSION['uid'])) { //���� ���� ����������� �����������, �� � ������ ���� uid

    //��������� ������ ��������� � ����� ����� �������
    define('USER_LOGGED',true);
    //������ ������� ����������
    //��� ���� ������� ������������� ������������ � ����� (��. ���. 35-37)
    //����� �������, ����� ���������� ������ ���� � ������� ���� ������� ���� ���� ������
    $UserName = $_SESSION['username'];
    $UserPass = $_SESSION['password'];
    $UserID = $_SESSION['uid'];
	$UserRole = $_SESSION['role'];
}
else {
    define('USER_LOGGED',false);
}

##�������� ��� ������� �����
if (isset($_POST['login'])) {
    
    if(get_magic_quotes_gpc()) { //���� ����� ������������� �����������
        $_POST['user']=stripslashes($_POST['user']);
        $_POST['pass']=stripslashes($_POST['pass']);
    }
    $user = mysql_real_escape_string($_POST['user']);
    $pass = mysql_real_escape_string($_POST['pass']);
    if(login($user,$pass)) {
        //header('Refresh: 3');
			die(header("Location: $redicet"));
        die('�� ������� ����������������!');
		
    }
    else {
       // header('Refresh: 3;');
	   	die(header("Location: $redicet"));
		die('������ ������������!');
		
    }
    
}

##�������� ��� ������� ������
if(isset($_GET['logout'])) {
    logout();
	
}
?>