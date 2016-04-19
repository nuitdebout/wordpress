<div id="socialhome">
	<div class="container padded">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
    			<h2>R&eacute;seaux sociaux</h2>
        </div>
		</div>
	</div>
	<div class="social-networks-section">
			<?php
				$sc = array(
							'twitter'=> array(
								'name'=>'Twitter',
								'icon' => 'fa fa-twitter'
							),
							'facebook' => array(
								'name'=>'Facebook',
								'icon' => 'fa fa-facebook'
							),
							'bambuser'=> array(
								'name'=>'Bambuser',
								'icon' => ''
							),
							'youtube'=> array(
								'name'=>'Youtube',
								'icon' => 'fa-youtube-play'
							),
							'instagram'=> array(
								'name'=>'Instagram',
								'icon' => 'fa fa-instagram'
							),
							'tumblr'=> array(
								'name'=>'Tumblr',
								'icon' => 'fa fa-tumblr'
							),
							'periscope'=> array(
								'name'=>'Periscope',
								'icon' => ''
							),
							'snapchat'=> array(
								'name'=>'Snapchat',
								'icon' => 'fa fa-snapchat-ghost'
							),
							'scoopit'=> array(
								'name'=>'Scoopit',
								'icon' => ''
							),
							'github'=> array(
								'name'=>'Github',
								'icon' => 'fa fa-github'
							),
							'reddit'=> array(
								'name'=>'Reddit',
								'icon' => 'fa'
							),
							'nuitdebout'=> array(
								'icon' => '',
								'name' => 'est partout',
								'image' => 'logowhite.svg'
							),
				);

			foreach ( $sc as $key => $socialConfig ) :
				if( get_field('social_'.$key, 'option') ) : ?>
					<a href="<?php echo get_field('social_'.$key, 'option'); ?>" target="_blank"
						class="social-networks-section-item social-networks-section-item--<?php echo $key ?>">
							<i class="social-networks-section-item__icon fa fa-<?= $socialConfig['icon'] ?>" ></i>
							<div class="social-networks-section-item__name">
								<?php echo $socialConfig['name']; ?>
							</div>
						</a>
					<?php
				endif;
				if ($key === 'nuitdebout') {
				?>
					<div class="social-networks-section-item social-networks-section-item--<?php echo $key ?>">
						<img class="social-networks-section-item__image" alt="<?php echo $key ?>"
								 src="<?php echo get_stylesheet_directory_uri() . '/assets/images/' . $socialConfig['image'] ?>" />
						<div class="social-networks-section-item__name">
							<?php echo $socialConfig['name']; ?>
						</div>
					</div>
				<?php
				}
			endforeach;
			?>
	</div>
</div>
