<?php
class _design {
	public function createMenu () {
		if (config::DB) {
			global $word;
			$user_prioritet = User::$userInfo ['rights'] + 1;
			$menu = array ();
			$menu_query = mysql_query ("SELECT * FROM `".config::PREFIX."pages` WHERE `show` <= '$user_prioritet' AND `show`!='0' ORDER BY `hor_menu` ASC");
			$menu_row = mysql_fetch_assoc ($menu_query);
			$i = 0;
			do {
				$title_index = $menu_row ['title'];
				$menu_row ['title'] = $word [$title_index];
				if ($menu_row ['cpurl'] == '/') {
					$menu_row ['cpurl'] = '';
				}
				// replace title of pages for menu from language array
				
				$menu [$i] ['title'] = $menu_row ['title'];
				$menu [$i] ['cpurl'] = $menu_row ['cpurl'];
				//get menu array
				$i ++;
			} while ($menu_row = mysql_fetch_assoc ($menu_query));
			//forming horisontal menu
		}
		return $menu;
	}
}
?>