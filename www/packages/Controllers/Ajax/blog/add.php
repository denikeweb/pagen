<?php
	/**
	 * demo AJAX-class
	 *
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */

	namespace Controllers\Ajax\blog;
	use \Pagen\eAjaxController;
	use \Pagen\User;
	use \Pagen\eController;

	\Pagen\ajaxSettings (['Config', 'DataBase']);

	class add extends eAjaxController {
		private $message;
		private $response;

		private $url;
		private $desc;
		private $title;
		private $text;

		function request () {
			$this->url   = $_REQUEST ['url'];
			$this->desc  = $_REQUEST ['desc'];
			$this->title = $_REQUEST ['title'];
			$this->text  = $_REQUEST ['text'];
		}

		function run () {
			User::init();
			if (User::is_admin ()) {
				$logic = new \Logic\Blog\Index ();
				$this->response = $logic->add ($this->url, $this->title, $this->desc, $this->text);
				$this->message = eController::getWords('alerts') [$logic->message_key];
			} else {
				$this->response = false;
				$this->message = eController::getWords ('alerts') ['access_error'];
			}
		}

		function response () {
			return json_encode([
				'message'  => $this->message,
				'response' => $this->response
			]);
		}
	}
?>
