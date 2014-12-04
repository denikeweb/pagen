<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */

namespace Annex;


class Dev {

	/**
	 * Print array with tabulation
	 *
	 * @param $array
	 */
	public static function showArray ($array) {
		echo '<pre style="white-space: pre-wrap"><code class="php">';
			print_r($array);
		echo '</code></pre>';
	}
} 