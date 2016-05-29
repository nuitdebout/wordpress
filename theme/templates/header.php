<?php use NuitDebout\Wordress\OpenAgenda; ?>

<?php if (is_main_site()) : ?>
	<?php get_template_part('templates/module', 'current-actions'); ?>
<?php endif ?>

<?php $logoImg =  get_stylesheet_directory_uri() . '/assets/images/logoblack.svg'; ?>
<?php $mobileNavImg =  get_stylesheet_directory_uri() . '/assets/images/headertest.jpg'; ?>

<header class="header">
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
			<ul id="menu-top" class="primary-nav">
				<li id="menu-item-323" class="menu-item active">
					<a href="/">En direct</a>
				</li>
				<li id="menu-item-324" class="menu-item">
					<a href="#" data-toggle="class" data-target="#menu-item-324" data-class="open">
						Decouvrir
					</a>

					<div class="navbar-subnav">
						<ul class="navbar-subnav-list">
							<li class="navbar-subnav-list__item">
								<a href="#">
									<i class="fa fa-times-circle-o "></i>
									Le mouvement
								</a>
							</li>
							<li class="navbar-subnav-list__item">
								<a href="#">
									<i class="fa fa-times-circle-o "></i>
									Les villes
								</a>
							</li>
							<li class="navbar-subnav-list__item">
								<a href="#">
									<i class="fa fa-times-circle-o "></i>
									Les commissions
								</a>
							</li>
							<li class="navbar-subnav-list__item">
								<a href="#">
									<i class="fa fa-times-circle-o "></i>
									Transparence
								</a>
							</li>
						</ul>
					</div>
				</li>
				<li id="menu-item-325" class="menu-item">
					<a href="/">Participer</a>
				</li>
				<li id="menu-item-326" class="menu-item">
					<a href="/">S'informer</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="nd-navbar__item nd-navbar__item--social">
		<ul class="social-icon-list">
			<?php get_template_part('templates/module', 'social'); ?>
		</ul>
	</div>
</nav>

</header>
