
<!-- Static navbar -->
<header class="banner">
		<nav class="navbar-nuitdebout navbar-nuitdebout-fixed">
	      <div class="container navbar-nuitdebout-container">
		       <a id="logo-container" href="/#top">
	            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logoblack.svg" class="navbar-nuitdebout-logo" alt="Nuit Debout"/>
		       </a>
	        <div class="nav-left col-md-8">
	        <?php
	        if (has_nav_menu('primary_navigation')) :
	          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
	        endif;
			?>
			</div>
	        <div class="nav-right text-right col-md-4" >
	        	<?php  get_template_part('templates/module', 'social');
			?>
			</div>
	      </div>
		</nav><!--/.nav-collapse -->
</header>

