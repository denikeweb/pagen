<?php
class View {

	private $content = '';

	public static function factory (array $data = NULL, array $files = NULL, array $word = NULL,  $template = 'index') {
		return new View($data, $files, $word, $template);
	}

	private function __construct ($data, $files, $word, $template) {
		//creating template path
		$folder = config::TEMPLATE;
		$viewPath = SITE.'templates'.DIRSEP.$folder.DIRSEP;
		$templateFile = $viewPath.$template.EXT;
		extract($data, EXTR_SKIP);

		//files content loading
		if (count($files) > 0)
		foreach ($files as $key => $value) {
			ob_start();
			$thisFile = $viewPath.$value.EXT;
			if (is_file($thisFile)) {
				include $thisFile;
				$var = 'file_'.$key;
				$$var = ob_get_clean();
			} else {
				ob_end_clean();
			}
		}

		//template loading
		ob_start();
		if (is_file($templateFile)) {
			include $templateFile;
			$this->content = ob_get_clean();
		} else {
			ob_end_clean();
			foreach ($filesInput as $value) {
				$this->content .= $value;
			}
		}
	}

	private function getFile ($file = NULL, array $data = NULL) {
		$folder = config::TEMPLATE;
		extract($data, EXTR_SKIP);
		$viewPath = SITE.'templates'.DIRSEP.$folder.DIRSEP;
		$templateFile = $viewPath.$template.EXT;
	}

	public function __toString() {
		return (string) $this->content;
	}
}
?>