<?php
	/**
	 * demo AJAX-class
	 *
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */

	namespace Controllers\Ajax\users_actions;
	use \Pagen\eAjaxController;
	\Pagen\ajaxSettings (['Config', 'DataBase']);

	class show_more extends eAjaxController {
		private $has_more;
		private $new_last_id;
		private $contents;

		private $last_id;

		function request () {
			$this->last_id   = $_REQUEST ['last_id'];
		}

		function run () {
			// @todo
		}

		function response () {
			return json_encode([
				'has_more'  => $this->has_more,
				'last_id'  => $this->new_last_id,
				'contents' => $this->contents
			]);
		}
	}
?>
