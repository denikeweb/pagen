<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 0.4
	 */
	abstract class Validator {
		public static function fname($str){
			if (preg_match("|^[.A-Za-z0-9_-]+$|",$str)) {
				return true;
			} else {
				return false;
			}
		}//check filename

		public static function urlname($str){
			if (preg_match("|^[\/.A-Za-z0-9_-]+$|",$str)) {
				return true;
			} else {
				return false;
			}
		}//check filename with "/"

		public static function email($var){
			if (preg_match("/[^(\w)|(\@)|(\.)|(\-)]/",$var)){
				return false;
			} else {
				return true;
			}
		}//check e-mail

		public static function mobile_number ($var){
			if (preg_match("|^[\(\)\-+\ 0-9]+$|",$var)) {
				return true;
			} else {
				return false;
			}
		}//check mobile number

		public static function login ($var){
			if (preg_match("|^[A-Za-z0-9_-]+$|",$var)) {
				return true;
			} else {
				return false;
			}
		}//check login-type data

		public static function number ($var){
			if (preg_match("|^[\d]+$|",$var)) {
				return true;
			} else {
				return false;
			}
		}//check is number

		public static function curyllic ($var){
			if (!preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$var)) {
				return true;
			} else {
				return false;
			}
		}//check cyrillic-type data

		public static function isDate ($var){
			if (preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/",$var)) {
				return true;
			} else {
				return false;
			}
		}//check is number

		public static function length ($var){
			$result = iconv_strlen($var, 'UTF-8');
			return $result;
		}
	}
?>