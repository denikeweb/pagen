<h1><?= $title; ?></h1>
<?php if (\Pagen\User::is_admin () and !isset($action)) : ?>
	<div style="
		padding-bottom: 20px;
		margin-left: 50px;
		">[ <a href="/blog/add" >Добавить заметку</a> ]</div>
<?php endif; ?>
<?= $file_publics; ?>