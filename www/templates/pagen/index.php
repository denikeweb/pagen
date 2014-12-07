<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= $SiteLang; ?>" lang="<?= $SiteLang; ?>">
	<head>
		<title><?php echo $SiteTitle, ' - ', $title; ?></title>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta http-equiv="content-language" content="<?php echo $SiteLang; ?>">
		<meta name="document-state" content="Dynamic">
		<meta name="resource-type" content="document">
		<meta name="revisit" content="7">
		<meta name="robots" content="all">
		<meta name="description" content="<?= $meta_d; ?>">
		<meta name="keywords" content="<?= $meta_k; ?>">
		<?php if (isset($canonical_url)) { ?><link rel="canonical" href="<?php echo $canonical_url; ?>"><?php } ?>
		
		<!--link rel="shortcut icon" href="<?php echo $url; ?>/favicon.ico" -->
		<link href="<?= $url; ?>/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?= $file_sign_in_form; ?>
		<?= $file_header; ?>
		<?= $file_hor_menu; ?>
		
		<section id="content">
			<article>
				<?= $file_content; ?>
				<?php \Annex\Dev::showArray ($data); ?>
			</article>
		</section><!-- #content-->

		<?= $file_footer; ?>

		<script type="text/javascript" src="<?php echo $url; ?>/js/jquery-1-11.js"></script>
		<script type="text/javascript" src="<?php echo $url; ?>/js/scripts.js"></script>
		<script type="text/javascript" src="<?php echo $url; ?>/js/ajax.js"></script>
	</body>
</html>