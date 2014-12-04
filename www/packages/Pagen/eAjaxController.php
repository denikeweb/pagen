<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */
	namespace Pagen;

	abstract class eAjaxController extends eController {
		abstract public function request ();
		abstract public function response ();
		abstract public function run ();
	}
?>