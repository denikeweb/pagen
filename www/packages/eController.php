<?php
abstract class eController {
	/**
	*	Pagen Controller parent class
	*	Pagen v1.1
	*
	*/
	public    $args;
	private   $url;
	private   $site_title;
	private   $lang;
	private   $ls_name;
	protected $word = array();
	protected $view = '';
	
	abstract public function run ();
	public function view () {return $this->view;}

	final public function __construct (array $args = NULL, array $word = NULL) {
		$this->args = $args;
		$this->lang = \config::$Lang;
		$this->url = "//$_SERVER[HTTP_HOST]";
		$this->site_title = \config::TITLE;
		$this->ls_name = $this->url."$_SERVER[REQUEST_URI]?lang";
		$this->word = $word;
		echo '<pre><code style="text-align: left; display: block;">';
		print_r ($word);
		echo '</code></pre>';
	}

	final protected function getLocals (array &$data = NULL, array $params = array ('url', 'title', 'lang', 'setLangUrl')) {
		if (in_array('url', $params)) {$data ['url'] = $this->url;}
		if (in_array('title', $params)) {$data ['SiteTitle'] = $this->site_title;}
		if (in_array('lang', $params)) {$data ['SiteLang'] = $this->lang;}
		if (in_array('setLangUrl', $params)) {$data ['setLangUrl'] = $this->ls_name;}
	}
}
?>