<?php
	/**
	 * demo AJAX-class
	 *
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */

	namespace Controllers\Ajax\blog;
	use \Pagen\eAjaxController;
	\Pagen\ajaxSettings (['Config', 'DataBase']);

	class delete extends eAjaxController {
		private $message;
		private $response;

		private $id;

		function request () {
			$this->id   = $_REQUEST ['id'];
		}

		function run () {
			// @todo
		}

		function response () {
			return json_encode([
				'message'  => $this->message,
				'response' => $this->response
			]);
		}
	}
?>
