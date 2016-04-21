<footer class="content-info">
	<div class="container">
		<div class="row foot">

			<div class="col-xs-2 col-sm-4">
				<h5>#NuitDebout</h5>
				<?php get_template_part('templates/module', 'social'); ?>

			</div>

			<div class="col-xs-2 col-sm-4">
				<h5>Voir aussi</h5>
				<a target="_blank" href="https://www.convergence-des-luttes.org/">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/CONVERGENCE-DES-LUTTES.png"/>
				</a>
			</div>

			<div class="col-xs-2 col-sm-4">
				<?php dynamic_sidebar('sidebar-footer'); ?>

				<h5>Contribuer</h5>
				<div class="contribute">
					<ul class="social-networks list-inline">
						<li>
							<a href="http://wiki.nuitdebout.fr" target="_blank" class="social-icons wiki  ">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ic_wiki.svg" />
							</a>
						</li>
						<li>
							<a href="https://github.com/nuitdebout/" target="_blank" class="social-icons github  ">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ic_github_light.svg" />
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
