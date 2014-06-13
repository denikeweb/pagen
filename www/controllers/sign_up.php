<?php
class sign_up {
	public static function run (){
		self::printContent ();
	}
	
	public static function printContent (){
		$data = array ();
		$url = Site::$SiteName;
		if (!User::is_auth()) { 
			Site::$Content = 
<<<HERE
<script type="text/javascript" src="$url/js/users.js"></script>
<center>
<div class="form">
	<form method="post" enctype="multipart/form-data" onsubmit="return false" action="/">
		<p class="title">$word[3]</p>
		<fieldset class="inputs" style="margin-bottom:0;">
		<input type="text" 		id="login" 	 name="login" 	title="$word[5]" placeholder="$word[5]" class="fields" /><br/>
		<input type="password" 	id="pass_out" 	 name="pass_out" 	title="$word[6]" placeholder="$word[6]" class="fields" /><br/>
		<input type="password" id="repeat_pass" name="repeat_pass" title="$word[7]" placeholder="$word[7]" class="fields" /><br/>
		<input type="email" 	id="e_mail" 	 name="e_mail" 	title="e-mail" placeholder="e-mail" class="fields" />
		</fieldset>
		<input type="submit" id="submit" class="button" value="$word[3]" name="log_btn" onclick="sign_up()" />
	</form>
	<div id="errors" class="errors"></div>
	<div id="access" class="access"></div>
</div>
</center>
HERE;

		//print sign up form if user nor auth else send to personal cabinet
		} else {
			Site::$Content = "<script type='text/javascript'>window.location = '$url/cabinet'</script>";
		}
		if (!config::DB){
			$data ['title'] = 'Зарегистрироваться';
			$data ['meta_d'] = '';
			$data ['meta_k'] = '';
			$data ['info'] = '© 2013 розробка Драгомирика Дениса, студія <a href="//web-mount.com" title="Web-Mount">Web-Mount</a>. Всі права захищені. PaGen доступний для використання та модифікації під ліцензією MIT.';
		}
		Site::printContent(Site::$Content, 'index', $data);
	}
}

?>

<?php
?>