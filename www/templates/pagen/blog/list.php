	<div>
		<?php foreach ($content as $item) {?>
				<div><a href="/blog/<?= $item ['blog_url'] ?>"><?= $item ['blog_title'] ?></a></div>
				<div><?= $item ['blog_desc'] ?></div>
		<?php } ?>
	</div>



	<div>
		<?= \Pagen\ViewController::facade('blog', 'ctrl_action_pagination',  [
			'page' => $page,
			'pages_count' => $pages_count
		]);?>
	</div>