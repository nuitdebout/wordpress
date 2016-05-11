<div class="row homepagescreen">
	<div class="banner-homepage">
		<div class="text-center container">
			<div id="nuitdeboutdate"><?php echo nd_get_revolutionary_date(); ?></div>
			<div id="site_title">
				<?php if ($nuitDeboutIcon) : ?>
					<h1><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logowhite.svg" class="nd_header__brand" alt="Nuit Debout"/></h1>
				<?php endif ?>
				<?php if ($logoicon) : ?>
					<h1><img src="<?php echo $logoIcon ?>" class="nd_header__brand" alt="Nuit Debout"/></h1>
				<?php endif ?>
				<?php if ($title && ! $smallTitle) : ?>
					<h1 class="CommuneFont site-name"><?php echo $title ?></h1>
				<?php endif ?>
				<?php if ($title && $smallTitle) : ?>
					<h2 class="CommuneFont CommuneFont-page_title"><?php echo $title ?></h2>
				<?php endif ?>
				<?php if ($description) : ?>
					<h2 class="site-description"><?php echo $description ?></h2>
				<?php endif ?>
				<?php if ($sentenceRotate) : ?>
					<div id="sentencerotate"></div>
				<?php endif ?>
				<?php if (is_page_template('page-ville.php')) : ?>
					<div class="ville-screen_btns">
						<a class="primary-button space-right-btn" href="<?php echo $wiki_url ?>">Aller sur le wiki</a>
						<a class="primary-button " href="<?php echo $chat_url ?>">Aller sur le chat</a>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
