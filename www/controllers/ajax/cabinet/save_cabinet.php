<?php
include_once "../../lib/JsHttpRequest/JsHttpRequest.php";
include_once "../../pagen_config.php";
$JsHttpRequest = new JsHttpRequest("utf-8");
include_once("../../class/DataBase.class.php");
include_once("../../class/RandKey.class.php");
include_once("../../class/Validator.class.php");
include_once("../../class/PageLang.class.php");
include_once("../../class/User.class.php");
Validator::csrf ();
DataBase::connect ();
session_start();

$login = $_REQUEST['login'];
$e_mail = $_REQUEST['e_mail'];
$pass_out = $_REQUEST['pass_out'];
// reading input data

$errors = "";
$access = "";

if (User::is_auth() && Validator::login($pass_out)) {
	$user_id = $_SESSION['id'];
	$check = mysql_query("SELECT `pass` FROM `".config::PREFIX."users` WHERE `id`='$user_id'");
	$myrow = mysql_fetch_array($check);
	if ($pass_out != RandKey::demask($myrow['pass'])) {$errors = PageLang::alert (2);}
} else {
	$errors = PageLang::alert (18);
}
//get password

$minpasslen = 6;
$minmaillen = 9;
$minloginlen = 4;
if (!Validator::login($pass_out)) {$errors = PageLang::alert (22);}
if (!Validator::login($login)) {$errors = PageLang::alert (23);}
if (strlen($login) < $minloginlen) {$errors = PageLang::alert (3);}
if (strlen($pass_out) < $minpasslen) {$errors = PageLang::alert (4);}
if (!Validator::email($e_mail) or strlen($e_mail) < $minmaillen) {$errors = PageLang::alert (9);}
//errors

if (empty($errors)){
	$update_user = mysql_query("UPDATE `".config::PREFIX."users` SET `email`='$e_mail',`login`='$login' WHERE `id`='$user_id'");
	if ($update_user === true) {
		$access = PageLang::alert (14);
	} else {
		$errors = PageLang::alert (6);
	}
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
