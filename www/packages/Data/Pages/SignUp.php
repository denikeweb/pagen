<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 07.12.2014
 * Time: 10:25
 */

namespace Data\Pages;

class SignUp {
	public static function addTitles (&$data) {
		$data ['title'] = $data ['titles'] ['sign_up'];
		$data ['meta_d'] = '';
		$data ['meta_k'] = '';
	}
} 