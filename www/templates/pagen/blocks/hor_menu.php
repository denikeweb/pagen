<nav id="nav">
	<ul id="menu">
		<?php
		$menu_rows = $pages_url;
		foreach ($menu_rows as $row) {?>
			<li><a href="<?php echo $url, $row ['url']; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></li>
		<?php }
		if (!\Pagen\User::is_auth()) {?>
			<li><a href="<?php echo $url; ?>/sign_up" title="<?php echo $word[3]; ?>"><?php echo $word[3]; ?></a></li><?php
		}
		?>
	</ul><!-- #menu -->
</nav><!-- #nav -->