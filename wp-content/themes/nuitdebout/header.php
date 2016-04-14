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
                <a href="https://www.facebook.com/NuitDebout/" target="_blank" class="social-icons facebook">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_fb.svg" /> 
                </a>
                <a href="https://twitter.com/nuitdebout" target="_blank" class="social-icons twitter  hide-on-small-only">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_twitter.svg" />
                </a>
                <a href="https://www.periscope.tv/RemyBuisine" target="_blank" class="social-icons periscope  hide-on-small-only">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_periscope_2.svg" />
                </a>

                 <a href="https://github.com/nuitdebout/nuitdebout.github.io" target="_blank" class="social-icons github  hide-on-small-only">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/icons/ic_github_dark.svg" />
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

        <div class="section no-pad-bot valign-wrapper nd_header">
          <div class="nd_header__img"> </div>
          <div class="container white-text valign" style="z-index: 2">

            <h1 class="header center  nd_brand white-text
            nd_header__cta"><img class="nd_header__brand" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logowhite.svg" alt="Nuit Debout"></h1>
            <h4 class="nd_header__quote header white-text">
              <small></small>
            </h4>
            <div class="row center">
              <a href="http://petition.nuitdebout.fr" class="btn-large waves-effect waves-light indigo">Signer la pétition</a>
            </div>
          </div>

          <a class="nd_header__radio_link  hide-on-small-only" alt="radio debout" href="#radio"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/radio.svg" style="width:100%;height:100%;"></a>
        </div>


        <div id="header" class="section">
          <div class="container center">

            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/manifesto.svg" class="hide-on-med-and-up" style="height: 50px;">

            <h2 class="center nd_brand">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/manifesto.svg" class="hide-on-small-only" style="height: 50px;">
              Manifeste
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/manifesto.svg" class="hide-on-small-only" style="height: 50px; transform: rotateY(180deg);">
            </h2>

            <div class="border-text">
              <p> <strong>Sais-­tu ce qui se passe là ? </strong> Des milliers de personnes se réunissent Place de la République à Paris, et dans toute la France, depuis le 31 mars. Des assemblées se forment où les gens discutent et échangent. Chacun se réapproprie la parole et l’espace public.</p>

              <p>Ni entendues ni représentées, des personnes de tous horizons reprennent possession de la réflexion sur l’avenir de notre monde. La politique n’est pas une affaire de professionnels, <strong>c’est l’affaire de tous</strong>. L’humain devrait être au cœur des préoccupations de nos dirigeants. Les intérêts particuliers ont pris le pas sur l’intérêt général.</p>

              <p><strong>Chaque jour, nous sommes des milliers à occuper l’espace public pour reprendre notre place dans la République.</strong> Venez nous rejoindre, et décidons ensemble de notre devenir commun.</p>
            </div>

          </div>
        </div>