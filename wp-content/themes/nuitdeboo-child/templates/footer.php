<footer class="content-info">
	<div class="container">
		<div class="row foot">

			<div class="foot-left col-xs-12 col-sm-4">
				<h5>#NuitDebout</h5>
				<ul class="list-unstyled list-inline">
				<?php get_template_part('templates/module', 'social'); ?>
				</ul>
				<h5>Liens</h5>
				<?php
		        if (has_nav_menu('footer_navigation')) :
		        	wp_nav_menu(['theme_location' => 'footer_navigation', 'menu_class' => 'list-unstyled']);
		        endif;
		        ?>
			</div>

			<div class="col-xs-12 col-sm-4">
				<h5>Voir aussi</h5>
				<a title="CONVERGENCE DES LUTTES" target="_blank" href="https://www.convergence-des-luttes.org/">
					<img alt="CONVERGENCE DES LUTTES" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/CONVERGENCE-DES-LUTTES.png"/>
				</a>
				<?php dynamic_sidebar('sidebar-footer'); ?>
			</div>

			<div class="col-xs-12 col-sm-4">
				<h5>A propos</h5>
				<?php
		        if (has_nav_menu('footer_colophon_navigation')) :
		        	wp_nav_menu(['theme_location' => 'footer_colophon_navigation', 'menu_class' => 'list-unstyled']);
		        endif;
		        ?>
				<h5>Contribuer</h5>
				<div class="contribute">
					<ul class="social-networks list-inline">
						<li>
							<a title="wiki"  href="http://wiki.nuitdebout.fr" target="_blank" class="social-icons social-icons-bigger wiki">
								<i alt="wiki nuitdebout" class="ic-wiki_rounded"></i>
							</a>
						</li>
						<li>
							<a title="github" href="https://github.com/nuitdebout/" target="_blank" class="social-icons social-icons-bigger github">
								<i alt="github" class="ic-github_rounded"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
