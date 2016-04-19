<div id="socialhome">
	<div class="container padded">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
    			<h2>R&eacute;seaux sociaux</h2>
        </div>
		</div>
	</div>
	<div class="socialonhome">
		<div class="row">
			<?php
				$sc = array(
							'facebook' => array(
								'key_' => 'facebook',
								'name'=>'Facebook',
								'icon' => 'fa fa-facebook'
							),
							'twitter'=> array(
								'key_' => 'twitter',
								'name'=>'Twitter',
								'icon' => 'fa fa-twitter'
							),
							'bambuser'=> array(
								'key_' => 'bambuser',
								'name'=>'Bambuser',
								'icon' => ''
							),
							'youtube'=> array(
								'key_' => 'youtube',
								'name'=>'Youtube',
								'icon' => 'fa-youtube-play'
							),
							'reddit'=> array(
								'key_' => 'reddit',
								'name'=>'Reddit',
								'icon' => 'fa'
							),
							'partout'=> array(
								'key_' => 'partout',
								'name'=>'<h3>Nuit debout <small>est partout</small></h3>',
								'icon' => ''
							),

							'instagram'=> array(
								'key_' => 'instagram',
								'name'=>'Instagram',
								'icon' => 'fa fa-instagram'
							),
							'tumblr'=> array(
								'key_' => 'tumblr',
								'name'=>'Tumblr',
								'icon' => 'fa fa-tumblr'
							),
							'periscope'=> array(
								'key_' => 'periscope',
								'name'=>'Periscope',
								'icon' => ''
							),
							'snapchat'=> array(
								'key_' => 'snapchat',
								'name'=>'Snapchat',
								'icon' => 'fa fa-snapchat-ghost'
							),
							'scoopit'=> array(
								'key_' => 'scoopit',
								'name'=>'Scoopit',
								'icon' => ''
							),
							'github'=> array(
								'key_' => 'github',
								'name'=>'Github',
								'icon' => 'fa fa-github'
							),
				);

			foreach ( $sc as $value  ) :
				if( get_field('social_'.$value['key_'], 'option') ) : ?>
					<div class="socialsquare col-xs-6 col-sm-4 col-md-2">
						<a href="<?php echo get_field('social_'.$value['key_'], 'option'); ?>" target="_blank" class="social-icons facebook">
							<i class="fa fa-<?php echo $value['icon']; ?>"></i><br /><?php echo $value['name']; ?>
						</a>
					</div>
					<?php
				endif;
				if( $value['key_'] == 'partout') : ?>
				<div class="socialsquare col-xs-6 col-sm-4 col-md-2">
						<?php echo $value['name']; ?>
				</div>
				<?php endif;
				endforeach;
			?>
		</div>
	</div>
</div>
