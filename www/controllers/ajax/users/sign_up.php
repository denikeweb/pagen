<?php
include_once "../../lib/JsHttpRequest/JsHttpRequest.php";
include_once "../../pagen_config.php";
$JsHttpRequest = new JsHttpRequest("utf-8");
include_once("../../class/DataBase.class.php");
include_once("../../class/RandKey.class.php");
include_once("../../class/Validator.class.php");
include_once("../../class/PageLang.class.php");
Validator::csrf();
DataBase::connect ();

$login = ($_REQUEST['login']);
$pass_out = ($_REQUEST['pass_out']);
$repeat_pass = ($_REQUEST['repeat_pass']);
$e_mail = ($_REQUEST['e_mail']);
// reading input data

$errors = "";
$access = "";

$minpasslen = 6;
$minloginlen = 4;
if (!Validator::email($e_mail) or strlen($e_mail) < 9) {$errors = PageLang::alert (1);}
if ($pass_out != $repeat_pass) {$errors = PageLang::alert (2);}
if (!Validator::login($login)) {$errors = PageLang::alert (23);}
if (!Validator::login($pass_out)) {$errors = PageLang::alert (22);}
if (strlen($login) < $minloginlen) {$errors = PageLang::alert (3);}
if (strlen($pass_out) < $minpasslen) {$errors = PageLang::alert (4);}
if (empty($errors)) {
	$usercount = mysql_query("SELECT `id` FROM `".config::PREFIX."users` WHERE `login`='$login'");
	if (mysql_num_rows($usercount) != 0) {$errors = PageLang::alert (7);}
}
// checking inputs variables
if (empty($errors)) {
	$pass = RandKey::mask($pass_out);
	$insert = mysql_query("INSERT INTO `".config::PREFIX."users`(`id`, `login`, `pass`, `email`, `rights`) VALUES (NULL, '$login', '$pass', '$e_mail', '1');");
	if ($insert === true) {
		session_start();
		$user_query = mysql_query("SELECT `id` FROM `".config::PREFIX."users` WHERE 1 ORDER BY `id` DESC");
		$myrow = mysql_fetch_array($user_query);
		$_SESSION['id'] = $myrow['id'];
		$_SESSION['rights'] = '1';
		$access = PageLang::alert (5);
	} else {
		$errors = PageLang::alert (6);}
	}
// if we have any errors then we inserting data to base

DataBase::disconnect ();

$GLOBALS['_RESULT'] = array(
      "errors"   => $errors,
      "access"   => $access,
    );
if ($_REQUEST['id'] == 'error') {
  error_demonstration__make_a_mistake_calling_undefined_function();
}
?>
