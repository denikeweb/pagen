<h1><?= $titles ['sign_in_form']; ?></h1>
<?php
	if (\Pagen\User::is_auth()) {
		$class = 'class="no_display"';
		$user_plus = $titles ['logged_as']." <strong>".\Pagen\User::$userInfo ['users_name']."</strong>
								(<span class='exit_span'>$titles[logout]</span>)";
	} else {
		$class = 'class="display"';
		$user_plus = '';
	}
?>
<form <?= $class; ?> method="post" enctype="multipart/form-data" onsubmit="return false" action="/">
	<fieldset class="inputs" style="margin-bottom:0; text-align: left">
		<input class="fields control login" type="email" id="login_e" name="email"
		       title="Логин" placeholder="Логин"><br/>
		<input class="fields control pass" type="password" id="pass_out_e" name="pass"
		       title="Пароль" placeholder="Пароль">
	</fieldset>
	<input type="submit" class="log_button control sign_in" value="Вход" name="log_btn">
</form>
<div id="errors_e" class="errors"></div>
<div id="access_e" class="access"></div>

<div style="text-align: left"><?= $user_plus; ?></div>

<br>
<?= $content; ?>
