<?php
__settings (['Config']);

class logout extends eAjaxController {
	public function run () {
		session_start();
		unset($_SESSION['id']);
		unset($_SESSION['rights']);
		echo '200 OK';
	}
}
?>
