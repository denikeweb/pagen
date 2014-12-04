<?php
	/**
	 *
	 * @ajaxFrontController
	 * @version Pagen 1.1.6
	 * @author Denis Dragomiric <den@lux-blog.org>
	 *
	 */

	define ('DIRSEP', DIRECTORY_SEPARATOR);
	define ('SITE', dirname(dirname(dirname(dirname(__FILE__)))).DIRSEP);

	include_once (SITE.'pagen_config.php');
	\Pagen\AjaxRegistry::start ();
	$controller = \Pagen\AjaxRegistry::$path;
	$a = new $controller ($_REQUEST);
	$a->request ();
	$a->run ();
	echo $a->response ();

	\Pagen\AjaxRegistry::finish ();
?>