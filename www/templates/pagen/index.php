<?php
	include($path.'models/_design.php');
	$_d = new _design();
	function hor_menu ($_d) {include ($viewPath.'blocks/hor_menu.php');}
	function sign_in_form () {include ($viewPath.'blocks/sign_in_form.php');}
	if (!config::DB) {include ($viewPath.'functional/set_lang.php');}
	if (empty($data['info'])) {$data['info'] = $word [0];}
?>

<!--?php
echo $data[title], 1;
echo '<br>';
echo $this->data[title], 2;
echo '<br>';
echo $word[2], 3;
echo '<br>';
echo $this->word[2], 4;
echo '<br>';
?-->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->lang; ?>" lang="<?php echo $this->lang; ?>">
	<head>
		<title><?php echo $this->site_title, ' - ', $data[title]; ?></title>
		
		<meta charset="utf-8">
		<meta http-equiv="content-language" content="$lang">
		<meta name="document-state" content="Dynamic">
		<meta name="resource-type" content="document">
		<meta name="revisit" content="7">
		<meta name="robots" content="all">
		<meta name="description" content="<?php echo $data['meta_d']; ?>">
		<meta name="keywords" content="<?php echo $data['meta_k']; ?>">
		<?php if (isset($data['canonical_url'])) { ?><link rel="canonical" href="<?php echo $data['canonical_url'], 1; ?>"><?php } ?>
		
		<!--link rel="shortcut icon" href="<?php echo $this->url; ?>/favicon.ico" -->
		<link href="<?php echo $this->url; ?>/css/style.css" rel="stylesheet" type="text/css">
		
		<script type="text/javascript" src="<?php echo $this->url; ?>/js/jquery-1.11.js"></script>
		<script type="text/javascript" src="<?php echo $this->url; ?>/js/scripts.js"></script>
	</head>
	<body>
		<?php sign_in_form (); ?>
		<header id="header">
			<hgroup>
				<div id="languages">
					<a href="<?php echo $this->ls_ame; ?>=uk">укр</a> / 
					<a href="<?php echo $this->ls_ame; ?>=ru">рус</a> / 
					<a href="<?php echo $this->ls_ame; ?>=en">eng</a>
				</div><!-- #languages -->
			</hgroup><!-- hgroup -->
		</header><!-- #languages -->
		<nav id="nav">
			<?php hor_menu ($_d); ?>
		</nav><!-- #nav -->
		
		<section id="content">
			<article>
				<?php echo $data['content']; ?>
				<?php echo $data['content2']; ?>
			</article>
		</section><!-- #content-->

		<footer id="footer">
			<span>
				<?php echo $data['info']; ?>
			</span>
		</footer><!-- #footer -->
	</body>
</html>