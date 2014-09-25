<?php

	namespace Controllers\Ajax\auth;
	\settings (['Config']);

	class logout extends \eAjaxController {
		public function run () {
			$this->request ()
				->response ();
		}

		protected function request () {
			$this->removeAuth ();
			return $this;
		}

		protected function response () {
			echo '200 OK';
		}

		private function removeAuth () {
			session_start();
			unset($_SESSION['id']);
			unset($_SESSION['rights']);
		}
	}
?>
