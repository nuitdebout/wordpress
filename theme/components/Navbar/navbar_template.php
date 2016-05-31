<nav class="nd-navbar">

	<div class="nd-navbar__item nd-navbar__toggle">
		<div class="menu-button">
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


	<div class="nd-navbar__item nd-navbar__item--navigation" id="main-nav">

		<img class="mobile-navigation-image" src="<?php echo $mobileNavImg ?>" alt="" />

		<div class="menu-top-container">
			<?php
				wp_nav_menu([
					'theme_location' => 'primary_navigation',
					'container' => 'div',
					'menu_class' => 'primary-nav',
					'depth' => 3,
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
