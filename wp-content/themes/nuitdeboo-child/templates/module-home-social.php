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
								'icon' => 'ic-twitter'
							),
							'facebook' => array(
								'name'=>'Facebook',
								'icon' => 'ic-facebook'
							),
							'bambuser'=> array(
								'name'=>'Bambuser',
								'icon' => 'ic-bambuser'
							),
							'youtube'=> array(
								'name'=>'Youtube',
								'icon' => 'ic-youtube'
							),
							'instagram'=> array(
								'name'=>'Instagram',
								'icon' => 'ic-instagram'
							),
							'tumblr'=> array(
								'name'=>'Tumblr',
								'icon' => 'ic-tumblr'
							),
							'periscope'=> array(
								'name'=>'Periscope',
								'icon' => 'ic-periscope'
							),
							'snapchat'=> array(
								'name'=>'Snapchat',
								'icon' => 'ic-snapchat'
							),
							'scoopit'=> array(
								'name'=>'Scoopit',
								'icon' => 'ic-scoopit'
							),
							'github'=> array(
								'name'=>'Github',
								'icon' => 'ic-github'
							),
							'reddit'=> array(
								'name'=>'Reddit',
								'icon' => 'ic-reddit'
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
							<i class="social-networks-section-item__icon <?= $socialConfig['icon'] ?>" ></i>
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
