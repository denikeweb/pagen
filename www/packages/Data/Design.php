<?php
	/**
	 * @todo demo class
	 *
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */
	namespace Data;
	use \Pagen\eController;
	use Pagen\User;

	class Design {
		public static function addMenu (&$data) {
			$words = eController::getWords ('menu');
			$data ['pages_url'] = [
				'index'          => [
					'url' => '/',
					'title' => $words ['index']
				],
				'sign_in'        => [
					'url' => '/sign_in',
					'title' => $words ['sign_in']
				],
				'sign_up'        => [
					'url' => '/sign_up',
					'title' => $words ['sign_up']
				],
				'page1'          => [
					'url' => '/page1',
					'title' => $words ['page1']
				],
				'page2'          => [
					'url' => '/page2',
					'title' => $words ['page2']
				],
				'blog'           => [
					'url' => '/blog',
					'title' => $words ['blog']
				],
				'blog_note'      => [
					'url' => '/blog/demo-note',
					'title' => $words ['blog_note']
				],
				'blog_note_edit' => [
					'url' => '/blog/demo-note/edit',
					'title' => $words ['blog_note_edit']
				],
				'users'          => [
					'url' => '/users',
					'title' => $words ['users']
				],
				'users_admin'    => [
					'url' => '/users/admin',
					'title' => $words ['users_admin']
				]
			];
			$data ['titles'] = eController::getWords('titles');
		}

		public static function getDefaultFilesArray () {
			return [
				'sign_in_form' => 'blocks'.DIRSEP.'sign_in_form',
				'hor_menu' => 'blocks'.DIRSEP.'hor_menu',
				'header' => 'blocks'.DIRSEP.'header',
				'footer' => 'blocks'.DIRSEP.'footer'
			];
		}

		public static function notForAuth () {
			$url = '/';
			if (User::is_auth())
				header ("Location: $url");
		}
	}
?>