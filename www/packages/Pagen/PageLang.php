<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */

	namespace Pagen;

	abstract class PageLang {
		public static function word ($label)    {return self::printWord ('titles', $label);}
		public static function alert ($label)   {return self::printWord ('alerts', $label);}

		private static function printWord ($table, $label) {
			$mysqli = &DataBase::$mysqli;
			$lan = \config::LANG;
			//standart language is ukrainian
			if (isset($_COOKIE["lang"]))
			{
				if ($_COOKIE ['lang'] == "uk") {$lang = 'uk';}
				if ($_COOKIE ['lang'] == "ru") {$lang = 'ru';}
				if ($_COOKIE ['lang'] == "en") {$lang = 'en';}
			}
			//choose language if isset cookie
			$query = $mysqli->query ('SELECT `'.$lan.'` FROM `'.\config::PREFIX.$table.'` WHERE `id`=\''.$label.'\'');
			$result_k = $query->fetch_array ();
			return $result_k [$lan];
		}
	}
?>