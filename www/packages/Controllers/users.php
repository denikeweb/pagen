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

	public function ctrl_action_index () {
		$this->ctrl_action_items();
		$this->files ['content'] = 'users'.DIRSEP.'index';
	}

	public function ctrl_action_items ($params = NULL) {
		$this->files ['users'] = 'users'.DIRSEP.'list';
		$logic = new \Logic\Users\Index ();
		$last_id = $params ['last_id'];
		$dataPicker = $params ['dataPicker'];
		$this->data ['content'] = $logic->facade ($last_id);
		if (!is_null($dataPicker)) {
			$dataPicker->new_last_id = $logic->last_id;
			$dataPicker->has_more = $logic->has_more;
		} else {
			$this->data ['title'] = $logic->getTitle ();
			$this->data ['last_id'] = $logic->last_id;
		}
	}
}