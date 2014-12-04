<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */

	namespace Pagen;

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
			$mysqli = DataBase::$mysqli;
			session_start();
			//start session for user's identification

			if (empty($_SESSION['rights']) or !isset($_SESSION['id'])) {
				$_SESSION['rights'] = 0;
				self::$Rights = 0;
			} else {
				self::$Rights = $_SESSION['rights'];
			}
			//create rights for guest; 0 - guest, 1 - user, 2 - vilide user, 4 - moderator, 6 - administrator

				if (!empty($_SESSION['id'])) {
					$id = $_SESSION['id'];
					$user_query = $mysqli->query('SELECT `id`, `login`, `email`, `rights` FROM `'.
						\config::PREFIX.'users` WHERE `id`=\''.$id.'\'');
					self::$userInfo = $user_query->fetch_assoc();
				}
				//create array with user information
			//if db connection is set we can authorisate this user

			self::$IP = $_SERVER['REMOTE_ADDR'];
		}

		public static function is_auth ()   {return isset($_SESSION['id']) and ($_SESSION['rights'] >= self::USER);     }
		public static function is_user ()   {return isset($_SESSION['id']) and ($_SESSION['rights'] == self::USER);     }
		public static function is_v_user () {return isset($_SESSION['id']) and ($_SESSION['rights'] == self::V_USER);   }
		public static function is_moder ()  {return isset($_SESSION['id']) and ($_SESSION['rights'] == self::MODER);    }
		public static function is_admin ()  {return isset($_SESSION['id']) and ($_SESSION['rights'] == self::ADMIN);    }
	}
?>