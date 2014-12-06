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
		 * @var array
		 */
		public static $userInfo;

		protected static $table = 'users';
		/**
		 * @abstract
		 *
		 * @return array
		 */
		public static function getRights () {
			return \config::$userRights;
		}

		/**
		 * @abstract
		 */
		public static function getUserInfo ($value, $field = 'id') {
			if ($value === 0) {
				return self::$userInfo = ['users_name' => 'admin'];
			}
			if (!empty( $value )) {
				$px = \config::PREFIX;
				$table = self::$table;
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
		 * init user
		 */
		public static function init () {
			session_start();
			//start session for user's identification

			if (empty($_SESSION['rights']) or !isset($_SESSION['id']))
				$_SESSION['rights'] = self::getRights () ['guest'];
			if (\config::GET_USER_DATA)
				self::getUserInfo ($_SESSION['id']);
		}

		/**
		 * Sign in user
		 *
		 * @param $id
		 * @param $rights
		 */
		public static function setUser ($id, $rights) {
			session_start();
			$_SESSION ['id'] = $id;
			$_SESSION ['rights'] = $rights;
		}

		/**
		 * Sign out user
		 */
		public static function removeUser () {
			session_start();
			unset($_SESSION['id']);
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
				isset($_SESSION['id'])
				and $_SESSION['rights'] = self::getRights () [substr ($name, 3)];
		}

		/**
		 * Is user signed in
		 *
		 * @return bool
		 */
		public static function is_auth ()   {
			return
				isset($_SESSION['id'])
				and $_SESSION['rights'] >= self::getRights () ['user'];
		}
	}
?>