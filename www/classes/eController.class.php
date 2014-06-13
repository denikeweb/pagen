<?php
class eController {
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

	public function view ($data = array (), $template = 'index') {
		global $word;
		define ('DIRSEP', DIRECTORY_SEPARATOR);
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
	
	public function run () {
		$this->loadModel ();
	}

	public function loadModel () {
		if (is_file($this->modelPath)) {
			define ('DIRSEP', DIRECTORY_SEPARATOR);
			$eModel = dirname(__FILE__).DIRSEP.'eModel.class.php';
			include_once ($eModel);
			include ($this->modelPath);
		}
	}
}
?>