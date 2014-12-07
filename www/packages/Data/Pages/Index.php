<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 07.12.2014
 * Time: 10:25
 */

namespace Data\Pages;

class Index {
	public static function addTitles (&$data) {
		$data ['title'] = 'Главная';
		$data ['meta_d'] = 'Главная [демо-страница] фреймворка Pagen';
		$data ['meta_k'] = 'Главная, демо-страница, фреймворк, Pagen';
		$data ['content'] = '
			<h1>Главная — Pagen</h1>
			<p>Содержимое Главной страницы.</p>
		';
	}
} 