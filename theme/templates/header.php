<!-- Static navbar -->
<header class="banner">
  <nav class="navbar navbar-nuitdebout navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="https://nuitdebout.fr">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logoblack.svg" class="navbar-nuitdebout-logo" alt="Nuit Debout"/>
        </a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<?php if (!is_main_site()) : ?>
				<ul class="nav navbar-nav navbar-left">
					<li><a class="navbar-nuitdebout-bloginfo" href="<?php echo home_url() ?>"><?php echo get_bloginfo('name') ?></a></li>
				</ul>
				<?php endif ?>

        <?php
        if (has_nav_menu('primary_navigation')) :
					wp_nav_menu([
						'theme_location' => 'primary_navigation',
						'depth' => 2,
						'container' => 'div',
						'menu_class' => 'nav navbar-nav menu-top',
						'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
						'walker' => new wp_bootstrap_navwalker(),
					]);
        endif;
        ?>

        <ul class="nav navbar-nav navbar-right">
        <?php get_template_part('templates/module', 'social'); ?>
        </ul>

      </div>
    </div>
  </nav><!--/.nav-collapse -->
</header>

