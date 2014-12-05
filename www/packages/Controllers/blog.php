<?php

namespace Controllers;
use \Pagen\eController;
use \Data\Design;


class blog extends eController {
	public function run (){
		$this->getLocals ($this->data);
		Design::addMenu ($this->data);
		$this->files = Design::getDefaultFilesArray ();
		$this->files ['content'] = 'blog'.DIRSEP.'index';
	}

	public function ctrl_action_items ($params = NULL) {
		$this->files = ['blog'.DIRSEP.'list'];
		$logic = new \Logic\Blog\Index ();
		$this->data  ['content'] = $logic->facade ();
		//@TODO
	}
}