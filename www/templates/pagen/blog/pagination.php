<?php for ($i = 1; $i <= $pages_count; $i ++):
	if ($i == $page) :?>
		<strong><?= $i ?></strong>
	<?php else: ?>
		<a href="/blog/page/<?= $i ?>"><?= $i ?></a>
<?php endif; endfor; ?>