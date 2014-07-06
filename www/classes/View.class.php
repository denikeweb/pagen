<?php
class View {

	private $content;

	public static function factory (array $data = NULL, array $files = NULL, array $word = NULL,  $template = 'index') {
		return new View($data, $files, $word, $template);
	}

	private function __construct ($data, $files, $word, $template) {
		$folder = config::TEMPLATE;
		extract($data, EXTR_SKIP);
		$viewPath = SITE.'templates'.DIRSEP.$folder.DIRSEP;
		$templateFile = $viewPath.$template.EXT;
		extract($data, EXTR_SKIP);

		//files content loading
		$filesInput = array ();
		if (count($files) > 0)
		foreach ($files as $key => $value) {
			ob_start();
			try {
				include $viewPath.$value.EXT;
			} catch (Exception $e) {
				ob_end_clean();
				throw $e;
			}
			$filesInput ['file_'.$key] = ob_get_clean();
		}
		extract($filesInput, EXTR_SKIP);

		//template loading
		ob_start();
		try {
			include $templateFile;
		} catch (Exception $e) {
			ob_end_clean();
			throw $e;
		}
		$this->content = ob_get_clean();
	}

	private function getFile ($file = NULL, array $data = NULL) {
		$folder = config::TEMPLATE;
		extract($data, EXTR_SKIP);
		$viewPath = SITE.'templates'.DIRSEP.$folder.DIRSEP;
		$templateFile = $viewPath.$template.EXT;
	}

	private function view ($data = array (), $template = 'index', $settings = array ()) {
		$url = $this->url;
		if (is_file($file)) {
			include ($file);
		} else {
			echo 'View do not loaded';
		}
	}

	public function __toString() {
		return (string) $this->content;
	}
}
?>