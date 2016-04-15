<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

  <meta name="description" content="<?php bloginfo( 'description' ); ?>">

  <!-- Place favicon.ico in the root directory , both file are missing ! cc @graphistes-->

  <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon.png">
  <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/logo2.png" type="image/ico" />


  <!--Import Google Icon Font-->
  <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <meta property="og:locale" content="fr_FR"> <!-- a tester : <?php bloginfo( 'language' ); ?> !-->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php bloginfo( 'name' ); ?> - Nuit Debout">
  <meta property="og:description" content="<?php bloginfo( 'description' ); ?> - Chaque jour, nous sommes des milliers à occuper l’espace public pour reprendre notre place dans la République. Rejoignez-nous, et décidons ensemble de notre devenir commun dans ce mouvement politique sans parti ni bannières.">
  <meta property="og:url" content="<?php bloginfo( 'url' ); ?>">
  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/img/headertest.jpg">
  <script type="text/javascript" id="gretaScript" src="https://cdn.greta.io/greta.min.js" data-ac="db56c2f2489199823062893e30e03720"></script>
	<?php wp_head(); ?>



</head>
<body class="grey-text text-darken-4">
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
        <!--[if lt IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <div class="navbar-fixed">
          <nav role="navigation">
            <div class="nav-wrapper">
	            <a id="logo-container" href="#" class="brand-logo">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logoblack.svg" class="navbar__logo" alt="Nuit Debout"/>
	            </a>
             	<div class="container">
	                <ul class="hide-on-med-and-down">
	                  <li><a href="#header">Le mouvement</a></li>
	                  <li><a href="#calendar">Programme</a></li>
	                  <li><a href="#participate">Participer</a></li>
	                  <li><a href="#assembly">Rassemblements</a></li>
	                  <li><a href="https://wiki.nuitdebout.fr" target="_blank" >WIKI</a></li>
	                </ul>

	                <ul id="nav-mobile" class="side-nav">
	                  <li><a href="#header">Le mouvement</a></li>
	                  <li><a href="#calendar">Programme</a></li>
	                  <li><a href="#participate">Participer</a></li>
	                  <li><a href="#assembly">Rassemblements</a></li>
	                  <li><a href="https://wiki.nuitdebout.fr" target="_blank" >WIKI</a></li>

	                </ul>
	                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons grey-text">menu</i></a>
              	</div>

             	<div class="social-networks">
                <?php 
	              // ACF plugin test.
                // if( get_option('options_social_instagram')){
                //  echo get_option('options_social_instagram');
                //}
               ?>
		 					<a href="https://www.facebook.com/NuitDebout/" target="_blank" class="social-icons facebook">
		                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_fb_light.svg" />
		                    </a>
		                    <a href="https://twitter.com/nuitdebout" target="_blank" class="social-icons twitter ">
		                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_twitter_light.svg" />
		                    </a>
		                    <a href="https://www.periscope.tv/RemyBuisine" target="_blank" class="social-icons periscope ">
		                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_periscope.svg" />
		                    </a>

		                     <a href="https://github.com/nuitdebout/nuitdebout.github.io" target="_blank" class="social-icons github  ">
		                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_github_light.svg" />
		                    </a>
						

              	</div>
            </div>
          </nav>
        </div>

        <div class="toolbar">

          <ul>
            <li>
              <a href=""></a>
            </li>

            <li>
              <a href=""></a>
            </li>
          </ul>

        </div>

       