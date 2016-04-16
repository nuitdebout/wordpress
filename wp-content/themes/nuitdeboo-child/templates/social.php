<ul class="list-inline">
	<?php
	$sc = array(
		'facebook',
		'twitter'
	);
	foreach ( $sc as $value ) :
		if( get_field('social_'.$value, 'option') ) : ?>
			<li>
				<a href="<?php echo get_field('social_'.$value, 'option'); ?>" target="_blank" class="social-icons facebook">
					<i class="fa fa-<?php echo $value ?>"></i>
				</a>
			</li>
			<?php
		endif;
	endforeach;
	?>
</ul>