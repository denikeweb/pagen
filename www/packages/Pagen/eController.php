<?php
	/**
	 *	Pagen Controller parent class
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */
	namespace Pagen;

	abstract class eController extends ParrentController {
		public    $args;
		private   $url;
		private   $site_title;
		private   $lang;
		private   $ls_name;
		public    $view = '';

		public    $data = [];
		public    $files = [];
		public    $template = 'index';
		public    $cache = [];

		protected static $words = [];

		abstract public function run ();
		public function setTemplate ($template) {$this->template = $template;}

		public function view () {
			$this->view = View::factory ($this->data, $this->files, $this->template, $this->cache);
			return $this->view;
		}

		final public function __construct (array $args = NULL) {
			$this->args = $args;
			$this->lang = \config::$Lang;
			$this->url = "//$_SERVER[HTTP_HOST]";
			$this->site_title = \config::TITLE;
			$this->ls_name = $this->url."$_SERVER[REQUEST_URI]?lang";
			parent::__construct ();
		}

		final protected function getLocals (array &$data = NULL, array $params = array ('url', 'title', 'lang', 'setLangUrl')) {
			if (in_array('url', $params)) {$data ['url'] = $this->url;}
			if (in_array('title', $params)) {$data ['SiteTitle'] = $this->site_title;}
			if (in_array('lang', $params)) {$data ['SiteLang'] = $this->lang;}
			if (in_array('setLangUrl', $params)) {$data ['setLangUrl'] = $this->ls_name;}
		}

		/**
		 * Load words of sth group of sth language
		 *
		 * @param      $group
		 * @param null $lang
		 *
		 * @return array
		 */
		final public static function getWords ($group, $lang = NULL) {
			if (is_null($lang))
				$lang = \config::$Lang;
			if (isset (self::$words [$lang] [$group]))
				return self::$words [$lang] [$group];
			$path = SITE.'templates'.DIRSEP.\config::TEMPLATE.DIRSEP.'languages'.DIRSEP.$lang.DIRSEP.$group.EXT;
			if (is_file($path) === false)
				return [];
			self::$words [$lang] [$group] = include ($path);
			return self::$words [$lang] [$group];
		}
	}
?>