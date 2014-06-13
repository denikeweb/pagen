<?php
class remind {
	public static function run (){
		self::printContent ();
	}
	
	public static function printContent (){
		$data = array ();
		$url = Site::$SiteName;
		Site::$Content = 
<<<HERE
<center>
<div class="form">
<script type="text/javascript" src="$url/js/users.js"></script>
	<form method="post" enctype="multipart/form-data" onsubmit="return false" action="/">
		<p class="title">$word[8]</p>
		<fieldset class="inputs" style="margin-bottom:0;">
		<input type="email" 	id="e_mail" 	 name="e_mail" 	title="e-mail" placeholder="e-mail" class="fields">
		</fieldset>
		<input type="submit" id="submit" class="button" value="$word[8]" name="log_btn" onclick="remind()" />
	</form>
	<div id="errors" class="errors"></div>
	<div id="access" class="access"></div>
</div>
</center>
HERE;
		if (!config::DB){
			$data ['title'] = 'Напомнить пароль';
			$data ['meta_d'] = '';
			$data ['meta_k'] = '';
			$data ['info'] = '© 2013 розробка Драгомирика Дениса, студія <a href="//web-mount.com" title="Web-Mount">Web-Mount</a>. Всі права захищені. PaGen доступний для використання та модифікації під ліцензією MIT.';
		}
		Site::printContent(Site::$Content, 'index', $data);
	}
}

?>
