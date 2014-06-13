<?php
include_once "../lib/JsHttpRequest/JsHttpRequest.php";
include_once "../pagen_config.php";
$JsHttpRequest = new JsHttpRequest("utf-8");
include_once("../class/DataBase.class.php");
include_once("../class/RandKey.class.php");
include_once("../class/Validator.class.php");
include_once("../class/PageLang.class.php");
Validator::csrf();

$login = $_REQUEST['login'];
$pass = $_REQUEST['pass_out'];

$bool = false;

if (config::DB) {
	DataBase::connect ();
	
	// reading input data

	$errors = "";

	if (!Validator::login ($login)) {
			$errors = PageLang::alert (8);
		} else {
			$user_query = mysql_query("SELECT `id`,`rights`,`pass` FROM `".config::PREFIX."users` WHERE `login`='$login'");
			$myrow = mysql_fetch_array($user_query);
			if (mysql_num_rows($user_query) == 0 or $pass != RandKey::demask($myrow['pass'])) {
				$errors = PageLang::alert (8);
			} else {
				session_start();
				$_SESSION['id'] = $myrow['id'];
				$_SESSION['rights'] = $myrow['rights'];
				$bool = true;
			}
		}

	DataBase::disconnect ();
} else {
	if ($login == config::ADMIN and $pass == RandKey::demask(config::PASS)) {
		session_start();
		$_SESSION['id'] = 0;
		$_SESSION['rights'] = 6;
		$bool = true;
	}
}

$GLOBALS['_RESULT'] = array(
      "errors"   => $errors,
      "bool"   => $bool,
    );
if ($_REQUEST['id'] == 'error') {
  error_demonstration__make_a_mistake_calling_undefined_function();
}
?>
