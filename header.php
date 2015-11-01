<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php wp_title(' - ', true, 'right'); ?></title>
		
		<!-- :: GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400' rel='stylesheet' type='text/css'>

		<!-- :: ICONS -->
		<link rel="shortcut icon" href="<?= TEMPLATE_URI ?>/favicon.png" type="image/png">

		<!-- :: CSS -->
		<link rel="stylesheet" type="text/css" href="<?= TEMPLATE_URI ?>/css/layout.css">

		<?php wp_head();  ?>
	</head>
	<body>
			
			<!-- :: MAIN NAV -->
			<?php

				$nav_defaults = array(
					'container'       => false,
					'menu_class'      => 'nav',
					'echo'            => true,
					'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
					'menu'            => 'Main Menu'
				);

				wp_nav_menu( $nav_defaults );

			?>
			