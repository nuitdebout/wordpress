<ul class="social-networks social-networks-picto list-inline">
	<?php
	$sc = get_social_array(array('facebook', 'twitter', 'periscope'));
	foreach ( $sc as $key => $socialConfig  ) :
		if( get_field('social_'.$key, 'option') ) : ?>
			<li>
				<a href="<?php echo get_field('social_'.$key, 'option'); ?>" target="_blank" class="social-icons <?php echo $value ?>">
					<i class="fa fa-<?php echo $key ?>"></i>
				</a>
			</li>
			<?php
		endif;
	endforeach;
	?>
</ul>
