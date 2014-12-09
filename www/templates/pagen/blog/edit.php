<form>
	<fieldset>
		<input class="control input-id" type="hidden" hidden="hidden" value="<?= $content ['blog_id'] ?>">
		<div><input class="fields control input-title" type="text" placeholder="Заголовок заметки"
		            value="<?= $content ['blog_title'] ?>"
				></div>
		<div><input class="fields control input-url" type="text" placeholder="URL заметки"
		            value="<?= $content ['blog_url'] ?>"
				></div>
		<div><textarea class="fields control input-desc" placeholder="Краткое описание заметки"><?=
					$content ['blog_desc']
				?></textarea></div>
		<div><textarea class="fields control input-text" placeholder="Текст заметки"><?=
					$content ['blog_text']
				?></textarea></div>
	</fieldset>
	<button class="log_button control blog_<?= $action; ?>">Сохранить</button>
</form>

<div>&nbsp;</div>