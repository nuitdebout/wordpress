<?php
$displayedSocials = [];

$sc = get_social_array();
foreach ( $sc as $key => $socialConfig ) {
	if( is_page_template('page-ville.php') ){
		$key_name = $key.'_page_url';
		$val_key  = get_field($key_name);
	}
	else{
		$key_name = 'social_'.$key;
	    $val_key  = get_field($key_name, 'option');
	}

	if( $val_key ) {
		$socialConfig['url'] = $val_key;
		$displayedSocials[$key] = $socialConfig;
	} elseif ($key === 'nuitdebout' && !is_page_template('page-ville.php') ) {
		$displayedSocials[$key] = $socialConfig;
	}
}
if (count($displayedSocials)) : ?>
	<section class="section">
		<div class="section__title">Réseaux sociaux</div>
		<div class="social-networks-section">
			<?php
			foreach ( $displayedSocials as $key => $socialConfig ) :
				if( $key !== 'nuitdebout' ) : ?>
					<a href="<?php echo $socialConfig['url']; ?>" target="_blank"
					   class="social-networks-section-item social-networks-section-item--<?php echo $key ?>">
						<i class="social-networks-section-item__icon <?= $socialConfig['icon'] ?>" ></i>
						<div class="social-networks-section-item__name">
							<?php echo $socialConfig['name']; ?>
						</div>
					</a>
				<?php
				else:
					?>
					<div class="social-networks-section-item social-networks-section-item--<?php echo $key ?>">
						<img class="social-networks-section-item__image" alt="<?php echo $key ?>"
							 src="<?php echo get_stylesheet_directory_uri() . '/assets/images/' . $socialConfig['image'] ?>" />
						<div class="social-networks-section-item__name">
							<?php echo $socialConfig['name']; ?>
						</div>
					</div>
				<?php
				endif;
			endforeach;
			?>
		</div>
	</section>
<?php endif; ?>
