<?php
class cabinet {
	public static function run (){
		self::printContent ();
	}
	
	public static function printContent (){
		$data = array ();
		if (User::is_auth()) {
		$siteurl = Site::$SiteName;
		$user = User::$userInfo;
		Site::$Content = 
<<<HERE
<center>
<script type="text/javascript" src="$siteurl/js/cabinet.js"></script>
<div class="form bigform">
	<form method="post" enctype="multipart/form-data" onsubmit="return false" action="/" name="cab_form">
		<p class="title">$word[9]</p>
		<p class="title">$word[18]</p>
		<fieldset class="inputs">
		<input type="text" 		id="my_login" 	 name="my_login" 	title="$word[5]" placeholder="$word[5]" value="$user[login]" class="fields" /><br/>
		<input type="email" 	id="my_e_mail" 	 name="my_e_mail" 	title="e-mail" placeholder="e-mail" value="$user[email]" class="fields" /><br/>
		<input type="password" 	id="my_pass" 	 name="my_pass" 	title="$word[6]" placeholder="$word[6]" class="fields" />
		</fieldset>
		<input type="submit" id="submit" class="button" value="$word[14]" name="log_btn" onclick="save_cabinet()" />
	<div id="errors1" class="errors"></div>
	<div id="access1" class="access"></div>
		<p class="title">$word[19]</p>
		<fieldset class="inputs">
		<input type="password" 	id="pass_out" 	 name="pass_out" 	title="$word[15]" placeholder="$word[15]" class="fields" /><br/>
		<input type="password" 	id="new_pass" 	 name="new_pass" 	title="$word[16]" placeholder="$word[16]" class="fields" /><br/>
		<input type="password" id="repeat_pass" name="repeat_pass" title="$word[7]" placeholder="$word[7]" class="fields" />
		</fieldset>
		<input type="submit" id="submit" class="button blue" value="$word[14]" name="log_btn" onclick="save_pass()" />
	<div id="errors2" class="errors"></div>
	<div id="access2" class="access"></div>
	</form>
</div>
</center>
HERE;
//print sign up form if user nor auth else send to personal cabinet
		} else {
			Site::$Content = '<div id="errors" class="errors">'.$word[13].'</div>';
		}
		if (!config::DB){
			$data ['title'] = 'Кабинет';
			$data ['meta_d'] = '';
			$data ['meta_k'] = '';
			$data ['info'] = '© 2013 розробка Драгомирика Дениса, студія <a href="//web-mount.com" title="Web-Mount">Web-Mount</a>. Всі права захищені. PaGen доступний для використання та модифікації під ліцензією MIT.';
		}
		Site::printContent(Site::$Content, 'index', $data);
	}
}

?>