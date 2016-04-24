<section id="socialhome" class="section section--gray">
	<h2 class="section__title">R&eacute;seaux sociaux</h2>
	<div class="social-networks-section">
			<?php
			$sc = get_social_array();


			foreach ( $sc as $key => $socialConfig ) :
				if( is_page_template('page-ville.php') ){
					$key_name = $key.'_page_url';
					$val_key  = get_field($key_name);

				}
				else{
					$key_name = 'social_'.$key;
				    $val_key  = get_field($key_name, 'option');

				}

				if( $val_key ) : ?>
					<a href="<?php echo $val_key; ?>" target="_blank"
						class="social-networks-section-item social-networks-section-item--<?php echo $key ?>">
							<i class="social-networks-section-item__icon <?= $socialConfig['icon'] ?>" ></i>
							<div class="social-networks-section-item__name">
								<?php echo $socialConfig['name']; ?>
							</div>
						</a>
					<?php
				endif;
				if ($key === 'nuitdebout' && !is_page_template('page-ville.php') ) {
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
</section>
