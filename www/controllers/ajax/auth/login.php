<?php
__settings (array('Config', 'DataBase', 'Controller', 'RandKey', 'Validator', 'PageLang'));

class login extends eController {
	public function run () {
		$login = $_REQUEST['0'];
		$pass = $_REQUEST['1'];

		if (config::DB) {
			echo $this->is_mysql ($login, $pass);
		} else {
			echo $this->not_mysql ($login, $pass);
		}
	}
	private function not_mysql ($login, $pass) {
		if ($login == config::ADMIN and $pass == RandKey::demask(config::PASS)) {
			session_start();
			$_SESSION ['id'] = 0;
			$_SESSION ['rights'] = 6;
			$message = 'You are logged in!';
		} else {
			$message = 'Error: check your login and password!';
		}
		return $message;
	}
	private function is_mysql ($login, $pass) {
		global $mysqli;
		if (!Validator::login ($login)) {
			$message = PageLang::alert (8);
		} else {
			$query = $mysqli->query ("SELECT `id`,`rights`,`pass` FROM `".config::PREFIX."users` WHERE `login`='$login'");
			$result = $query->fetch_assoc ();
			if ($query->num_rows == 0 or $pass != RandKey::demask ($result['pass'])) {
				$message = PageLang::alert (8);
			} else {
				session_start ();
				$_SESSION ['id'] = $result ['id'];
				$_SESSION ['rights'] = $result ['rights'];
				$message = '';
			}
		}
		return $message;
	}
}
?>
