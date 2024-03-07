<!doctype html>
<html>
<head>
	<title>
		<?php the_title(); ?>
	</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="theme-color" content="#48242e"/>
	<?php wp_head(); ?>
	<script>var wpurl = '<?php bloginfo( 'template_url' ); ?>';</script>
	<link rel="stylesheet" href="<?php path('css/common.css') ?>">
	<link rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
	<link rel="preload"
		as="style"
		href="" />
	<link rel="stylesheet"
		href=""
		media="print" onload="this.media='all'" />
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
	
</header>