<?php
abstract class User {
	const GUEST = 0;
	const USER = 1;
	const V_USER = 2;
	const MODER = 4;
	const ADMIN = 6;
	public static $userInfo;
	public static $Rights;
	public static $IP;
	
	public static function userAuth () {
		session_start();
		//start session for user's identification

		if (empty($_SESSION['rights']) or !isset($_SESSION['id'])) {
			$_SESSION['rights'] = 0;
			self::$Rights = 0;
		} else {
			self::$Rights = $_SESSION['rights'];
		}
		//create rights for guest; 0 - guest, 1 - user, 2 - vilide user, 4 - moderator, 6 - administrator
		
		if (config::DB) {
			if (!empty($_SESSION['id'])) {
				$id = $_SESSION['id'];
				$user_query = mysqli__query("SELECT `id`, `login`, `email`, `rights` FROM `".config::PREFIX."users` WHERE `id`='$id'");
				self::$userInfo = mysqli__fetch_assoc($user_query);
			}
			//create array with user information
		}
		//if db connection is set we can authorisate this user
		
		self::$IP = $_SERVER['REMOTE_ADDR'];
	}
	
	public static function is_auth () {
		if (isset($_SESSION['id']) and ($_SESSION['rights'] >= self::USER)) {
			return true;
		} else {
			return false;
			}
	}
	
	public static function is_user () {
		if (isset($_SESSION['id']) and ($_SESSION['rights'] == self::USER)) {
			return true;
		} else {
			return false;
			}
	}
	
	public static function is_v_user () {
		if (isset($_SESSION['id']) and ($_SESSION['rights'] == self::V_USER)) {
			return true;
		} else {
			return false;
			}
	}
	
	public static function is_moder () {
		if (isset($_SESSION['id']) and ($_SESSION['rights'] == self::MODER)) {
			return true;
		} else {
			return false;
			}
	}
	
	public static function is_admin () {
		if (isset($_SESSION['id']) and ($_SESSION['rights'] == self::ADMIN)) {
			return true;
		} else {
			return false;
			}
	}
}
?>