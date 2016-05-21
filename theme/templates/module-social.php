<?php if (is_main_site()) : ?>

<li>
	<a href="https://www.facebook.com/NuitDebout" target="_blank" title="Facebook" class="social-icons social-icons-bigger"><i class="ic-facebook_rounded"></i></a>
</li>
<li>
	<a href="https://twitter.com/nuitdebout" target="_blank" title="Twitter" class="social-icons social-icons-bigger"><i class="ic-twitter_rounded"></i></a>
</li>
<li>
	<a href="/periscope" title="Periscope" class="social-icons social-icons-bigger"><i class="ic-periscope_rounded"></i></a>
</li>

<?php else : ?>

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
<?php endif; ?>
