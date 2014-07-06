<?php
abstract class eController {
	/**
	*	Pagen Controller parrent class
	*	Pagen v1.0
	*
	*/
	public  $args;
	private $modelPath;
	private $url;
	private $site_title;
	private $lang;
	private $ls_name;
	
	public function run () {
		$this->loadModel ();
	}

	final public function __construct ($modelPath = '', $args = array ()) {
		$this->modelPath = $modelPath;
		$this->args = $args;
		$this->lang = config::$Lang;
		$this->url = "//$_SERVER[HTTP_HOST]";
		$this->site_title = config::TITLE;
		$this->ls_name = "//$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]?lang";
	}

	final protected function getLocals (array $data = NULL, array $params = array ('url', 'title', 'lang', 'setLangUrl')) {
		if (in_array('url', $params)) {$data ['url'] = $this->url;}
		if (in_array('title', $params)) {$data ['SiteTitle'] = $this->site_title;}
		if (in_array('lang', $params)) {$data ['SiteLang'] = $this->lang;}
		if (in_array('setLangUrl', $params)) {$data ['setLangUrl'] = $this->ls_name;}
		return $data;		
	}

	final protected function loadModel ($modelPath = '') {
		if (empty($modelPath)) {
			$modelPath = $this->modelPath;
		}
		$modelPath = SITE.'models'.DIRSEP.$modelPath.EXT;
		if (is_file($modelPath)) {
			$eModel = dirname(__FILE__).DIRSEP.'eModel.class'.EXT;
			include_once ($eModel);
			include ($modelPath);
		}
	}
}
?>