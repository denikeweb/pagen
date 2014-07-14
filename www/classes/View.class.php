<?php
class View {

	private $content = '';

	public static function factory (array $data = NULL, array $files = NULL, array $word = NULL,  $template = 'index', array $cache = NULL) {
		$storage = new Storage ($files, $cache);
		return new View($data, $storage, $word, $template);
	}

	private function __construct ($data, $storage, $word, $template) {
		//creating template path
		$folder = config::TEMPLATE;
		$viewPath = SITE.'templates'.DIRSEP.$folder.DIRSEP;
		$templateFile = $viewPath.$template.EXT;
		extract($data, EXTR_SKIP);

		//files content loading
		$fs = $storage->getFiles ();
		if ($fs)
			foreach ($fs as $key => $value) {
				ob_start();
				if ($storage->isCached ($key)) {
					$storage->getCache ();
				} else {
					$thisFile = $viewPath.$value.EXT;
					if (is_file($thisFile)) {
						include $thisFile;
						$var = 'file_'.$key;
						$$var = ob_get_clean();
					} else {
						ob_end_clean();
					}
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

	public function __toString() {
		return (string) $this->content;
	}
}
?>