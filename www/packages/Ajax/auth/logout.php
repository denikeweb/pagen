<?php
__settings (['Controller']);

class logout extends eController {
	public function run () {
		session_start();
		unset($_SESSION['id']);
		unset($_SESSION['rights']);
		echo '200 OK';
	}
}
?>
