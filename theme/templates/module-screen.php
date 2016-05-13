<div class="row homepagescreen">
	<div class="banner-homepage">
		<div class="text-center container">
			<div id="nuitdeboutdate"><?php echo nd_get_revolutionary_date(); ?></div>
			<div id="site_title">
				<?php if (is_main_site() && is_front_page()) : ?>
					<h1><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logowhite.svg" class="nd_header__brand" alt="Nuit Debout"/></h1>
					<div id="sentencerotate"></div>
				<?php elseif (is_home()) : ?>
					<h1 class="site-name CommuneFont"><?php echo get_bloginfo('name') ?></h1>
					<h2 class="site-description"><?php echo get_bloginfo('description') ?></h2>
				<?php elseif (is_page()) : ?>
					<h2 class="CommuneFont  CommuneFont-page_title"><?php echo get_the_title() ?></h2>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
