<nav class="nd-navbar">

	<div class="nd-navbar__item nd-navbar__toggle">
		<div class="menu-button" data-toggle="class" data-target="#main-nav" data-class="open">
			<i class="fa fa-bars"></i>
		</div>
	</div>

	<div class="nd-navbar__item nd-navbar__item--logo">
		<a href="<?php echo home_url() ?>">
			<img src="<?php echo $logoImg ?>" class="navbar-nuitdebout-logo" alt="Nuit Debout" />

			<?php if (!is_main_site()) : ?>
				<a class="navbar-nuitdebout-bloginfo" href="<?php echo home_url() ?>">
					<?php echo get_bloginfo('name') ?>
				</a>
			<?php endif ?>
		</a>
	</div>


	<div class="nd-navbar__item nd-navbar__item--navigation" id="main-nav" data-remove-class-on-outside="open">

		<img class="mobile-navigation-image" src="<?php echo $mobileNavImg ?>" alt="" />

		<div class="menu-top-container">
			<?php
				wp_nav_menu([
					'theme_location' => 'primary_navigation',
					'container' => 'div',
					'menu_class' => 'primary-nav',
					'depth' => 2,
					'walker' => $walker,
				]);
			?>
		</div>
	</div>

	<div class="nd-navbar__item nd-navbar__item--social">
		<ul class="social-icon-list">
			<?php get_template_part('templates/module', 'social'); ?>
		</ul>
	</div>
</nav>
