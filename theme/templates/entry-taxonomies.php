<?php
$taxonomies = [];
$types = array('category', 'post_tag','media_category');
foreach( $types as $tax ) {
	$categories = get_the_terms( $post->ID, $tax );
	if($categories){
		$taxonomies[$tax] = $categories;
	}
}
?>

<?php if ($taxonomies) : ?>
	<div class="post-taxonomies">
		<?php foreach( $taxonomies as $tax => $categories ) : ?>
			<span class="post-taxonomy post-taxonomy--<?php echo $tax ?>">
				<?php if($tax == 'category'): ?>
					<span>Classé dans </span>
				<?php endif; ?>
				<?php if($tax == 'post_tag'): ?>
					<span> | </span>
				<?php endif; ?>
				<?php foreach( $categories as $category ) : ?>
					<a href="<?php echo esc_url( get_category_link( $category->term_id ) )?>">
						<?php echo esc_html( $category->name ) ?>
					</a>
					<?php if($tax =='category' && $category !== end($categories)) : ?>,<?php endif; ?>
				<?php endforeach ?>
			</span>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
