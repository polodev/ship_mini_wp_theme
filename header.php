<!DOCTYPE html>
<html <?php language_attributes();  ?> >
<head>
	<meta charset=<?php bloginfo('charset'); ?> />
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700|Roboto:400,700" rel="stylesheet">
	<link rel='stylesheet' href="<?php bloginfo('stylesheet_url') ?>"/>
	<?php wp_head(); ?>
</head>
<body>
	<div id='wrapper'>
		<header>
		<a href="<?php esc_url(bloginfo( 'home' ))  ?>">
			<img src="<?php echo get_header_image(); ?>" alt=''/>
		</a>
		</header>
		<main>
