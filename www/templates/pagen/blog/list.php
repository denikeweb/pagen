	<div>
		<?php foreach ($content as $item) {?>
			<div>
				<div><a href="/blog/<?= $item ['blog_url'] ?>"><?= $item ['blog_title'] ?></a></div>
				<div><?= $item ['blog_desc'] ?></div>
				<div class="control text-id hide"><?= $item ['blog_id'] ?></div>
				<?php if (\Pagen\User::is_admin ()) : ?>
					<div>
						<a href="/blog/<?= $item ['blog_url'] ?>/edit" >Редактировать</a>
						<span class="blog_control control blog_delete">Удалить</span>
					</div>
				<?php endif; ?>
			</div>
		<?php } ?>
	</div>


	<div>
		<?= \Pagen\ViewController::facade('blog', 'ctrl_action_pagination',  [
			'page' => $page,
			'pages_count' => $pages_count
		]);?>
	</div>