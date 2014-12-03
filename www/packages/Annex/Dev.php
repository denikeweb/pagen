<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 25.10.2014
 * Time: 1:01
 */

namespace Annex;


class Dev {
	public static function showArray ($array) {
		echo '<pre style="white-space: pre-wrap">';
			print_r($array);
		echo '</pre>';
	}
} 