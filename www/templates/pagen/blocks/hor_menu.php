<?php if (config::DB) { ?>
	<ul id="menu">
		<?php
			$menu_rows = $_d->createMenu ($word);
			foreach ($menu_rows as $row) {?>
				<li><a href="<?php echo $url; ?>/<?php echo $row['cpurl']; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></li>
			<?php }
			if (!User::is_auth()) {?>
				<li><a href="<?php echo $url; ?>/sign_up" title="<?php echo $word[3]; ?>"><?php echo $word[3]; ?></a></li><?php
			}
		?>
	</ul><!-- #menu -->
<?php } ?>