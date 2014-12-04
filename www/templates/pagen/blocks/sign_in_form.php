<?php
	if (\Pagen\User::is_auth()) {
		$class = 'class="no_display"';
		$user_plus = "<div id='user_plus'>$word[10] <strong>".\Pagen\User::$userInfo['login']."</strong>
								(<span class='exit_span'>$word[12]</span>)</div>";
	} else {
		$class = 'class="display"';
		$user_plus = '';
	}
?>
<center <?php echo $class; ?>>
<div id="login_alert" onclick="login_form(1)"><?php echo $word[17]; ?></div>
<div id="login_form">
	<form method="post" enctype="multipart/form-data" onsubmit="return false" action="/">
		<div class="login_close" onclick="login_form(2)">X</div>
		<p class="enter_label"><?php echo $word[17]; ?></p>
		<fieldset class="inputs" style="margin-bottom:0;">
		<input class="fields" type="text" id="login_e" name="login_e" title="<?php echo $word[5]; ?>" placeholder="<?php echo $word[5]; ?>"><br/>
		<input class="fields" type="password" id="pass_out_e" name="pass_out_e" title="<?php echo $word[6]; ?>" placeholder="<?php echo $word[6]; ?>">
		</fieldset>
		<div id="else_enter"><a href="sign_up"><?php echo $word[3]; ?></a><br><a href="remind"><?php echo $word[8]; ?></a></div>
		<input type="submit" class="log_button" value="<?php echo $word[4]; ?>" name="log_btn">
	</form>
	<div id="errors_e" class="errors"></div>
	<div id="access_e" class="access"></div>
</div>
</center>
<?php echo $user_plus; ?>