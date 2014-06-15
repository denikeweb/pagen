<?php
abstract class PageLang {
	public static function word ($label) {
		$lan = config::LANG;
		//standart language is ukrainian
		if (isset($_COOKIE["lang"]))
		{
			if ($_COOKIE ['lang'] == "uk") {$lang = 'uk';}
			if ($_COOKIE ['lang'] == "ru") {$lang = 'ru';}
			if ($_COOKIE ['lang'] == "en") {$lang = 'en';}
		}
		//choose language if isset cookie
		$result_k = mysql_fetch_array(mysql_query("SELECT `".$lan."` FROM `".config::PREFIX."titles` WHERE `id`='".$label."'"));
		return $result_k [$lan];
	}
	public static function alert ($label) {
		$lan = config::LANG;
		//standart language is ukrainian
		if (isset($_COOKIE["lang"]))
		{
			if ($_COOKIE ['lang'] == "uk") {$lang = 'uk';}
			if ($_COOKIE ['lang'] == "ru") {$lang = 'ru';}
			if ($_COOKIE ['lang'] == "en") {$lang = 'en';}
		}
		//choose language if isset cookie
		$result_k = mysql_fetch_array(mysql_query("SELECT `".$lan."` FROM `".config::PREFIX."alerts` WHERE `id`='".$label."'"));
		return $result_k [$lan];
	}
}
?>