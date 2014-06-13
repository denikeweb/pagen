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

$pass = $_REQUEST['pass_out'];
$new_pass = $_REQUEST['new_pass'];
$repeat_pass = $_REQUEST['repeat_pass'];
// reading input data

$errors = "";
$access = "";

if (!Validator::login($pass) or !Validator::login($new_pass) or !Validator::login($repeat_pass)) {
	$errors = PageLang::alert (24);
} else {
	if (User::is_auth ()) {
		$user_id = $_SESSION['id'];
		$check = mysql_query("SELECT `pass` FROM `".config::PREFIX."users` WHERE `id`='$user_id'");
		$myrow = mysql_fetch_array($check);
		if ($pass != RandKey::demask($myrow['pass'])) {$errors = PageLang::alert (20);}
		} else {
		$errors = PageLang::alert (18);
	}
	//get password
}
$minpasslen = 6;
if (strlen($new_pass) < $minpasslen) {$errors = PageLang::alert (4);}
if ($new_pass != $repeat_pass) {$errors = PageLang::alert (2);}
//errors

if (empty($errors)){
		$new_pass = RandKey::mask($new_pass);
		$update_user = mysql_query("UPDATE `".config::PREFIX."users` SET `pass`='$new_pass' WHERE `id`='$user_id'");
		if ($update_user === true) {
			$access = PageLang::alert (17);
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
