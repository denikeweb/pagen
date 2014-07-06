<?php
class View {

	private $content;

	public static function factory (array $data = NULL, array $files = NULL, array $word = NULL,  $template = 'index') {
		return new View($data, $files, $word, $template);
	}

	private function __construct ($data, $files, $word, $template) {

	}

	private function getFile ($file = NULL, array $data = NULL) {
		$folder = config::TEMPLATE;
		extract($data, EXTR_SKIP);
		$viewPath = SITE.'templates'.DIRSEP.$folder.DIRSEP;
		$templateFile = $this->viewPath.$template.EXT;
	}

	private function view ($data = array (), $template = 'index', $settings = array ()) {
		$this->
		$file = $this->viewPath.$template.EXT;
		$viewPath = $this->viewPath;
		$url = $this->url;
		if (is_file($file)) {
			include ($file);
		} else {
			echo 'View do not loaded';
		}
	}

	public function __toString() {
		return $this->content;
	}
}
?>