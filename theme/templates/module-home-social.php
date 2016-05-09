<?php
if (count($displayedSocials)) : ?>
<div class="row social-networks-section">
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
<?php endif; ?>
