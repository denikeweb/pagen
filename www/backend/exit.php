<?php
include_once "../lib/JsHttpRequest/JsHttpRequest.php";
$JsHttpRequest = new JsHttpRequest("utf-8");
include_once("../class/Validator.class.php");
Validator::csrf();
session_start();
unset($_SESSION['id']);
unset($_SESSION['rights']);
$GLOBALS['_RESULT'] = array(

    );
if ($_REQUEST['id'] == 'error') {
  error_demonstration__make_a_mistake_calling_undefined_function();
}
?>
