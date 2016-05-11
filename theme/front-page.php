<?php
/**
 * Template Name: page "home"
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php

if (!is_main_site()) :
	if (is_active_sidebar('homepage-top')) : ?>
		<div id="widget-homepage-top" class="section home-widget-container">
		<?php dynamic_sidebar('homepage-top') ?>
		</div>
	<?php endif;
	if (is_active_sidebar('homepage-one-half') || is_active_sidebar('homepage-two-half')) : ?>
		<div id="widget-homepage-half" class="section home-widget-container">
			<div class="container padded">
				<div class="row">
					<?php dynamic_sidebar('homepage-one-half') ?>
					<?php dynamic_sidebar('homepage-two-half') ?>
				</div>
			</div>
		</div>
	<?php endif;
	if (is_active_sidebar('homepage-one-third') || is_active_sidebar('homepage-two-third') || is_active_sidebar('homepage-three-third')) : ?>
		<div id="widget-homepage-third" class="section home-widget-container">
			<div class="container padded">
				<div class="row">
					<?php dynamic_sidebar('homepage-one-third') ?>
					<?php dynamic_sidebar('homepage-two-third') ?>
					<?php dynamic_sidebar('homepage-three-third') ?>
				</div>
			</div>
		</div>
	<?php endif;
		include get_home_template();
		dynamic_sidebar('homepage-bottom');
	if (!is_paged() && get_field('global_module_social', 'option') == 'oui') :
		get_template_part('templates/module', 'home-social');
	endif;
else :

	get_template_part('templates/module', 'screen');
	get_template_part('templates/module', 'manifesto');
	get_template_part('templates/module', 'news');
	if( !is_paged() && get_field('global_module_social', 'option') == 'oui' ) {
		get_template_part('templates/module', 'home-social');
	}
	get_template_part('templates/module', 'rassemblements');
	if (!is_paged() && get_field('homepage_module_global', 'option') == 'oui') {
		get_template_part('templates/module', 'global');
	}
	get_template_part('templates/module', 'agenda');

	if ( !is_paged() && get_field('homepage_module_free_iframe_1', 'option') ) {
		get_template_part('templates/module', 'free_iframe_1');
	}
	if ( !is_paged() &&get_field('homepage_module_free_iframe_2', 'option') ) {
		get_template_part('templates/module', 'free_iframe_2');
	}

endif;
?>
