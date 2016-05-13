<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	  <?php wp_head(); ?>
	  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/images/favicon.ico" />
	  <?php
	  $url = get_bloginfo('url');
	  $thumb = get_stylesheet_directory_uri().'/dist/images/nuitdebout-thumb.png';
	  $suffix = ' - nuitdebout.fr';
	  $title = get_bloginfo('name');
	  if( is_single() || is_page() ){
	  	  $title = get_the_title();
		  if ( has_post_thumbnail() ) {
			$thumb = getAttachmentThumb($post->ID);
		  }
		  $url = get_permalink();
	  }
	  $title .= $suffix;
	  ?>
	  <meta property="og:locale" content="fr_FR">
	  <meta property="og:type" content="website">
	  <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
	  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
	  <meta property="og:image" content="<?php echo $thumb ?>">
	  <meta property="og:title" content="<?php echo $title ?>">
	  <meta property="og:url" content="<?php echo $url ?>">
</head>
