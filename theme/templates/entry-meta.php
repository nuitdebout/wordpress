<div class="byline author vcard">
    <?= __('By', 'sage'); ?>
    <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn">
        <?= get_the_author(); ?>
    </a>
</div>
<time class="updated" datetime="<?= get_post_time('c', true); ?>">
    <?= get_the_date(); ?>
</time>
<?php
/*
<div class="post-taxonomies">
$taxonomies = array('category', 'post_tag','media_category');
foreach( $taxonomies as $tax ) {
	echo '<div class="post-taxonomy post-taxonomy--'.$tax.'">';
	$categories = get_the_terms( $post->ID, $tax );
	foreach( $categories as $category ) {
	     echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
	}
	echo '</div>';
}
</div>
*/
?>
