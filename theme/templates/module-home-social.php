<?php

$displayedSocials = [
	'twitter' => array(
		'name' => 'Twitter',
		'url' => 'https://twitter.com/nuitdebout',
		'icon' => 'ic-twitter'
	),
	'facebook' => array(
		'name' => 'Facebook',
		'url' => 'https://www.facebook.com/NuitDebout',
		'icon' => 'ic-facebook'
	),
	'bambuser' => array(
		'name' => 'Bambuser',
		'url' => 'http://bambuser.com/channel/nuitdebout',
		'icon' => 'ic-bambuser'
	),
	'instagram' => array(
		'name' => 'Instagram',
		'url' => 'https://www.instagram.com/nuitdebout',
		'icon' => 'ic-instagram'
	),
	'tumblr' => array(
		'name' => 'Tumblr',
		'url' => 'https://nuitdebout.tumblr.com/',
		'icon' => 'ic-tumblr'
	),
	'periscope' => array(
		'name' => 'Periscope',
		'url' => 'https://nuitdebout.fr/periscope/',
		'icon' => 'ic-periscope'
	),
	'snapchat' => array(
		'name' => 'Snapchat',
		'url' => 'https://www.snapchat.com/#nuitdebout',
		'icon' => 'ic-snapchat'
	),
	'scoopit' => array(
		'name' => 'Scoopit',
		'url' => 'http://www.scoop.it/t/nuit-debout',
		'icon' => 'ic-scoopit'
	),
	'github' => array(
		'name' => 'Github',
		'url' => 'https://github.com/nuitdebout',
		'icon' => 'ic-github'
	),
	'reddit' => array(
		'name' => 'Reddit',
		'url' => 'https://www.reddit.com/r/nuitdebout/',
		'icon' => 'ic-reddit'
	),
];

if (count($displayedSocials)) : ?>
	<section class="section">
		<div class="section__title">Réseaux sociaux</div>
		<div class="social-networks-section">
			<?php foreach ( $displayedSocials as $key => $socialConfig ) : ?>
				<a href="<?php echo $socialConfig['url']; ?>" target="_blank"
				   class="social-networks-section-item social-networks-section-item--<?php echo $key ?>">
					<i class="social-networks-section-item__icon <?= $socialConfig['icon'] ?>" ></i>
					<div class="social-networks-section-item__name">
						<?php echo $socialConfig['name']; ?>
					</div>
				</a>
			<?php endforeach; ?>
			<div class="social-networks-section-item social-networks-section-item--nuitdebout">
				<img class="social-networks-section-item__image" alt="Nuitdebout"
					 src="<?php echo get_stylesheet_directory_uri() ?>/dist/images/logowhite.svg" />
				<div class="social-networks-section-item__name">est partout</div>
			</div>
		</div>
	</section>
<?php endif; ?>
