<ul class="nav navbar-nav navbar-right">
	<?php
	$sc = get_social_array(array('facebook', 'twitter', 'periscope'));
	foreach ( $sc as $key => $socialConfig  ) :
		if( get_field('social_'.$key, 'option') ) : ?>
			<li>
				<a href="<?php echo get_field('social_'.$key, 'option'); ?>" target="_blank" title="<?php echo $socialConfig['name'] ?>" class="social-icons social-icons-bigger <?php echo $value ?>">
					<i class="ic-<?php echo $key ?>_rounded"></i>
				</a>
			</li>
			<?php
		endif;
	endforeach;
	?>
</ul>
