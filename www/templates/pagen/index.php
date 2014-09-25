<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $SiteLang; ?>" lang="<?php echo $SiteLang; ?>">
	<head>
		<title><?php echo $SiteTitle, ' - ', $title; ?></title>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta http-equiv="content-language" content="<?php echo $SiteLang; ?>">
		<meta name="document-state" content="Dynamic">
		<meta name="resource-type" content="document">
		<meta name="revisit" content="7">
		<meta name="robots" content="all">
		<meta name="description" content="<?php echo $meta_d; ?>">
		<meta name="keywords" content="<?php echo $meta_k; ?>">
		<?php if (isset($canonical_url)) { ?><link rel="canonical" href="<?php echo $canonical_url; ?>"><?php } ?>
		
		<!--link rel="shortcut icon" href="<?php echo $url; ?>/favicon.ico" -->
		<link href="<?php echo $url; ?>/css/style.css" rel="stylesheet" type="text/css">
		
		<script type="text/javascript" src="<?php echo $url; ?>/js/jquery-1.11.js"></script>
		<script type="text/javascript" src="<?php echo $url; ?>/js/scripts.js"></script>
		<script type="text/javascript" src="<?php echo $url; ?>/js/ajax.js"></script>
	</head>
	<body>
		<?php echo $file_sign_in_form; ?>
		<header id="header">
			<hgroup>
				<div id="languages">
					<a href="<?php echo $setLangUrl; ?>=uk">укр</a> / 
					<a href="<?php echo $setLangUrl; ?>=ru">рус</a> / 
					<a href="<?php echo $setLangUrl; ?>=en">eng</a>
				</div><!-- #languages -->
			</hgroup><!-- hgroup -->
		</header><!-- #languages -->
		<nav id="nav">
			<?php echo $file_hor_menu; ?>
		</nav><!-- #nav -->
		
		<section id="content">
			<article>
				<?= $data['content']; ?>
				<pre style="text-align: left; width: 940px; overflow: hidden;">
					<?php print_r ($data); ?>
				</pre>
			</article>
		</section><!-- #content-->

		<footer id="footer">
			<span>
				<?php echo $info; ?>
			</span>
		</footer><!-- #footer -->
	</body>
</html>