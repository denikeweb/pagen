<?php
	/**
	 *	Pagen Controller parent class
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */
	abstract class eController {
		public    $args;
		private   $url;
		private   $site_title;
		private   $lang;
		private   $ls_name;
		protected $word = array();
		protected $view = '';

		protected $data = [];
		protected $files = [];
		protected $template = 'index';
		protected $cache = NULL;

		abstract public function run ();
		public function setTemplate ($template) {$this->template = $template;}

		public function view () {
			if (count($this->files) > 0)
				$this->view = \View::factory ($this->data, $this->files, NULL, $this->template, $this->cache);
			return $this->view;
		}

		final public function __construct (array $args = NULL, array $word = NULL) {
			$this->args = $args;
			$this->lang = \config::$Lang;
			$this->url = "//$_SERVER[HTTP_HOST]";
			$this->site_title = \config::TITLE;
			$this->ls_name = $this->url."$_SERVER[REQUEST_URI]?lang";
			$this->word = $word;
		}

		final protected function getLocals (array &$data = NULL, array $params = array ('url', 'title', 'lang', 'setLangUrl')) {
			if (in_array('url', $params)) {$data ['url'] = $this->url;}
			if (in_array('title', $params)) {$data ['SiteTitle'] = $this->site_title;}
			if (in_array('lang', $params)) {$data ['SiteLang'] = $this->lang;}
			if (in_array('setLangUrl', $params)) {$data ['setLangUrl'] = $this->ls_name;}
		}
	}
?>