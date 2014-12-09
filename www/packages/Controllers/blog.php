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
				$params ['edit'] = true;
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

		$this->files ['content'] = 'blog'.DIRSEP.'index';
	}

	public function action_add () {
		echo 1;
	}

	public function ctrl_action_index ($params = NULL) {
		$this->files ['publics'] = 'blog'.DIRSEP;
		$this->files ['content'] = 'blog'.DIRSEP.'index';
		$logic = new \Logic\Blog\Index ();
		$is_page = NULL;
		$this->data  ['content'] = $logic->facade ($params, $is_page);
		if ($is_page) {
			$this->files ['publics'] .= 'page';
			if (!is_null($params ['edit']))
				$this->files ['publics'] .= 'edit';

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
		$this->files = ['blog'.DIRSEP.'pagination'];
		$this->data = $params;
	}
}