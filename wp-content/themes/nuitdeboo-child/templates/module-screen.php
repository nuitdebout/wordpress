<?php
	if ( get_field('homepage_screen', 'option') ) {
		// Temporary
		$homepage_bg = get_field('homepage_screen', 'option');
		?>
		<div class="homepagescreen">
			<div class="row-----">
				<div class="col-xs-12">
         			<div class="banner-homepage" style="
                      background: url(<?= $homepage_bg['url'] ?>);
                      background-size: cover !important;
                      background-position: center center;
                      background-repeat: no-repeat;">
            			<div class="text-center container">
              				<div id="nuitdeboutdate">
              				</div>
              				<div id="site_title">
               					<h1>
                  					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logowhite.svg" class="nd_header__brand" alt="Nuit Debout"/>
                				</h1>
              				</div>
              				<div id="sentencerotate"></div>
            				</div>
          				</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
?>