<h2>Réseaux sociaux</h2>
<div class="social-networks-section">
	<?php
	$socials = array(
		'facebook' => 'facebook',
		'twitter' => 'twitter',
		'bambuser' => 'ban',
		'youtube' => 'youtube-play',
		'instagram' => 'instagram',
		'tumblr' => 'tumblr',
		'periscope' => 'ban',
		'snapchat' => 'snapchat-ghost',
		'scoopit' => 'ban',
		'github' => 'github'
	);
	foreach ( $socials as $name => $icon ) :
		if( get_field('social_'.$name, 'option') ) : ?>
			<a href="<?php echo get_field('social_'.$name, 'option'); ?>" target="_blank"
				 class="social-networks-section-item social-networks-section-item--<?= $name ?>">
					<i class="social-networks-section-item__icon fa fa-<?= $icon ?>" ></i>
					<div class="social-networks-section-item__name">
						<?= $name ?>
					</div>

			</a>
			<?php
		endif;
	endforeach;
	?>
</div>
