<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */
	namespace Pagen;

	class View {

		private $content = '';

		public static function factory (
			array $data = NULL,
			array $files = NULL,
			$template = 'index',
			array $cache = NULL
		) {
			$storage = new Storage ($files, $cache);
			return new View($data, $storage, $template);
		}

		private function __construct ($data, $storage, $template) {
			//creating template path
			$folder = \config::TEMPLATE;
			$storage->setviewPath(SITE.'templates'.DIRSEP.$folder.DIRSEP);
			$storage->setviewCachePath(SITE.'templates/'.$folder.'/_cache/');
			$templateFile = $storage->viewPath ().$template.EXT;
			extract($data, EXTR_SKIP);

			//files content loading
			$fs = $storage->getFiles ();
			if ($fs)
				foreach ($fs as $key => $value) {
					if ($storage->isCached ($key)) {
						if ($storage->needCaching ($key)) {
							$content = '';
							ob_start();
							$tFile = $storage->viewPath ().$value.EXT;
							if (is_file($tFile)) {
								include $tFile;
								$content = ob_get_clean ();
							} else {
								ob_end_clean();
							}
							$thisFile = $storage->viewCachePath ().$value.EXT;
							$handle = fopen($thisFile, 'w+b');
							if ($handle) {
								fwrite($handle, $content);
								fclose($handle);
							}
							//echo $handle;
						}
						$var = 'file_'.$key;
						$$var = $storage->getCache ($key);
					} else {
						ob_start();
						$thisFile = $storage->viewPath ().$value.EXT;
						if (is_file($thisFile)) {
							include $thisFile;
							$var = 'file_'.$key;
							$$var = ob_get_clean ();
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
				foreach ($storage->getFiles () as $key => $value) {
					$var = 'file_'.$key;
					$this->content .= $$var;
				}
			}
		}

		public function __toString() {
			return (string) $this->content;
		}
	}
?>