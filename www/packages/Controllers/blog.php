<?php

namespace Controllers;
use \Pagen\eController;
use \Data\Design;


class blog extends eController {
	public function run (){
		$this->getLocals ($this->data);
		Design::addMenu ($this->data);
		$this->files = Design::getDefaultFilesArray ();

		$params = ['page' => 1];
		$n = count ($this->args);
		for ($i = 0; $i < $n; $i ++) {
			if ($this->args [$i] == 'edit' and $i + 1 == $n) {
				$params ['edit'] = \Pagen\User::is_admin ();
				break;
			}
			if ($this->args [$i] == 'page') {
				$params ['page'] = (isset($this->args [$i + 1])) ? $this->args [$i + 1] : $params ['page'];
				break;
			}
			$params [] = $this->args [$i];
		}
		$func = 'ctrl_action_index';
		$this->$func ($params);
	}

	public function action_add () {
		$this->getLocals ($this->data);
		Design::addMenu ($this->data);
		$this->files = Design::getDefaultFilesArray ();

		$this->files ['publics'] = 'blog'.DIRSEP.'edit';
		$this->files ['content'] = 'blog'.DIRSEP.'index';
		$this->data ['action'] = 'add';
		$this->data ['title'] = "Добавить заметку";
	}

	public function ctrl_action_index ($params = NULL) {
		$this->files ['publics'] = 'blog'.DIRSEP;
		$this->files ['content'] = 'blog'.DIRSEP.'index';
		$logic = new \Logic\Blog\Index ();
		$is_page = NULL;
		$this->data  ['content'] = $logic->facade ($params, $is_page);
		if ($is_page) {
			$annex = 'page';
			if (!is_null($params ['edit']) and $params ['edit']) {
				$annex = 'edit';
				$this->data ['action'] = 'edit';
			}
			$this->files ['publics'] .= $annex;
		} else
			$this->files ['publics'] .= 'list';

		$this->data ['title'] = $logic->title;
		$this->data ['page'] = $logic->page;
		$this->data ['pages_count'] = $logic->pages_count;
	}

	/**
	 * @param $params
	 *      [page] -- current page
	 *      [pages_count] -- pages_count
	 */
	public function ctrl_action_pagination ($params) {
		$this->files = ['pagination' => 'blog'.DIRSEP.'pagination'];
		$this->cache = array(
			'pagination' => 60
		);
		$this->data = $params;
	}
}