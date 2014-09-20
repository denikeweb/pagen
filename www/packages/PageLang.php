<?php
abstract class PageLang {
	public static function word ($label) {
		global $mysqli;
		$lan = \config::LANG;
		//standart language is ukrainian
		if (isset($_COOKIE["lang"]))
		{
			if ($_COOKIE ['lang'] == "uk") {$lang = 'uk';}
			if ($_COOKIE ['lang'] == "ru") {$lang = 'ru';}
			if ($_COOKIE ['lang'] == "en") {$lang = 'en';}
		}
		//choose language if isset cookie
		$query = $mysqli->query('SELECT `'.$lan.'` FROM `'.config::PREFIX.'titles` WHERE `id`=\''.$label.'\'');
		$result_k = $query->fetch_array();
		return $result_k [$lan];
	}
	public static function alert ($label) {
		global $mysqli;
		$lan = \config::LANG;
		//standart language is ukrainian
		if (isset($_COOKIE["lang"]))
		{
			if ($_COOKIE ['lang'] == "uk") {$lang = 'uk';}
			if ($_COOKIE ['lang'] == "ru") {$lang = 'ru';}
			if ($_COOKIE ['lang'] == "en") {$lang = 'en';}
		}
		//choose language if isset cookie
		$query = $mysqli->query ('SELECT `'.$lan.'` FROM `'.config::PREFIX.'alerts` WHERE `id`=\''.$label.'\'');
		$result_k = $query->fetch_array ();
		return $result_k [$lan];
	}
}
?>