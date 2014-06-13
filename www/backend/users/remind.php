<?php
include_once "../../lib/JsHttpRequest/JsHttpRequest.php";
include_once "../../pagen_config.php";
$JsHttpRequest = new JsHttpRequest("utf-8");
include_once("../../class/DataBase.class.php");
include_once("../../class/RandKey.class.php");
include_once("../../class/Validator.class.php");
include_once("../../class/PageLang.class.php");
Validator::csrf();
DataBase::connect();

$e_mail = ($_REQUEST['e_mail']);
// reading input data

$errors = "";
$access = "";

if (!Validator::email($e_mail)) {
		$errors = PageLang::alert (9);
	} else {
		$usercount = mysql_query("SELECT `login`,`pass` FROM `".config::PREFIX."users` WHERE `email`='$e_mail'");
		$user = mysql_fetch_array($usercount);
		$pass = RandKey::demask($user['pass']);
		$login = $user['login'];
		if (mysql_num_rows($usercount) != 0){
			$subject = "Remind password";
			$message = "Login: $login, Password: $pass";
			if (mail($e_mail,$subject,$message,"Content-type:text/plain; Charset=utf-8\r\n")) {
				$access = PageLang::alert (10);
			} else {
				$errors = PageLang::alert (11);
			}
		} else {
			$errors = PageLang::alert (12);
		}
	}
// check inputs & send mail

DataBase::disconnect ();

$GLOBALS['_RESULT'] = array(
      "errors"   => $errors,
      "access"   => $access,
    );
if ($_REQUEST['id'] == 'error') {
  error_demonstration__make_a_mistake_calling_undefined_function();
}
?>
