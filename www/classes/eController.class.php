<?php
abstract class eController {
	/**
	*	Pagen Controller parrent class
	*	Pagen v1.0
	*
	*/
	private $modelPath;
	public $viewPath;
	public $path;
	public $args;
	public $data;
	public $content;
	public $url;
	public $site_title;
	public $ls_ame;

	function __construct ($modelPath = '', $args = array (), $path = '') {
		$this->modelPath = $modelPath;
		$this->args = $args;
		$this->path = $path;
		$this->lang = Site::$Lang;
		$this->url = "//$_SERVER[HTTP_HOST]";
		$this->site_title = config::TITLE;
		$this->ls_ame = "//$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]?lang";
		$this->content = array ();
	}

	protected function view ($data = array (), $template = 'index', $settings = array ()) {
		global $word;
		$folder = config::TEMPLATE;
		$content = $this->content;
		foreach ($content as $part) {
			$data ['content'] .= $part;
		}
		$this->data = $data;
		$this->word = $word;
		$this->viewPath = $this->path.'templates'.DIRSEP.$folder.DIRSEP;
		$file = $this->viewPath.$template.'.php';
		if (is_file($file)) {
			include ($file);
		} else {
			echo 'View do not loaded';
		}
	}
	
	protected function run () {
		$this->loadModel ();
	}

	protected function loadModel ($modelPath = '') {
		if (empty($modelPath)) {
			$modelPath = $this->modelPath;
		}
		$modelPath = SITE.'models'.DIRSEP.$modelPath.'.php';
		if (is_file($modelPath)) {
			$eModel = dirname(__FILE__).DIRSEP.'eModel.class.php';
			include_once ($eModel);
			include ($modelPath);
		}
	}
}
?>