<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 *
	 * use magic method __callStatic
	 */

	namespace Pagen;

	abstract class User {
		/**
		 * array with user data
		 *
		 * @var array
		 */
		public static $userInfo;

		/**
		 * Table with users at DB
		 *
		 * @var string
		 */
		protected static $table = 'users';

		/**
		 * unique user type key in session
		 *
		 * @var string
		 */
		protected static $id_key = 'id';

		/**
		 * get array with types of user rights
		 *
		 * @abstract
		 *
		 * @return array
		 */
		public static function getRights () {
			return \config::$userRights;
		}

		/**
		 * generate array with user data
		 *
		 * @abstract
		 */
		public static function getUserInfo ($value, $field = 'id') {
			if ($value === 0) {
				return self::$userInfo = ['users_name' => 'admin'];
			}
			if (!empty( $value )) {
				$px = \config::PREFIX;
				$table = static::$table;
				$data_postfix = ($field == 'id') ? '' : '_data';
				$query_text = "
					SELECT * FROM `{$px}users`

					INNER JOIN `{$px}{$table}_data`
						ON  `{$px}{$table}`.`{$table}_id`=`{$px}{$table}_data`.`{$table}_id`

					WHERE
						`{$px}{$table}{$data_postfix}`.`{$table}_{$field}`='$value'
				";
				$user_query = DataBase::$mysqli->query($query_text);
				return self::$userInfo = $user_query->fetch_assoc();
			}
		}

		/**
		 * init user at session
		 */
		public static function init () {
			session_start();
			//start session for user's identification

			if (empty($_SESSION['rights']) or !isset($_SESSION[static::$id_key]))
				$_SESSION['rights'] = self::getRights () ['guest'];
			if (\config::GET_USER_DATA)
				self::getUserInfo ($_SESSION[static::$id_key]);
		}

		/**
		 * Sign in user
		 *
		 * @param $id
		 * @param $rights
		 */
		public static function setUser ($id, $rights) {
			session_start();
			$_SESSION [static::$id_key] = $id;
			$_SESSION ['rights'] = $rights;
		}

		/**
		 * Sign out user
		 */
		public static function removeUser () {
			session_start();
			unset($_SESSION[static::$id_key]);
			unset($_SESSION['rights']);
		}

		/**
		 * Check user rights. For example: User::is_admin () User::is_user () User::is_guest ()
		 *
		 * @magic
		 * @param $name
		 * @param $args
		 */
		public static function __callStatic ($name, $args) {
			return
				isset($_SESSION[static::$id_key])
				and $_SESSION['rights'] = self::getRights () [substr ($name, 3)];
		}

		/**
		 * Is user signed in
		 *
		 * @return bool
		 */
		public static function is_auth ()   {
			return
				isset($_SESSION[static::$id_key])
				and $_SESSION['rights'] >= self::getRights () ['user'];
		}
	}
?>