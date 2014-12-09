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

	class edit extends eAjaxController {
		private $message;
		private $response;

		private $id;
		private $url;
		private $desc;
		private $title;
		private $text;

		function request () {
			$this->id   = $_REQUEST ['id'];
			$this->url   = $_REQUEST ['url'];
			$this->desc  = $_REQUEST ['desc'];
			$this->title = $_REQUEST ['title'];
			$this->text  = $_REQUEST ['text'];
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
