<h1><?= $titles ['sign_in_form']; ?></h1>
<form action="" method="post" enctype="multipart/form-data" style="text-align: left">
	<fieldset>
		<div><input class="fields control text-email" type="email" placeholder="E-mail" name="email"></div>
		<div><input class="fields control text-pass"  type="password"  placeholder="<?= $titles ['pass']; ?>"   name="pass" ></div>
		<div><input class="fields control text-name"  type="text"  placeholder="Name"   name="name" ></div>
		<div><input class="fields control text-url"   type="text"  placeholder="Your account link" name="url" ></div>
	</fieldset>
	<button class="log_button control sign_up"><?= $titles ['to_sign_up']; ?></button>
</form>
<br>