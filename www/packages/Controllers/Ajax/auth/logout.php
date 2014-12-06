<?php
	/**
	 * demo AJAX-class
	 *
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */

	namespace Controllers\Ajax\auth;
	use \Pagen\eAjaxController;
	use \Pagen\User;
	\Pagen\ajaxSettings (['Config']);

	class logout extends eAjaxController {
		function request () {}
		function run () {User::removeUser ();}
		function response () {return '200 OK';}
	}
?>
