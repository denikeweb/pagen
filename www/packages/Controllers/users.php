<?php

namespace Controllers;
use \Pagen\eController;
use \Data\Design;


class users extends eController {
	public function run (){
		$this->getLocals ($this->data);
		Design::addMenu ($this->data);
		$this->files = Design::getDefaultFilesArray ();

		$func = 'ctrl_action_index';
		$this->$func ();
	}

	public function ctrl_action_index ($params = NULL) {
		$this->files ['publics'] = 'users'.DIRSEP.'list';
		$this->files ['content'] = 'users'.DIRSEP.'index';
		$logic = new \Logic\Blog\Index ();
		$is_page = NULL;
		$this->data  ['content'] = $logic->facade ($params, $is_page);
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