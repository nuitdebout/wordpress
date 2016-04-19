<!-- Static navbar -->
<header class="banner">
  <nav class="navbar-nuitdebout navbar-nuitdebout-fixed">
      <div class="container navbar-nuitdebout-container">
        <a id="logo-container" href="/#top">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logoblack.svg" class="navbar-nuitdebout-logo" alt="Nuit Debout"/>
        </a>
         <?php
         if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
         endif;
         ?>
      </div>
   </nav><!--/.nav-collapse -->
</header>
