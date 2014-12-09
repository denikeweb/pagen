<?php
	/**
	 * demo AJAX-class
	 *
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */

	namespace Controllers\Ajax\users_actions;
	use \Pagen\eAjaxController;
	use \Pagen\ViewController;
	\Pagen\ajaxSettings (['Config', 'DataBase']);

	class show_more extends eAjaxController {
		public $has_more;
		public $new_last_id;
		public $contents;

		public $last_id;

		function request () {
			$this->last_id = $_REQUEST ['last_id'];
		}

		function run () {
			$this->contents = (string) ViewController::facade(
				'users',
				'ctrl_action_items',
				[
					'last_id' => $this->last_id,
					'dataPicker' => $this
				]
			);
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
