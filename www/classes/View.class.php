<?php
class View {

	public static function factory (array $data = NULL, array $files = NULL, array $word = NULL,  $template = 'index') {
		return new View($data, $files, $word, $template);
	}

	private function __construct ($data, $files, $word, $template) {

	}

	private function view ($data = array (), $template = 'index', $settings = array ()) {
		global $word;
		$folder = config::TEMPLATE;
		extract($data, EXTR_SKIP);
		$this->word = $word;
		$this->viewPath = SITE.'templates'.DIRSEP.$folder.DIRSEP;
		$file = $this->viewPath.$template.EXT;
		$viewPath = $this->viewPath;
		$url = $this->url;
		if (is_file($file)) {
			include ($file);
		} else {
			echo 'View do not loaded';
		}
	}

	public function __toString()
	{
		return '1';
		/*try
		{
			return $this->render();
		}
		catch (Exception $e)
		{
			return $error_response->body();
		}*/
	}
	

}
?>