<?php
class Validator {
	public static function csrf(){
		if (substr_count($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == 0) {
			exit();
		}
	}
	
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

	public static function cyrillic ($var){
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
	
	public static function timeBegin (){
		global $start_time;
		$start_time = microtime(0);
	}
	
	public static function timeEnd (){
		global $start_time;
		$end_time = microtime(0);
		$time = $end_time - $start_time;
		echo "<span class='microtime'>Download time: <br />".$time."</span>";
	}

	public static function length ($var){
		$len = strlen ($str);
		$n = $len;
		for ($i = 0; $i < $n; $i ++) {
			if (ord($str [$i]) == 208) {
				$len --;
			}
		}
		return $len;
	}
	
	public static function text ($var){
		$var = trim($var);
		$var = htmlspecialchars($var);
		$var = str_replace("#", "&#35;", $var);
		$var = str_replace("'", "&#39;", $var);
		$var = str_replace('$', "&#36;", $var);
		$var = str_replace('%', "&#37;", $var);
		$var = stripslashes($var);
		return $var;
	}
	
	public static function html ($var){
		$var = trim($var);
		$var = str_replace("#", "&#35;", $var);
		$var = str_replace("'", "&#39;", $var);
		$var = str_replace('$', "&#36;", $var);
		$var = str_replace('%', "&#37;", $var);
		$var = stripslashes($var);
		return $var;
	}
	
	private static function rus2translit($string) {
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'y',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

			'А' => 'A',   'Б' => 'B',   'В' => 'V',
			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
			'И' => 'I',   'Й' => 'Y',   'К' => 'K',
			'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			'О' => 'O',   'П' => 'P',   'Р' => 'R',
			'С' => 'S',   'Т' => 'T',   'У' => 'U',
			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		return strtr($string, $converter);
	}

	public static function transliterate($str) {
		$str = self::rus2translit($str);
		$str = strtolower($str);
		$str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
		$str = trim($str, "-");
		return $str;
	}
	
}
?>