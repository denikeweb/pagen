<?php
	if (config::DB) {
		$HorMenu = '<ul id="menu">';
		$menu_rows = $_d->createMenu ();
		$url = $a->url;
		foreach ($menu_rows as $row) {
			$HorMenu .= "<li><a href=\"$url/$row[cpurl]\" title=\"$row[title]\">$row[title]</a></li>";
		}
		if (!User::is_auth()) {
			$HorMenu .= "<li><a href=\"$url/sign_up\" title=\"$word[3]\">$word[3]</a></li>";
		}
		$HorMenu .= '</ul><!-- #menu -->';
		echo $HorMenu;
	}
?>