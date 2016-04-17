<div class="container">
	<div class="page-header">
		<h2>Réseaux sociaux</h2>
	</div>
</div>

<div class="social-networks-section">
	<?php
	// @todo move in a config file
	$socials = array(
		'twitter' => [
			'icon' => 'twitter',
		],
		'facebook' =>  [
			'icon' => 'facebook',
		],
		'bambuser' =>  [
			'icon' => 'ban',
		],
		'youtube' =>  [
			'icon' => 'youtube-play',
		],
		'instagram' =>  [
			'icon' => 'instagram',
		],
		'nuitdebout' => [
			'url' => 'http://www.nuitdebout.fr',
			'image' => 'logowhite.svg',
			'title' => 'dans le monde',
			'special' => true
		],
		'fluxtwitter' => [
			'url' => 'http://www.nuitdebout.fr',
			'title' => 'Flux twitter',
			'special' => true
		],
		'tumblr' =>  [
			'icon' => 'tumblr',
		],
		'periscope' =>  [
			'icon' => 'ban',
		],
		'snapchat' =>  [
			'icon' => 'snapchat-ghost',
		],
		'scoopit' =>  [
			'icon' => 'ban',
		],
		'github' =>  [
			'icon' => 'github'
		],
	);

	function getSocialLink($socialConfig, $name) {
		if ($socialConfig['url']) {
			return $socialConfig['url'];
		}

		return get_field('social_'.$name, 'option');
	}



	foreach ( $socials as $name => $socialConfig ) :
		if( get_field('social_'.$name, 'option') || $socialConfig['special'] ) : ?>
			<a href="<?php echo getSocialLink($socialConfig, $name) ?>" target="_blank"
				 class="social-networks-section-item social-networks-section-item--<?= $name ?>">

		 		<?php if ($socialConfig['icon']) { ?>
					<i class="social-networks-section-item__icon fa fa-<?= $socialConfig['icon'] ?>" ></i>
				<?php } else if ($socialConfig['image']) { ?>
					<img class="social-networks-section-item__image" alt="<?= $name ?>"
							 src="<?= get_stylesheet_directory_uri() . '/assets/images/' . $socialConfig['image'] ?>" />
				<?php } ?>

				<div class="social-networks-section-item__name">
					<?= $socialConfig['title'] ? $socialConfig['title'] : $name ?>
				</div>
			</a>
			<?php
		endif;
	endforeach;
	?>
</div>
